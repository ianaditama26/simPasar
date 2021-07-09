@extends('template.coreTemplate')
@section('title', 'Detail Data retribusi pedagang')
@section('breadcrumb')
   <div class="section-header-breadcrumb">
      <div class="breadcrumb-item active"><a href="/admin">Dashboard</a></div>
      <div class="breadcrumb-item active"><a href="{{ route('admin.retribusi.index') }}">Master retribusi pedagang</a></div>
      <div class="breadcrumb-item">Detail Data retribusi->pedagang</div>
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
               <div class="row">
                  <div class="col-md-7">
                     <div class="form-group row">
                        <label for="noLapak" class="col-sm-2 col-form-label">Nik</label>
                           <div class="col-sm-10">
                              {{ $pedagang->nik }}
                           </div>
                        </div>
                        <div class="form-group row">
                           <label for="noLapak" class="col-sm-2 col-form-label">Nama</label>
                           <div class="col-sm-10">
                              {{ $pedagang->nama }}
                           </div>
                        </div>
                        <div class="form-group row">
                           <label for="noLapak" class="col-sm-2 col-form-label">Tempat Tgl Lahir</label>
                           <div class="col-sm-10">
                              {{ $pedagang->tempat_tglLahir }}
                           </div>
                        </div>
                        <div class="form-group row">
                           <label for="noLapak" class="col-sm-2 col-form-label">Alamat</label>
                           <div class="col-sm-10">
                              {{ $pedagang->alamat }}
                           </div>
                        </div>
                        <div class="form-group row">
                           <label for="noLapak" class="col-sm-2 col-form-label">Foto</label>
                           <div class="col-sm-10">
                              <img src="{{ $pedagang->getFoto() }}" height="130px" alt="">
                           </div>
                        </div>
                        <div class="form-group row">
                           <label for="pekerjaan" class="col-sm-4 col-form-label">Pekerjaan</label>
                           <div class="col-sm-8">
                              {{ $pedagang->pekerjaan }}
                           </div>
                        </div>
                     </div>
                     {{-- BATAS COL --}}
                     <div class="col-md-5">
                        <div class="form-group row">
                           <label for="lapak" class="col-sm-3 col-form-label">Lapak / Pasar</label>
                           <div class="col-sm-9">
                              <ul>
                                 <li>Pasar: {{ $pedagang->mPasar->pasar->namaPasar }}</li>
                                 <li>Tarif: {{ number_format($pedagang->lapak->tarif, 0, ',', '.') }}</li>
                                 <li>No Lapak: {{ $pedagang->lapak->noLapak }}</li>
                              </ul>
                           </div>
                        </div>
                        <div class="form-group row">
                        <label for="zonasi" class="col-sm-4 col-form-label">Zonasi</label>
                        <div class="col-sm-8">
                           {{ $pedagang->lapak->zonasi }}
                        </div>
                     </div>
                     <div class="form-group row">
                        <label for="ukuran" class="col-sm-4 col-form-label">Ukuran</label>
                        <div class="col-sm-8">
                           {{ $pedagang->lapak->luas }}
                        </div>
                     </div>
                     <div class="form-group row">
                        <label for="jenidDagangan" class="col-sm-4 col-form-label">Komoditas</label>
                        <div class="col-sm-8">
                           {{ $pedagang->lapak->komoditas }}
                        </div>
                     </div>
                     <div class="form-group row">
                        <label for="jenidDagangan" class="col-sm-4 col-form-label">Status</label>
                        <div class="col-sm-8">
                           <b>{{ $pedagang->getStatus() }}</b>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      {{-- BATAS --}}
      <div class="col-22 col-md-12 col-lg-12">
         <div class="card">
            <div class="card-header">
               <h4>Detail Data</h4>
            </div>
            <div class="card-body">
               <div id="calendar"></div>
            </div>
         </div>
      </div>
   </div>
@endsection
@push('styles')
   <link href='https://fullcalendar.io/releases/fullcalendar/3.9.0/fullcalendar.min.css' rel='stylesheet' />
   <link href='https://fullcalendar.io/releases/fullcalendar/3.9.0/fullcalendar.print.min.css' rel='stylesheet' media='print' />
   <link rel="stylesheet" href="http://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
@endpush
@push('scripts')
   <script src='https://fullcalendar.io/releases/fullcalendar/3.9.0/lib/moment.min.js'></script>
   <script src='https://fullcalendar.io/releases/fullcalendar/3.9.0/lib/jquery.min.js'></script>
   <script src='https://fullcalendar.io/releases/fullcalendar/3.9.0/fullcalendar.min.js'></script>
   <script>
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
                     title: '{{ $v->pedagang->nama }}',
                     start: '{{ $v->tglBayar_retribusi }}',
                     color: 'green'
                  },
               @endforeach
            ],
         });
      })
   </script>  
@endpush