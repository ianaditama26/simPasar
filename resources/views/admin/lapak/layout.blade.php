@extends('template.coreTemplate')
@section('title', 'Layout Lapak')
@section('breadcrumb')
   <div class="section-header-breadcrumb">
      <div class="breadcrumb-item active"><a href="/super_admin">Dashboard</a></div>
      <div class="breadcrumb-item active"><a href="{{ route('admin.lapak.index') }}">Master Lapak</a></div>
      <div class="breadcrumb-item">Layout Lapak</div>
   </div>
@endsection
@section('content')
   <div class="row">
      <div class="col-22 col-md-12 col-lg-12">
         <div class="card">
            <div class="card-header">
               <h4>Layout</h4>
            </div>
            <div class="card-body">
               
            </div>
         </div>
      </div>
   </div>
@endsection