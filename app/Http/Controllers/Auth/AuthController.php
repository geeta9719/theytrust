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


use Socialite;
use Auth;
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



            Session::forget( 'claim_profile_id' );

            if( !empty( $user_id_to_be_claimed ) )
            {
                
                $existingUser = User::where('email', $user->email)->first();
                if ($existingUser && $existingUser->id !== $user_id_to_be_claimed) {
                    $company = Company::where('user_id', $user_id_to_be_claimed)->first();
                     $companySlug = str_replace('+', '-', strtolower(html_entity_decode(urlencode($company['name']))));
                     return Redirect::to(route('profile', $companySlug))->with('message', 'You have already claimed a listing. One id can claim only one listing. Please connect with support in case of any query/doubt.');

                }

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
                    $company = Company::where('user_id', $user_id_to_be_claimed)->first();
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
        dd($e,$e->getMessage());
    }
}


/* --------------------------------------------------------------------------------- */


    public function redirectToLinkedin()
    {
        return Socialite::driver( 'linkedin' )->redirect();
    }


    public function handleLinkedinCallback()
    {  
        try 
        {
            $user       = Socialite::driver( 'linkedin' )->user();    
            $finduser   = User::where( 'linkedin_id', $user->id )->first();


            if( $finduser )
            {
                Auth::login( $finduser );
                return redirect( str_replace( url('/'), '', session( 'referer' ) ) );
            }
            else
            {
                $newUser = User::create([
                                            'name'          => $user->name,
                                            'email'         => $user->email,
                                            'linkedin_id'   => $user->id,
                                            'first_name'    => $user->first_name,
                                            'last_name'     => $user->last_name,
                                            'avatar'        => $user->avatar,
                                            'role'          => 2,
                                            'slug'          => 'User',
                                        ]);
                
                Auth::login( $newUser );
                
                return redirect( str_replace( url( '/' ), '', session( 'referer' ) ) );
            }
            
        } 
        catch ( Exception $e ) 
        {
            dd( $e );
        }
    }
}