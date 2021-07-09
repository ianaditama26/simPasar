@extends('template.coreTemplate')
@section('title', 'Detail Data Lapak')
@section('breadcrumb')
   <div class="section-header-breadcrumb">
      <div class="breadcrumb-item active"><a href="/super_admin">Dashboard</a></div>
      <div class="breadcrumb-item active"><a href="{{ route('admin.lapak.index') }}">Master Lapak</a></div>
      <div class="breadcrumb-item">Detail Data Lapak</div>
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
                  <label for="noLapak" class="col-sm-2 col-form-label">Nama Pasar</label>
                  <div class="col-sm-10">
                     {{ $lapak->mPasar->pasar->namaPasar }}
                  </div>
               </div>
               <div class="form-group row">
                  <label for="alamat" class="col-sm-2 col-form-label">Tarif</label>
                  <div class="col-sm-10">
                     {{ $lapak->tarif }} | {{ $lapak->zonasi }}
                  </div>
               </div>
               <div class="form-group row">
                  <label for="penanggungJawab" class="col-sm-2 col-form-label">Komoditas</label>
                  <div class="col-sm-10">
                     {{ $lapak->komoditas }}
                  </div>
               </div>
               <div class="form-group row">
                  <label for="penanggungJawab" class="col-sm-2 col-form-label">No Lapak</label>
                  <div class="col-sm-10">
                     {{ $lapak->noLapak }}
                  </div>
               </div>
               <div class="form-group row">
                  <label for="penanggungJawab" class="col-sm-2 col-form-label">Luas</label>
                  <div class="col-sm-10">
                     {{ $lapak->luas }}
                  </div>
               </div>
               <div class="form-group row">
                  <label for="penanggungJawab" class="col-sm-2 col-form-label">Status Lapak</label>
                  <div class="col-sm-10">
                     {{ $lapak->statusLapak }}
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
@endsection