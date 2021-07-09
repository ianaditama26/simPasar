@extends('template.coreTemplate')
@section('title', 'Detail Data Pasar')
@section('breadcrumb')
   <div class="section-header-breadcrumb">
      <div class="breadcrumb-item active"><a href="/super_admin">Dashboard</a></div>
      <div class="breadcrumb-item active"><a href="{{ route('super_admin.pasar.index') }}">Master Pasar</a></div>
      <div class="breadcrumb-item">Detail Data Pasar</div>
   </div>
@endsection
@section('content')
   <div class="row">
      <div class="col-22 col-md-12 col-lg-12">
         <div class="card">
            <div class="card-header">
               <h4>Detail Data</h4>
            </div>
            <div class="card-body">
               <div class="form-group row">
                  <label for="noPasar" class="col-sm-2 col-form-label">Nama Pasar</label>
                  <div class="col-sm-10">
                     {{ $pasar->namaPasar }}
                  </div>
               </div>
               <div class="form-group row">
                  <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                  <div class="col-sm-10">
                     {{ $pasar->alamat }}
                  </div>
               </div>
               <div class="form-group row">
                  <label for="penanggungJawab" class="col-sm-2 col-form-label">Penanggung Jawab</label>
                  <div class="col-sm-10">
                     {{ $pasar->penanggungJawab }}
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
@endsection