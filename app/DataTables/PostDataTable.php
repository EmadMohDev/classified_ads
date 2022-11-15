<?php

namespace App\DataTables;

use App\Models\Post;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class PostDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
            // title    description  contact_phone_number  image  user_id
        return datatables()
            ->eloquent($query)
            ->addColumn('check', 'backend.includes.tables.checkbox')

            ->editColumn('image', function(Post $post) {return view('backend.includes.tables.image', ['image' => $post->image, 'alt' => $post->title])->render();})

            ->filterColumn('user_id', function ($query, $keywords) {
                return $query->whereHas('user', function($query) use($keywords) {
                    return $query->where('user.name', 'LIKE', "%$keywords%");
                });
            })

            ->editColumn('action', function(Post $post) {return view('backend.posts.actions', ['id' => $post->id])->render();})
            ->rawColumns(['action', 'check', 'image']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Post $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Post $model)
    {
        return $model->filter()->with('user:id,name');
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('post-table')
                    ->columns($this->getColumns())
                    ->setTableAttribute('class', 'table table-bordered table-striped table-sm w-100 dataTable')
                    ->minifiedAjax()
                    ->dom('Brtip')
                    ->lengthMenu([[5, 10, 20, 25, 30, -1], [5, 10, 20, 25, 30, 'All']])
                    ->pageLength(20)
                    ->buttons([
                        Button::make()->text('<i class="fa fa-plus"></i>')->addClass('btn btn-info '. (canUser("posts-create") ? "" : "remove-hidden-element"))->action("window.location.href = window.location.href+'/create'")->titleAttr(trans('menu.create-row', ['model' => trans('menu.post')])),
                        Button::make()->text('<i class="fas fa-trash"></i>')->addClass('btn btn-danger multi-delete '. (canUser("posts-multidelete") ? "" : "remove-hidden-element"))->titleAttr(trans('buttons.multi-delete')),

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
                    ->orderBy(2);
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
            Column::make('id')->title('ID')->footer('#'),
            Column::make('title')->title(trans('inputs.title')),
            Column::make('description')->title(trans('inputs.description')),
            Column::make('contact_phone_number')->title(trans('inputs.contact_phone_number')),
            Column::make('image')->title(trans('title.avatar'))->footer(trans('title.avatar'))->orderable(false),

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
        return 'Post_' . date('YmdHis');
    }
}
