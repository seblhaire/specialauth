<?php
namespace Seblhaire\Specialauth;

use Illuminate\Support\ServiceProvider;

class SpecialauthServiceProvider extends ServiceProvider{
  protected $defer = true;
 /**
  * Bootstrap the application services.
  *
  * @return void
  */
 public function boot()
 {
   $this->loadViewsFrom(__DIR__.'/../resources/views', 'specialauth');
   $this->publishes([
      __DIR__ . '/../config/specialauth.php' => config_path('specialauth.php'),
      __DIR__.'/../resources/views' => resource_path('views/vendor/seblhaire/specialauth'),
   ]);
   $this->loadRoutesFrom(__DIR__.'/../routes/web.php');
   $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
 }

 /**
  * Register the application services.
  *
  * @return void
  */

 public function register()
 {
    $this->mergeConfigFrom(__DIR__ . '/../config/specialauth.php', 'specialauth');
    /*\App::bind('AutocompleterService',function() {
         return new AutocompleterService;
    });*/
 }

 public function provides() {
    // return [PasswordResetServiceProvider::class];
 }

}