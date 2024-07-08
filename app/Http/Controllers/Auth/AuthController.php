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
use Illuminate\Support\Facades\Mail;

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
    // Validate incoming request
    $validator = Validator::make($request->all(), [
        'first_name' => 'required|string|max:255',
        'last_name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email', // Ensure email is unique in users table
        'password' => 'required|string|min:8',
    ]);

    if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput()->with('showModal', true);
    }


    // If validation passes, create new user
    $user = User::create([
        'first_name' => $request->input('first_name'),
        'last_name' => $request->input('last_name'),
        'email' => $request->input('email'),
        'password' => bcrypt($request->input('password')),
    ]);

    Auth::login($user);

    // Additional logic (e.g., login user, send verification email)

    return redirect()->route('home')->with('success', 'Sign up successful!');
}

}