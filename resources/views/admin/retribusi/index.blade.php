@extends('template.coreTemplate')
@section('title', 'Data Retribusi')
@section('breadcrumb')
   <div class="section-header-breadcrumb">
      <div class="breadcrumb-item active"><a href="/admin">Dashboard</a></div>
      <div class="breadcrumb-item">Data Retribusi</div>
   </div>
@endsection
@section('content')
   <div class="row">
      <div class="col-12 col-md-12">
         <div class="card">
            <div class="card-header">
               <h4>Data Retribusi</h4>
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
               <div class="table-responsive">
                  <table id="dataTable" class="table table-bordered table-striped">
                     <thead>
                        <tr>
                           <th>#</th>
                           <th>No Izin</th>
                           <th>Nik</th>
                           <th>Nama</th>
                           <th>Tgl Kontrak</th>
                           <th>Status</th>
                           <th>Action</th>
                        </tr>
                     </thead>
                  </table>
               </div>
            </div>
         </div>
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

<script>
   $(function() {
      $('#dataTable').DataTable({
         "processing": true,
         "serverSide": true,
         "responsive": true,
         "autoWidth": true,
         ajax: '{{ route('admin.dt.verifikasi') }}',
         columns : [
            {data: 'DT_RowIndex'},
            {data: 'noIzin_pedagang'},
            {data: 'pedagang.nik'},
            {data: 'pedagang.nama'},
            {data: 'tgl_kontrak'},
            {data: 'status'},
            {data: 'action'}
         ]
      });
   })
</script>
@endpush