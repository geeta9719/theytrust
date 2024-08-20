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


    public function redirectToLinkedinClaimProfile( $user_id )
    {
        Session::put('claim_profile_id', $user_id );
        return Socialite::driver( 'linkedin2' )->redirect(); 
    }

    public function handleLinkedinCalimYourProfile()
{
    try 
    {
        $user = Socialite::driver('linkedin2')->user();
        $user_id_to_be_claimed = Session::get('claim_profile_id');
        Session::forget('claim_profile_id');

        if (!empty($user_id_to_be_claimed)) 
        {
            $user_to_be_claimed = User::where('id', $user_id_to_be_claimed)->first();

            if (!empty($user_to_be_claimed)) 
            {
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

                if ($user_to_be_claimed->save()) 
                {
                    // Send email notification
                    Mail::to($user_to_be_claimed->email)->send(new ProfileClaimed());

                    // Login the user
                    Auth::login($user_to_be_claimed);

                    return redirect()->back()->with('message', 'Yay.. You have successfully claimed this profile.');
                } 
                else 
                {
                    return redirect(url('/error'));
                }
            }
        }
    } 
    catch (Exception $e) 
    {
        dd("Sdfsdf");
        dd($e,$e->getMessage());
    }
}


/* --------------------------------------------------------------------------------- */


    public function redirectToLinkedin()
    {
        return Socialite::driver( 'linkedin' )->redirect();
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
    try 
    {
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
    } 
    catch (\Throwable $e) 
    {
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
        'gmail.com', 'yahoo.com', // (other domains...)
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

    // Auth::login($user);
    Mail::to($user->email)->send(new VerificationEmail($user));

    return redirect()->back()->with('success', 'Email has been sent.')->with('showModal', true);
}

public function loginWithEmail(Request $request)
{
    // Validate the incoming request data
    $validator = Validator::make($request->all(), [
        'email' => 'required|email',
        'password' => 'required|string|min:8',
    ]);

    if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput()->with('showModal', 'login');
    }


    $user = User::where('email', $request->input('email'))->first();

    if ($user && !$user->hasVerifiedEmail()) { // Assuming hasVerifiedEmail() method is defined
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


}