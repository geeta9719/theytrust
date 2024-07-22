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


    $publicDomains = [
        'gmail.com', 'yahoo.com', 'hotmail.com', 'outlook.com', 'aol.com', 'icloud.com',
        'mail.com', 'gmx.com', 'zoho.com', 'yandex.com', 'protonmail.com', 'me.com', 'mac.com',
        'fastmail.com', 'hushmail.com', 'msn.com', 'live.com', 'comcast.net', 'verizon.net',
        'att.net', 'bellsouth.net', 'btinternet.com', 'cox.net', 'earthlink.net', 'optonline.net',
        'qq.com', '163.com', '126.com', 'sina.com', 'sohu.com', 'tutanota.com', 'mail.ru',
        'inbox.ru', 'bk.ru', 'list.ru', 'mailinator.com', 'yopmail.com', 'guerrillamail.com',
        '10minutemail.com', 'temp-mail.org', 'throwawaymail.com', 'maildrop.cc', 'dispostable.com',
        'sharklasers.com', 'fakeinbox.com', 'mintemail.com', 'mytemp.email', 'noip.com',
        'jetable.org', 'trashmail.com', 'getnada.com', 'tempail.com', 'mailcatch.com',
        'tempinbox.com', 'tempmailaddress.com', 'emailondeck.com',
        'gawab.com', 'web.de', 't-online.de', 'freenet.de', 'gmx.de', 'gmx.at', 'gmx.ch',
        'bluewin.ch', 'seznam.cz', 'centrum.cz', 'post.cz', 'volny.cz', 'atlas.cz', 'email.cz',
        'laposte.net', 'orange.fr', 'free.fr', 'sfr.fr', 'voila.fr', 'wanadoo.fr', 'libero.it',
        'virgilio.it', 'tin.it', 'alice.it', 'telecomitalia.it', 'tiscali.it', 'email.it',
        'email.hu', 'onet.pl', 'interia.pl', 'wp.pl', 'o2.pl', 'gazeta.pl', 'tlen.pl',
        'poczta.onet.pl', 'poczta.fm', 'eclipso.de', 'hush.com', 'inbox.lv', 'inbox.ru', 'mail.kz',
        'mail.pl', 'qip.ru', 'ukr.net', 'webmail.co.za', 'netvigator.com', 'netcabo.pt', 'net.hr',
        'netzero.com', 'privaterelay.appleid.com', 'proxymail.appleid.com', 'lavabit.com',
        'runbox.com', 'vfemail.net', 'safe-mail.net', 'inbox.lt', 'online.ms', 'mailbox.org',
        'mailvault.com', 'orci.com', 'orci.co', 'offshore.co', 'orci.biz', 'orci.link', 'anonmail.de',
        'secure-mail.biz', 'secure-mail.cc', 'secure-mail.ch', 'secure-mail.net', 'secure-mail.pro',
        'anonymousemail.me', 'disposablemail.com', 'privatdemail.net', 'nomail.xl.cx', 'hoopoe.ru',
        'anonmails.de', 'anomail.xyz', 'inbox.lt', '5mail.cf', 'getairmail.com', 'spambog.com',
        'dispostable.com', 'guerrillamailblock.com', 'nowmymail.com', 'yepmail.com', 'findermail.com',
        'mail-temporaire.fr', 'mohmal.com', 'anonymbox.com', 'meltmail.com', 'mailsac.com',
        'spamex.com', 'spamgourmet.com', 'spam4.me', '33mail.com', 'dodsi.com', 'tempail.com',
        'tempmailaddress.com', 'throwawaymail.com', 'emailondeck.com', 'privaterelay.appleid.com',
        'proxymail.appleid.com', 'relay.privacy.mail.yahoo.com', 'eclipso.de', 'mailo.com',
        'hey.com', 'mailbox.org', 'protonmail.ch', 'posteo.net', 'disroot.org', 'mailfence.com',
        'riseup.net', 'cryptoservice.org', 'sicher-mail.de', 'dispostable.com', 'guerrillamail.com',
        '10minutemail.net', 'getairmail.com', 'mytemp.email', 'noip.com', 'jetable.org', 'trashmail.com',
        'maildrop.cc', 'sharklasers.com', 'fakeinbox.com', 'mintemail.com', 'tempmail.net',
        'nospam.com', 'mailnesia.com', 'mailinator.com', 'tempmail.org', 'tempmailaddress.com',
        'emailondeck.com', 'spambox.us', 'guerrillamail.com', 'dispostable.com', 'spambog.com',
        'tempail.com', 'tempinbox.com', 'spamex.com', 'spamgourmet.com', 'spam4.me', '33mail.com',
        'dodsi.com', 'inbox.ru', 'ya.ru', 'bk.ru', 'list.ru', 'pochta.ru', 'yandex.ru', 'eclipso.de',
        'mailo.com', 'yandex.ru', 'mail.ru', 'inbox.ru', 'bk.ru', 'list.ru', 'pochta.ru',
        'yepmail.com', 'mail-temporaire.fr', 'mohmal.com', 'anonymbox.com', 'meltmail.com',
        'inbox.lt', 'secure-email.org', 'safe-mail.net', 'offshore.co', 'orci.com', 'orci.biz',
        'orci.link', 'nomail.xl.cx', 'hoopoe.ru', 'anonmails.de', 'anomail.xyz', 'spambog.com',
        'dispostable.com', 'sharklasers.com', 'tempmailaddress.com', 'emailondeck.com',
        'privaterelay.appleid.com', 'proxymail.appleid.com', 'relay.privacy.mail.yahoo.com'
        // Add more public domains as needed
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


    // If validation passes, create new user
    $user = User::create([
        'first_name' => $request->input('first_name'),
        'last_name' => $request->input('last_name'),
        'email' => $request->input('email'),
        'password' => bcrypt($request->input('password')),
    ]);

    Auth::login($user);

    // Additional logic (e.g., login user, send verification email)
    return redirect(url('user/' . $user->id . '/basicInfo?profile=basic'));

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

    // Attempt to log the user in
    $credentials = $request->only('email', 'password');

    if (Auth::attempt($credentials)) {
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


}