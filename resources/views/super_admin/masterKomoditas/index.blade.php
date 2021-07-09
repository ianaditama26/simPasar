@extends('template.coreTemplate')
@section('title', 'Data Komoditas')
@section('breadcrumb')
   <div class="section-header-breadcrumb">
      <div class="breadcrumb-item active"><a href="/super_admin">Dashboard</a></div>
      <div class="breadcrumb-item">Data Komoditas</div>
   </div>
@endsection
@section('content')
   <div class="row">
      <div class="col-12 col-md-5">
         <div class="card">
            <div class="card-header">
               <h4>Form</h4>
            </div>
            <div class="card-body">
               <form action="{{ route('super_admin.master-komoditas.store') }}" method="post">
               @csrf
                  <div class="form-group row">
                     <label for="komoditas" class="col-sm-3 col-form-label">Komoditas</label>
                     <div class="col-sm-9">
                        <input type="text" class="form-control @error('komoditas') is-invalid @enderror" name="komoditas" placeholder="Komoditas" value="">
                        @error('komoditas')
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
            </div>
         </div>
      </div>
      <div class="col-12 col-md-7">
         <div class="card">
            <div class="card-header">
               <h4>Data Lapak</h4>
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
                           <th>Komoditas</th>
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
         ajax: '{{ route('super_admin.dt.masterKomoditas') }}',
         columns : [
            {data: 'DT_RowIndex'},
            {data: 'komoditas'},
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
                     url: "/super_admin/master-komoditas/" + id,
                     data: {
                        "id": id,
                        "_token": "{{ csrf_token() }}"
                     }, 

                     //setelah berhasil hapus data
                     success: function(data){
                        Swal.fire(
                        'Hapus data!',
                        'Data telah di hapus.',
                        'success'
                        )
                        //setelah alert succes, maka reload halaman
                        location.reload(true);
                     },
               });
            }
         })
      });
   })
</script>
@endpush