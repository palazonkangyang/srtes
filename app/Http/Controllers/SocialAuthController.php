<?php

namespace App\Http\Controllers;


use Laravel\Socialite\Facades\Socialite;
use App\Core\PresenterCore;
use App\Core\ControllerCore;
use App\Factories\TypeFactory;
use App\Factories\ModelFactory;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\ChangePasswordRequest;
use Illuminate\Http\Request;
use Auth;
use Hash;
use Session;
use Response;
use Carbon\Carbon;
use Storage;
use Mail;

class SocialAuthController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */

  public function redirect()
  {
    return Socialite::driver('google')->redirect();
  }

/**
 * Expands the home directory alias '~' to the full path.
 * @param string $path the path to expand.
 * @return string the expanded path.
 */

  public function callback()
  {
    $googleuser = Socialite::driver('google')->user();
    $client = new \Google_Client();
    $client->setApplicationName('Redcross');
    $scopes = array('https://www.googleapis.com/auth/admin.directory.user','https://www.googleapis.com/auth/admin.directory.userschema');
    $configPath = public_path().'/client_secret.json';
    $client->setAuthConfig($configPath);
    $client->setScopes($scopes);
    $user_to_impersonate = 'palazon@redcross.sg';
    $client->setSubject($user_to_impersonate);
    $dir = new \Google_Service_Directory($client);
    $optParams = array('projection' => 'full');
    $r = $dir->users->get($googleuser->email, $optParams);

    if(!$r['customSchemas']['AccessSrcams']['srcams'])
    {
      return redirect('/login')
              ->withErrors([
                  'email' => 'Your account didnt have access to AMS which ticked by administrator in google admin, please check with administrator' ,
              ]);
    }

    $userexist = ModelFactory::getInstance('User')
                  ->where('emailadd','=',$googleuser->email)
                  ->first();

    if($userexist)
    {
      $user = ModelFactory::getInstance('User')
              ->where('emailadd','=',$googleuser->email)
              ->first()->toarray();

      $userfixpassword = ModelFactory::getInstance('User')
                        ->findOrNew($user['idsrc_login']);

      $userfixpassword->passwd = bcrypt('nopassword');
      $userfixpassword->save();

      if (Auth::attempt(['loginid' => $user['loginid'] , 'password' => 'nopassword', 'isactive' => 1]))
      {
        $userupdatepostlogin = ModelFactory::getInstance('User')
                                ->findOrNew(Auth::User()->idsrc_login);

        $userupdatepostlogin->postlogin = date('Y-m-d H:i:s');

        if($userupdatepostlogin->save())
        {
          return redirect()->intended('/dashboard');
        }
      }

      // when google call us a with token
    }

    else
    {
      return redirect('/login')
              ->withErrors([
                  'email' => 'Your account didnt been created on the approval management system, please check with administrator' ,
              ]);
    }
  }
}
