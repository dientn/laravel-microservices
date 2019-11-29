<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider as BaseProvider;

class MicroServiceProvider extends BaseProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {

    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $serviceName = config('micro-service.service_name');
        $serviceConfig = config('micro-service.config');
        $service = $serviceConfig['services'][$serviceName];
        $relations= $service['relations'];
        $serviceNamespace = 'App\Services\Clients\\';
//        $this->app->singleton(\App\Services\Clients\TestServiceClient::class, function (){
//            return new \App\Services\Clients\TestServiceClient([
//                'base_uri' => 'http://core.cargopedia.local/'
//            ]);
//        });
//        dd(\App\Services\Clients\TestServiceClient::class);
        foreach ($relations as $key) {
            $_service = $serviceConfig['services'][$key];
            $sName = ucfirst($key);
            $classname = $sName."ServiceClient";
            $classNamespace = $serviceNamespace.$classname;
            $this->app->singleton($classNamespace, function () use($_service, $classNamespace){
                return new $classNamespace([
                    'base_uri' => $_service['url']
                ]);
            });
        }
    }
}
