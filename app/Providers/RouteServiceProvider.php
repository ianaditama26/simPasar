<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to the "home" route for your application.
     *
     * This is used by Laravel authentication to redirect users after login.
     *
     * @var string
     */
    public const HOME = '/home';

    /**
     * The controller namespace for the application.
     *
     * When present, controller route declarations will automatically be prefixed with this namespace.
     *
     * @var string|null
     */
    protected $namespace = 'App\\Http\\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        $this->configureRateLimiting();

        $this->routes(function () {
            Route::prefix('api')
                ->middleware('api')
                ->namespace($this->namespace)
                ->group(base_path('routes/api.php'));

            Route::middleware('web')
                ->namespace($this->namespace)
                ->group(base_path('routes/web.php'));

            Route::middleware('web', 'auth', 'role:superAdmin')
                ->namespace($this->namespace . '\SuperAdmin')
                ->prefix('super_admin')
                ->name('super_admin.')
                ->group(\base_path('routes/superAdmin.php'));

            Route::middleware('web', 'auth', 'role:admin|diskomindag|upt')
                ->namespace($this->namespace . '\Admin')
                ->prefix('admin')
                ->name('admin.')
                ->group(\base_path('routes/admin.php'));

            Route::middleware('web', 'auth', 'role:diskomindag')
                ->namespace($this->namespace . '\Diskomindag')
                ->prefix('diskomindag')
                ->name('diskomindag.')
                ->group(\base_path('routes/diskomindag.php'));

            Route::middleware('web', 'auth', 'role:upt')
                ->namespace($this->namespace . '\Upt')
                ->prefix('upt')
                ->name('upt.')
                ->group(\base_path('routes/upt.php'));
        });
    }

    /**
     * Configure the rate limiters for the application.
     *
     * @return void
     */
    protected function configureRateLimiting()
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by(optional($request->user())->id ?: $request->ip());
        });
    }
}
