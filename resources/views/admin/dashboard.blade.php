@extends('template.coreTemplate')
@section('title', 'Dashboard')
@section('breadcrumb')
   <div class="section-header-breadcrumb">
      <div class="breadcrumb-item active"><a href="/admin">Dashboard</a></div>
   </div>
@endsection
@section('content')
   <div class="row">
      <div class="col-lg-3 col-md-6 col-sm-6 col-12">
         <div class="card card-statistic-1">
            <div class="card-icon bg-primary">
               <i class="fas fa-store"></i>
            </div>
            <div class="card-wrap">
               <div class="card-header">
                  <h4>Total Lapak</h4>
               </div>
               <div class="card-body">
                  {{ count($lapaks) }}
               </div>
            </div>
         </div>
      </div>
      <div class="col-lg-3 col-md-6 col-sm-6 col-12">
         <div class="card card-statistic-1">
            <div class="card-icon bg-info">
               <i class="far fa-user"></i>
            </div>
            <div class="card-wrap">
               <div class="card-header">
                  <h4>Total Pedagang</h4>
               </div>
               <div class="card-body">
                  {{ count($pedagangs) }}
               </div>
            </div>
         </div>
      </div>
      <div class="col-lg-3 col-md-6 col-sm-6 col-12">
         <div class="card card-statistic-1">
            <div class="card-icon bg-danger">
               <i class="fas fa-user-times"></i>
            </div>
            <div class="card-wrap">
               <div class="card-header">
                  <h4>Pedagang Non Aktif</h4>
               </div>
               <div class="card-body">
                  {{ count($pedagang_nonActive) }}
               </div>
            </div>
         </div>
      </div>
      <div class="col-lg-3 col-md-6 col-sm-6 col-12">
         <div class="card card-statistic-1">
            <div class="card-icon bg-success">
               <i class="far fa-user"></i>
            </div>
            <div class="card-wrap">
               <div class="card-header">
                  <h4>Data Non Spt</h4>
               </div>
               <div class="card-body">
                  1
               </div>
            </div>
         </div>
      </div>
   </div>

   <div class="row">
      <div class="col-lg-6">
         <div class="card">
            <div class="card-header">
               <h4>Retribusi perminggu</h4> 
               {{ \Carbon\Carbon::now()->startOfWeek()->translatedFormat('d F Y') }} - {{ \Carbon\Carbon::now()->endOfWeek()->translatedFormat('d F Y') }}
            </div>
            <div class="card-body">
               <div class="table-responsive" style="font-size:12px;">
                  <table class="table table-striped">
                     <thead>
                        <th>#</th>
                        <th>Tanggal</th>
                        <th>Jumlah</th>
                     </thead>
                     @foreach($retribusi_perWeeks as $retribusi)
                        <tbody class="text-xs">
                           <tr>
                              <td>{{ $loop->iteration }}</td>
                              <td>{{ \Carbon\Carbon::parse($retribusi->date)->translatedFormat('D, d F Y') }}</td>
                              <td>{{ number_format($retribusi->sumTarif, 0, ',', '.') }}</td>
                           </tr>
                        </tbody>
                     @endforeach
                  </table>
               </div>
            </div>
         </div>
      </div>

      <div class="col-lg-6">
         <div class="card">
            <div class="card-header">
               <h4>Retribusi Per Bulan Dalam Satu Tahun</h4>
            </div>
            <div class="card-body">
               <div class="table-responsive">
                  <table class="table table-striped" style="font-size:12px;">
                     <thead>
                        <th>#</th>
                        <th>Bulan</th>
                        <th>Data</th>
                        <th>Jumlah</th>
                     </thead>
                     @foreach($retribusi_perMonths as $retribusi)
                        <tbody class="text-xs">
                           <tr>
                              <td>{{ $loop->iteration }}</td>
                              <td>
                                 @if($retribusi->month == 1)
                                    Januari
                                 @elseif($retribusi->month == 2)
                                    Februari
                                 @elseif($retribusi->month == 3)
                                    Maret
                                 @elseif($retribusi->month == 4)
                                    April
                                 @elseif($retribusi->month == 5)
                                    Mei
                                 @elseif($retribusi->month == 6)
                                    Jani
                                 @elseif($retribusi->month == 7)
                                    Juli
                                 @elseif($retribusi->month == 8)
                                    Agustus
                                 @elseif($retribusi->month == 9)
                                    September
                                 @elseif($retribusi->month == 10)
                                    Oktober
                                 @elseif($retribusi->month == 11)
                                    November
                                 @elseif($retribusi->month == 12)
                                    Desember
                                 @else
                                    Not data
                                 @endif
                              </td>
                              <td>{{ $retribusi->data }}</td>
                              <td>{{ number_format($retribusi->sumTarif, 0, ',', '.') }}</td>
                           </tr>
                        </tbody>
                     @endforeach
                  </table>
               </div>
            </div>
         </div>
      </div>

      <div class="col-lg-3">

      </div>
   </div>
@endsection
@push('styles')
   <!-- DataTables -->
   <link rel="stylesheet" href="{{ asset('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
   <link rel="stylesheet" href="{{ asset('assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">

   <!--- Sweet alert -->
   <link rel="stylesheet" href="{{ asset('assets/plugins/sweetalert2-theme/bootstrap-4.min.css') }}">
@endpush

@push('scripts')
   <!-- DataTables -->
   <script src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
   <script src="{{ asset('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
   <script src="{{ asset('assets/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
   <script src="{{ asset('assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>

   <!-- Sweet alert -->
   <script src="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.js') }}"></script>

   {{-- Hight cahrt --}}
   <script src="https://code.highcharts.com/highcharts.js"></script>
@endpush