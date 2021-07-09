@extends('template.coreTemplate')
@section('title', 'Buat Data Pedagang')
@section('breadcrumb')
   <div class="section-header-breadcrumb">
      <div class="breadcrumb-item active"><a href="/admin">Dashboard</a></div>
      <div class="breadcrumb-item active"><a href="{{ route('admin.kontrak.index') }}"> Kontrak Pedagang</a></div>
      <div class="breadcrumb-item">Buat Data Kontrak Pedagang</div>
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
               <div class="row">
                  <div class="col-md-6">
                     <div class="form-group row">
                        <label for="ukuran" class="col-sm-4 col-form-label">Nama | Nik</label>
                        <div class="col-sm-8">
                           {{ $pedagang->nama }} | {{ $pedagang->nik }}
                        </div>
                     </div>
                     <div class="form-group row">
                        <label for="ukuran" class="col-sm-4 col-form-label">Zonasi | Luas</label>
                        <div class="col-sm-8">
                           {{ $pedagang->lapak->zonasi }} | {{ $pedagang->lapak->luas }}
                        </div>
                     </div>
                     <div class="form-group row">
                        <label for="ukuran" class="col-sm-4 col-form-label">No Lapak | Komoditas</label>
                        <div class="col-sm-8">
                           {{ $pedagang->lapak->noLapak }} | {{ $pedagang->lapak->komoditas }}
                        </div>
                     </div>
                  </div>

                  <div class="col-md-6">
                     <form action="{{ route('admin.kontrak.store') }}" method="post">
                     @csrf
                        <div class="form-group row">
                           <label for="noIzin_pedagang" class="col-sm-4 col-form-label">No izin lapak</label>
                           <div class="col-sm-8">
                              <input required type="text" name="noIzin_pedagang" class="form-control @error('noIzin_pedagang') is-invalid @enderror" value="{{ old('noIzin_pedagang') }}">
                              @error('noIzin_pedagang')
                                 <div class="invalid-feedback">
                                    {{ $message }}
                                 </div>
                              @enderror
                           </div>
                        </div>
                        <div class="form-group row">
                           <label for="mPasar_id" class="col-sm-4 col-form-label">Nama Pasar</label>
                           <div class="col-sm-8">
                              <select name="mPasar_id" class="form-control" readonly>
                                 <option value="{{ $pasar->pasar->id }}">{{ $pasar->pasar->namaPasar }}</option> 
                              </select>
                              @error('mPasar_id')
                                 <div class="invalid-feedback">
                                    {{ $message }}
                                 </div>
                              @enderror
                           </div>
                        </div>
                        <div class="form-group row">
                           <label for="tglKontrak" class="col-sm-4 col-form-label">Tgl Kontrak</label>
                           <div class="col-sm-8">
                              <input required type="date" name="tglKontrak" class="form-control @error('tglKontrak') is-invalid @enderror" value="{{ old('tglKontrak') }}">
                              @error('tglKontrak')
                                 <div class="invalid-feedback">
                                    {{ $message }}
                                 </div>
                              @enderror
                           </div>
                        </div>
                        <div class="form-group row">
                           <label for="akhirKontrak" class="col-sm-4 col-form-label">Tgl Akhir Kontrak</label>
                           <div class="col-sm-8">
                              <input required type="date" name="akhirKontrak" class="form-control @error('akhirKontrak') is-invalid @enderror" value="{{ old('akhirKontrak') }}">
                              @error('akhirKontrak')
                                 <div class="invalid-feedback">
                                    {{ $message }}
                                 </div>
                              @enderror
                           </div>
                        </div>
                  </div>
               </div>
         </div>
         <div class="card-footer">
            <input type="hidden" name="pedagang_id" value="{{ $pedagang->id }}" readonly>
            <button type="submit" class="btn btn-success">Simpan</button>
         </div>
         </form>
      </div>
   </div>
@endsection