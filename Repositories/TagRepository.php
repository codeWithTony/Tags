<?php namespace Modules\Tags\Repositories;

use Modules\Core\Repositories\BaseRepository;

interface TagRepository extends BaseRepository
{
    /**
     * Find a tag for the entity by zone
     * @param string $zone
     * @param object $entity
     * @return object
     */
    public function findTagByZoneForEntity($zone, $entity);

    /**
     * Find multiple tags for the given zone and entity
     * @param zone $zone
     * @param object $entity
     * @return object
     */
    public function findMultipleTagsByZoneForEntity($zone, $entity);
}
