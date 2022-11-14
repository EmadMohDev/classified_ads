<div class="card-header bg-secondary">
    <h3 class="card-title"> <i class="fas fa-align-justify text-primary mx-3"></i> @lang('inputs.content') :</h3>
</div>

<div class="card-body">
    @if ($row->contentType->name == "Audio")
    <audio controls class="w-50">
        <source src="{{ url($row->getData()) }}">
    </audio>
    <a href="{{ url($row->getData()) }}" download="{{ $row->title }}.{{ last(explode('.', $row->getData())) }}"
        class="btn btn-dark btn-sm float-end"> <i class="fas fa-download"></i> Download Audio</a>

    @elseif ($row->contentType->name == "Video")
        <div class="row">
            <div class="col-md-3">
                <img src="{{ url($row->video_thumb) }}" width="100%" class="img-border img-thumbnail preview-modal-image mb-15">
            </div>
        </div>

        <di class="row">
            <div class="col-md-3">
                <video width="100%" controls>
                    <source src="{{ url($row->getData()) }}">
                </video>
            </div>

            <div class="col-md-3">
                <div class="d-flex align-items-end h-100 pb-2">
                    <a href="{{ url($row->getData()) }}"
                        download="{{ $row->title }}.{{ last(explode('.', $row->getData())) }}"
                        class="btn btn-dark btn-sm mx-5"> <i class="fas fa-download"></i> Download Video</a>
                </div>
            </div>
        </di>

    @elseif ($row->contentType->name == "Advanced Text" || $row->contentType->name == "Normal Text")
    <ul class="nav nav-tabs nav-pills nav-line-tabs-2x mb-5 fs-6 bg-secondary">
        @foreach (config('languages') as $name => $lang)
        <li class="nav-item">
            <a class="nav-link btn-light-success {{ $loop->first ? " active" : "" }}"
                data-bs-toggle="tab" href="#data-{{ $lang }}">{{ ucfirst($name) }}</a>
        </li>
        @endforeach
    </ul>
    <div class="tab-content px-1">
        @foreach (config('languages') as $name => $lang)
        <div class="tab-pane fade {{ $loop->first ? " show active" : "" }}" id="data-{{ $lang }}" role="tabpanel">
            <div>{!! $row->getData($lang) !!}</div>
        </div>
        @endforeach
    </div>

    @elseif ($row->contentType->name == "Image")
    <a href="{{ url($row->getData()) }}" download="{{ $row->title }}.{{ last(explode('.', $row->getData())) }}"
        class="btn btn-dark btn-sm float-end"> <i class="fas fa-download"></i> Download Image</a>
    <img src="{{ url($row->getData()) }}" width="100%" class="img-border img-thumbnail preview-modal-image">

    @elseif ($row->contentType->name == "External Link")
    <p>{{ $row->data }}</p>

    @else
    <p>{{ $row->data }}</p>
    @endif
</div>
