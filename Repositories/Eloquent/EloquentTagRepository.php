<?php namespace Modules\Tags\Repositories\Eloquent;

use Illuminate\Database\Eloquent\Collection;
use Modules\Core\Repositories\Eloquent\EloquentBaseRepository;
use Modules\Tags\Entities\Tag;
use Modules\Tags\Helpers\TagHelper;
use Modules\Tags\Repositories\TagRepository;

class EloquentTagRepository extends EloquentBaseRepository implements TagRepository
{
    /**
     * Update a resource
     * @param  Tag  $tag
     * @param $data
     * @return mixed
     */
    public function update($tag, $data)
    {
        $tag->update($data);
        return $tag;
    }

    public function destroy($tag)
    {
        $tag->delete();
    }

    /**
     * Find a tag for the entity by zone
     * @param $zone
     * @param object $entity
     * @return object
     */
    public function findTagByZoneForEntity($zone, $entity)
    {
        foreach ($entity->tags as $tag) {
            if ($tag->pivot->zone == $zone) {
                return $tag;
            }
        }

        return '';
    }

    /**
     * Find multiple tags for the given zone and entity
     * @param zone $zone
     * @param object $entity
     * @return object
     */
    public function findMultipleTagsByZoneForEntity($zone, $entity)
    {
        $tags = [];
        foreach ($entity->tags as $tag) {
            if ($tag->pivot->zone == $zone) {
                $tags[] = $tag;
            }
        }

        return new Collection($tags);
    }

    /**
     * Sync multiple tags for the given zone and entity
     * @param zone $zone
     * @param object $entity
     * @return object
     */
    public function syncMultipleTagsByZoneForEntity($tags_string, $zone, $entity)
    {
        $entityClass = get_class($entity);
        $tags = explode(',', $tags_string);
        $sync_tags = [];
        foreach ($tags as $tag) {
            $tag = trim($tag, " \t\n\r\0\x0B");
            if(empty($tag)){ continue; }
            if ($db_tag = Tag::whereTranslation('slug', TagHelper::slug($tag))->first()){
                $id = $db_tag->id;
            }
            else {
                $new_tag = new Tag();
                $new_tag->tag = $tag;
                $new_tag->slug = TagHelper::slug($tag);
                $new_tag->save();
                $id = $new_tag->id;
            }
            $sync_tags[$id] = ['tagable_type' => $entityClass, 'zone' => $zone];
        }
        if(!empty($sync_tags)){
            $entity->tags()->sync($sync_tags);
        }
        return $entity;
    }
}
