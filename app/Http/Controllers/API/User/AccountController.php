<?php

namespace App\Http\Controllers\API\User;

use App\Components\ApiCounter;
use App\Components\RandomGenerator;
use App\Exceptions\ApiKeyNotDefinedException;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserActivation;
use App\Http\Requests\UserRegistration;
use App\Http\Requests\UserUpdate;
use App\Http\Resources\SecretQuestionResource;
use App\Http\Resources\UserResource;
use App\Models\Backoffice\SecretQuestion;
use App\Models\Backoffice\Role;
use Cartalyst\Sentinel\Checkpoints\NotActivatedException;
use Illuminate\Http\Request;
use Mockery\Exception;
use Tymon\JWTAuth\Exceptions\UserNotDefinedException;
use Tymon\JWTAuth\Facades\JWTAuth;

use Tymon\JWTAuth\Exceptions\JWTException;

use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Cartalyst\Sentinel\Laravel\Facades\Activation;
use Cartalyst\Sentinel\Laravel\Facades\Reminder;
use App\Models\User;
use Illuminate\Validation\ValidationException;
use App\Components\Notifier;
use Validator;

use App\Http\Requests\PasswordResetStepOne;
use App\Http\Requests\PasswordResetStepTwo;


/**
 * This controller uses by anyone for auth
 *
 * Class AccountController
 * @package App\Http\Controllers\Auth
 */
class AccountController extends Controller
{
    /**
     * Create a new AccountController instance.
     *
     * @return void
     */
    public function __construct(Request $request)
    {
        $this->middleware('auth:api', [
            'only' => [
                'updateProfile',
                'sendActivationEmailAgain'
            ]
        ]);
    }

    /**
     * Send activation email again, if user didn't become it
     */
    public function sendActivationEmailAgain(UserActivation $request) {
        if($request->validated()) {
            $user = Sentinel::findById($request->user);

            // Remove activation if exists
            if(Activation::exists($user)) {
                Activation::remove($user);
            }

            // Create activation pro user again
            $activationObj = Activation::create($user);

            // Send email after creating. For activation.
            if($notifier = $this->_sendActivationMail(User::find($request->user), $activationObj)) {
                $answer = [
                    'success' => true
                ];
            } else {
                $answer = [
                    'success' => false
                ];
            }

            return $answer;
        }
    }

    /**
     * Create Account
     *
     * @param Request $request
     */
    public function createAccount(UserRegistration $request) {
        if ($request->validated()) {

            $newUser = Sentinel::register([
                'email' => $request->email,
                'password' => $request->password
            ]);

            if(!$newUser) {
                throw new UserNotDefinedException('Cannot create user.');
            }

            $userModel = User::find($newUser->id);
            if (!$userModel) {
                throw new UserNotDefinedException('User after creating is not found: userId = ' . $newUser->id);
            }

            $userModel->skype_id = $request->skype_id;
            $userModel->first_name = $request->first_name;
            $userModel->last_name = $request->last_name;
            $userModel->telegram_id = $request->telegram_id;
            $userModel->secret_question_id = $request->secret_question_id;
            $userModel->secret_question_answer = md5($request->secret_question_answer);

            if (!$userModel->save()) {
                throw new UserNotDefinedException('Cannot update existing user: userId = ' . $userModel->id);
            }

            $role = Sentinel::findRoleBySlug($request->role);
            $role->users()->attach($newUser);

            // Create activation pro new user
            $activationObj = Activation::create($newUser);

            // Send email after creating. For activation.
            if($notifier = $this->_sendActivationMail($userModel, $activationObj)) {
                $answer = [
                    'success' => true
                ];
            } else {
                $answer = [
                    'success' => false
                ];
            }

            return $answer + [
                'data' => UserResource::make($userModel),
                'messages' => [
                    'errors' => $notifier->flush('error'),
                    'notices' => $notifier->flush('notice'),
                    'successes' => $notifier->flush('success')
                ]
            ];
        }
    }

    /**
     * Send activation link to userMail
     */
    private function _sendActivationMail(User $userModel, $activation) {
        return (new Notifier())->sendEmailNotice('sendActivation', [
            'activationKeyLink' => env('COIN_FRONT_URL').'/user/'.$userModel->id.'/activate/'.$activation->code
        ], $userModel);
    }

    /**
     * Activate account by email link
     * 
     * @param Request $request
     */
    public function activateAccount(UserActivation $request) {
        if($request->validated()) {
            $user = Sentinel::findById($request->user);
            if (!$user) {
                throw new UserNotDefinedException('Пользователь не найден.');
            }

            $validator = Validator::make($request->all(), [
                'token' => function ($attribute, $value, $fail) use ($request, $user) { // Is activation exists?
                    return Activation::exists($user);
                },
            ]);

            if ($validator->fails()) {
                throw new NotActivatedException('Невозможно активировать пользователя.');
            }

            // Activate user
            if (!Activation::complete($user, $request->token)) {
                throw new NotActivatedException('Код активации использован, либо невалидный!');
            }

            // Make API key for user
            $userModel = User::find($request->user);
            $userModel->api_key = (new ApiCounter())->generateApiKey();
            if(!$userModel->save()) {
                throw new ApiKeyNotDefinedException('Cannot save user after inserting API key');
            }

            // Auto-login after registration: return JWT token
            if (!$token = auth()->tokenById($request->user)) {
                return response()->json([
                    'error' => 'Unauthorized'
                ], 401);
            }

            return [
                'success' => true,
                'token' => $token
            ];
        }
    }

    /**
     * Update profile
     *
     * @param Request $request
     */
    public function updateProfile(UserUpdate $request) {
        if($request->validated()) {
            $currentUser = auth()->user();
            $currentUser->telegram_id = $request->telegram_id;
            $currentUser->skype_id = $request->skype_id;
            $currentUser->first_name = $request->first_name;
            $currentUser->last_name = $request->last_name;
            return [
                'success' => (bool)$currentUser->save()
            ];
        }
    }

    /**
     * Reset your password, checking of secret question
     *
     * @param PasswordResetStepOne $request
     */
    public function resetPasswordStepOne(PasswordResetStepOne $request) {
        if($request->validated()) {
            $user = Sentinel::findByCredentials([
                'login' => $request->email
            ]);

            // Create reminder first step.....
            $reminder = Reminder::create($user);

            return [
                'success' => true,
                'code' => $reminder->code
            ];
        }

        return [
            'success' => false
        ];
    }

    /**
     * Reset your password, complete reseting
     *
     * @param PasswordResetStepTwo $request
     */
    public function resetPasswordStepTwo(PasswordResetStepTwo $request) {
        if($request->validated()) {
            $user = Sentinel::findByCredentials([
                'login' => $request->email
            ]);

            if(!$user) {
                throw new UserNotDefinedException('User not found.');
            }

            return [
                'success' => Reminder::exists($user) && Reminder::complete($user, $request->code, $request->password),
            ];
        }
    }

    /**
     * Get variants for secret questions
     *
     * @param Request $request
     * @return SecretQuestionResource
     */
    public function getSecretQuestions(Request $request) {
        return SecretQuestionResource::collection(SecretQuestion::all());
    }
}
