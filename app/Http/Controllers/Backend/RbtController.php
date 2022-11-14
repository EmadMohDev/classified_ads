<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\RbtDataTable;
use App\Http\Controllers\BackendController;
use Illuminate\Http\Request;
use App\Models\Rbt;
use App\Http\Services\RbtService;
use App\Http\Requests\RbtRequest;
use App\Models\ContentType;

class RbtController extends BackendController
{
    public $use_form_ajax   = true;
    public $use_button_ajax = true;

    public function __construct(RbtDataTable $dataTable, Rbt $Rbt)
    {
        parent::__construct($dataTable, $Rbt);
    }

    public function store(RbtRequest $request, RbtService $RbtService)
    {
        $row = $RbtService->handle($request->validated());
        if (is_string($row)) return $this->throwException($row);
        return $this->redirect("Row Created Successfully!", routeHelper('contents.rbts.index', $request->content_id));
    }

    public function update(RbtRequest $request, RbtService $RbtService, $id)
    {
        $row = $RbtService->handle($request->validated(), $id);
        if (is_string($row)) return $this->throwException($row);
        return $this->redirect("Row Updated Successfully!");
    }

    public function append(): array
    {
        return [
			'contents' => \App\Models\Content::filter()->where('content_type_id', ContentType::where('name', 'Audio')->first()->id)->pluck('title', 'id'),
			'operators' => \App\Models\Operator::filter()->get(),
        ];
    }

    public function query($id) :object|null
    {
        return $this->model::find($id);
    }
}
