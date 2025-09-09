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
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Models\Company;
use PDF;
use App\Helpers\CompanyPointHelper;

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
            $user = auth()->user();
            $company = Company::where('user_id', auth()->id())->first();
            $plan = PlanModel::find($request->plan_id);
            $redirectUrl = url('company/' . $company->id . '/dashboard');
            if ($plan->price == 0) {
                $subscription = $user->subscribeTo($plan, $plan->duration, false);
                return response()->json(['status' => 'success', 'is_free' => true, 'redirect_url' => $redirectUrl]);

            }
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
                'success_url' => url('company/' . $company->id . '/dashboard'),
                'cancel_url' => url('/'),
            ]);
            // dd($session);
            return response()->json(['status' => 'success', 'sessionId' => $session->id]);
        }
        catch (ApiErrorException $e) {
            dd($e);
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
        }
        catch (\Exception $e) {
            dd($e);
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
        }
    }

    public function choosePlan(Request $request)
    {
        try {
            Log::info('Webhook event handled PLan  - Type:');
            $request->validate([
                'plan_id' => 'required|string',
                'user_id' => 'required|integer',
            ]);
            $session = $this->createCheckoutSession($request);
            return response()->json(['status' => 'success', 'sessionId' => $session]);
        }
        catch (\Exception $e) {
            dd($e->$e->getMessage());
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
        }
    }

    public function handle(Request $request)
    {
        Log::info("Webhook event handled :", $request->all());

        $payload = $request->getContent();
        $sigHeader = $request->header('Stripe-Signature');
        $endpointSecret = config('whsec_WSCssGdchSw7TYICEmaf1IIybWPvvAJv'); // Replace with your webhook secret

        try {
            $event = Event::constructFrom(json_decode($payload, true), $sigHeader, $endpointSecret);
        }
        catch (\UnexpectedValueException $e) {
            return response()->json(['error' => 'Invalid payload'], 400);
            Log::info('Webhook event handled successfully - Type: ', $e);
        }
        catch (\Stripe\Exception\SignatureVerificationException $e) {
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

            Log::info('ddddddddddddddddddddddddddddddddd points updated: ');

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
            $subscription = $this->subscribeToPlan($plan, $user, false);
            $invoice = $this->makeInvoiceData([
                'number'          => 'INV-' . strtoupper(substr($paymentIntent->id ?? uniqid(), -8)),
                'date'            => now()->format('Y-m-d'),
                'status'          => $paymentStatus,
                'payment_method'  => $paymentIntent->charges->data[0]->payment_method_details->type ?? 'Stripe',
                'currency'        => strtoupper($currency),
                'currency_symbol' => in_array(strtolower($currency), ['usd']) ? '$' : (strtolower($currency) === 'inr' ? '₹' : strtoupper($currency).' '),
                'tx_id'           => $paymentIntent->id ?? null,
                'item_title'      => 'TheyTrustUs Membership',
                'item_desc'       => $plan->description ?? '',
                'plan_name'       => $plan->name ?? 'Plan',
                'amount'          => $amount,
                // 'discount'      => 0.00,
                // 'tax'           => 0.00,
            ]);



            
            $this->sendEmailWithPdf($user->id, $invoice); // <-- pass the invoice array you built

            // Log::info('userIduser: ',$userId,";;;;;");
            $company = Company::where('user_id', $userId)->first();
            // Log::info('userIduserId: ',$company->id,$company[0],";;;;;");
            // Log::info('companycompanycompanycompanycompany points updated: ',$company->id,$plan->name,";;;;;");
            if ($company->id) {
                $membershipPointsResult = CompanyPointHelper::processMembershipPoints($company->id, $plan->name);
                Log::info('Membership points updated: ', $membershipPointsResult);
            }

            // }
        }
        catch (\Exception $e) {
            Log::error('Error in handleAllowedEvents: ' . $e->getMessage());
            // Optionally, you can throw the exception again if you want it to propagate to the outer catch block
            // throw $e;
        }
    }

    public function sendEmailWithPdf($userId, array $invoice)
{
    try {
        $user = User::findOrFail($userId);
        $pdfContent = $this->generatePdf($user, $invoice);

        Mail::send([], [], function ($message) use ($user, $pdfContent) {
            $message->to($user->email)
                    ->subject('TheyTrustUs — Invoice')
                    ->attachData($pdfContent, 'invoice.pdf', ['mime' => 'application/pdf']);
        });

        return "Email sent successfully";
    } catch (\Exception $e) {
        Log::error('sendEmailWithPdf error: ' . $e->getMessage());
        return "Email failed: " . $e->getMessage();
    }
}


    public function generatePdf(User $user, array $invoice)
    {
        $pdf = PDF::loadView('invoicePDF', compact('user', 'invoice'));
        return $pdf->output(); // raw PDF bytes
    }

    public function subscribeToPlan(PlanModel $plan, User $user)
    {
        try {
            $subscription = $user->subscribeTo($plan, $plan->duration, false);
            return response()->json(['message' => 'Subscription successful']);
        }
        catch (\Exception $e) {
            dd($e);
            return response()->json(['error' => 'Subscription failed: ' . $e->getMessage()], 500);
        }
    }

    function makeInvoiceData(array $overrides = []): array
    {
        // Sensible defaults; override from Stripe PI/Plan where available
        $defaults = [
            'number'          => 'INV-' . strtoupper(uniqid()),
            'date'            => now()->format('Y-m-d'),
            'status'          => 'succeeded',          // or canceled/payment_failed
            'payment_method'  => 'Stripe',
            'currency'        => 'usd',
            'currency_symbol' => '$',                  // simple map below if you want
            'tx_id'           => null,
            'item_title'      => 'TheyTrustUs Membership',
            'item_desc'       => '',
            'plan_name'       => 'Plan',
            'amount'          => 0.00,
            'discount'        => 0.00,
            'tax'             => 0.00,
            'total'           => 0.00,
        ];
    
        $data = array_merge($defaults, $overrides);
        if (empty($data['total'])) {
            $data['total'] = ($data['amount'] - ($data['discount'] ?? 0)) + ($data['tax'] ?? 0);
        }
        return $data;
    }
}


