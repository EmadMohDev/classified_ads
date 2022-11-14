<style>
    .details {
        text-align: center;
        font-weight: bold;
        font-size: 20px;
        background: #ccc;
    }

    table#note-details {
        direction: "{{ App::isLocale('ar') ? 'rtl' : 'ltr'  }}";
        margin: auto;
        width: 100%
    }

    #note-details tr {
        background: #ccc;
        text-align: right;
        width: 100px
    }

    #note-details tr:nth-child(odd) {
        background: #fff;
    }

    #note-details th {
        padding: 10px 20px !important;
        border: 1px solid #666;
        border-collapse: collapse;
        text-align: {{ App::isLocale('ar') ? 'right' : 'left'  }};
    }
</style>

@if(isset($body))
    <p> {!! $body !!} </p>
@endif

<hr>

<h3 class="details" style="padding: 20px"> <a href="{{ routeHelper("notes.show", $row->id) }}">@lang('title.for more details')</a> </h3>

<table class="table table-bordered mb-0" id="note-details">
    <thead>

        <tr>
            <th style="width: 200px"><b>@lang('menu.club')</b></th>
            <th>{{ $row->club->name }}</th>
        </tr>

        <tr>
            <th style="width: 200px"><b>@lang('menu.note_category')</b></th>
            <th>{{ $row->category->name }}</th>
        </tr>

        <tr>
            <th style="width: 200px"><b>@lang('inputs.manager')</b></th>
            <th>{{ $row->manager->name }}</th>
        </tr>

        <tr>
            <th style="width: 200px"><b>@lang('inputs.employee')</b></th>
            <th>{{ $row->employee->name }}</th>
        </tr>

        <tr>
            <th style="width: 200px"><b>@lang('menu.priority')</b></th>
            <th>{{ "{$row->priority->name} ({$row->priority->duration} Days)" }}</th>
        </tr>

        <tr>
            <th style="width: 200px"><b>@lang('inputs.created_at')</b></th>
            <th>{{ $row->created_at->format('Y-m-d') }}</th>
        </tr>

        <tr>
            <th style="width: 200px"><b>@lang('inputs.desc')</b></th>
            <th>{!! $row->desc !!}</th>
        </tr>

        <tr>
            <th style="width: 200px"><b>@lang('inputs.deadline_date')</b></th>
            <th>{{ $row->deadline_date }}</th>
        </tr>

        @if ($row->employee_close_date)
        <tr>
                <th style="width: 200px"><b>@lang('inputs.employee_close_date')</b></th>
                <th>{{ $row->employee_close_date }}</th>
            </tr>
        @endif

        @if ($row->employee_reply)
            <tr>
                <th style="width: 200px"><b>@lang('inputs.employee_reply')</b></th>
                <th>{!! $row->employee_reply !!}</th>
            </tr>
        @endif

        <tr>
            <th style="width: 200px"><b>@lang('inputs.status')</b></th>
            <th>@lang("inputs.".$row->status->name)</th>
        </tr>

    </thead>
</table>

<br>
<p>
    Thank You,
</p>
