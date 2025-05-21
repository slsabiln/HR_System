<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * هذا هو المسار الأساسي لـ "home" الذي يستخدم عادةً كوجهة إعادة التوجيه بعد تسجيل الدخول.
     *
     * @var string
     */
    public const HOME = '/home';

    /**
     * قم بتعيين المسارات الخاصة بالتطبيق.
     *
     * @return void
     */
   public function boot()
{
    $this->routes(function () {
        Route::middleware('api')
            ->prefix('api')
            ->group(base_path('routes/api.php'));

        Route::middleware('web')
            ->group(base_path('routes/web.php'));
    });
}


    /**
     * قم بتكوين تحديد المعدل (rate limiting) لطلبات API.
     *
     * @return void
     */
    protected function configureRateLimiting()
    {
        //
    }
}
