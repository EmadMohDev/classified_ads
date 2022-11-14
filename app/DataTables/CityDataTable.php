<?php

namespace App\DataTables;

use App\Models\City;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class CityDataTable extends DataTable
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
            ->editColumn('name', function(City $city) {
                $text = '<ul>';
                foreach ($city->getTranslations()['name'] as $name)
                    $text .= "<li>$name</li>";
                return "$text </ul>";
            })
            ->filterColumn('governorate_id', function ($query, $keywords) {
                return $query->whereHas('governorate', function($query) use($keywords) {
                    return $query->where('name', 'LIKE', "%$keywords%");
                });
            })
            ->editColumn('governorate_id', function(City $city) { return $city->governorate?->name; })
            ->addColumn('check', 'backend.includes.tables.checkbox')
            ->addColumn('action', 'backend.includes.buttons.table-buttons')
            ->rawColumns(['action', 'check', 'name']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\City $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(City $model)
    {
        return $model->newQuery()->filter();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('city-table')
                    ->columns($this->getColumns())
                    ->setTableAttribute('class', 'table table-bordered table-striped table-sm w-100 dataTable')
                    ->minifiedAjax()
                    ->dom('Bfrtip')
                    ->lengthMenu([[5, 10, 20, 25, 30, -1], [5, 10, 20, 25, 30, 'All']])
                    ->pageLength(5)
                    ->buttons([
                        Button::make()->text('<i class="fa fa-plus"></i> <span class="hidden" data-yajra-href="'.request()->url().'/create"></span>')->addClass('btn btn-info show-modal-form '. (canUser("cities-create") ? "" : "remove-hidden-element"))->titleAttr(trans('menu.create-row', ['model' => trans('menu.game')])),
                        Button::make()->text('<i class="fas fa-trash"></i>')->addClass('btn btn-danger multi-delete '. (canUser("cities-multidelete") ? "" : "remove-hidden-element"))->titleAttr(trans('buttons.multi-delete')),
                        Button::make('pageLength')->text('<i class="fa fa-sort-numeric-up"></i>')->addClass('btn btn-light page-length')->titleAttr(trans('buttons.page-length'))
                    ])
                    ->responsive(true)
                    ->parameters([
                        'initComplete' => " function () {
                            this.api().columns([1,2]).every(function () {
                                var column = this;
                                var input = document.createElement(\"input\");
                                $(input).appendTo($(column.footer()).empty())
                                .on('keyup', function () {
                                    column.search($(this).val(), true, true, true).draw();
                                });
                            });
                        }",
                    ]);
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
            Column::make('id')->title('#'),
            Column::make('name')->title(trans('inputs.name')),
            Column::make('governorate_id')->title(trans('menu.governorate')),
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
        return 'City_' . date('YmdHis');
    }
}