@extends('template.coreTemplate')
@section('title', 'Retribusi')
@section('breadcrumb')
   <div class="section-header-breadcrumb">
      <div class="breadcrumb-item active"><a href="/admin">Dashboard</a></div>
      <div class="breadcrumb-item active"><a href="{{ route('admin.retribusi.index') }}">Data Pedagang Verifikasi</a></div>
      <div class="breadcrumb-item">Retribusi</div>
   </div>
@endsection
@section('content')
   <div class="row">
      <div class="col-22 col-md-6 col-lg-6">
         <div class="card">
            <div class="card-header">
               <h4>Detail Pedagang</h4>
               <div class="card-header-action">
                  @if($ranges != '')
                     <button class="btn btn-success" data-toggle="modal" data-target="#modalTanggungan">Tanggungan Retribusi {{ count($ranges) }} Hari</button>
                  @endif
               </div>
            </div>
            <div class="card-body">
               <div class="form-group row">
                  <label class="col-sm-4 col-form-label">No Izin</label>
                  <div class="col-sm-8">
                     {{ $kontrakPedagang->noIzin_pedagang }}
                  </div>
               </div>
               <div class="form-group row">
                  <label class="col-sm-4 col-form-label">Tanggal Kontrak</label>
                  <div class="col-sm-8">
                     {{ $kontrakPedagang->tglKontrak }}
                  </div>
               </div>
               <div class="form-group row">
                  <label class="col-sm-4 col-form-label">Nama</label>
                  <div class="col-sm-8">
                     {{ $kontrakPedagang->pedagang->nama }}
                  </div>
               </div>
               <div class="form-group row">
                  <label class="col-sm-4 col-form-label">Pasar & No Lapak</label>
                  <div class="col-sm-8">
                     {{ $kontrakPedagang->mPasar->pasar->namaPasar }} | {{ $kontrakPedagang->pedagang->lapak->noLapak }}
                  </div>
               </div>
               <div class="form-group row">
                  <label class="col-sm-4 col-form-label">Zonasi & Komoditas</label>
                  <div class="col-sm-8">
                     {{ $kontrakPedagang->pedagang->lapak->zonasi }} | {{ $kontrakPedagang->pedagang->lapak->komoditas }}
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div class="col-22 col-md-6 col-lg-6">
         <div class="card">
            <div class="card-header">
               <h4>Form Retribusi</h4>
            </div>
            <div class="card-body">
               @if(session('message'))
                  <div class="alert alert-primary alert-dismissible show fade">
                     <div class="alert-body">
                     <button class="close" data-dismiss="alert">
                        <span>&times;</span>
                     </button>
                        {{ session('message') }}
                     </div>
                  </div>
               @endif
               <form action="{{ route('admin.retribusi.store') }}" method="post">
               @csrf
               <div class="form-group row">
                  <label for="start" class="col-sm-4 col-form-label">Nomot Faktur</label>
                  <div class="col-sm-8">
                     <input type="text" name="noFaktur" class="form-control" value="{{ $noFaktur }}" readonly>
                  </div>
               </div>
               <div class="form-group row">
                  <label for="start" class="col-sm-4 col-form-label">Dari Tanggal</label>
                  <div class="col-sm-8">
                     <input required type="date" name="start" class="form-control is-valid" value="{{ $dateFirstPay }}" readonly>
                     <div class="is-valid-feedback">
                        Pembayaran terakhir
                     </div>
                  </div>
               </div>
               <div class="form-group row">
                  <label for="finish" class="col-sm-4 col-form-label">Sampai Tanggal</label>
                  <div class="col-sm-8">
                     <input required type="date" name="finish" class="form-control @error('finish') is-invalid @enderror" value="{{ Carbon\Carbon::now()->format('Y-m-d') }}">
                     @error('finish')
                        <div class="invalid-feedback">
                           {{ $message }}
                        </div>
                     @enderror
                  </div>
               </div>

               <div class="form-group row">
                  @php
                     $jumlahTarif = $kontrakPedagang->pedagang->lapak->tarif;

                     $data2000 = $jumlahTarif % 2000;
                     $karcis2000 = ($jumlahTarif - $data2000) / 2000;

                     $data1000 = $jumlahTarif % 1000;
                     $karcis1000 = ($data2000 - $data1000) / 1000;

                     $data500 = $data1000 % 500;
                     $karcis500 = ($data1000 - $data500) / 500;
                  @endphp
                  <div class="col-sm-3">
                     Tarif {{  $kontrakPedagang->pedagang->lapak->tarif }}
                  </div>
                  <div class="col-sm-3">
                     Karcis F 2000 {{ $karcis2000 }}x
                  </div>
                  <div class="col-sm-3">
                     Karcis K 1000 {{ $karcis1000 }}x
                  </div>
                  <div class="col-sm-3">
                     Karcis Q 500 {{ $karcis500 }}x
                  </div>
               </div>
            </div>
               {{-- INPUT HIDDEN ID --}}
               <input type="hidden" name="mPasar_id" value="{{ $kontrakPedagang->mPasar_id }}">
               <input type="hidden" name="pedagang_id" value="{{ $kontrakPedagang->pedagang_id }}">
               <input type="hidden" name="lapak_id" value="{{ $kontrakPedagang->pedagang->lapak->id }}">
               <input type="hidden" name="tarif" value="{{ $kontrakPedagang->pedagang->lapak->tarif }}">

               {{-- INPUT HIDDEN KARCIS --}}
               <input type="hidden" name="karcis2000" value="{{ $karcis2000 }}">
               <input type="hidden" name="karcis1000" value="{{ $karcis1000 }}">
               <input type="hidden" name="karcis500" value="{{ $karcis500 }}">

               <div class="card-footer">
                  <button type="submit" class="btn btn-success">Bayar</button>
               </div>
            </form>
         </div>
      </div>
   </div>
@endsection
@push('scripts')
   {{-- MODAL --}}
   @if($ranges != '')
      <div class="modal fade" tabindex="-1" role="dialog" id="modalTanggungan">
         <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
         <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title">Tanggungan retribusi</h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
               </button>
            </div>
            <div class="modal-body">
               <table class="table table-stripped">
                  <thead>
                     <tr>
                        <th>#</th>
                        <th>Tanggal</th>
                        <th>Nominal</th>
                     </tr>
                  </thead>
                  <tbody>
                     @php
                        $no = 1;
                     @endphp
                     @foreach($ranges as $date)
                        <tr>
                           <td>{{ $no++ }}</td>
                           <td>{{ $date['date'] }}</td>
                           <td>{{ $date['tarif'] }}</td>
                        </tr>
                     @endforeach
                  </tbody>
               </table>
            </div>
            <div class="modal-footer bg-whitesmoke br">
               <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
         </div>
         </div>
      </div>
   @endif
@endpush