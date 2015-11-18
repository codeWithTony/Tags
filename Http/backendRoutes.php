<?php
use Illuminate\Routing\Router;

$router->group(['prefix' =>'/tags'], function (Router $router) {
    $router->bind('tags', function ($id) {
        return app('Modules\Tags\Repositories\TagRepository')->find($id);
    });

    $router->resource(
        'tags', 
        'TagController', [
        'except' => ['show'], 
        'names' => [
            'index' => 'admin.tags.tag.index',
            'create' => 'admin.tags.tag.create',
            'store' => 'admin.tags.tag.store',
            'edit' => 'admin.tags.tag.edit',
            'update' => 'admin.tags.tag.update',
            'destroy' => 'admin.tags.tag.destroy',
        ]
    ]);
});