<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Schema;

// Ajuste o namespace do seu Model:
use App\Models\Specialty;

class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
        //
    }

    public function boot()
    {
        // Evita rodar em comandos artisan que podem ocorrer sem banco pronto
        if ($this->app->runningInConsole()) {
            return;
        }

        View::composer('*', function ($view) {
            try {
                // Evita quebrar se a tabela ainda não existir
                if (!Schema::hasTable('specialties')) {
                    $view->with('specialties', collect());
                    return;
                }

                $specialties = Cache::remember('specialties:list', now()->addHours(6), function () {
                    return Specialty::query()
                        ->orderBy('name')
                        ->get();
                });

                $view->with('specialties', $specialties);
            } catch (\Throwable $e) {
                // Fallback seguro (não derruba a página)
                $view->with('specialties', collect());
            }
        });
    }
}
