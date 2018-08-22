<?php namespace App\Providers;

use App\Models\Backoffice\AdvGroup;
use App\Models\Backoffice\BannerForm;
use App\Models\Backoffice\BannerType;
use App\Models\Backoffice\Campaign;
use App\Models\Backoffice\ContainerForm;
use App\Models\Backoffice\Project;
use App\Models\Backoffice\Segment;
use App\Models\Backoffice\User;
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

use DB;

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
        $this->app['validator']->extend('owner_of_advgroup', function ($attribute, $value, $parameters, $validator) {
            $inputData = $validator->getData();

            $advGroupModel = AdvGroup::find($value);
            return $advGroupModel && ($advGroupModel->user_id == auth()->user()->id || auth()->user()->hasAccess('advgroups.create'));
        });


        // Owner or not for adv
        $this->app['validator']->extend('owner_of_adv', function ($attribute, $value, $parameters, $validator) {
            $inputData = $validator->getData();

            $advModel = Adv::find($inputData['adv_id']);
            return $advModel && ($advModel->user_id == auth()->user()->id || auth()->user()->hasAccess('advs.create'));
        });

        // Owner or not for campaign
        $this->app['validator']->extend('owner_of_campaign', function ($attribute, $value, $parameters, $validator) {
            $inputData = $validator->getData();

            $campaignModel = Campaign::find($inputData['campaign_id']);
            return $campaignModel && ($campaignModel->user_id == auth()->user()->id || auth()->user()->hasAccess('campaigns.create'));
        });

        // Owner or not for campaign
        $this->app['validator']->extend('owner_of_container', function ($attribute, $value, $parameters, $validator) {
            $inputData = $validator->getData();
            if(!isset($inputData['container_id'])) {
                return true;
            }

            $containerModel = Container::find($inputData['container_id']);
            return $containerModel && ($containerModel->user_id == auth()->user()->id || auth()->user()->hasAccess('containers.create'));
        });

        // Owner or not for project
        $this->app['validator']->extend('owner_of_project', function ($attribute, $value, $parameters, $validator) {
            $inputData = $validator->getData();
            if(!isset($inputData['project_id'])) {
                return true;
            }

            $projectModel = Project::find($inputData['project_id']);
            return $projectModel && ($projectModel->user_id == auth()->user()->id || auth()->user()->hasAccess('projects.create'));
        });

        // Base64 validator
        $this->app['validator']->extend('base64', function ($attribute, $value, $parameters, $validator) {
            return preg_match('%^[a-zA-Z0-9/+]*={0,2}$%', $value);
        });

        // Base64 image validator
        $this->app['validator']->extend('base64image', function ($attribute, $value, $parameters, $validator) {
            if(trim($value) == '') {
                return true;
            }

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
            /**
             * Example of format:
             *
             * {
             *   'geo' : [
             *       [
             *          'continent_code' => '',
             *          'country_code' => '',
             *          'area_code' => '',
             *          'city_code' => ''
             *       ]
             *      ...
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

            if(!is_array($value)) {
                return false;
            }

            if(isset($value['geo'])) {
                if(!is_array($value['geo'])) {
                    return false;
                }

                foreach($value['geo'] as $geoParams) {
                    if(!isset($geoParams['continent_code'], $geoParams['country_code'], $geoParams['area_code'], $geoParams['city'])) {
                        return false;
                    }
                }

            }

            if(isset($value['language'])) {
                if(!is_array($value['language'])) {
                    return false;
                }
            }

            if(isset($value['time'])) {
                if(!is_array($value['time'])) {
                    return false;
                }

                foreach ($value['time'] as $index => $time) {
                    if(!isset($time['time_begin'], $time['time_end'])) {
                        return false;
                    }
                }
            }

            return true;
        });

        // User's budget limit, all budget
        $this->app['validator']->extend('user_budget_limit', function ($attribute, $value, $parameters, $validator) {
            if($value !== null) {
                $inputData = $validator->getData();
                return auth()->user()->bill->num_tokens > $value;
            }

            return true;
        });

        // User's daily budget limit, all budget
        $this->app['validator']->extend('user_daily_budget_limit', function ($attribute, $value, $parameters, $validator) {
            if($value !== null) {
                $inputData = $validator->getData();
                if($inputData['user_budget_limit'] < $inputData['user_daily_budget_limit']) {
                    return false;
                }
            }

            return true;
        });


        // Daily project budget limit. Using by create company.
        $this->app['validator']->extend('project_daily_budget_limit', function ($attribute, $value, $parameters, $validator) {
            if($value !== null) {
                $inputData = $validator->getData();
                if(!isset($inputData['project_id'])) {
                    return true;
                }
                $projectModel = Project::find($inputData['project_id']);
                if($projectModel->daily_budget < $value || $inputData['daily_budget'] > $inputData['budget']) {
                    return false;
                }
            }

            return true;
        });


        // Project budget limit, all budget
        $this->app['validator']->extend('project_budget_limit', function ($attribute, $value, $parameters, $validator) {
            if($value !== null) {
                $inputData = $validator->getData();
                if(!isset($inputData['project_id'])) {
                    return true;
                }
                $projectModel = Project::find($inputData['project_id']);
                if($projectModel->budget < $value) {
                    return false;
                }
            }

            return true;
        });

        // Daily campaign budget limit. Using by create company.
        $this->app['validator']->extend('campaign_daily_budget_limit', function ($attribute, $value, $parameters, $validator) {
            if($value !== null) {
                $inputData = $validator->getData();
                if(!isset($inputData['project_id'])) {
                    return true;
                }
                $projectModel = Project::find($inputData['project_id']);
                if($projectModel->daily_budget < $value || $inputData['daily_budget'] > $inputData['budget']) {
                    return false;
                }
            }

            return true;
        });

        // Campaign budget limit, all budget
        $this->app['validator']->extend('campaign_budget_limit', function ($attribute, $value, $parameters, $validator) {
            if($value !== null) {
                $inputData = $validator->getData();
                if(!isset($inputData['project_id'])) {
                    return true;
                }
                $projectModel = Project::find($inputData['project_id']);
                if($projectModel->budget < $value) {
                    return false;
                }
            }

            return true;
        });

        // Daily advgroup budget limit. Using by create company.
        $this->app['validator']->extend('advgroup_daily_budget_limit', function ($attribute, $value, $parameters, $validator) {
            if($value !== null) {
                $inputData = $validator->getData();
                if(!isset($inputData['campaign_id'])) {
                    return true;
                }
                $campaignModel = Campaign::find($inputData['campaign_id']);
                if($campaignModel->daily_budget < $value || $inputData['daily_budget'] > $inputData['budget']) {
                    return false;
                }
            }

            return true;
        });

        // Advgroup budget limit, all budget
        $this->app['validator']->extend('advgroup_budget_limit', function ($attribute, $value, $parameters, $validator) {
            if($value !== null) {
                $inputData = $validator->getData();
                if(!isset($inputData['campaign_id'])) {
                    return true;
                }
                $campaignModel = Campaign::find($inputData['campaign_id']);
                if($campaignModel->budget < $value) {
                    return false;
                }
            }

            return true;
        });

        // Click price cannot be over advgroup budget...
        $this->app['validator']->extend('max_click_price', function($attribute, $value, $parameters, $validator) {
            if($value !== null) {
                $inputData = $validator->getData();
                if(!isset($inputData['daily_budget'])) {
                    return false;
                }

                return $inputData['daily_budget'] >= $value;
            }

            return true;
        });

        // All segments exists?...
        $this->app['validator']->extend('segments_exists', function($attribute, $value, $parameters, $validator) {
            // Try to find all segments...
            return DB::connection('mysql-backoffice')->table((new Segment)->getTable().' AS t1')
                ->select([
                    't1.*'
                ])
                ->join('segments-adv_groups AS t2', 't2.segment_id', '=', 't1.id')
                ->join((new AdvGroup)->getTable().' AS t3', 't3.id', '=', 't2.adv_group_id')
                ->whereIn('t1.id', $value)
                ->where('t3.user_id', '=', auth()->user()->id)
                ->whereOr('t3.user_id', '=', null)
                ->count() == count($value);
        });

        /**
         * Check sets
         */
        $this->app['validator']->extend('check_sets', function($attribute, $value, $parameters, $validator) {
            $bannerTypes = BannerType::all();
            $bannerForms = BannerForm::all();
            $containerTypes = ContainerType::all();
            $containerForms = ContainerForm::all();

            /**
             * Search correct in sets
             *
             * @param $entities
             * @param $searchable
             * @return bool
             */
            $searchElement = function($entities, $searchable) {
                if($searchable === null) { // Field can be VERY optional
                    return true;
                }

                foreach ($entities as $entity) {
                    if($entity->id == $searchable) {
                        return true;
                    }
                }

                return false;
            };

            /**
             * Loop on sets
             */
            foreach ($value as $set) {
                if(
                    !($searchElement($bannerTypes, $set['banner_type_id'])
                    && $searchElement($bannerForms, $set['banner_form_id'])
                    && $searchElement($containerTypes, $set['container_type_id'])
                    && $searchElement($containerForms, $set['container_form_id']))
                ) {
                    return false;
                }
            }

            return true;
        });

        /**
         * Banner file exists or not?
         */
        $this->app['validator']->extend('banner_image_exists', function($attribute, $value, $parameters, $validator) {
            if($value == 'dummy.png') {
                return false;
            }

            return Storage::disk('public')->exists('/banners/'.$value);
        });
    }

    public function register()
    {
        //
    }
}