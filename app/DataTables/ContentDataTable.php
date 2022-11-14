<?php

namespace App\DataTables;

use App\Models\Content;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class ContentDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->editColumn('content_type_id', function(Content $content) {
                return $content->contentType?->name;
            })
            ->addColumn('cover', function(Content $content) {
                return "<a href='".routeHelper('contents.show', $content)."' class='btn btn-sm btn-info' data-toggle='tooltip' data-bs-custom-class='tooltip-dark' data-bs-placement='top'
                            title='".trans('buttons.cover')."'>
                            <i class='fas fa-info'></i> ".trans('title.show-row-details', ['model' => trans('menu.content')])."
                        </a>";
            })
            ->filterColumn('category.name', function($query, $keywords) {
                return $query->whereHas('category', function($query) use($keywords) {
                    return $query->where('name', 'LIKE', "%$keywords%");
                });
            })
            ->filterColumn('content_type_id', function($query, $keywords) {
                return $query->whereHas('contentType', function($query) use($keywords) {
                    return $query->where('name', 'LIKE', "%$keywords%");
                });
            })
            ->addColumn('check', 'backend.includes.tables.checkbox')
            ->editColumn('rbts', function(Content $content) {return view('backend.contents.rbts', compact('content'));})
            ->editColumn('posts', function(Content $content) {return view('backend.contents.posts', compact('content'));})
            ->editColumn('action', 'backend.includes.buttons.table-buttons')
            ->rawColumns(['action', 'check', 'cover', 'rbts', 'posts']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Content $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Content $model)
    {
        return $model->with('category', 'contentType:id,name')->withCount('posts', 'rbts')->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                ->setTableId('content-table')
                ->columns($this->getColumns())
                ->setTableAttribute('class', 'table table-bordered table-striped table-sm w-100 dataTable')
                ->minifiedAjax()
                ->dom('Bfrtip')
                ->lengthMenu([[5, 10, 20, 25, 30, -1], [5, 10, 20, 25, 30, 'All']])
                ->pageLength(5)
                ->buttons([
                    Button::make()->text('<i class="fa fa-plus"></i>')->addClass('btn btn-info '. (canUser("contents-create") ? "" : "remove-hidden-element"))->action("window.location.href = " . '"' . routeHelper('contents.create'). '"')->titleAttr(trans('menu.create-row', ['model' => trans('menu.content')])),
                    Button::make()->text('<i class="fas fa-trash"></i>')->addClass('btn btn-danger multi-delete '. (canUser("contents-multidelete") ? "" : "remove-hidden-element"))->titleAttr(trans('buttons.multi-delete')),
                    Button::make('pageLength')->text('<i class="fa fa-sort-numeric-up"></i>')->addClass('btn btn-light page-length')->titleAttr(trans('buttons.page-length'))
                ])
                ->responsive(true)
                ->parameters([
                    'initComplete' => " function () {
                        this.api().columns([2,3,4]).every(function () {
                            var column = this;
                            var input = document.createElement(\"input\");
                            $(input).appendTo($(column.header()))
                            .on('keyup', function () {
                                column.search($(this).val(), false, false, true).draw();
                            });
                        });
                    }",
                ])
                ->orderBy(0);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            Column::make('id')->hidden(),
            Column::make('check')->title('<label class="skin skin-square"><input data-color="red" type="checkbox" class="switchery" id="check-all"></label>')->exportable(false)->printable(false)->orderable(false)->searchable(false)->width(15)->addClass('text-center')->footer(trans('buttons.delete')),
            Column::make('title')->title(trans('inputs.title')),
            Column::make('content_type_id')->title(trans('menu.content_type')),
            Column::make('category.name')->title(trans('menu.category')),
            Column::computed('cover')->exportable(false)->printable(false)->addClass('text-center')->footer(trans('buttons.cover'))->title(trans('buttons.cover')),
            Column::computed('rbts')->exportable(false)->printable(false)->addClass('text-center')->footer(trans('menu.rbts'))->title(trans('menu.rbts')),
            Column::computed('posts')->exportable(false)->printable(false)->addClass('text-center')->footer(trans('menu.posts'))->title(trans('menu.posts')),
            Column::computed('action')->exportable(false)->printable(false)->addClass('text-center')->footer(trans('inputs.action'))->title(trans('inputs.action')),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Content_' . date('YmdHis');
    }
}
