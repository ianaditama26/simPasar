@extends('template.coreTemplate')
@section('title', 'Log Activity')
@section('breadcrumb')
   <div class="section-header-breadcrumb">
      <div class="breadcrumb-item active"><a href="/admin">Dashboard</a></div>
      <div class="breadcrumb-item">Log Activity</div>
   </div>
@endsection
@section('content')
   <div class="row">
      <div class="col-12 col-md-12">
         <div class="card">
            <div class="card-header">
               <h4>Log Activity</h4>
            </div>
            <div class="card-body">
               <div class="table-responsive">
                  <table id="dataTables" class="table table-bordered table-striped">
                     <thead>
                        <tr>
                           <th>#</th>
                           <th>Log Name</th>
                           <th>Desc</th>
                           <th>Subj_type</th>
                           <th>Subj_id</th>
                           <th>Causer_id</th>
                           <th>Properties</th>
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
      $('#dataTables').DataTable({
         "processing": true,
         "serverSide": true,
         "responsive": true,
         "autoWidth": true,
         ajax: '{{ route('super_admin.dt.log-activity') }}',
         columns : [
            {data: 'DT_RowIndex'},
            {data: 'log_name'},
            {data: 'description'},
            {data: 'subject_type'},
            {data: 'subject_id'},
            {data: 'causer_id'},
            {data: 'properties'},
         ]
      });
   })
</script>
@endpush