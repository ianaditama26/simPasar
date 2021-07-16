@extends('template.coreTemplate')
@section('title', 'Data Kelas')
@section('breadcrumb')
   <div class="section-header-breadcrumb">
      <div class="breadcrumb-item active"><a href="/super_admin">Dashboard</a></div>
      <div class="breadcrumb-item">Data Kelas</div>
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
               <form action="{{ route('super_admin.master-kelas.store') }}" method="post">
               @csrf
                  <div class="form-group row">
                     <label for="kelas" class="col-sm-3 col-form-label">Kelas</label>
                     <div class="col-sm-9">
                        <input type="text" class="form-control @error('kelas') is-invalid @enderror" name="kelas" placeholder="kelas" value="">
                        @error('kelas')
                           <div class="invalid-feedback">
                              {{ $message }}
                           </div>
                        @enderror
                     </div>
                  </div>
                  {{-- <div class="form-group row">
                     <label for="tarif" class="col-sm-3 col-form-label">Tarif
                     <a href="#" class="btn btn-secondary btn-sm" id="addRowBill"><i class="fa fa-plus px-1"></i></a>
                     </label>
                     <div class="col-sm-9">
                        <div id="rowBill"></div>
                     </div>
                  </div> --}}
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
                           <th>Kelas</th>
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
         ajax: '{{ route('super_admin.dt.masterKelas') }}',
         columns : [
            {data: 'DT_RowIndex'},
            {data: 'kelas'},
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
                     url: "/super_admin/master-kelas/" + id,
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
   //batas
      var count = 0;
      $("#addRowBill").live('click' ,function(){
         count++;
         $('#rowBill').append(`
            <div class="row mt-2" id="corso_${count}">
               <div class="col-md-5">
                  <select name="zonasi[]" class="form-control">
                     <option></option>
                     @foreach($zonasi as $v)
                        <option value="{{ $v->zonaLapak }}">{{ $v->zonaLapak }}</option>
                     @endforeach
                  </select>
               </div>
               <div class="col-md-5">
                  <input type="number" class="form-control @error('tarif') is-invalid @enderror" name="tarif[]" placeholder="tarif" value="">
                  @error('tarif')
                     <div class="invalid-feedback">
                        {{ $message }}
                     </div>
                  @enderror
               </div>
               <div class="col-sm-1">
                  <a href="#" class="btn btn-danger btn-sm hapus" id="hapus_${count}" onclick="hapus(this);"><i class="fa fa-times"></i></a>
               </div>
            </div>
         `);
      });

   function hapus(aRemove){
      var divid = aRemove.id.replace("hapus_", "corso_");
      $("#" + divid).remove();
   }
</script>
@endpush