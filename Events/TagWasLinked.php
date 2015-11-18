<?php namespace Modules\Tags\Events;

use Modules\Tags\Entities\Tag;

class TagWasLinked
{
    /**
     * @var Tag
     */
    public $tag;
    /**
     * The entity that was linked to a tag
     * @var object
     */
    public $entity;

    /**
     * @param Tag $tag
     * @param object $entity
     */
    public function __construct(Tag $tag, $entity)
    {
        $this->tag = $tag;
        $this->entity = $entity;
    }
}
