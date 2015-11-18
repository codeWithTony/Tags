<?php namespace Modules\Tags\Support\Traits;

trait TagRelation
{
    /**
     * Make the Many To Many Morph To Relation
     * @return object
     */
    public function tags()
    {
        return $this->morphToMany('Modules\Tags\Entities\Tag', 'tagable', 'tags__tagables')->withPivot('zone', 'id');
    }
}
