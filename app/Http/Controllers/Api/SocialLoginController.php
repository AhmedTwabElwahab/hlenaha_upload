<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\SocialLoginRequest;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Hash;
use Kreait\Firebase\Contract\Auth as FirebaseAuth;

class SocialLoginController extends Controller
{
    use AuthenticatesUsers;

    protected $auth;
    protected $redirectTo = RouteServiceProvider::HOME;

    public function __construct(FirebaseAuth $auth)
    {
        $this->auth = $auth;
    }

    public function socialLogin(SocialLoginRequest $request)
    {
        $socialTokenId = $request->input('access_token', '');
        try {
            $verifiedIdToken = $this->auth->verifyIdToken($socialTokenId);
            $email = $verifiedIdToken->claims()->get('email');
            if ($email !== null)
            {
                $user  = User::where('email', $email)->first();
                if (!$user)
                {
                    $user = new User();
                    $user->name       = $verifiedIdToken->claims()->get('name');
                    $user->email      = $verifiedIdToken->claims()->get('email');
                    $user->fcm_token  = $socialTokenId;
                    $user->uuid       = $verifiedIdToken->claims()->get('user_id');
                    $user->password   = Hash::make('jjuuoii23');
                    $user->save();
                }
                else
                {
                    $user->fcm_token  = $socialTokenId;
                    $user->update();
                }
                //Login user
                auth()->login($user);

                if (auth()->check())
                {
                    return response()->json([
                        'message' => 'Logged in successfully',
                        'data' => ['token' => auth()->user()->createToken('API Token')->plainTextToken],
                    ]);
                } else {
                    return $this->error(
                        message: 'Failed to Login try again',
                        code: 401
                    );
                }
            }

        } catch (\InvalidArgumentException $e)
        {
            return redirect()->route('login');
        } catch (InvalidToken $e)
        {
            return redirect()->route('login');
        }
    }
}
