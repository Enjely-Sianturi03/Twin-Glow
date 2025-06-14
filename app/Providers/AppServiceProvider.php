<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        // Model::class => Policy::class,
    ];

    public function boot()
    {
        $this->registerPolicies();

        // Cek blokir
        Gate::before(function ($user) {
            if ($user->is_blocked) {
                abort(403, 'Akun kamu diblokir oleh admin.');
            }
        });
    }
}
