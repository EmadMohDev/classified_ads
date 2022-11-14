<div class="mb-8">
    <!--begin::Info-->
    <div class="d-flex justify-content-between mb-6">
        <!--begin::Item-->
        <div class="me-9 my-1">
            <span class="me-1"> <i class="fas fa-calendar-check text-primary"></i> </span>
            <span class="fw-bolder text-dark"><span class=""> <b>Created Date:</b> <span class="fw-normal text-gray-800">{{ $row->created_at->format('l, d M Y') }}</span> </span></span>
        </div>
        <!--end::Item-->

        <!--begin::Item-->
        <div class="me-9 my-1">
            {{-- <span class="me-1"> <i class="fas fa-question text-primary"></i> </span> --}}
            <span class="fw-bolder text-dark"> @lang('menu.content_type'): <span class="text-hover-primary fw-normal text-gray-800">{{ $row->contentType?->name }}</span> </span>
        </div>
        <!--end::Item-->

        <!--begin::Item-->
        <div class="me-9 my-1">
            <span class="me-1"> <i class="fas fa-list text-primary"></i> </span>
            <span class="fw-bolder text-dark"> @lang('menu.category'): <span class="text-hover-primary text-hover-primary fw-normal text-gray-800">{{ $row->category?->name }}</span></span>
        </div>
        <!--end::Item-->
    </div>
    <!--end::Info-->



    <div class="card-header bg-secondary">
        <h3 class="card-title">
            @lang('inputs.title') :
            <ul class="nav nav-tabs nav-pills nav-line-tabs-2x my-5 fs-6 bg-secondary mx-10">
                @foreach (config('languages') as $name => $lang)
                    <li class="nav-item bg-secondary me-0">
                        <a class="nav-link btn-light-success {{ $loop->first ? "active" : "" }}" data-bs-toggle="tab" href="#title-{{ $lang }}">{{ ucfirst($name) }}</a>
                    </li>
                @endforeach
            </ul>
        </h3>
    </div>

        <!--begin::Title-->

        <div class="tab-content py-10">
            @foreach (config('languages') as $name => $lang)
                <div class="tab-pane fade {{ $loop->first ? "show active" : "" }}" id="title-{{ $lang }}" role="tabpanel">
                    <p>{{ $row->getTitle($lang) }}</p>
                </div>
            @endforeach
        </div>
        <!--end::Title-->
</div>



