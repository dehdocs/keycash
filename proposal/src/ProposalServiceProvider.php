<?php
namespace Proposal;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

/**
 * Class ProposalServiceProvider
 * @package Proposal
 */
class ProposalServiceProvider extends ServiceProvider {


    public function boot(){
        Schema::defaultStringLength(191);

        $this->loadRoutesFrom(__DIR__.'/../routes/web.php');

        $this->loadViewsFrom(__DIR__.'/../resources/views','proposal');

    }


    public function register(){
        $this->registerPublishables();
    }


    private function registerPublishables(){

        $basePath = dirname(__DIR__);

        $pub = [
            'migrations' => [
                "$basePath/publishable/database/migrations" => database_path('migrations'),
            ]
        ];

        foreach($pub as $group => $path){
            $this->publishes($path, $group);
        }
    }
}