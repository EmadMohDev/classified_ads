<ul class="nav nav-tabs nav-pills">
    @foreach ($roles as $role)
        <li class="nav-item">
            <a class="nav-link {{ $loop->first ? "active" : "" }}" data-bs-toggle="tab" href="#{{ str_replace(' ', '_', $role->name)."_".$role->id }}">{{ $role->name }}</a>
        </li>
    @endforeach
</ul>

<div class="tab-content" id="myTabContent">
    @foreach ($roles as $role)
    <div class="tab-pane fade show list-routes {{ $loop->first ? "active" : "" }}" id="{{ str_replace(' ', '_', $role->name)."_".$role->id }}" role="tabpanel">
        <button class="btn btn-sm btn-info toggle-checked float-end">Check/Uncheck All</button>
            @foreach ($routes as $route)
                    <div class="form-group mb-5">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="form-switch">
                                    <input type="checkbox" name="roles[{{ $route->id }}][]" value="{{ $role->id }}" multiple class="form-check-input cursor-pointer" id="route_{{ $route->id }}_role_{{ $role->id }}" @checked($route->hasRole($role->id)) style="margin-top: 8px;">
                                </div>
                            </div>
                            <p class="form-control copy text-primary" data-toggle="tooltip" title="@lang('buttons.copy')" style="flex-grow: 3">{{ $route->uri }}</p>
                            <p class="form-control copy text-info" style="flex-grow: 2">{{ $route->route }}</p>
                            <p class="form-control text-danger">{{ str_replace(',', ' | ', $route->method) }}</p>
                            <p class="form-control copy text-success" data-toggle="tooltip" title="@lang('buttons.copy')">{{ $route->func }}</p>
                        </div>
                    </div>
            @endforeach
        </div>
    @endforeach
</div>
