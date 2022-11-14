@if (canUser("$model-index"))
    <div class="col-xl-3">
        <!--begin::Statistics Widget 5-->
        <div class="card my-4">
            <a href="{{ routeHelper("$model.index") }}" class="hoverable" style="background-color: {{ $color }}">
                <!--begin::Body-->
                <div class="card-body">
                    <!--begin::Svg Icon | path: icons/duotune/ecommerce/ecm008.svg-->
                    <i class="{{ $icons[ ucwords( str_replace('_', ' ', $model) ) ] }} text-white fa-3x font-large-2 float-end"></i>
                    <!--end::Svg Icon-->
                    <div class="text-white fw-bolder fs-2 mb-2 mt-5">{{ $count }}</div>
                    <h2 class="fw-bold text-white mb-0">@lang("menu.$model")</h2>
                </div>
                <!--end::Body-->
            </a>

            @if (canUser("$model-create"))
                <a href="{{ routeHelper("$model.create") }}" class="btn btn-sm text-white d-block mt-1" style="background-color: {{ $color }}">
                    <i class="fa fa-plus text-white"></i> <b> @lang('buttons.create')</b>
                </a>
            @endif
        </div>
        <!--end::Statistics Widget 5-->
    </div>
@endif
