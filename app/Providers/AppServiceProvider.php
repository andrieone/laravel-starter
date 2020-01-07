<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     * @return void
     */
    public function register(){
        require_once app_path() . '/Helpers/DatatablesHelper.php';
        require_once app_path() . '/Helpers/ImageHelper.php';
        require_once app_path() . '/Helpers/FileHelper.php';
        require_once app_path() . '/Helpers/Select2AjaxHelper.php';
        require_once app_path() . '/Helpers/AssetHelper.php';
    }

    /**
     * Bootstrap any application services.
     * @return void
     */
    public function boot(){
        Schema::defaultStringLength(191);
        // Blade::component('backend._components.breadcrumbs', 'breadcrumbs');
    }
}
