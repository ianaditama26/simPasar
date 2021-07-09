@extends('template.coreTemplate')
@section('title', 'Edit Data Pasar')
@section('breadcrumb')
   <div class="section-header-breadcrumb">
      <div class="breadcrumb-item active"><a href="/super_admin">Dashboard</a></div>
      <div class="breadcrumb-item active"><a href="{{ route('super_admin.pasar.index') }}">Master Data Pasar</a></div>
      <div class="breadcrumb-item">Edit Data Pasar</div>
   </div>
@endsection
@section('content')
   <div class="row">
      <div class="col-22 col-md-12 col-lg-12">
         <div class="card">
            <div class="card-header">
               <h4>Edit Data</h4>
            </div>
            <div class="card-body">
            <form action="{{ route('super_admin.pasar.update', $pasar->id) }}" method="post">
            @csrf
            @method('put')
               <div class="form-group row">
                  <label for="namaPasar" class="col-sm-2 col-form-label">Nama Pasar</label>
                  <div class="col-sm-10">
                     <input type="text" class="form-control @error('namaPasar') is-invalid @enderror" name="namaPasar" placeholder="Nama pasar" value="{{ $pasar->namaPasar }}">
                     @error('namaPasar')
                        <div class="invalid-feedback">
                           {{ $message }}
                        </div>
                     @enderror
                  </div>
               </div>
            <div class="card-footer">
               <button type="submit" class="btn btn-success">Ubah</button>
            </div>
            </form>
         </div>
      </div>
   </div>
@endsection