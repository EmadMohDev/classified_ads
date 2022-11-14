<div class="toolbar" id="kt_toolbar">
    <!--begin::Container-->
    <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
        <!--begin::Page title-->
        <div data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}" class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
            <!--begin::Breadcrumb-->
            <ul class="breadcrumb breadcrumb-separatorless fw-bold fs-5 my-1">

                @php $full_url = ""; @endphp
                @foreach (convertUrlToArray() as $link)
                    @php $full_url .= "/$link"; @endphp

                    @if($loop->last || stripos($link, "{") !== false)
                        <li class="breadcrumb-item">
                            @if ($link == "")
                                @lang('menu.dashboard')
                            @elseif (stripos($link, "{") !== false)
                                @php $full_url = str_replace($link, getModelSlug($link, true), $full_url); @endphp
                                <span class="text-muted"> {{ getModelSlug($link) }} </span>
                            @else
                                @lang("menu.$link")
                            @endif

                            @if (!$loop->last)
                                <li class="breadcrumb-item">
                                    <span class="bullet bg-gray-300 w-10px h-3px"></span>
                                </li>
                            @endif
                        </li>
                    @else
                        <li class="breadcrumb-item text-muted">
                            <a href="{{ url($full_url) }}" class="text-muted text-hover-primary">
                                {{ $link == "" ? trans('menu.dashboard') : trans("menu.$link") }}
                            </a>
                        </li>

                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-300 w-8px h-2px"></span>
                        </li>
                    @endif
                @endforeach
            </ul>
            <!--end::Breadcrumb-->
        </div>
        <!--end::Page title-->
    </div>
    <!--end::Container-->
</div>


