<?php namespace App\Providers;

use App\Models\Backoffice\Campaign;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\ServiceProvider;
use App\Models\Backoffice\SecretQuestion;
use App\Models\Backoffice\Role;
use App\Models\Backoffice\Container;
use App\Models\Backoffice\ContainerType;
use App\Models\Backoffice\Adv;
use App\Http\Resources\RoleResource;

use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Extending validation rules
 *
 * Class ValidatorServiceProvider
 * @package App\Providers
 */
class ValidatorServiceProvider extends ServiceProvider {

    public function boot()
    {
        // Secret question validator
        $this->app['validator']->extend('secret_question', function ($attribute, $value, $parameters) {
            // Is the question enumed?
            return (bool) SecretQuestion::where('id', $value)->first();
        });

        // Existing role validator
        $this->app['validator']->extend('role_exists', function ($attribute, $value, $parameters) {
            return count(array_filter(RoleResource::collection(Role::all())->toArray(null), function($v) use ($value) {
                return $v['slug'] == $value;
            })) > 0;
        });

        // Non-admin role validator
        $this->app['validator']->extend('non_admin', function ($attribute, $value, $parameters) {
            // Is the question enumed?
            $defaultRole = Role::where('is_default', 1)->first();
            return $defaultRole->slug != $value;
        });

        // Correct secret question answer
        $this->app['validator']->extend('correct_secret_answer', function ($attribute, $value, $parameters, $validator) {
            $inputData = $validator->getData();
            return (bool) User::where([
                'email' => $inputData['email'],
                'secret_question_id' => $inputData['secret_question_id'],
                'secret_question_answer' => md5($inputData['secret_question_answer'])
            ])->first();
        });

        // Banner owner or not
        $this->app['validator']->extend('owner_of_banner', function ($attribute, $value, $parameters) {
            $contModel = Container::findById($parameters['banner']);
            return $contModel && ($contModel->user_id == auth()->user()->id || auth()->user()->hasAccess('banners.create'));
        });

        // Min width of container for banners
        $this->app['validator']->extend('min_width', function ($attribute, $value, $parameters, $validator) {
            $inputData = $validator->getData();

            $typeModel = ContainerType::find($inputData['type_id']);
            if(!$typeModel) {
                return false;
            } elseif(!$typeModel->min_width) { // If type has nullable field, this field is random
                return true;
            }

            $minWidth = $typeModel->min_width;

            $validator->addReplacer('min_width', function($message, $attribute, $rule, $parameters) use ($minWidth) {
                return str_replace(':min_width', $minWidth, $message);
            });

            return $inputData['width'] >= $minWidth;
        });

        // Min height of container for banners
        $this->app['validator']->extend('min_height', function ($attribute, $value, $parameters, $validator) {
            $inputData = $validator->getData();

            $typeModel = ContainerType::find($inputData['type_id']);
            if(!$typeModel) {
                return false;
            } elseif(!$typeModel->min_height) { // If type has nullable field, this field is random
                return true;
            }

            $minHeight = $typeModel->min_height;

            $validator->addReplacer('min_height', function($message, $attribute, $rule, $parameters) use ($minHeight) {
                return str_replace(':min_height', $minHeight, $message);
            });

            return $inputData['height'] >= $minHeight;
        });

        // Max width of container for banners
        $this->app['validator']->extend('max_width', function ($attribute, $value, $parameters, $validator) {
            $inputData = $validator->getData();

            $typeModel = ContainerType::find($inputData['type_id']);
            if(!$typeModel) {
                return false;
            } elseif(!$typeModel->max_width) { // If type has nullable field, this field is random
                return true;
            }

            $maxWidth = $typeModel->max_width;

            $validator->addReplacer('max_width', function($message, $attribute, $rule, $parameters) use ($maxWidth) {
                return str_replace(':max_width', $maxWidth, $message);
            });

            return $inputData['width'] <= $maxWidth;
        });

        // Max height of container for banners
        $this->app['validator']->extend('max_height', function ($attribute, $value, $parameters, $validator) {
            $inputData = $validator->getData();

            $typeModel = ContainerType::find($inputData['type_id']);
            if(!$typeModel) {
                return false;
            } elseif(!$typeModel->max_height) { // If type has nullable field, this field is random
                return true;
            }

            $maxHeight = $typeModel->max_height;

            $validator->addReplacer('max_height', function($message, $attribute, $rule, $parameters) use ($maxHeight) {
                return str_replace(':max_height', $maxHeight, $message);
            });

            return $inputData['height'] <= $maxHeight;
        });

        // Owner or not for adv
        $this->app['validator']->extend('owner_of_adv', function ($attribute, $value, $parameters, $validator) {
            $inputData = $validator->getData();

            $advModel = Adv::find($validator->getData()['adv_id']);
            return $advModel && ($advModel->user_id == auth()->user()->id || auth()->user()->hasAccess('advs.create'));
        });

        // Owner or not for campaign
        $this->app['validator']->extend('owner_of_campaign', function ($attribute, $value, $parameters, $validator) {
            $inputData = $validator->getData();

            $campaignModel = Campaign::find($validator->getData()['campaign_id']);
            return $campaignModel && ($campaignModel->user_id == auth()->user()->id || auth()->user()->hasAccess('campaigns.create'));
        });

        // Owner or not for campaign
        $this->app['validator']->extend('owner_of_container', function ($attribute, $value, $parameters, $validator) {
            $inputData = $validator->getData();
            if(!isset($inputData['container'])) {
                return true;
            }

            $containerModel = Container::find($validator->getData()['container_id']);
            return $containerModel && ($containerModel->user_id == auth()->user()->id || auth()->user()->hasAccess('containers.create'));
        });

        // Base64 validator
        $this->app['validator']->extend('base64', function ($attribute, $value, $parameters, $validator) {
            return preg_match('%^[a-zA-Z0-9/+]*={0,2}$%', $value);
        });

        // Base64 image validator
        $this->app['validator']->extend('base64image', function ($attribute, $value, $parameters, $validator) {
            $explode = explode(',', $value);
            $allow = ['png', 'jpg', 'svg', 'jpeg'];
            $format = str_replace(
                [
                    'data:image/',
                    ';',
                    'base64',
                ],
                [
                    '', '', '',
                ],
                $explode[0]
            );
            // check file format
            if (!in_array($format, $allow)) {
                return false;
            }
            // check base64 format
            if (!preg_match('%^[a-zA-Z0-9/+]*={0,2}$%', $explode[1])) {
                return false;
            }

            return true;
        });

        // Banner exists or not
        $this->app['validator']->extend('banner_exists', function ($attribute, $value, $parameters, $validator) {
            return Storage::disk('public')->exists('/banners/'.$value);
        });

        // Check segments params
        $this->app['validator']->extend('check_segment_params', function ($attribute, $value, $parameters, $validator) {
            $decoded = json_decode($value);

            if(isset($parameters['geo'])) {

            }

            if(isset($parameters['language'])) {

            }

            if(isset($parameters['time'])) {

            }

            /**
             * Example of format:
             *
             * {
             *   'geo' : [
             *       'London',
             *       'Magadan',
             *       'Saint Petersburg'
             *   ],
             *   'language' : [
             *       'RU',
             *       'EN'
             *   ],
             *   'time' : [
             *      [
             *          'time_begin' : '9:00',
             *          'time_end' : '11:00'
             *      ],
             *      [
             *          'time_begin' : '16:30',
             *          'time_end' : '21:00'
             *      ]
             *   ]
             * }
             */
        });
    }

    public function register()
    {
        //
    }
}