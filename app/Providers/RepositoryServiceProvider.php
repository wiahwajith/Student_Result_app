<?php

namespace App\Providers;

use App\Repository\Admin\AdminRepository;
use App\Repository\Admin\AdminRepositoryInterface;
use App\Repository\Login\LoginRepository;
use App\Repository\Login\LoginRepositoryInterface;
use App\Repository\Result\ResultRepository;
use App\Repository\Result\ResultRepositoryInterface;
use App\Repository\Student\StudentRepository;
use App\Repository\Student\StudentRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(StudentRepositoryInterface::class , StudentRepository::class);
        $this->app->bind(AdminRepositoryInterface::class , AdminRepository::class);
        $this->app->bind(ResultRepositoryInterface::class , ResultRepository::class);
        $this->app->bind(LoginRepositoryInterface::class , LoginRepository::class);
    }
}
