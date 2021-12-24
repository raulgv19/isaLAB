<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use DB;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
    /*
        // check DB connection
        try {
            DB::connection()
                ->getPdo();
        } catch (Exception $e) {
            abort($e instanceof PDOException ? 503 : 500);
        }
    */
    }
}
