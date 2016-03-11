<?php namespace Minioak\TwofactorExtension;

use Anomaly\Streams\Platform\Addon\AddonServiceProvider;

class TwofactorExtensionServiceProvider extends AddonServiceProvider
{

    protected $plugins = [];

    protected $routes = [
        'validate/twofa' => ['as' => 'twofa.validate', 'uses' => 'Minioak\TwofactorExtension\Http\Controller\AuthenticateController@index']
    ];

    protected $middleware = [];

    protected $listeners = [];

    protected $aliases = [];

    protected $bindings = [];

    protected $providers = [];

    protected $singletons = [];

    protected $overrides = [];

    protected $mobile = [];

    public function register()
    {
    }

    public function map()
    {
    }

}
