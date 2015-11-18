<?php namespace Modules\Tags\Events;

use Modules\Tags\Entities\Tag;

class TagWasCreated
{
    /**
     * @var Tag
     */
    public $tag;

    /**
     * @param Tag $tag
     */
    public function __construct(Tag $tag)
    {
        $this->tag = $tag;
    }
}
