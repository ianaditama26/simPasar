@extends('template.coreTemplate')
@section('title', 'Detail Data Riwayat Pedagang')
@section('breadcrumb')
   <div class="section-header-breadcrumb">
      <div class="breadcrumb-item active"><a href="/admin">Dashboard</a></div>
      <div class="breadcrumb-item active"><a href="{{ route('admin.riwayatPedagang.index') }}">Riwayat Pedagang</a></div>
      <div class="breadcrumb-item">Detail Data Riwayat Pedagang</div>
   </div>
@endsection
@section('content')
   <div class="row">
      {{-- Detail pedagang / kontrak pedagang --}}
      <div class="col-lg-12">
         <div class="card">
            <div class="card-header">
               <div class="card-header-action">
                  <a href="#" class="btn btn-icon icon-left btn-light" data-toggle="modal" data-target="#modalRiwayatKontrak"><i class="fas fa-history"></i> Riwayat Kontrak</a>
               </div>
            </div>
            <div class="card-body">
               <div class="alert alert-danger">
                  Status pedagang non aktif.
               </div>
               <div class="row">
                  <div class="col-md-7">
                     <div class="form-group row">
                        <label for="noLapak" class="col-sm-2 col-form-label">Nik</label>
                           <div class="col-sm-10">
                              {{ $riwayatPedagang->pedagang->nik }}
                           </div>
                        </div>
                        <div class="form-group row">
                           <label for="noLapak" class="col-sm-2 col-form-label">Nama</label>
                           <div class="col-sm-10">
                              {{ $riwayatPedagang->pedagang->nama }}
                           </div>
                        </div>
                        <div class="form-group row">
                           <label for="noLapak" class="col-sm-2 col-form-label">Tempat Tgl Lahir</label>
                           <div class="col-sm-10">
                              {{ $riwayatPedagang->pedagang->tempat_tglLahir }}
                           </div>
                        </div>
                        <div class="form-group row">
                           <label for="noLapak" class="col-sm-2 col-form-label">Alamat</label>
                           <div class="col-sm-10">
                              {{ $riwayatPedagang->pedagang->alamat }}
                           </div>
                        </div>
                        <div class="form-group row">
                           <label for="noLapak" class="col-sm-2 col-form-label">Foto</label>
                           <div class="col-sm-10">
                              <img src="{{ $riwayatPedagang->pedagang->getFoto() }}" height="130px" alt="">
                           </div>
                        </div>
                        <div class="form-group row">
                           <label for="pekerjaan" class="col-sm-4 col-form-label">Pekerjaan</label>
                           <div class="col-sm-8">
                              {{ $riwayatPedagang->pedagang->pekerjaan }}
                           </div>
                        </div>
                     </div>
                     {{-- BATAS COL --}}
                     <div class="col-md-5">
                        <div class="form-group row">
                           <label for="lapak" class="col-sm-3 col-form-label">Lapak / Pasar</label>
                           <div class="col-sm-9">
                              <ul>
                                 <li>Pasar: {{ $riwayatPedagang->mPasar->pasar->namaPasar }}</li>
                                 <li>Tarif: {{ number_format($riwayatPedagang->pedagang->lapak->tarif, 0, ',', '.') }}</li>
                                 <li>No Lapak: {{ $riwayatPedagang->pedagang->lapak->noLapak }}</li>
                                 <li>Zonasi: {{ $riwayatPedagang->pedagang->lapak->zonasi }}</li>
                              </ul>
                           </div>
                        </div>
                     <div class="form-group row">
                        <label for="jenidDagangan" class="col-sm-4 col-form-label">Status</label>
                        <div class="col-sm-8">
                           <b>{{ $riwayatPedagang->status }}</b>
                        </div>
                     </div>
                     <div class="form-group row">
                        <label for="pekerjaan" class="col-sm-4 col-form-label">No Izin Pedagang</label>
                        <div class="col-sm-8">
                           {{ $riwayatPedagang->noIzin_pedagang }}
                        </div>
                     </div>
                     <div class="form-group row">
                        <label for="pekerjaan" class="col-sm-4 col-form-label">Tanggal Kontrak</label>
                        <div class="col-sm-8">
                           {{ $riwayatPedagang->tglKontrak }}
                        </div>
                     </div>
                     <div class="form-group row">
                        <label for="pekerjaan" class="col-sm-4 col-form-label">Tanggal Akhir Kontrak</label>
                        <div class="col-sm-8">
                           {{ $riwayatPedagang->akhirKontrak }}
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   <div class="row">
   {{-- Calendar retribusi --}}
    <div class="row">
         {{-- Calendar retribusi --}}
         <div class="col-lg-7">
            <div class="card">
               <div class="card-header">
                  <h4>Retribusi pedagang</h4>
               </div>
               <div class="card-body">
                  <div id="calendar"></div>
               </div>
            </div>
         </div>
         {{-- tanggungan retribusi pedagang --}}
         <div class="col-lg-5">
            <div class="card">
               <div class="card-header">
                  <h4>Tagihan retribusi <font color="red">{{ count($ranges) }} hari</font></h4>
               </div>
               <div class="card-body" style="overflow: auto;height: 475px;">
                  <table class="table table-stripped" style="font-size:12px;">
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
            </div>
         </div>
   </div>
@endsection
@push('styles')
   {{-- Calendar --}}
   <link href='https://fullcalendar.io/releases/fullcalendar/3.9.0/fullcalendar.min.css' rel='stylesheet' />
   <link href='https://fullcalendar.io/releases/fullcalendar/3.9.0/fullcalendar.print.min.css' rel='stylesheet' media='print' />
   <link rel="stylesheet" href="http://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
@endpush
@push('scripts')
   {{-- MODAL --}}
   <div class="modal fade" tabindex="-1" role="dialog" id="modalRiwayatKontrak">
      <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title">Riwayat kontrak</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body">
            <table class="table table-striped" style="font-size:12px;">
               <thead>
                  <tr>
                     <th>#</th>
                     <th>Tanggal</th>
                     <th>Keterangan</th>
                     <th>Status</th>
                  </tr>
               </thead>
               <tbody>
                  @foreach($contrakHistories as $history)
                     <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $history->riwayat_tglKontrak }} - {{ $history->riwayat_akhirKontrak }}</td>
                        <td>{{ $history->keterangan }}</td>
                        <td>{{ $history->status }}</td>
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

   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js"></script>

   <script src='https://fullcalendar.io/releases/fullcalendar/3.9.0/lib/moment.min.js'></script>
   <script src='https://fullcalendar.io/releases/fullcalendar/3.9.0/lib/jquery.min.js'></script>
   <script src='https://fullcalendar.io/releases/fullcalendar/3.9.0/fullcalendar.min.js'></script>

   <script>
   // calendar
   $(document).ready(function(){
      $('#calendar').fullCalendar({
         header : {
            left: 'prev, next today',
            center: 'Kalender',
            right: 'month, basicWeek, basicDay'
         },
         initialView: 'dayGridMonth',
         eventColor: 'green',
         events: [
            @foreach($detailRetribusi as $v)
               {
                  title: '{{ $v->noFaktur }}',
                  start: '{{ $v->tglBayar_retribusi }}',
                  color: 'lightgreen'
               },
            @endforeach
         ],
      });
   })
   </script>
@endpush