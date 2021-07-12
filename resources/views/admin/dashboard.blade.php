@extends('template.coreTemplate')
@section('title', 'Dashboard')
@section('breadcrumb')
   <div class="section-header-breadcrumb">
      <div class="breadcrumb-item active"><a href="/admin">Dashboard</a></div>
   </div>
@endsection
@section('content')
   <div class="row">
      <div class="col-lg-3 col-md-6 col-sm-6 col-12">
         <div class="card card-statistic-1">
            <div class="card-icon bg-primary">
               <i class="fas fa-store"></i>
            </div>
            <div class="card-wrap">
               <div class="card-header">
                  <h4>Total Lapak</h4>
               </div>
               <div class="card-body">
                  {{ count($lapaks) }}
               </div>
            </div>
         </div>
      </div>
      <div class="col-lg-3 col-md-6 col-sm-6 col-12">
         <div class="card card-statistic-1">
            <div class="card-icon bg-info">
               <i class="far fa-user"></i>
            </div>
            <div class="card-wrap">
               <div class="card-header">
                  <h4>Total Pedagang</h4>
               </div>
               <div class="card-body">
                  {{ count($pedagangs) }}
               </div>
            </div>
         </div>
      </div>
      <div class="col-lg-3 col-md-6 col-sm-6 col-12">
         <div class="card card-statistic-1">
            <div class="card-icon bg-warning">
               <i class="fas fa-money-check-alt"></i>
            </div>
            <div class="card-wrap">
               <div class="card-header">
                  <h4>Total</h4>
               </div>
               <div class="card-body">
                  2
               </div>
            </div>
         </div>
      </div>
      <div class="col-lg-3 col-md-6 col-sm-6 col-12">
         <div class="card card-statistic-1">
            <div class="card-icon bg-success">
               <i class="far fa-user"></i>
            </div>
            <div class="card-wrap">
               <div class="card-header">
                  <h4>Data Non Spt</h4>
               </div>
               <div class="card-body">
                  1
               </div>
            </div>
         </div>
      </div>
   </div>

   {{--  --}}
   <div class="row">
      <div class="col-lg-8 col-md-12 col-12 col-sm-12">
         <div class="card">
            <div class="card-header">
               <h4>Tagihan retribusi pedagang</h4>
               <div class="card-header-action">
                  <div class="btn-group">
                     <a href="#" class="btn btn-primary">Week</a>
                     <a href="#" class="btn">Month</a>
                  </div>
               </div>
            </div>
            <div class="card-body">
               <table class="table table-condensed" style="font-size:12px;">
                  <thead>
                     <tr>
                        <th>#</th>
                        <th>Nama</th>
                        <th>Detail Lapak</th>
                        <th>Jumlah Tanggungan</th>
                     </tr>
                  </thead>
               </table>
            </div>
         </div>
      </div>
   </div>
@endsection