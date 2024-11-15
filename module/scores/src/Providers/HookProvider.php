<?php

namespace Scores\Providers;
use Illuminate\Support\ServiceProvider;
use Scores\Hook\ScoresHook;

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
        add_action('wadmin-register-menu',[ScoresHook::class,'handle'],22);
    }
}
