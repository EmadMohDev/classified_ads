<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\PostDataTable;
use App\Http\Controllers\BackendController;
use App\Http\Requests\PostRequest;
use App\Http\Services\PostService;
use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PostController extends BackendController
{
    public $use_form_ajax  = true;
    public $index_view     = "backend.posts.index";

    public function __construct(PostDataTable $dataTable, Post $post)
    {
        parent::__construct($dataTable, $post);
    }

    public function store(PostRequest $request, PostService $PostService)
    {
        $row = $PostService->handle($request->validated());
        if (is_string($row)) return $this->throwException($row);
        $redirect = routeHelper("posts.index");
        return $this->redirect(trans('flash.row created', ['model' => trans('menu.post')]), $redirect);
    }

    public function update(PostRequest $request, PostService $PostService, $id)
    {
        $row = $PostService->handle($request->validated(), $id);
        if (is_string($row)) return $this->throwException($row);
        return $this->redirect(trans('flash.row updated', ['model' => trans('menu.post')]));
    }

    public function append(): array
    {
        return [

        ];
    }




}
