<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Repositories\MailSenderRepository;
use App\Repositories\MailSenderRepositoryEloquent;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(MailSenderRepository::class, MailSenderRepositoryEloquent::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
