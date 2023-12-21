<link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
<div class="row mb-4">
    <div class="col-12 col-md-6 fv-row fv-plugins-icon-container mb-4">
        {{ Form::label('coupon_title', 'Coupon Title', ['class' => 'form-label required','enctype' => 'multipart/form-data']) }}
        {{ Form::text('coupon_title', old('coupon_title'), ['class' => 'form-control form-control-lg form-control', 'placeholder' => 'Coupon Title']) }}
    </div>
</div>


<div class="row mb-4">
    <div class="col-12 col-md-6 fv-row fv-plugins-icon-container mb-4">
        {{ Form::label('coupon_code', 'Coupon Code', ['class' => 'form-label required','enctype' => 'multipart/form-data']) }}
        {{ Form::text('coupon_code', old('coupon_code'), ['class' => 'form-control form-control-lg form-control', 'placeholder' => 'Coupon Code']) }}
    </div>
</div>
<div class="row mb-4"> 
    <div class="col-12 col-md-6 fv-row fv-plugins-icon-container mb-4">
        {{ Form::label('coupon_type', 'Coupon Type', ['class' => 'form-label','enctype' => 'multipart/form-data']) }}
        {{ Form::select('coupon_type', @$selectLookups['couponTypes'], @$selectLookups['couponType'], ['class' => 'form-control form-select form-control-lg','id' => 'coupon_type_id']) }}
    </div>     
</div>
<div class="row mb-4">
    <div class="col-12 col-md-6 fv-row fv-plugins-icon-container mb-4">
        {{ Form::label('discount_amount', 'Discount Amount', ['class' => 'form-label required','enctype' => 'multipart/form-data']) }}
        {{ Form::text('discount_amount', old('discount_amount'), ['class' => 'form-control form-control-lg form-control', 'placeholder' => 'Discount Amount']) }}
    </div>
</div>
<div class="row mb-4">
    <div class="col-12 col-md-6 fv-row fv-plugins-icon-container mb-4">
        {{ Form::label('start_at', 'Start Date', ['class' => 'form-label','enctype' => 'multipart/form-data']) }}
        {{ Form::text('start_at', old('start_at'), array('id' => 'sdatepicker')) }}
        
    </div>
</div>
<div class="row mb-4">
    <div class="col-12 col-md-6 fv-row fv-plugins-icon-container mb-4">
        {{ Form::label('expire_at', 'End Date', ['class' => 'form-label','enctype' => 'multipart/form-data']) }}
        {{ Form::text('expire_at',old('expire_at'), array('id' => 'edatepicker')) }}
        
    </div>
</div>

<div class="card-footer d-flex justify-content-end py-6 px-9">
    <a href="{{ route('products.index') }}" class="btn btn-light me-2" style="border: 1px solid black;">Back</a>
    {{ Form::submit('Save',['class' => 'btn btn-primary']) }}
</div>
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
  <script>
  $(function() {
    $( "#sdatepicker" ).datepicker({
        dateFormat: 'yy-mm-dd', 
        changeMonth: true,
        changeYear: true
    });
    $( "#edatepicker" ).datepicker({
        dateFormat: 'yy-mm-dd', 
        changeMonth: true,
        changeYear: true
    });
  });
  </script>
