@extends('template.coreTemplate')
@section('title', 'Dashboard')
@section('breadcrumb')
   <div class="section-header-breadcrumb">
      <div class="breadcrumb-item active"><a href="/">Dashboard</a></div>
   </div>
@endsection
@section('content')
   <div class="row">
      <div class="col-lg-3 col-md-6 col-sm-6 col-12">
         <div class="card card-statistic-1">
            <div class="card-icon bg-primary">
               <i class="far fa-user"></i>
            </div>
            <div class="card-wrap">
               <div class="card-header">
                  <h4>Total User</h4>
               </div>
               <div class="card-body">
                  4
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
                  <h4>Peminjam</h4>
               </div>
               <div class="card-body">
                  3
               </div>
            </div>
         </div>
      </div>
      <div class="col-lg-3 col-md-6 col-sm-6 col-12">
         <div class="card card-statistic-1">
            <div class="card-icon bg-warning">
               <i class="far fa-user"></i>
            </div>
            <div class="card-wrap">
               <div class="card-header">
                  <h4>Data Spt</h4>
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
   </div>
@endsection