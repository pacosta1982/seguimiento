<?php

namespace App\Providers;
use Cmgmyr\Messenger\Models\Thread;
use Illuminate\Support\Facades\Auth;
use App\User;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        
        view()->composer('*', function ($view) {

            //$user = User::find(Auth::id())->get();
            //var_dump($user.'abc');
            $view->with('user', Auth::user());

        });
        
        view()->composer('messenger.messagesdropdown',function($view){
            $threads = Thread::forUser(Auth::id())->latest('updated_at')->get();
            $view->with('threads',$threads);

        });
        //Carbon::setLocale('es');
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
