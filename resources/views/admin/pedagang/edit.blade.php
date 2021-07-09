@extends('template.coreTemplate')
@section('title', 'Edit Data Pedagang')
@section('breadcrumb')
   <div class="section-header-breadcrumb">
      <div class="breadcrumb-item active"><a href="/admin">Dashboard</a></div>
      <div class="breadcrumb-item active"><a href="{{ route('admin.pedagang.index') }}">Master Data Pedagang</a></div>
      <div class="breadcrumb-item">Edit Data Pedagang</div>
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
               <form action="{{ route('admin.pedagang.update', $pedagang->id) }}" method="post"  enctype="multipart/form-data">
               @csrf
               @method('put')
                  <div class="form-group row">
                     <label for="lapak_id" class="col-sm-2 col-form-label">Lapak</label>
                     <div class="col-sm-10">
                        <select name="lapak_id" class="form-control @error('lapak_id') is-invalid @enderror" id="" required>
                           <option value="{{ $pedagang->lapak_id }}">{{ $pedagang->lapak->noLapak }}</option>
                           <option value=""></option>
                           @foreach($lapaks as $v)
                              <option value="{{ $v->id }}">{{ $v->noLapak }} | {{ $v->zonasi }}</option>
                           @endforeach
                        </select>
                        @error('lapak_id')
                           <div class="invalid-feedback">
                              {{ $message }}
                           </div>
                        @enderror
                     </div>
                  </div>
                  <div class="form-group row">
                     <label for="nik" class="col-sm-2 col-form-label">Nik Pedagang</label>
                     <div class="col-sm-10">
                        <input required type="text" name="nik" class="form-control @error('nik') is-invalid @enderror" value="{{ $pedagang->nik }}">
                        @error('nik')
                           <div class="invalid-feedback">
                              {{ $message }}
                           </div>
                        @enderror
                     </div>
                  </div>
                  <div class="form-group row">
                     <label for="nama" class="col-sm-2 col-form-label">Nama Pedagang</label>
                     <div class="col-sm-10">
                        <input required type="text" name="nama" class="form-control @error('nama') is-invalid @enderror" value="{{ $pedagang->nama }}">
                        @error('nama')
                           <div class="invalid-feedback">
                              {{ $message }}
                           </div>
                        @enderror
                     </div>
                  </div>
                  <div class="form-group row">
                     <label for="tempat_tglLahir" class="col-sm-2 col-form-label">Tempat Tgl Lahir</label>
                     <div class="col-sm-10">
                        <input required type="text" name="tempat_tglLahir" class="form-control @error('tempat_tglLahir') is-invalid @enderror" value="{{ $pedagang->tempat_tglLahir }}">
                        @error('tempat_tglLahir')
                           <div class="invalid-feedback">
                              {{ $message }}
                           </div>
                        @enderror
                     </div>
                  </div>
                  <div class="form-group row">
                     <label for="pekerjaan" class="col-sm-2 col-form-label">Pekerjaan</label>
                     <div class="col-sm-10">
                        <input required type="text" name="pekerjaan" class="form-control @error('pekerjaan') is-invalid @enderror" value="{{ $pedagang->pekerjaan }}">
                        @error('pekerjaan')
                           <div class="invalid-feedback">
                              {{ $message }}
                           </div>
                        @enderror
                     </div>
                  </div>
                  <div class="form-group row">
                     <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                     <div class="col-sm-10">
                        <input required type="text" name="alamat" class="form-control @error('alamat') is-invalid @enderror" value="{{ $pedagang->alamat }}">
                        @error('alamat')
                           <div class="invalid-feedback">
                              {{ $message }}
                           </div>
                        @enderror
                     </div>
                  </div>
                  
                  <div class="form-group row">
                     <label for="mPasar_id" class="col-sm-2 col-form-label">Nama Pasar</label>
                     <div class="col-sm-10">
                        <select name="mPasar_id" class="form-control" readonly>
                           <option value="{{ $pasar->id }}">{{ $pasar->pasar->namaPasar }}</option> 
                        </select>
                        @error('mPasar_id')
                           <div class="invalid-feedback">
                              {{ $message }}
                           </div>
                        @enderror
                     </div>
                  </div>

                  <div class="form-group row">
                     <label for="foto" class="col-sm-2 col-form-label">Foto</label>
                     <div class="col-sm-10">
                        <input type="file" name="foto" class="form-control @error('foto') is-invalid @enderror" id="">
                        @error('foto')
                           <div class="invalid-feedback">
                              {{ $message }}
                           </div>
                        @enderror
                     </div>
                  </div>

                  <div class="form-group row">
                     <label for="noTelp" class="col-sm-2 col-form-label">No Telp</label>
                     <div class="col-sm-10">
                        <input required type="number" name="noTelp" class="form-control @error('noTelp') is-invalid @enderror" value="{{ $pedagang->noTelp }}">
                        @error('noTelp')
                           <div class="invalid-feedback">
                              {{ $message }}
                           </div>
                        @enderror
                     </div>
                  </div>
                  
                  
         </div>
         <div class="card-footer">
            <button type="submit" class="btn btn-success">Simpan</button>
         </div>
         </form>
      </div>
   </div>
@endsection