@extends('layouts.backend')

@section('back')
    @include('backend.includes.cards.form-header')
@endsection

@section('content')
<div class="content-body">
    <div class="card">
        @if (isset($row))
        @include('backend.includes.forms.form-update')
        @else
        @include('backend.includes.forms.form-create')
        @endif
    </div>
</div>
@endsection
