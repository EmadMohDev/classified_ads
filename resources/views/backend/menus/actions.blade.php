<div class="float-end">
    @if (! empty($menu->route))
        <a href="{{ routeHelper($menu->route) }}" class="btn btn-sm btn-dark" data-toggle="tooltip" data-bs-custom-class="tooltip-dark" data-bs-placement="top" title="Show Page">
            <i class="fas fa-eye"></i>
        </a>
    @endif

    @if (canUser("menus-edit"))
        <a href="{{ routeHelper('menus.edit', $menu->id) }}" class="btn btn-sm btn-primary show-modal-form" data-toggle="tooltip" data-bs-custom-class="tooltip-dark" data-bs-placement="top" title="Edit This Menu">
            <i class="fas fa-edit"></i>
        </a>
    @endif

    @if (canUser("menus-create"))
        <a href="{{ routeHelper('menus.subs.create', $menu->id) }}" class="btn btn-sm btn-info show-modal-form" data-toggle="tooltip" data-bs-custom-class="tooltip-dark" data-bs-placement="top" title="Create Sub Menu">
            <i class="fas fa-plus"></i>
        </a>
    @endif

    @if (canUser("menus-destroy"))
        <form action="{{ routeHelper('menus.destroy', $menu->id) }}" method="POST" class="form-destroy d-inline">
            @csrf
            @method('delete')
            <button type="submit" class="btn btn-sm btn-danger delete" data-toggle="tooltip" data-bs-custom-class="tooltip-dark" data-bs-placement="top" title="Delete This Menu">
                <i class="fas fa-trash"></i>
            </button>
        </form>
    @endif

    @if ((isset($menu->parent) && $menu->parent->visible) || ! $menu->parent)
        <form action="{{ routeHelper('menus.toggle.visible', $menu->id) }}" method="POST" class="d-inline">
            @csrf
            @if ($menu->visible)
                <button type="submit" class="btn btn-warning btn-sm" data-toggle="tooltip" data-bs-custom-class="tooltip-dark" data-bs-placement="top" title="Make Menu Is Hidden">
                    <i class="fas fa-eye-slash"></i>
                </button>
            @else
                <button type="submit" class="btn btn-success btn-sm" data-toggle="tooltip" data-bs-custom-class="tooltip-dark" data-bs-placement="top" title="Make Menu Is Visible">
                    <i class="fas fa-eye"></i>
                </button>
            @endif
        </form>
    @else
        <button class="btn btn-secondary btn-sm" style="cursor: no-drop" data-toggle="tooltip" data-bs-custom-class="tooltip-dark" data-bs-placement="top" title="First Parent Must Be Visible">
            <i class="fas fa-hand-paper"></i>
        </button>
    @endif

</div>
