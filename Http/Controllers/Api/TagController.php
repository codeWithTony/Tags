<?php namespace Modules\Tags\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Modules\Tags\Events\TagWasLinked;
use Modules\Tags\Events\TagWasUnlinked;
use Modules\Tags\Events\TagWasUploaded;
use Modules\Tags\Http\Requests\UploadTagRequest;
use Modules\Tags\Repositories\TagRepository;
use Modules\Tags\Services\TagService;

class TagController extends Controller
{
    /**
     * @var TagService
     */
    private $tagService;
    /**
     * @var TagRepository
     */
    private $tag;

    public function __construct(TagService $tagService, TagRepository $tag)
    {
        $this->tagService = $tagService;
        $this->tag = $tag;
    }

    public function all()
    {
        $tags = $this->tag->all();

        return [
            'count' => $tags->count(),
            'data' => $tags,
        ];
    }

    /**
     * Store a newly created resource in storage.
     * @param  CreateTagRequest $request
     * @return Response
     */
    public function store(CreateTagRequest $request)
    {
        $savedTag = $this->tagService->store($request->tag('tag'));

        if (is_string($savedTag)) {
            return Response::json(['error' => $savedTag], 409);
        }

        event(new TagWasCreated($savedTag));

        return Response::json($savedTag->toArray());
    }

    /**
     * Link the given entity with a tag
     * @param Request $request
     */
    public function linkTag(Request $request)
    {
        $tagId = $request->get('tagId');
        $entityClass = $request->get('entityClass');
        $entityId = $request->get('entityId');

        $entity = $entityClass::find($entityId);
        $zone = $request->get('zone');
        $entity->files()->attach($tagId, ['tagable_type' => $entityClass, 'zone' => $zone]);
        $tagable = DB::table('tags__tagables')->whereTagId($tagId)->whereZone($zone)->whereImageableType($entityClass)->first();
        $tag = $this->tag->find($tagable->tag_id);

//        $thumbnailPath = $this->imagy->getThumbnail($tag->path, 'mediumThumb');

        event(new TagWasLinked($tag, $entity));

        return Response::json([
            'error' => false,
            'message' => 'The link has been added.',
            'result' => ['tagableId' => $tagable->id]
        ]);
    }

    /**
     * Remove the record in the tags__tagables table for the given id
     * @param Request $request
     */
    public function unlinkTag(Request $request)
    {
        $tagableId = $request->get('tagableId');
        $deleted = DB::table('tags__tagables')->whereId($tagableId)->delete();
        if (! $deleted) {
            return Response::json(['error' => true, 'message' => 'The tag was not found.']);
        }

        event(new TagWasUnlinked($tagableId));

        return Response::json(['error' => false, 'message' => 'The link has been removed.']);
    }
}
