<?php


namespace App\Services\TokenManagement;


use App\User;
use Carbon\Carbon;
use Exception;
use Firebase\JWT\JWT;

class TokenHandler
{

    public function handle($token)
    {
        $key = env('APP_KEY');



        // trying if the token is a valid jwt AND has a valid date
        try {

            //checking the jwt token
            $decoded = JWT::decode($token, $key, ['HS256']);

            //passing all, return the logged user
            $user = User::query()->where([
                "active" => 1,
                "id" => $decoded->userId,
            ])
//                ->whereRaw('age(now(), last_activity_on) <= ?', ['6 hours'])
               ->get()->first();

//            dd($user->toArray);


            if ($user) {
                $user->last_activity_on = Carbon::now('America/Sao_Paulo');
                $user->save();
            }
            return $user;

        } catch (Exception $e)
        {
            return null;
        }
    }
}
