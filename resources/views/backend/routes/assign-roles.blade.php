@extends('layouts.backend')

@section('content')
<div class="card">
    @include('backend.includes.cards.table-header', ['title' => trans('title.assign-roles-for-each-route')])

    <div class="card-content collpase show">
        <div class="card-body">
            <form action="{{ routeHelper('routes.assign-roles') }}" method="post">
                @csrf

                {{-- START ROLES --}}
                <div class="form-group mb-5">
                    <label for="controller" class="required">
                        @lang('inputs.select-data', ['data' => trans('inputs.controller')])
                    </label>
                    <select class="form-control" data-control="select2" id="controller" name="controller" data-placeholder="--- @lang('inputs.select-data', ['data' => trans('inputs.controller')]) --- " required>
                        <option value="">@lang('inputs.please-select')</option>
                        @foreach ($controllers as $name)
                        <option value="{{ $name }}">{{ $name }}</option>
                        @endforeach
                    </select>
                </div>
                {{-- END ROLES --}}

                <div id="load-table" class="my-5"></div>

                {{-- END FORM BUTTONS --}}
                @include('backend.includes.buttons.form-buttons')
                {{-- END FORM BUTTONS --}}
            </form>
        </div>
    </div>
</div>
@endsection

@section('script')

    <script>
        $(function() {
            $('body').on('change', '#controller', function() {
                if ($(this).val() == '') return true;
                $('#load-table').addClass('load');
                $.ajax({
                    url: window.location.href,
                    type: "get",
                    data: {controller: $(this).val()},
                    success: function(data, textStatus, jqXHR) {
                        $('#load-table').empty().append(data);
                    },
                    error: function(jqXHR) {
                        handleErrors(jqXHR);
                        $('#load-table').removeClass('load');
                    },
                    complete: function () { $('#load-table').removeClass('load');}
                });
            });
        });
    </script>
@endsection
