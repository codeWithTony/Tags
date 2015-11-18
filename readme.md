# Site-wide Tag Module

[![Latest Version](https://img.shields.io/github/release/codewithtony/taggable.svg?style=flat-square)](https://github.com/codewithtony/taggable/releases)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)

# Quick Use Docs

Rough docs...

To Controller add:
```php
use Modules\Tags\Support\Traits\TagRelation;
```
```php
    /**
     * @var Tag
     */
    private $tag;

    public function __construct(
        ...
        TagRepository $tag
    ) {
        parent::__construct();

        ...
        $this->tag = $tag;
    }
```
```php
    public function store(Request $request)
    {
        $[OBJECT] = $this->[OBJECT]->create($request->all());
        $this->tag->syncMultipleTagsByZoneForEntity($request->tags, 'tags', $[OBJECT]);
```
```php
    public function update([OBJECT] $[OBJECT], Request $request)
    {
        $this->tag->syncMultipleTagsByZoneForEntity($request->tags, 'tags', $[OBJECT]);
```

To Entitie add:
```php
use Modules\Tags\Support\Traits\TagRelation;
```
```php
class [OBJECT] extends Model
{
    use TagRelation;
```

In Views:
```php
	@include('tags::admin.fields.tags', ['zone' => 'tags'])
```


## Resources

- [License](LICENSE.md)
