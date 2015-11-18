<?php namespace Modules\Tags\Entities;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use Translatable;

    protected $table = 'tags__tags';
    public $translatedAttributes = ['tag', 'slug'];
    protected $fillable = ['tag', 'slug'];
}
