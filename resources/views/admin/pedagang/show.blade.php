@extends('template.coreTemplate')
@section('title', 'Detail Data Pedagang')
@section('breadcrumb')
   <div class="section-header-breadcrumb">
      <div class="breadcrumb-item active"><a href="/admin">Dashboard</a></div>
      <div class="breadcrumb-item active"><a href="{{ route('admin.pedagang.index') }}">Master Pedagang</a></div>
      <div class="breadcrumb-item">Detail Data Pedagang</div>
   </div>
@endsection
@section('content')
   <div class="row">
      <div class="col-22 col-md-12 col-lg-12">
         <div class="card">
            <div class="card-header">
               <h4>Detail Data</h4>
               <div class="buttons">
                  @role('admin')
                     <a href="/{{ request()->segment(1) }}/{{ request()->segment(2) }}/{{ $pedagang->id }}/edit" class="btn btn-icon icon-left btn-success"><i class="fa fa-edit"></i> Edit</a>

                     <button type="submit" class="btn btn-icon icon-left btn-danger" id="delete" data-id="{{ $pedagang->id }}">
                     <i class="fa fa-trash"></i> Hapus
                     </button>

                     @if($pedagang->status == 'request')
                        <a href="{{ route('admin.prosesRequest.lapak', $pedagang->id) }}" class="btn btn-icon icon-left btn-info" >
                        <i class="fas fa-file-contract"></i> Proses request pedagang
                        </a>
                     @elseif($pedagang->status == 'verified')
                        <a href="{{ route('admin.verifikasiForm.create', $pedagang->id) }}" class="btn btn-icon icon-left btn-success" >
                        <i class="fas fa-file-contract"></i> Penerbitan izin kontrak
                        </a>
                     @endif
                  @endrole

                  @role('diskomindag')
                     <a href="{{ route('diskomindag.verified.pedagang', $pedagang->id) }}" class="btn btn-icon icon-left btn-success" >
                        <i class="fas fa-file-contract"></i> Verifikasi lapak pedagang
                     </a>

                     <a href="{{ route('diskomindag.denied.pedagang', $pedagang->id) }}" class="btn btn-icon icon-left btn-danger" >
                     <i class="fas fa-file-contract"></i> Verifikasi ditolak
                     </a>
                  @endrole

                  @role('upt')
                     <a href="{{ route('upt.statusPedagang.isVefied_upt', $pedagang->id) }}" class="btn btn-icon icon-left btn-success" >
                        <i class="fas fa-file-contract"></i> Verifikasi lapak pedagang
                     </a>

                     <a href="{{ route('upt.denied.pedagang', $pedagang->id) }}" class="btn btn-icon icon-left btn-danger" >
                     <i class="fas fa-file-contract"></i> Verifikasi ditolak
                     </a>
                  @endrole
               </div>
            </div>
            <div class="card-body">
               {{-- Status pedagang --}}
               @include('admin.pedagang.cardStatus.card')
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
                     <div class="form-group row">
                        <label for="jenidDagangan" class="col-sm-4 col-form-label">Tanggal daftar</label>
                        <div class="col-sm-8">
                           {{ $pedagang->getCreated() }}
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
@endsection
@push('styles')
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
      $('#delete').on('click', function(e){
         e.preventDefault();
         var id = $(this).data('id'); //ambil dari data-id

         Swal.fire({
            title: 'Yakin hepus data ini?',
            text: "Data yang terhapus tidak bisa dikembalikan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batalkan!',
            }).then((result) => {
            if (result.value) {
               $.ajax({
                     type: "DELETE",
                     url: "/admin/pedagang/" + id,
                     data: {
                        "id": id,
                        "_token": "{{ csrf_token() }}"
                     }, 

                     //setelah berhasil hapus data
                     success: function(data){
                        if(data.success === true){
                           Swal.fire('Erase Data!', data.message, 'success')
                           location.href = 'admin/pedagang';
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
   </script>
@endpush