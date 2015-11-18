<?php

$router->resource('tag', 'TagController', ['only' => ['store']]);
$router->post('tags/link', ['uses' => 'TagController@linkTag', 'as' => 'api.tags.link']);
$router->post('tags/unlink', ['uses' => 'TagController@unlinkTag', 'as' => 'api.tags.unlink']);
$router->get('tags/all', [
    'as' => 'api.tags.all',
    'uses' => 'TagController@all',
]);
