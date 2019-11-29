<?php


namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Contracts\Auth\UserProvider as BaseProvider;
use Illuminate\Contracts\Auth\Authenticatable;

class UserProvider implements BaseProvider
{
    /**
     * The User Model
     */
    private $model;

    /**
     * Create a new mongo user provider.
     *
     * @param User $userModel
     */
    public function __construct(User $userModel)
    {
        $this->model = $userModel;
    }

    /**
     * Retrieve a user by the given credentials.
     *
     * @param  array  $credentials
     * @return Authenticatable|null
     */
    public function retrieveByCredentials(array $credentials)
    {
        if (empty($credentials)) {
            return;
        }
        $user = User::where(['email' => $credentials['email']])->first();
        //TODO: will remove when implement call authenticate api of <Deliveree>
//        $user = factory('App\Models\User')->create([
//            'email' =>"test@ssdsd.com",
//            "password" => md5("123")
//        ]);

        return $user;
    }

    /**
     * Validate a user against the given credentials.
     *
     * @param Authenticatable $user
     * @param  array  $credentials  Request credentials
     * @return bool
     */
    public function validateCredentials(Authenticatable $user, Array $credentials)
    {
        return ($credentials['email'] == $user->getAuthIdentifier() &&
            md5($credentials['password']) == $user->getAuthPassword());
    }

    public function retrieveById($identifier) {
        // TODO: Implement retrieveById() method.
        $user = User::where('id', $identifier)->first();
        return $user;
    }

    public function retrieveByToken($identifier, $token) {
        // TODO: Implement retrieveByToken() method.
    }

    public function updateRememberToken(Authenticatable $user, $token) {}
}