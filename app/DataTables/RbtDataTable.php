<?php

namespace App\DataTables;

use App\Models\Rbt;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;

class RbtDataTable extends DataTable
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
            ->editColumn('operator_id', function(Rbt $rbt) {return "{$rbt->operator?->name} - {$rbt->operator?->country?->name}";})
            ->editColumn('content_id', function(Rbt $rbt) {return $rbt->content?->title;})
            ->filterColumn('content_id', function ($query, $keywords) {
                return $query->whereHas('content', function($query) use($keywords) {
                    return $query->where('title', 'LIKE', "%$keywords%");
                });
            })
            ->filterColumn('operator_id', function ($query, $keywords) {
                $keywords = explode('-', $keywords);
                return $query->whereHas('operator', function($query) use($keywords) {
                    $query->where('name', 'LIKE', "%".trim($keywords[0])."%")->when(isset($keywords[1]), function($query) use($keywords) {
                        return $query->whereHas('country', function($query) use($keywords) {
                            $query->where('name', 'LIKE', "%".trim($keywords[1])."%");
                        });
                    });
                });
            })
            ->addColumn('play', function(Rbt $rbt) {
                return $rbt->content->contentType == 'Audio'
                            ? view('backend.rbts.play', ['audio' => $rbt->content->getData()])
                            : '';
            })
            ->addColumn('check', 'backend.includes.tables.checkbox')
            ->editColumn('action', 'backend.includes.buttons.table-buttons')
            ->rawColumns(['action', 'check', 'play']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Rbt $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Rbt $model)
    {
        return $model->newQuery()->filter()->with(['content', 'content.contentType', 'operator']);
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
        ->setTableId('rbts-table')
        ->columns($this->getColumns())
        ->setTableAttribute('class', 'table table-bordered table-striped table-sm w-100 dataTable')
        ->minifiedAjax()
        ->dom('Bfrtip')
        ->lengthMenu([[5, 10, 20, 25, 30, -1], [5, 10, 20, 25, 30, 'All']])
        ->pageLength(5)
        ->buttons([
            Button::make()->text('<i class="fa fa-plus"></i>')->addClass('btn btn-info '. (canUser("rbts-create") ? "" : "remove-hidden-element"))->action("window.location.href = window.location.href+'/create'")->titleAttr(trans('menu.create-row', ['model' => trans('menu.rbt')])),
            Button::make()->text('<i class="fas fa-trash"></i>')->addClass('btn btn-danger multi-delete '. (canUser("rbts-multidelete") ? "" : "remove-hidden-element"))->titleAttr(trans('buttons.multi-delete')),
            Button::make('pageLength')->text('<i class="fa fa-sort-numeric-up"></i>')->addClass('btn btn-light page-length')->titleAttr(trans('buttons.page-length'))
        ])
        ->responsive(true)
        ->parameters([
            'initComplete' => " function () {
                this.api().columns([1,2,3,4,5]).every(function () {
                    var column = this;
                    var input = document.createElement(\"input\");
                    $(input).appendTo($(column.footer()).empty())
                    .on('keyup', function () {
                        column.search($(this).val(), true, true, true).draw();
                    });
                });
            }",
        ])
        ->orderBy(1);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            Column::make('check')->title('<label class="skin skin-square"><input data-color="red" type="checkbox" class="switchery" id="check-all"></label>')->exportable(false)->printable(false)->orderable(false)->searchable(false)->width(15)->addClass('text-center')->footer(trans('buttons.delete')),
            Column::make('id')->title('ID'),
			Column::make('code')->title(trans('inputs.code')),
			Column::make('ussd')->title(trans('inputs.ussd')),
			Column::make('content_id')->title(trans('menu.content')),
			Column::make('operator_id')->title(trans('menu.operator')),
			Column::computed('play')->title(trans('buttons.play'))->exportable(false)->printable(false)->addClass('text-center')->footer(trans('buttons.play')),
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
        return 'rbts_' . date('YmdHis');
    }
}
