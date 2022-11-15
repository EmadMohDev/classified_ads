<div class="table-responsive">
    <table class="table table-bordered mb-0">
        <thead>
            <tr>

                <th rowspan="4">
                    <img src="{{ asset($row->image) }}" class="img-thumbnail w-50">
                </th>
            </tr>
            <tr>
                <th>@lang('inputs.name')</th>
                <th>
                    <a href="{{ routeHelper('users.edit', $row->id) }}" data-toggle="tooltip" data-original-title="Edit User Details">
                        {{ $row->name }}
                    </a>
                </th>
            </tr>
            <tr>
                <th>@lang('inputs.email')</th>
                <th>{{ $row->email }}</th>
            </tr>



            <tr>
                <th>@lang('menu.roles')</th>
                <th>
                    @forelse ($row->roles as $role)
                        {{ $role->name }} {{ $loop->last ? '' : ' | ' }}
                    @empty
                        No Roles
                    @endforelse
                </th>
            </tr>
        </thead>
    </table>
</div>
