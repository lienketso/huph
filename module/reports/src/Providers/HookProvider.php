<?php

namespace Reports\Providers;

use Illuminate\Support\ServiceProvider;
use Reports\Hook\ReportsHook;

class HookProvider extends ServiceProvider
{
    public function boot(){
        $this->app->booted(function (){
            $this->booted();
        });
    }
    public function register()
    {
        parent::register(); // TODO: Change the autogenerated stub
    }
    public function booted(){
        add_action('wadmin-register-menu',[ReportsHook::class,'handle'],24);
    }
}
