@extends('layouts.backend')

@section('back')
    @if(canUser(getModel().'-edit'))
        <a href="{{ routeHelper("{$row->getTable()}.edit", $row) }}" data-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="tooltip-dark" title="" class="btn btn-info float-end btn-glow" style="line-height: 3" data-bs-original-title="Go To Edit Page">
            <i class="fas fa-edit"></i>  @lang('buttons.edit')
        </a>
    @endif
@endsection

@section('content')
<div class="card">
    {{-- START INCLUDE TABLE HEADER --}}
    @include('backend.includes.cards.table-header', ['title' => trans('title.show-row-details', ['model' => trans('menu.'.getModel(true))])])
    {{-- START INCLUDE TABLE HEADER --}}

    <div class="card-content collpase show">
        <div class="card-body">
            @include('backend.'.getModel().'.show')
        </div>
    </div>
</div>
@endsection
