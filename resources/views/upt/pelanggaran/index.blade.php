@extends('template.coreTemplate')
@section('title', 'Pelanggaran Pedagang')
@section('breadcrumb')
   <div class="section-header-breadcrumb">
      <div class="breadcrumb-item active"><a href="/admin">Dashboard</a></div>
      <div class="breadcrumb-item"><a href="#">Pelanggaran Pedagang</a></div>
   </div>
@endsection
@section('content')
<div class="row">
   <div class="col-lg-12 col-md-12 col-12 col-sm-12">
      <div class="card">
         <div class="card-header">
            <h4>Pelanggaran pedagang</h4>
            <div class="card-header-action">
               <div class="btn-group">
                  <a href="#" class="btn btn-primary">Week</a>
                  <a href="#" class="btn">Month</a>
               </div>
            </div>
         </div>
         <div class="card-body">
            <div class="table-responsive">
               <table id="dataTable" class="table table-bordered table-striped">
                  <thead>
                     <tr>
                        <th>#</th>
                        <th>Nik</th>
                        <th>Nama</th>
                        <th>Keterangan</th>
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
         ajax: '{{ route('upt.dt.pedagangSp') }}',
         columns : [
            {data: 'DT_RowIndex'},
            {data: 'nik'},
            {data: 'name'},
            {data: 'keterangan'},
            {data: 'action'}
         ]
      });

      $('#dataTable').on('click', '#delete', function(e){
         e.preventDefault();
         var id = $(this).data('id'); //ambil dari data-id

         Swal.fire({
            title: 'Yakin hepus data ini?',
            text: "Data yang terhapus tidak bisa dikembalikan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batalkan!',
            }).then((result) => {
            if (result.value) {
               $.ajax({
                     type: "DELETE",
                     url: "/admin/kontrak/" + id,
                     data: {
                        "id": id,
                        "_token": "{{ csrf_token() }}"
                     }, 

                     //setelah berhasil hapus data
                     success: function(data){
                        if(data.success === true){
                           Swal.fire('Erase Data!', data.message, 'success')
                           location.reload(true);
                        } else {
                           Swal.fire({
                           icon: 'error',
                           title: 'Oops...',
                           text: data.message
                           })
                        }
                     },
               });
            }
         })
      });
   })
</script>
@endpush