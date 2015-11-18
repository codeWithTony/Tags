<?php namespace Modules\Tags\Http\Controllers\Admin;

use Illuminate\Contracts\Config\Repository;
use Modules\Core\Http\Controllers\Admin\AdminBaseController;
use Modules\Tags\Entities\Tag;
use Modules\Tags\Http\Requests\UpdateTagRequest;
use Modules\Tags\Http\Requests\CreateTagRequest;
use Modules\Tags\Repositories\TagRepository;

class TagController extends AdminBaseController
{
    /**
     * @var TagRepository
     */
    private $tag;
    /**
     * @var Repository
     */
    private $config;

    public function __construct(TagRepository $tag, Repository $config)
    {
        parent::__construct();
        $this->tag = $tag;
        $this->config = $config;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $tags = $this->tag->all();
        $config = $this->config->get('asgard.tags.config');

        return view('tags::admin.index', compact('tags', 'config'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('tags::admin.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateTagRequest $request
     * @return Response
     */
    public function store(CreateTagRequest $request)
    {
        $this->tag->create($request->all());
        flash(trans('tags::messages.tag created'));
        return redirect()->route('admin.tags.tag.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Tag $tag
     * @return Response
     */
    public function edit(Tag $tag)
    {
        return view('tags::admin.edit', compact('tag'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Tag $tag
     * @param  UpdateTagRequest $request
     * @return Response
     */
    public function update(Tag $tag, UpdateTagRequest $request)
    {
        $this->tag->update($tag, $request->all());

        flash(trans('tags::messages.tag updated'));

        return redirect()->route('admin.tags.tag.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Tag $tag
     * @internal param int $id
     * @return Response
     */
    public function destroy(Tag $tag)
    {
        $this->tag->destroy($tag);

        flash(trans('tags::messages.tag deleted'));

        return redirect()->route('admin.tags.tag.index');
    }
}
