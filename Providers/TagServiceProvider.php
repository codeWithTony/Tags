<?php namespace Modules\Tags\Providers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;
use Modules\Tags\Entities\Tag;
use Modules\Tags\Repositories\Eloquent\EloquentTagRepository;

class TagServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->booted(function () {
            $this->registerBindings();
        });
    }

    public function boot(){}

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return array();
    }

    private function registerBindings()
    {
        $this->app->bind(
            'Modules\Tags\Repositories\TagRepository',
            function ($app) {
                return new EloquentTagRepository(new Tag());
            }
        );
    }
}
