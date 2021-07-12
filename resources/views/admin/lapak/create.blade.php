@extends('template.coreTemplate')
@section('title', 'Buat Data lapak')
@section('breadcrumb')
   <div class="section-header-breadcrumb">
      <div class="breadcrumb-item active"><a href="/super_admin">Dashboard</a></div>
      <div class="breadcrumb-item active"><a href="{{ route('admin.lapak.index') }}">Master Data lapak</a></div>
      <div class="breadcrumb-item">Buat Data lapak</div>
   </div>
@endsection
@section('content')
   <div class="row">
      <div class="col-22 col-md-12 col-lg-12">
         <div class="card">
            <div class="card-header">
               <h4>Buat Data</h4>
            </div>
            <div class="card-body">
               <form action="{{ route('admin.lapak.store') }}" method="post">
               @csrf
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
                     <label for="tarif" class="col-sm-2 col-form-label">Tarif</label>
                     <div class="col-sm-10">
                        <select name="tarif" class="form-control @error('tarif') is-invalid @enderror" required>
                           <option value="">Pilih . . .</option> 
                           <option value=""></option> 
                           @foreach($tarif as $v)
                              <option value="{{ $v->tarif }}">{{ $v->zonasi }} | {{ number_format($v->tarif, 0, ',', '.') }}</option>
                           @endforeach
                        </select>
                        @error('tarif')
                           <div class="invalid-feedback">
                              {{ $message }}
                           </div>
                        @enderror
                     </div>
                  </div>
                  <div class="form-group row">
                     <label for="zonasi" class="col-sm-2 col-form-label">Zonasi</label>
                     <div class="col-sm-10">
                        <select name="zonasi" class="form-control @error('zonasi') is-invalid @enderror" required>
                           <option value="">Pilih . . .</option> 
                           <option value=""></option> 
                           @foreach($zonasi as $v)
                              <option value="{{ $v->zonaLapak }}">{{ $v->zonaLapak }}</option>
                           @endforeach
                        </select>
                        @error('zonasi')
                           <div class="invalid-feedback">
                              {{ $message }}
                           </div>
                        @enderror
                     </div>
                  </div>
                  <div class="form-group row">
                     <label for="komoditas" class="col-sm-2 col-form-label">Komoditas</label>
                     <div class="col-sm-10">
                        <select name="komoditas" class="form-control @error('komoditas') is-invalid @enderror" required>
                           <option value="">Pilih . . .</option> 
                           @foreach($komoditas as $v)
                              <option value="{{ $v->komoditas }}">{{ $v->komoditas }}</option>
                           @endforeach
                        </select>
                        @error('komoditas')
                           <div class="invalid-feedback">
                              {{ $message }}
                           </div>
                        @enderror
                     </div>
                  </div>
                  <div class="form-group row">
                     <label for="noLapak" class="col-sm-2 col-form-label">No Lapak</label>
                     <div class="col-sm-10">
                        <input type="text" name="noLapak" class="form-control @error('noLapak') is-invalid @enderror" id="" required>
                        @error('noLapak')
                           <div class="invalid-feedback">
                              {{ $message }}
                           </div>
                        @enderror
                     </div>
                  </div>
                  <div class="form-group row">
                     <label for="blok" class="col-sm-2 col-form-label">Blok</label>
                     <div class="col-sm-10">
                        <select name="blok" class="form-control" id="">
                           <option value="">Pilih . . .</option>
                           <option value=""></option>
                        </select>
                        @error('blok')
                           <div class="invalid-feedback">
                              {{ $message }}
                           </div>
                        @enderror
                     </div>
                  </div>
                  <div class="form-group row">
                     <label for="luas" class="col-sm-2 col-form-label">Luas Lapak</label>
                     <div class="col-sm-10">
                        <input type="text" name="luas" class="form-control @error('luas') is-invalid @enderror" id="" required>
                        @error('luas')
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