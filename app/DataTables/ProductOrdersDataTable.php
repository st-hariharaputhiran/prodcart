<?php

namespace App\DataTables;

use App\Models\ProductOrders;
use Yajra\DataTables\Services\DataTable;
use Illuminate\Http\Request;

class ProductOrdersDataTable extends DataTable
{
    public function dataTable($query)
    {
        return datatables($query)
            ->editColumn('id', function ($model) {
                return ucwords($model->id);
            })
            ->editColumn('firstname', function ($model) {
                return ucwords(@$model->firstname);
            })
            ->editColumn('lastname', function ($model) {
                return (int) $model->lastname;
            })
            ->editColumn('mobile', function ($model) {
                return $model->mobile;
            })
            ->editColumn('email', function ($model) {
                return $model->email;
            })
            ->editColumn('subtotal', function ($model) {
                return $model->subtotal;
            })
            ->editColumn('total', function ($model) {
                return $model->total;
            })
            ->editColumn('action', function ($model) {
                
                $action = '<a href="javascript:void(0);" class="badge btn-danger btn-sm btn-delete" data-id="'.$model->id.'" data-model="productorders" data-loading-text="<i class=\'fa fa-spin fa-spinner\'></i> Please Wait..." title="Delete"><i class="fa fa-trash"></i></a>';

                return $action;
            })
            ->editColumn('created_at', function ($model) {
                return $model->created_at;
            })
            ->rawColumns(['action']);
    }

    public function query(ProductOrders $model, Request $request)
    {        
        $query = $model->newQuery();
        return $query;
    }

    public function html()
    {
        $html = $this->builder()
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->addAction()
            ->parameters([
                //'dom' => 'Bfrtip',
                //'buttons' => ['create'],
                'stateSave'=> true,
                'bInfo' => false,
                'order' => [[5, 'desc']],
            ]);

        return $html;
    }

    protected function getColumns()
    {
        return [
            [
                'data' => 'id',
                'title' => 'Order Number',
            ],
            [
                'data' => 'firstname',
                'title' => 'First Name',
            ],
            [
                'data' => 'lastname',
                'title' => 'Last Name',
            ],
            [
                'data' => 'mobile',
                'title' => 'Mobile Number',
            ],
            [
                'data' => 'email',
                'title' => 'Email',
            ],
            [
                'data' => 'subtotal',
                'title' => 'Subtotal',
            ],
            [
                'data' => 'total',
                'title' => 'Total Price',
            ],
            'created_at'
        ];
    }

}
