<?php

namespace App\DataTables\Backend;

use App\Models\Product;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class ProductDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', 'backend.pages.product.partials.actions')
            ->addColumn('category_name', fn($product) => $product->category->name ?? '')
            ->addColumn('subcategory_name', fn($product) => $product->subcategory->name ?? '')

            ->editColumn('image', function ($row) {
                return view('backend.pages.product.partials.image', compact('row'));
            })

            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Product $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('product-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom('Bfrtip')
            ->orderBy(1)
            ->selectStyleSingle()
            ->buttons([
                Button::make('excel')->className('btn btn-success me-1'),
                Button::make('csv')->className('btn btn-info me-1'),
                Button::make('pdf')->className('btn btn-danger me-1'),
                Button::make('print')->className('btn btn-warning me-1'),

            ]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(60)
                ->addClass('text-center'),
            Column::make('id'),
            Column::make('name'),
            Column::make('image'),
            Column::make('category_name')->title('Category'),
            Column::make('subcategory_name')->title('Subcategory'),
            Column::make('slug'),
            Column::make('description'),
            Column::make('short_description'),
            Column::make('sku'),
            Column::make('price'),
            Column::make('sale_price'),
            Column::make('cost_price'),
            Column::make('stock_quantity'),
            Column::make('min_quantity'),
            Column::make('weight'),
            Column::make('dimensions'),
            Column::make('is_active'),
            Column::make('is_featured'),
            Column::make('manage_stock'),
            Column::make('stock_status'),
            Column::make('meta_title'),
            Column::make('meta_description'),
            Column::make('rating_average'),
            Column::make('rating_count'),
            Column::make('created_at'),
            Column::make('updated_at'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Product_' . date('YmdHis');
    }
}
