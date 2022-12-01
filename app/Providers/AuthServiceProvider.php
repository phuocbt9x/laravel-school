<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Models\LoginModel;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        Gate::define('manager', function (LoginModel $loginModel) {
            return $loginModel->isManager();
        });

        Gate::define('teacher', function (LoginModel $loginModel) {
            return $loginModel->isTeacher();
        });

        Gate::define('student', function (LoginModel $loginModel) {
            return $loginModel->isStudent();
        });
    }
}
