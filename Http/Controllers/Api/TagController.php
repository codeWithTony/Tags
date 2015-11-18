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


}
