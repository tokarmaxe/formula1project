<?php

namespace App\Components\User\Models;

//use App\Components\User\Services\Request;
//use App\Components\User\Services\Response;
use App\Components\User\Services\UserContract;
use App\Components\User\Services\UserServiceContract;
use Illuminate\Http\Request as Request;
use Illuminate\Http\Response as Response;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Auth;
use Socialite;


class UserService implements UserServiceContract
{
    private $user;


    public function __construct(UserContract $user)
    {
        $this->user=$user;
    }

    public function socialSignIn(Request $request, Response $response = null)
    {

        $expiredDate = date('Y-m-d h:i:s',strtotime(
            '+'.Config::get('services.validity.access_token').' day'));
        $clientServiceID = Config::get('services.google.client_id');
        $driver = Socialite::driver('google');
        $client = new \Google_Client();
        //gets Id token from request
        $idToken=$request->header('Authorization');
        $idToken=str_replace('Beare','',str_replace(" ","", $idToken));
        $clientEmail = $request->input('email');
        if (isset($idToken)) {
            //gets client or exeption - 404
            //$client = $driver->userFromToken($idToken);
            //$clientEmail = $client->getEmail();
        //    $client->setDeveloperKey($clientServiceID);
          //  $payload = $client->verifyIdToken($idToken);
//mok
            $clientEmail ='sklyack@gmail.com';
           // if ($payload) {
                if (User::where('email', '=', $clientEmail)->exists()) {
                    $user = User::Where('email', '=', $clientEmail)->first();
                    /* We need just only generate acces_token
                    if(!Auth::loginUsingId($user->id)){
                        return response()->json([
                            'failed'
                        ], 403);
                    }*/

                    //   $autorizedUser = User::where('id', Auth::user()->id)->first();
                    $user->access_token = mt_rand(5, 5555555512233);
                    $user->expired_at = $expiredDate;
                    $user->save();
            //    }


               // $updateLastLoginDate->save();

              //  $activeAccount = Auth::user();
              //  $activeAccount->active = '1';
              //  $activeAccount->save();

            }
        }








        return response()->json([
            'acces_token' => ''.$user->access_token.''
        ],200);



    }


    public function testResponse () {
        return response()->json([
            'name' => 'Abigail',
            'state' => 'CA'
        ]);

    }
}