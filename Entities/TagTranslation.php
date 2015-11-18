<?php namespace Modules\Tags\Entities;

use Illuminate\Database\Eloquent\Model;

class TagTranslation extends Model
{
    public $timestamps = false;
    protected $fillable = ['tag', 'slug'];
    protected $table = 'tags__tag_translations';
}
