<?php

/**
 * Part of the Sentinel package.
 *
 * NOTICE OF LICENSE
 *
 * Licensed under the 3-clause BSD License.
 *
 * This source file is subject to the 3-clause BSD License that is
 * bundled with this package in the LICENSE file.
 *
 * @package    Sentinel
 * @version    2.0.17
 * @author     Cartalyst LLC
 * @license    BSD License (3-clause)
 * @copyright  (c) 2011-2017, Cartalyst LLC
 * @link       http://cartalyst.com
 */

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

use Cartalyst\Sentinel\Laravel\Facades\Sentinel as Sentinel;

class MigrationCartalystSentinel extends Migration
{
    private $defaultPermissions = [ // Default permissions by actions
        'banners' => [
            'get' => [
                'administrators' => true,
                'managers' => true,
                'guests' => false,
                'webmasters' => false
            ],
            'get-moderated' => [
                'administrators' => true,
                'managers' => true,
                'guests' => false,
                'webmasters' => false
            ],
            'edit' => [
                'administrators' => true,
                'managers' => false,
                'guests' => false,
                'webmasters' => false
            ],
            'edit-own' => [
                'administrators' => true,
                'managers' => true,
                'guests' => false,
                'webmasters' => false
            ],
            'create' => [
                'administrators' => true,
                'managers' => true,
                'guests' => false,
                'webmasters' => false
            ],
            'delete' => [
                'administrators' => true,
                'managers' => false,
                'guests' => false,
                'webmasters' => false
            ],
            'delete-own' => [
                'administrators' => true,
                'managers' => true,
                'guests' => false,
                'webmasters' => false
            ]
        ],
        'users' => [
            'edit' => [
                'administrators' => true,
                'managers' => false,
                'guests' => false,
                'webmasters' => false
            ],
            'edit-profile' => [
                'administrators' => true,
                'managers' => true,
                'guests' => false,
                'webmasters' => true
            ],
            'recover-password' => [
                'administrators' => false,
                'managers' => false,
                'guests' => true,
                'webmasters' => false
            ],
            'change-password' => [
                'administrators' => true,
                'managers' => true,
                'guests' => false,
                'webmasters' => true
            ]
        ],
        'websites' => [
            'edit' => [
                'administrators' => true,
                'managers' => false,
                'guests' => false,
                'webmasters' => true
            ],
            'edit-own' => [
                'administrators' => true,
                'managers' => false,
                'guests' => false,
                'webmasters' => true
            ],
            'create' => [
                'administrators' => true,
                'managers' => false,
                'guests' => false,
                'webmasters' => true
            ],
            'delete' => [
                'administrators' => true,
                'managers' => false,
                'guests' => false,
                'webmasters' => false
            ],
            'delete-own' => [
                'administrators' => true,
                'managers' => false,
                'guests' => false,
                'webmasters' => true
            ]
        ],
        'campaigns' => [
            'edit' => [
                'administrators' => true,
                'managers' => false,
                'guests' => false,
                'webmasters' => false
            ],
            'edit-own' => [
                'administrators' => true,
                'managers' => true,
                'guests' => false,
                'webmasters' => false
            ],
            'create' => [
                'administrators' => true,
                'managers' => true,
                'guests' => false,
                'webmasters' => false
            ],
            'delete' => [
                'administrators' => true,
                'managers' => false,
                'guests' => false,
                'webmasters' => false
            ],
            'delete-own' => [
                'administrators' => true,
                'managers' => true,
                'guests' => false,
                'webmasters' => false
            ]
        ],
        'advgroups' => [
            'edit' => [
                'administrators' => true,
                'managers' => false,
                'guests' => false,
                'webmasters' => false
            ],
            'edit-own' => [
                'administrators' => true,
                'managers' => true,
                'guests' => false,
                'webmasters' => false
            ],
            'create' => [
                'administrators' => true,
                'managers' => true,
                'guests' => false,
                'webmasters' => false
            ],
            'delete' => [
                'administrators' => true,
                'managers' => false,
                'guests' => false,
                'webmasters' => false
            ],
            'delete-own' => [
                'administrators' => true,
                'managers' => true,
                'guests' => false,
                'webmasters' => false
            ]
        ],
        'advs' => [
            'edit' => [
                'administrators' => true,
                'managers' => false,
                'guests' => false,
                'webmasters' => false
            ],
            'edit-own' => [
                'administrators' => true,
                'managers' => true,
                'guests' => false,
                'webmasters' => false
            ],
            'create' => [
                'administrators' => true,
                'managers' => true,
                'guests' => false,
                'webmasters' => false
            ],
            'delete' => [
                'administrators' => true,
                'managers' => false,
                'guests' => false,
                'webmasters' => false
            ],
            'delete-own' => [
                'administrators' => true,
                'managers' => true,
                'guests' => false,
                'webmasters' => false
            ]
        ],
        'containers' => [
            'edit' => [
                'administrators' => true,
                'managers' => false,
                'guests' => false,
                'webmasters' => false
            ],
            'edit-own' => [
                'administrators' => true,
                'managers' => false,
                'guests' => false,
                'webmasters' => true
            ],
            'create' => [
                'administrators' => true,
                'managers' => false,
                'guests' => false,
                'webmasters' => true
            ],
            'delete' => [
                'administrators' => true,
                'managers' => false,
                'guests' => false,
                'webmasters' => false
            ],
            'delete-own' => [
                'administrators' => true,
                'managers' => false,
                'guests' => false,
                'webmasters' => true
            ]
        ],
        'projects' => [
            'edit' => [
                'administrators' => true,
                'managers' => false,
                'guests' => false,
                'webmasters' => false
            ],
            'edit-own' => [
                'administrators' => true,
                'managers' => true,
                'guests' => false,
                'webmasters' => false
            ],
            'create' => [
                'administrators' => true,
                'managers' => true,
                'guests' => false,
                'webmasters' => false
            ],
            'delete' => [
                'administrators' => true,
                'managers' => false,
                'guests' => false,
                'webmasters' => false
            ],
            'delete-own' => [
                'administrators' => true,
                'managers' => true,
                'guests' => false,
                'webmasters' => false
            ]
        ],
        'segments' => [
            'edit' => [
                'administrators' => true,
                'managers' => false,
                'guests' => false,
                'webmasters' => false
            ],
            'edit-own' => [
                'administrators' => true,
                'managers' => true,
                'guests' => false,
                'webmasters' => false
            ],
            'create' => [
                'administrators' => true,
                'managers' => true,
                'guests' => false,
                'webmasters' => false
            ],
            'delete' => [
                'administrators' => true,
                'managers' => false,
                'guests' => false,
                'webmasters' => false
            ],
            'delete-own' => [
                'administrators' => true,
                'managers' => true,
                'guests' => false,
                'webmasters' => false
            ]
        ],
        'sites' => [
            'edit' => [
                'administrators' => true,
                'managers' => false,
                'guests' => false,
                'webmasters' => false
            ],
            'edit-own' => [
                'administrators' => true,
                'managers' => false,
                'guests' => false,
                'webmasters' => true
            ],
            'create' => [
                'administrators' => true,
                'managers' => false,
                'guests' => false,
                'webmasters' => true
            ],
            'delete' => [
                'administrators' => true,
                'managers' => false,
                'guests' => false,
                'webmasters' => false
            ],
            'delete-own' => [
                'administrators' => true,
                'managers' => false,
                'guests' => false,
                'webmasters' => true
            ]
        ]
    ];

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql-backoffice')->create('activations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->string('code');
            $table->boolean('completed')->default(0);
            $table->timestamp('completed_at')->nullable();
            $table->timestamps();

            $table->engine = 'InnoDB';
        });

        Schema::connection('mysql-backoffice')->create('persistences', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->string('code');
            $table->timestamps();

            $table->engine = 'InnoDB';
            $table->unique('code');
        });

        Schema::connection('mysql-backoffice')->create('reminders', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->string('code');
            $table->boolean('completed')->default(0);
            $table->timestamp('completed_at')->nullable();
            $table->timestamps();

            $table->engine = 'InnoDB';
        });

        Schema::connection('mysql-backoffice')->create('roles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('slug');
            $table->string('name');
            $table->text('permissions')->nullable();
            $table->timestamps();

            $table->engine = 'InnoDB';
            $table->unique('slug');
        });

        Schema::connection('mysql-backoffice')->create('role_users', function (Blueprint $table) {
            $table->integer('user_id')->unsigned();
            $table->integer('role_id')->unsigned();
            $table->nullableTimestamps();

            $table->engine = 'InnoDB';
            $table->primary(['user_id', 'role_id']);
        });

        Schema::connection('mysql-backoffice')->create('throttle', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned()->nullable();
            $table->string('type');
            $table->string('ip')->nullable();
            $table->timestamps();

            $table->engine = 'InnoDB';
            $table->index('user_id');
        });

        Schema::connection('mysql-backoffice')->create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('email');
            $table->string('password');
            $table->text('permissions')->nullable();
            $table->timestamp('last_login')->nullable();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->timestamps();

            $table->engine = 'InnoDB';
            $table->unique('email');
        });

        $this->createFirstUsers();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('mysql-backoffice')->drop('activations');
        Schema::connection('mysql-backoffice')->drop('persistences');
        Schema::connection('mysql-backoffice')->drop('reminders');
        Schema::connection('mysql-backoffice')->drop('roles');
        Schema::connection('mysql-backoffice')->drop('role_users');
        Schema::connection('mysql-backoffice')->drop('throttle');
        Schema::connection('mysql-backoffice')->drop('users');
    }

    /**
     * Create first user
     */
    private function createFirstUsers() {
        $firstManager = Sentinel::registerAndActivate([
            'email' => 'manager@testmail.com',
            'password' => '123456',
            'first_name' => 'Mr.',
            'last_name' => 'Manager'
        ]);

        $firstWebmaster =  Sentinel::registerAndActivate([
            'email' => 'webmaster@testmail.com',
            'password' => '123456',
            'first_name' => 'Mrs.',
            'last_name' => 'Webmaster'
        ]);

        $firstAdministrator = Sentinel::registerAndActivate([
            'email' => 'administrator@testmail.com',
            'password' => '123456',
            'first_name' => 'Mr. and Mrs.',
            'last_name' => 'Administrators',
        ]);

        $this->createRoles(
            $firstManager,
            $firstWebmaster,
            $firstAdministrator
        );
    }

    /**
     * Creating of roles
     */
    private function createRoles($firstManager,
                                 $firstWebmaster,
                                 $firstAdministrator) {
        $roles = [];

        /**
         * Ad manager role
         */
        $managerRole = Sentinel::getRoleRepository()->createModel()->create([
            'name' => 'Managers',
            'slug' => 'managers',
        ]);

        array_push($roles, $managerRole);

        $manager = Sentinel::findById($firstManager->id);
        $managerRole->users()->attach($manager);

        /**
         * Webmaster role
         */
        $webmasterRole = Sentinel::getRoleRepository()->createModel()->create([
            'name' => 'Webmasters',
            'slug' => 'webmasters',
        ]);

        array_push($roles, $webmasterRole);

        $webmaster = Sentinel::findById($firstWebmaster->id);
        $webmasterRole->users()->attach($webmaster);

        /**
         * Administrator role
         */
        $administratorRole = Sentinel::getRoleRepository()->createModel()->create([
            'name' => 'Administrators',
            'slug' => 'administrators',
        ]);

        array_push($roles, $administratorRole);

        $administrator = Sentinel::findById($firstAdministrator->id);
        $administratorRole->users()->attach($administrator);


        /**
         * Guest role
         */
        $guestRole = Sentinel::getRoleRepository()->createModel()->create([
            'name' => 'Guests',
            'slug' => 'guests',
        ]);

        array_push($roles, $guestRole);


        $this->addPermissions($roles);
    }

    /**
     * Add permissions to users
     */
    private function addPermissions($roles) {
        $permsToApply = [];
        foreach($this->defaultPermissions as $groupIndex => $group) {
            foreach($group as $permIndex => $perm) {
                foreach ($roles as $role) {
                    if(isset($perm[$role->slug])) {
                        if(!isset($permsToApply[$role->slug])) {
                            $permsToApply[$role->slug] = [];
                        }
                        $permsToApply[$role->slug][$groupIndex.'.'.$permIndex] = $perm[$role->slug];
                    }
                }
            }
        }

        // Save all rolePerms
        foreach ($roles as $role) {
            $role->permissions = $permsToApply[$role->slug];
            $role->save();
        }
    }
}
