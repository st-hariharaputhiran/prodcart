@extends('webadmin.layouts.admin')
        
        <!-- ============================================================== -->
        <!-- end left sidebar -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- wrapper  -->
        <!-- ============================================================== -->
        @section('content')
        <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
   
      <div class="container-fluid py-1 px-2">
                   
        <div class="card mb-5 mb-xl-10">
        <div class="card-header border-0 cursor-pointer">
            <div class="card-title m-0">
                <h3 class="fw-boldest m-0">Coupons</h3>
            </div>
        </div>
        <div class="card-body border-top p-9">
            {!! $dataTable->table([
                'class' => 'table align-middle table-row-dashed fs-6 gy-5 dataTable',
                'id' => 'datatable-buttons',
            ]) !!}
        </div>
        </div>
        @include('webadmin.partials.datatable_scripts')
                    
            </div>
            
            </main>
        
    @endsection   
</body>
 
</html>
