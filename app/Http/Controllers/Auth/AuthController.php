<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\Company;
use Illuminate\Support\Facades\Redirect;
use App\Events\UserLoggedIn;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Mail\VerificationEmail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Carbon\Carbon;
use App\Mail\WelcomeEmail;
use Log;
use Illuminate\Support\Facades\Password;



use Socialite;
//use Auth;
use Exception;
use Session;
use Cookie;

class AuthController extends Controller
{

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    //protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }


    public function redirectToLinkedinClaimProfile($user_id)
    {
        Session::put('claim_profile_id', $user_id);
        return Socialite::driver('linkedin2')->redirect();
    }

    public function handleLinkedinCalimYourProfile()
    {
        try {
            $user = Socialite::driver('linkedin2')->user();
            $user_id_to_be_claimed = Session::get('claim_profile_id');
            Session::forget('claim_profile_id');

            if (!empty($user_id_to_be_claimed)) {
                $user_to_be_claimed = User::where('id', $user_id_to_be_claimed)->first();

                if (!empty($user_to_be_claimed)) {
                    $existingUser = User::where('email', $user->email)->first();
                    if ($existingUser && $existingUser->id !== $user_id_to_be_claimed) {
                        $company = Company::where('user_id', $user_id_to_be_claimed)->first();
                        $companySlug = str_replace('+', '-', strtolower(html_entity_decode(urlencode($company['name']))));
                        return Redirect::to(route('profile', $companySlug))->with('message', 'You have already claimed a listing. One id can claim only one listing. Please connect with support in case of any query/doubt.');
                    }

                    // Update user details
                    $user_to_be_claimed->name = $user->name;
                    $user_to_be_claimed->email = $user->email;
                    $user_to_be_claimed->linkedin_id = $user->id;
                    $user_to_be_claimed->first_name = $user->first_name;
                    $user_to_be_claimed->last_name = $user->last_name;
                    $user_to_be_claimed->avatar = $user->avatar;
                    $user_to_be_claimed->role = 2;
                    $user_to_be_claimed->slug = 'User';

                    if ($user_to_be_claimed->save()) {
                        // Send email notification
                        Mail::to($user_to_be_claimed->email)->send(new ProfileClaimed());

                        // Login the user
                        Auth::login($user_to_be_claimed);

                        return redirect()->back()->with('message', 'Yay.. You have successfully claimed this profile.');
                    } else {
                        return redirect(url('/error'));
                    }
                }
            }
        } catch (Exception $e) {
            dd("Sdfsdf");
            dd($e, $e->getMessage());
        }
    }


    /* --------------------------------------------------------------------------------- */


    public function redirectToLinkedin()
    {
        return Socialite::driver('linkedin')->redirect();
    }


    // public function handleLinkedinCallback()
    // {  
    //     try 
    //     {
    //         $user       = Socialite::driver( 'linkedin' )->user();    
    //         $finduser   = User::where( 'linkedin_id', $user->id )->first();

    //         if( $finduser )
    //         {
    //             Auth::login( $finduser );
    //             return redirect( str_replace( url('user/' . $user->id . '/basicInfo?profile=basic'), '', session( 'referer' ) ) );
    //         }
    //         else
    //         {
    //             $newUser = User::create([
    //                                         'name'          => $user->name,
    //                                         'email'         => $user->email,
    //                                         'linkedin_id'   => $user->id,
    //                                         'first_name'    => $user->first_name,
    //                                         'last_name'     => $user->last_name,
    //                                         'avatar'        => $user->avatar,
    //                                         'role'          => 2,
    //                                         'slug'          => 'User',
    //                                     ]);

    //             Auth::login( $newUser );



    //             return redirect(url('user/' . $newUser->id . '/basicInfo?profile=basic'));
    //             // return redirect( str_replace( url( '/membership-plans' ), '', session( 'referer' ) ) );
    //         }

    //     } 
    //     catch ( Exception $e ) 
    //     {
    //         dd( $e );
    //     }
    // }

    public function handleLinkedinCallback()
    {
        try {
            $user = Socialite::driver('linkedin')->user();
            $finduser = User::where('linkedin_id', $user->id)->first();

            if ($finduser) {
                Auth::login($finduser);
                return redirect(str_replace(url('user/' . $user->id . '/basicInfo?profile=basic'), '', session('referer')));
            } else {
                $newUser = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'linkedin_id' => $user->id,
                    'first_name' => $user->first_name,
                    'last_name' => $user->last_name,
                    'avatar' => $user->avatar,
                    'role' => 2,
                    'slug' => 'User',
                ]);

                Auth::login($newUser);
                return redirect(url('user/' . $newUser->id . '/basicInfo?profile=basic'));
            }
        } catch (\Throwable $e) {
            Log::error('LinkedIn callback error', [
                'exception' => $e,
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            // Retry logic in case of temporary issues
            sleep(2); // Wait for 2 seconds before retrying
            try {
                $user = Socialite::driver('linkedin')->user();
                $finduser = User::where('linkedin_id', $user->id)->first();

                if ($finduser) {
                    Auth::login($finduser);
                    return redirect(str_replace(url('user/' . $user->id . '/basicInfo?profile=basic'), '', session('referer')));
                } else {
                    $newUser = User::create([
                        'name' => $user->name,
                        'email' => $user->email,
                        'linkedin_id' => $user->id,
                        'first_name' => $user->first_name,
                        'last_name' => $user->last_name,
                        'avatar' => $user->avatar,
                        'role' => 2,
                        'slug' => 'User',
                    ]);

                    Auth::login($newUser);
                    return redirect(url('user/' . $newUser->id . '/basicInfo?profile=basic'));
                }
            } catch (\Throwable $e) {
                Log::error('LinkedIn callback retry error', [
                    'exception' => $e,
                    'message' => $e->getMessage(),
                    'trace' => $e->getTraceAsString(),
                ]);
                return redirect('/login')->with('error', 'Unable to authenticate using LinkedIn. Please try again later.');
            }
        }
    }

    public function signupWithEmail(Request $request)
    {
        $publicDomains = [
            'gmail.com',
            'yahoo.com',
        ];

        $email = $request->input('email');
        $domain = substr(strrchr($email, "@"), 1);

        // Validate incoming request
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email', // Ensure email is unique in users table
            'password' => 'required|string|min:8',
        ]);

        if (in_array($domain, $publicDomains)) {
            $validator->after(function ($validator) {
                $validator->errors()->add('email', 'Public email addresses are not allowed.');
            });
        }

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput()->with('showModal', true);
        }

        // Generate verification token and expiration date
        $verificationToken = Str::random(32);
        $tokenExpiresAt = Carbon::now()->addDays(7);

        // If validation passes, create new user
        $user = User::create([
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
            'verification_token' => $verificationToken,
            'token_expires_at' => $tokenExpiresAt,
        ]);
        Mail::to($user->email)->send(new VerificationEmail($user));
        return redirect()->back()->with('showModal', 'verifyEmail')->with('user', $user);
    }

    public function resendVerificationEmail($email)
    {
        // Find the user by email
        $user = User::where('email', $email)->first();

        // If the user is found and not verified
        if ($user && !$user->hasVerifiedEmail()) {
            // Regenerate verification token and update the user
            $verificationToken = Str::random(32);
            $tokenExpiresAt = Carbon::now()->addDays(7);

            $user->update([
                'verification_token' => $verificationToken,
                'token_expires_at' => $tokenExpiresAt,
            ]);

            // Resend the verification email
            Mail::to($user->email)->send(new VerificationEmail($user));
            return redirect()->back()->with('showModal', 'verifyEmail')->with('user', $user);
        }

        return redirect()->back()->with('error', 'Unable to resend verification email.');
    }


    public function loginWithEmail(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string|min:8',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput()->with('showModal', 'login');
        }


        $user = User::where('email', $request->input('email'))->first();

        if ($user && !$user->hasVerifiedEmail()) {
            return redirect()->back()
                ->withInput($request->only('email'))
                ->withErrors([
                    'email' => 'Your email is not verified. Please check your inbox for the verification link.',
                ])
                ->with('showModal', 'login');
        }

        // Attempt to log the user in
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            Auth::login($user);
            // Authentication passed...
            return redirect()->intended('/'); // Change 'dashboard' to your intended route
        }



        // Authentication failed...
        return redirect()->back()
            ->withInput($request->only('email'))
            ->withErrors([
                'email' => 'The provided credentials do not match our records.',
            ])
            ->with('showModal', 'login');
    }

    public function verifyEmail($token)
    {

        $user = User::where('verification_token', $token)->first();

        if (!$user || $user->token_expires_at < Carbon::now()) {
            return redirect('/')->with('error', 'Invalid or expired verification token.');
        }

        $user->verification_token = null;
        $user->token_expires_at = null;
        $user->email_verified_at = Carbon::now();
        $user->save();
        Auth::login($user);
        Mail::to($user->email)->send(new WelcomeEmail($user));
        return redirect(url('user/' . $user->id . '/basicInfo?profile=basic'));
    }
    public function sendResetLinkEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        // Check if the email exists in the database
        $status = Password::sendResetLink(
            $request->only('email')
        );

        // Get the email entered by the user
        $userEmail = $request->input('email');

        // Retrieve the user by email to pass it along with the redirect
        $user = User::where('email', $userEmail)->first();

        // If reset link was sent successfully, send a custom mail to additional recipients
        if ($status === Password::RESET_LINK_SENT) {
            // Send mail to additional recipients

            Mail::to($userEmail)->send(new ResetPasswordMail($userEmail));

            // Redirect back with the modal, showing the 'verifyEmail' and passing user data
            return redirect()->back()->with('showModal', 'verifyEmail')->with('user', $user);
        }

        return redirect()->back()->withErrors(['email' => __($status)]);
    }
    public function showResetForm($token)
    {
        // Fetch the email from the query string
        $email = request()->query('email');

        // Verify the token and email format (optional)
        if (!$token || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return redirect()->route('login')->withErrors(['error' => 'Invalid reset token or email.']);
        }

        // Simulate retrieving a user based on email (optional, you may need to fetch an actual user)
        $user = User::where('email', $email)->first();

        // Redirect back with modal, token, and user data
        return redirect('/')->with('showModal', 'resetPasswordModal')->with('user', $user)->with('token', $token)->with('email', $email);
    }
    public function reset(Request $request)
    {
        // Validate the incoming request for password reset
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'setpassword' => 'required|confirmed', // Validate setpassword as it is the custom field
        ]);
    
        // Prepare the input data by adding 'password' from 'setpassword'
        $credentials = $request->only('email', 'token', 'password_confirmation');
        $credentials['password'] = $request->input('setpassword'); // Add the custom field as 'password'
    
        // Attempt to reset the user's password
        $status = Password::reset(
            $credentials, // Pass the credentials with the 'password' field
            function ($user, $password) {
                // Set the user's password with the provided 'password'
                $user->password = Hash::make($password);
                $user->verification_token = null;
                $user->token_expires_at = null;
                $user->email_verified_at = Carbon::now();
                $user->save();
    
                // Optionally, login the user after reset
                Auth::login($user);
            }
        );
    
        // If the password was successfully reset
        if ($status == Password::PASSWORD_RESET) {
            return redirect()->back()->with([
                'showModal' => 'resetPasswordModal',
                'statusset' => __('Password has been updated successfully.')
            ]);
        }
    
        // If there were errors, return to the modal with errors
        return redirect()->back()->withErrors(['email' => [__($status)]])
            ->withInput($request->only('email'))
            ->with([
                'showModal' => 'resetPasswordModal'
            ]);
    } 
    
}
