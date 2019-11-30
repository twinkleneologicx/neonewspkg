<?php
namespace Neologicx\Newspkg;
use Illuminate\Support\ServiceProvider;

class NewsServiceProvider extends ServiceProvider{
    public function boot(){
        // dd('hello');
    $this->loadRoutesFrom(__DIR__.'/routes/web.php');
    $this->loadViewsFrom(__DIR__.'/views','news');
    $this->loadMigrationsFrom(__DIR__.'/database/migrations');

    $this->publishes([
        __DIR__.'/assets' => public_path('/neonewspkg')
    ], 'public');
    }

    public function register(){

    }
}