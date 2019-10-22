<?php


namespace App\Services\TokenManagement;


use App\User;
use Firebase\JWT\JWT;


class TokenManager
{
    /**
     * @var User
     */
    private $user;

    /**
     * @var string
     */
    public $token;


    /**
     * TokenGenerator constructor.
     * @param User $user
     */
    public function __construct(User $user) {
        $this->user = $user;
    }

    public function generate() : void
    {
        $payload = [
        'userId' => $this->user->id
    ];

        $key = env('APP_KEY');

        $this->token = JWT::encode($payload, $key);
    }
}
