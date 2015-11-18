<?php namespace Modules\Tags\Helpers;

use Illuminate\Support\Str;

class TagHelper
{
    public static function slug($name)
    {
        $name = Str::slug($name);
        return $name;
    }

    public static function toString($tags_collection)
    {
    	$tags = $tags_collection;
    	$stringable = array_map(function($tag){ return $tag['tag']; }, $tags->toArray());
		return implode(", ", $stringable);
    }
}
