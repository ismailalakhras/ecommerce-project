<?php

namespace App\DataTables\Backend;

use App\Models\Coupon;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class CouponDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', 'backend.pages.coupon.partials.actions')
           
            ->editColumn('is_active', function ($coupon) {
                return $coupon->is_active ? 'Yes' : 'No';
            })

            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Coupon $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('coupon-table')
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
            Column::make('code')->addClass('align-middle')->orderable(false),
            Column::make('type')->addClass(' align-middle')->orderable(false),

            Column::make('value')->addClass('align-middle')->orderable(false),
            Column::make('minimum_amount')->addClass('text-center align-middle')->orderable(false),
            Column::make('usage_limit')->addClass('text-center align-middle')->orderable(false),
            Column::make('used_count')->addClass('text-center align-middle')->orderable(false),

            Column::make('is_active')->addClass(' align-middle')->orderable(false),
            Column::make('starts_at')->addClass(' align-middle')->orderable(false),
            Column::make('expires_at')->addClass(' align-middle')->orderable(false),


            Column::make('created_at')->addClass(' align-middle'),
            Column::make('updated_at')->addClass(' align-middle'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Coupon_' . date('YmdHis');
    }
}
