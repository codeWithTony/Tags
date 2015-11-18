<?php namespace Modules\Tags\Events;

class TagWasUnlinked
{
    /**
     * The tagable id
     * @var int
     */
    public $tagableId;

    /**
     * @param int $imageableId
     */
    public function __construct($tagableId)
    {
        $this->tagableId = $tagableId;
    }
}
