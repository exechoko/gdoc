<?php

namespace App\Providers;

use App\Models\Curso;
use App\Policies\CursoPolicy;
use Carbon\Carbon;
use Illuminate\Pagination\Paginator;
//use Illuminate\Support\ServiceProvider;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    protected $policies = [
        Curso::class => CursoPolicy::class,
    ];
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->registerPolicies();
        // Establece la configuración regional a español para Carbon
        Carbon::setLocale('es');
        Paginator::useBootstrapFive();
    }
}
