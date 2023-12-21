@extends('webadmin.layouts.admin')
@section('content')
<main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
   
      <div class="container-fluid py-1 px-2">
    <div class="card mb-5 mb-xl-10" >
        <div class="card-header border-0 cursor-pointer">
            <div class="card-title m-0">
                <h3 class="fw-boldest m-0">Create Coupon</h3>
            </div>
        </div>
        <div class="card-body border-top p-9">
            {{ Form::model($model, ['route' => 'coupons.store', 'class' => 'form-horizontal','id'  => 'classesForm','files'=> true,'autocomplete' => 'off']) }}
                @include('webadmin.coupons.partials.form')
            {{ Form::close() }}
        </div>
    </div>
</div>
</main>
@endsection