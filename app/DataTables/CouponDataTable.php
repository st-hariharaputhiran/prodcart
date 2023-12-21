<?php

namespace App\DataTables;

use App\Models\Coupon;
use Yajra\DataTables\Services\DataTable;
use Illuminate\Http\Request;

class CouponDataTable extends DataTable
{
    public function dataTable($query)
    {
        return datatables($query)
            ->editColumn('coupon_title', function ($model) {
                return ucwords($model->coupon_title);
            })
            ->editColumn('coupon_code', function ($model) {
                return ucwords(@$model->coupon_code);
            })
            ->editColumn('coupon_type', function ($model) {
                return  $model->coupon_type;
            })
            ->editColumn('discount_amount', function ($model) {
                return $model->discount_amount;
            })
            ->editColumn('start_at', function ($model) {
                return $model->start_at;
            })
            ->editColumn('expire_at', function ($model) {
                return $model->expire_at;
            })
            
            ->editColumn('action', function ($model) {
                $action = '<a href="'.route('coupons.edit', $model->id).'" class="badge btn-success btn-sm" title="Edit"><i class="fa fa-edit"></i></a>&nbsp;';
                
                $action .= '<a href="javascript:void(0);" class="badge btn-danger btn-sm btn-delete" data-id="'.$model->id.'" data-model="coupons" data-loading-text="<i class=\'fa fa-spin fa-spinner\'></i> Please Wait..." title="Delete"><i class="fa fa-trash"></i></a>';

                return $action;
            })
            ->editColumn('created_at', function ($model) {
                return $model->created_at;
            })
            ->rawColumns(['action']);
    }

    public function query(Coupon $model, Request $request)
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
                'dom' => 'Bfrtip',
                'buttons' => ['create'],
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
                'data' => 'coupon_title',
                'title' => ' Coupon Name',
            ],
            [
                'data' => 'coupon_code',
                'title' => 'Coupon Code',
            ],
            [
                'data' => 'coupon_type',
                'title' => 'Coupon Type',
            ],
            [
                'data' => 'discount_amount',
                'title' => 'Discount Amount',
            ],
            [
                'data' => 'start_at',
                'title' => 'Starts At',
            ],
            [
                'data' => 'expire_at',
                'title' => 'Expiry',
            ],
            'created_at'
        ];
    }

}
