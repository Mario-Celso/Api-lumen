<?php


namespace App\Http\Controllers;


use App\Services\TokenManagement\TokenManager;
use App\User;
use Carbon\Carbon;
use function hash;
use Illuminate\Http\Request;
use Illuminate\Validation\UnauthorizedException;


class AuthController extends Controller
{
    public function authenticate(Request $request)
    {
        $this->validate($request,
            [
            'email' => 'required|email',
            'pass_user' => 'required'
            ]);

        //search user
        $passHash = hash('sha512', $request->input('pass_user').env('APP_KEY'));
        $user = User::query()->where([
            'email' => $request->input('email'),
            'pass_user' => $passHash])->first();

       // validate user
        if ((!$user)) {
            throw new UnauthorizedException("user");
        }


        $user->last_activity_on = Carbon::now('America/Sao_Paulo')->format('Y-m-d H:i:s.u');
        $user->logged = true;
        $user->save();


        //generate token
        $tokenGen = new TokenManager($user);
        $tokenGen->generate();


        return response([
            'name' => $user->full_name,
            'token' => $tokenGen->token], 200);

    }

    public function logout(Request $request)
    {
        $user = $request->user();

        $user->logged = false;

        $user->save();

        return response([
            'message' => trans('messages.logout')
        ], 200);
    }
}
