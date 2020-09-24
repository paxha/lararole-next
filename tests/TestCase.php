<?php

namespace Lararole\Tests;

use Lararole\LararoleServiceProvider;
use Lararole\Tests\Models\Admin;
use Lararole\Tests\Models\User;
use Orchestra\Testbench\TestCase as OrchestraTestCase;

class TestCase extends OrchestraTestCase
{
    protected $userModules = [
        [
            'name' => 'User Management',
            'modules' => [
                ['name' => 'Roles',],
                ['name' => 'Users',],
            ],
        ],
    ];

    protected $adminModules = [
        [
            'name' => 'User Management',
            'modules' => [
                ['name' => 'Roles',],
                ['name' => 'Users',],
            ],
        ],
    ];

    protected $merchantModules = [
        [
            'name' => 'User Management',
            'modules' => [
                ['name' => 'Roles',],
                ['name' => 'Users',],
            ],
        ],
    ];

    public function setUp(): void
    {
        parent::setUp();

        $this->loadMigrationsFrom(__DIR__ . '/database/migrations');
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
    }

    protected function getPackageProviders($app)
    {
        return [
            LararoleServiceProvider::class,
        ];
    }

    protected function getEnvironmentSetUp($app)
    {
        $app['config']->set('database.default', 'testbench');
        $app['config']->set('database.connections.testbench', [
            'driver' => 'sqlite',
            'database' => ':memory:',
            'prefix' => '',
        ]);

//        $app['config']->set('database.connections.mysql', [
//            'host' => 'localhost',
//            'driver' => 'mysql',
//            'database' => 'lararole',
//            'username' => 'root',
//            'password' => '',
//        ]);

        /*User Provider*/
        $app['config']->set('lararole.providers.user.model', User::class);
        $app['config']->set('lararole.providers.user.modules', $this->userModules);

        /*Admin Provider*/
        $app['config']->set('lararole.providers.admin.model', Admin::class);
        $app['config']->set('lararole.providers.admin.modules', $this->adminModules);

        /*Merchant Provider*/
        $app['config']->set('lararole.providers.merchant.model', Admin::class);
        $app['config']->set('lararole.providers.merchant.modules', $this->merchantModules);
    }
}
