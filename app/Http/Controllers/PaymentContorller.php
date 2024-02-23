<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Rennokki\Plans\Models\PlanModel;
use Stripe\Checkout\Session;
use Illuminate\Support\Facades\Auth;
use Stripe\Stripe;
use Stripe\Event;
use Illuminate\Support\Facades\Log;
use App\Models\Transaction;
use Illuminate\Support\Facades\DB;
use Rennokki\Plans\Traits\HasPlans;
use App\Models\User;
use Rennokki\Plans\Events\NewSubscription;
use Rennokki\Plans\Traits\PlanSubscriptionModel;
use Dompdf\Dompdf;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Mail;
use PDF;
// use App\Http\Controllers\PDF;

class PaymentContorller extends Controller
{
    public function checkout()
    {
        $users = Auth::user();
        $plans = PlanModel::all();
        return view('checkout', compact('users', 'plans'));
    }

    public function createCheckoutSession(Request $request)
    {
        try {
            Stripe::setApiKey(config('services.stripe.secret'));
            $plan = PlanModel::find($request->plan);
            $lineItems = [
                [
                    'price_data' => [
                        'currency' => $plan->currency,
                        'product_data' => [
                            'name' => $plan->name,
                            'description' => 'Your product description here',
                        ],
                        'unit_amount' => $plan->price * 100,
                    ],
                    'quantity' => 1,
                ],
            ];
            $user = auth()->user();
            $clientReferenceId = $user ? $user->id : null;
            $metadata = [
                'metadata' => [
                    'plan_id' => $plan->id,
                    'user_id' => $user->id,
                ],
            ];

            $session = Session::create([
                'payment_method_types' => ['card'],
                'line_items' => $lineItems,
                'client_reference_id' => json_encode($metadata),
                'payment_intent_data' => $metadata,
                'mode' => 'payment',
                'success_url' => url('user/' . $user->id . '/basicInfo?profile=basic'),
                'cancel_url' => url('/'),
            ]);
            return response()->json(['status' => 'success', 'sessionId' => $session->id]);
        } catch (ApiErrorException $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
        }
    }

    public function choosePlan(Request $request)
    {
        try {
            Log::info('Webhook event handled PLan  - Type:');
            $request->validate([
                'plan' => 'required|string',
                'user_id' => 'required|integer',
            ]);
            $session = $this->createCheckoutSession($request);
            return response()->json(['status' => 'success', 'sessionId' => $session]);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
        }
    }

    public function handle(Request $request)
    {
        Log::info("Webhook event handled :",$request->all());
    
        $payload = $request->getContent();
        $sigHeader = $request->header('Stripe-Signature');
        $endpointSecret = config('we_1OUSmQSBpRscNHwBYng6RvEl'); // Replace with your webhook secret
    
        try {
            $event = Event::constructFrom(json_decode($payload, true), $sigHeader, $endpointSecret);
        } catch (\UnexpectedValueException $e) {
            return response()->json(['error' => 'Invalid payload'], 400);
            Log::info('Webhook event handled successfully - Type: ', $e);
        } catch (\Stripe\Exception\SignatureVerificationException $e) {
            Log::info('Webhook event handled successfully - Type: ', $e);
            return response()->json(['error' => 'Invalid signature'], 400);
        }
        switch ($event->type) {
            case 'payment_intent.succeeded':
                $this->handleAllowedEvents($event);
                break;
            // case 'payment_intent.payment_failed':
            //     $this->handleAllowedEvents($event);
            //     break;
            // default:
            //     Log::info('Ignoring event type: ' . $event->type);
            //     break;
        }
    
        return response()->json(['success' => true]);
    }
    
    private function handleAllowedEvents(Event $event)
    {
        try {
            $paymentIntent = $event->data->object;
            $paymentStatus = $paymentIntent->status;
            // if (in_array($paymentStatus, ['succeeded', 'canceled', 'payment_failed'])) {
                $amount = $paymentIntent->amount;
                $currency = $paymentIntent->currency;
                // Extract metadata
                $metadata = $paymentIntent->metadata;
                $planId = $metadata->plan_id ?? null;
                $userId = $metadata->user_id ?? null;
    

                // Use a database transaction to ensure data integrity
                DB::transaction(function () use ($paymentStatus, $amount, $currency, $planId, $userId) {
                    // Create a new transaction record
                    $transaction = new Transaction();
                    $transaction->payment_status = $paymentStatus;
                    $transaction->amount = $amount;
                    $transaction->currency = $currency;
                    $transaction->plan_id = $planId;
                    $transaction->user_id = $userId;
                    $transaction->save();
                });
                $plan = PlanModel::find($planId);
                $user = User::find($userId);
                $subscription = $this->subscribeToPlan($plan,$user,false);
                $this->sendEmailWithPdf($user->id);

            // }
        } catch (\Exception $e) {
            Log::error('Error in handleAllowedEvents: ' . $e->getMessage());
            // Optionally, you can throw the exception again if you want it to propagate to the outer catch block
            // throw $e;
        }
    }

    public function sendEmailWithPdf($userId) {
        try{
            $user = User::findOrFail($userId); 
            $pdfContent = $this->generatePdf($user);

            $data =    Mail::send([], [], function ($message) use ($user, $pdfContent) {
                $message->to($user->email)
                        ->subject('User Details PDF')
                        ->attachData($pdfContent, 'user_details.pdf', [
                            'mime' => 'application/pdf',
                        ]);
            });
            // dd($data);
        }catch(\Exception $e) {
            dd($e);
            // Log::error('Error in handleAllowedEvents: ' . $e->getMessage());

        }
    
        return "Email sent successfully";
    }

    public function generatePdf($user){
        // dd($user);
        $pdf = PDF::loadView('invoicePDF', [$user]);
        return $pdf->download('invoice.pdf');

    }

    public function subscribeToPlan(PlanModel $plan,User $user){
    try 
    {
        $subscription = $user->subscribeTo($plan,$plan->duration,false);
        return response()->json(['message' => 'Subscription successful']);
    } catch (\Exception $e) {
        dd($e);
        return response()->json(['error' => 'Subscription failed: ' . $e->getMessage()], 500);
    }
}
}
