@extends('template.coreTemplate')
@section('title', 'Data Pasar')
@section('breadcrumb')
   <div class="section-header-breadcrumb">
      <div class="breadcrumb-item active"><a href="/admin">Dashboard</a></div>
      <div class="breadcrumb-item">Data Pasar</div>
   </div>
@endsection
@section('content')
   <div class="row">
      <div class="col-12 col-md-6">
         <div class="card">
            <div class="card-header">
               <h4>Data Pasar</h4>
            </div>
            <div class="card-body">
               @if($dataMasterPasar !== null)
                  <div class="form-group row">
                     <label for="noPasar" class="col-sm-3 col-form-label">Nama Pasar</label>
                     <div class="col-sm-8">
                        {{ $dataMasterPasar->pasar->namaPasar }}
                     </div>
                  </div>
                  <div class="form-group row">
                     <label for="noPasar" class="col-sm-3 col-form-label">Kelas Pasar</label>
                     <div class="col-sm-8">
                        {{ $dataMasterPasar->kelas->kelas }}
                     </div>
                  </div>
                  <div class="form-group row">
                     <label for="noPasar" class="col-sm-3 col-form-label">Alamat Pasar</label>
                     <div class="col-sm-8">
                        {{ $dataMasterPasar->alamat }}
                     </div>
                  </div>
                  <div class="form-group row">
                     <label for="noPasar" class="col-sm-3 col-form-label">Penanggung Jawab</label>
                     <div class="col-sm-8">
                        {{ $dataMasterPasar->penanggungJawab }}
                     </div>
                  </div>
               @else
                  <form action="{{ route('admin.pasar.store') }}" method="post">
                  @csrf
                     <div class="form-group row">
                        <label for="pasar_id" class="col-sm-3 col-form-label">Nama Pasar</label>
                        <div class="col-sm-9">
                           <select name="pasar_id" class="form-control" readonly>
                              <option value="{{ $pasar->id }}">{{ $pasar->namaPasar }}</option> 
                           </select>
                           @error('pasar_id')
                              <div class="invalid-feedback">
                                 {{ $message }}
                              </div>
                           @enderror
                        </div>
                     </div>
                     <div class="form-group row">
                        <label for="kelas_id" class="col-sm-3 col-form-label">Kelas</label>
                        <div class="col-sm-9">
                           <select name="kelas_id" class="form-control @error('kelas_id') is-invalid @enderror">
                              <option value="">Pilih . . .</option>
                              <option value=""></option>
                              @foreach($classes as $class)
                                 <option value="{{ $class->id }}">{{ $class->kelas }}</option>
                              @endforeach
                           </select>
                           @error('kelas_id')
                              <div class="invalid-feedback">
                                 {{ $message }}
                              </div>
                           @enderror
                        </div>
                     </div>
                     <div class="form-group row">
                        <label for="alamat" class="col-sm-3 col-form-label">Alamat</label>
                        <div class="col-sm-9">
                           <textarea name="alamat" class="form-control @error('alamat') is-invalid @enderror" cols="30" rows="10"></textarea>
                           @error('alamat')
                              <div class="invalid-feedback">
                                 {{ $message }}
                              </div>
                           @enderror
                        </div>
                     </div>
                     <div class="form-group row">
                        <label for="penanggungJawab" class="col-sm-3 col-form-label">Penanggung Jawab</label>
                        <div class="col-sm-9">
                           <input type="text" name="penanggungJawab" class="form-control @error('penanggungJawab') is-invalid @enderror">
                           @error('penanggungJawab')
                              <div class="invalid-feedback">
                                 {{ $message }}
                              </div>
                           @enderror
                        </div>
                     </div>
                  <div class="card-footer">
                     <button type="submit" class="btn btn-success">Simpan</button>
                  </div>
               </form>
               @endif
            </div>
         </div>
      </div>
      <div class="col-12 col-md-6">
         <div class="card">
            <div class="card-header">
               <h4>Data Lapak</h4>
            </div>
            <div class="card-body">
               {{-- @if($dataMasterPasar !== null)
                  <div class="form-group row">
                     <label for="noPasar" class="col-sm-3 col-form-label">Nama Pasar</label>
                     <div class="col-sm-8">
                        {{ $dataMasterPasar->pasar->namaPasar }}
                     </div>
                  </div>
               @endif --}}
            </div>
         </div>
      </div>
   </div>
@endsection