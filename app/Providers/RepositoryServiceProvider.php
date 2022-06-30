<?php

namespace App\Providers;

use App\Interfaces\DetailKegiatanInterface;
use App\Interfaces\GServiceInterface;
use App\Repositories\DetailKegiatanRepo;
use App\Repositories\GServiceRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{

    public function register()
    {
        $this->app->bind(GServiceInterface::class, GServiceRepository::class);
        $this->app->bind(DetailKegiatanInterface::class, DetailKegiatanRepo::class);
    }

    public function boot()
    {
        //
    }
}
