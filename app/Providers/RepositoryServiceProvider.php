<?php

namespace App\Providers;

use App\Interfaces\GServiceInterface;
use App\Repositories\GServiceRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{

    public function register()
    {
        $this->app->bind(GServiceInterface::class, GServiceRepository::class);
    }

    public function boot()
    {
        //
    }
}
