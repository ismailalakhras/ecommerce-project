<?php

namespace App\DataTables\Backend;

use App\Models\Subcategory;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class SubcategoryDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', 'backend.pages.subcategory.partials.actions')
            ->addColumn('category_name', fn($subcategory) => $subcategory->category->name ?? '')
            ->editColumn('name', function ($row) {
                return view('backend.pages.subcategory.partials.name', compact('row'));
            })
            ->editColumn('is_active', function ($subcategory) {
                return $subcategory->is_active ? 'Yes' : 'No';
            })

            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Subcategory $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('subcategory-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            // ->dom('Bfrtip')
            ->dom("<'row align-items-center mb-3'
                        <'col-md-7'l>
                        <'col-md-5 d-flex justify-content-end align-items-center'
                            <'me-2'f>
                            B
                        >
                    >
                    <'row'
                        <'col-12'tr>
                    >
                    <'row mt-2'
                        <'col-md-5'i>
                        <'col-md-7 text-end'p>
                    >
                ")



            ->orderBy(1)
            ->selectStyleSingle()
            ->buttons([
                Button::make('excel')->className('btn btn-success me-1 custom-btn'),
                Button::make('csv')->className('btn btn-info me-1 custom-btn'),
                Button::make('pdf')->className('btn btn-danger me-1 custom-btn'),
                Button::make('print')->className('btn btn-warning me-1 custom-btn'),

            ]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::computed('action')
                ->title('')
                ->exportable(false)
                ->printable(false)
                ->width(60)
                ->addClass('text-center bg-action-column'),

            Column::make('id')->addClass('text-center align-middle'),
            Column::make('name')->addClass('align-middle'),
            Column::make('category_name')->title('Category')->addClass(' align-middle')->orderable(false),

            Column::make('slug')->addClass(' align-middle')->orderable(false),
            Column::make('description')->addClass(' align-middle')->orderable(false),

            Column::make('is_active')->addClass('text-center align-middle'),
            Column::make('sort_order')->addClass('text-center align-middle'),
            Column::make('meta_title')->addClass(' align-middle')->orderable(false),
            Column::make('meta_description')->addClass(' align-middle')->orderable(false),

            Column::make('created_at')->addClass(' align-middle'),
            Column::make('updated_at')->addClass(' align-middle'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Subcategory_' . date('YmdHis');
    }
}
