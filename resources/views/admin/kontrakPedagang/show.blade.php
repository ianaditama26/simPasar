@extends('template.coreTemplate')
@section('title', 'Detail Data Pedagang Kontrak')
@section('breadcrumb')
   <div class="section-header-breadcrumb">
      <div class="breadcrumb-item active"><a href="/admin"kontrak</a></div>
      <div class="breadcrumb-item active"><a href="{{ route('admin.kontrak.index') }}">Kontrak Pedagang</a></div>
      <div class="breadcrumb-item">Detail Data Pedagang Kontrak</div>
   </div>
@endsection
@section('content')
   <div class="row">
      <div class="col-12 col-md-12 col-lg-12">
         <div class="card">
            <div class="card-header">
               <h4>Detail Data</h4>
            </div>
            <div class="card-body">
               <div class="buttons">
                  <a href="/{{ request()->segment(1) }}/{{ request()->segment(2) }}/{{ $verifikasiPedagang->id }}/edit" class="btn btn-icon icon-left btn-success"><i class="fa fa-edit"></i> Edit</a>

                  <button type="submit" class="btn btn-icon icon-left btn-danger" style="display: inline" id="delete" class="btn btn-icon icon-left btn-dark" data-id="{{ $verifikasiPedagang->id }}">
                  <i class="fa fa-trash"> Hapus</i>
                  </button>

                  <a href="{{ route('admin.riwayat-kontrak.perpajangan', $verifikasiPedagang->id) }}" class="btn btn-icon icon-left btn-light" data-toggle="modal" data-target="#modalRiwayatKontrak"><i class="fas fa-history"></i> Riwayat Kontrak</a>
                  
                  <a href="{{ route('admin.riwayat-kontrak.perpajangan', $verifikasiPedagang->id) }}" class="btn btn-icon icon-left btn-dark" data-toggle="modal" data-target="#modalTanggungan"><i class="fas fa-file-contract"></i> Perpanjang Kontrak</a>

                  <a href="#" class="btn btn-icon icon-left btn-dark"><i class="fas fa-file-contract"></i> Pencabutan Kontrak</a>
               </div>
               
               <div class="row">
                  <div class="col-md-7">
                     <div class="form-group row">
                        <label for="noLapak" class="col-sm-2 col-form-label">Nik</label>
                           <div class="col-sm-10">
                              {{ $verifikasiPedagang->pedagang->nik }}
                           </div>
                        </div>
                        <div class="form-group row">
                           <label for="noLapak" class="col-sm-2 col-form-label">Nama</label>
                           <div class="col-sm-10">
                              {{ $verifikasiPedagang->pedagang->nama }}
                           </div>
                        </div>
                        <div class="form-group row">
                           <label for="noLapak" class="col-sm-2 col-form-label">Tempat Tgl Lahir</label>
                           <div class="col-sm-10">
                              {{ $verifikasiPedagang->pedagang->tempat_tglLahir }}
                           </div>
                        </div>
                        <div class="form-group row">
                           <label for="noLapak" class="col-sm-2 col-form-label">Alamat</label>
                           <div class="col-sm-10">
                              {{ $verifikasiPedagang->pedagang->alamat }}
                           </div>
                        </div>
                        <div class="form-group row">
                           <label for="noLapak" class="col-sm-2 col-form-label">Foto</label>
                           <div class="col-sm-10">
                              <img src="{{ $verifikasiPedagang->pedagang->getFoto() }}" height="130px" alt="">
                           </div>
                        </div>
                        <div class="form-group row">
                           <label for="pekerjaan" class="col-sm-4 col-form-label">Pekerjaan</label>
                           <div class="col-sm-8">
                              {{ $verifikasiPedagang->pedagang->pekerjaan }}
                           </div>
                        </div>
                     </div>
                     {{-- BATAS COL --}}
                     <div class="col-md-5">
                        <div class="form-group row">
                           <label for="lapak" class="col-sm-3 col-form-label">Lapak / Pasar</label>
                           <div class="col-sm-9">
                              <ul>
                                 <li>Pasar: {{ $verifikasiPedagang->mPasar->pasar->namaPasar }}</li>
                                 <li>Tarif: {{ number_format($verifikasiPedagang->pedagang->lapak->tarif, 0, ',', '.') }}</li>
                                 <li>No Lapak: {{ $verifikasiPedagang->pedagang->lapak->noLapak }}</li>
                                 <li>Zonasi: {{ $verifikasiPedagang->pedagang->lapak->zonasi }}</li>
                              </ul>
                           </div>
                        </div>
                     <div class="form-group row">
                        <label for="jenidDagangan" class="col-sm-4 col-form-label">Status</label>
                        <div class="col-sm-8">
                           <b>{{ $verifikasiPedagang->status }}</b>
                        </div>
                     </div>
                     <div class="form-group row">
                        <label for="pekerjaan" class="col-sm-4 col-form-label">No Izin Pedagang</label>
                        <div class="col-sm-8">
                           {{ $verifikasiPedagang->noIzin_pedagang }}
                        </div>
                     </div>
                     <div class="form-group row">
                        <label for="pekerjaan" class="col-sm-4 col-form-label">Tanggal Kontrak</label>
                        <div class="col-sm-8">
                           {{ $verifikasiPedagang->tglKontrak }}
                        </div>
                     </div>
                     <div class="form-group row">
                        <label for="pekerjaan" class="col-sm-4 col-form-label">Tanggal Akhir Kontrak</label>
                        <div class="col-sm-8">
                           {{ $verifikasiPedagang->akhirKontrak }}
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
   {{-- MODAL --}}
   <div class="modal fade" tabindex="-1" role="dialog" id="modalTanggungan">
      <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title">Form Perpanjang Kontrak</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body">
            <form action="{{ route('admin.riwayat-kontrak.perpajangan') }}" method="post"></form>
               @csrf
               <div class="form-group">
                  <label for="finish" class="col-sm-12 col-form-label">Tanggal Kontrak</label>
                  <div class="col-sm-12">
                     <input required type="date" name="riwayat_tglKontrak" class="form-control is-valid" value="{{ Carbon\Carbon::parse($verifikasiPedagang->akhirKontrak)->addDay(1)->format('d-m-Y') }}">
                     <div class="valid-feedback">
                        Tanggal Akhir Kontrak {{ Carbon\Carbon::parse($verifikasiPedagang->akhirKontrak)->format('d-m-Y') }}
                     </div>
                  </div>
               </div>
               <div class="form-group">
                  <label for="finish" class="col-sm-12 col-form-label">Tanggal Akhir Kontrak</label>
                  <div class="col-sm-12">
                     <input required type="date" name="riwayat_akhirKontrak" class="form-control" value="">
                  </div>
               </div>
            {{-- Form --}}
         </div>
         <div class="modal-footer bg-whitesmoke br">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <input type="hidden" name="kontrakPedagang_id" value="{{ $verifikasiPedagang->id }}">
            <button type="submit" class="btn btn-success">Simpan</button>
            </form>
         </div>
      </div>
      </div>
   </div>

   <div class="modal fade" tabindex="-1" role="dialog" id="modalRiwayatKontrak">
      <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title">Riwayat Kontrak</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body">
            <table class="table table-borderless" style="font-size:12px;">
               <thead>
                  <tr>
                     <th>#</th>
                     <th>Tanggal Kontrak</th>
                     <th>Keterangan</th>
                  </tr>
               </thead>
               <tbody>
                  @forelse($contrakHistories as $history)
                     <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ Carbon\Carbon::parse($history->riwayat_tglKontrak)->format('d-m-Y') }} - {{ Carbon\Carbon::parse($history->riwayat_akhirKontrak)->format('d-m-Y') }}</td>
                        <td>{{ $history->keterangan }}</td>
                     </tr>
                  @empty
                     <tr>
                        <td colspan="3"><center>No Data</center></td>
                     </tr>
                  @endforelse
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
                     url: "/admin/kontrak/" + id,
                     data: {
                        "id": id,
                        "_token": "{{ csrf_token() }}"
                     }, 

                     //setelah berhasil hapus data
                     success: function(data){
                        if(data.success === true){
                           Swal.fire('Erase Data!', data.message, 'success')
                           location('admin/kontrak');
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

      $('#verifikasi').on('click', function(e){
         e.preventDefault();
         var id = $(this).data('id'); //ambil dari data-id

         Swal.fire({
            title: 'Yakin memverifikasi data ini?',
            icon: 'info',
            showCancelButton: true,
            confirmButtonColor: '#068626',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, verifikasi!',
            cancelButtonText: 'Batalkan!',
            }).then((result) => {
            if (result.value) {
               $.ajax({
                     type: "DELETE",
                     url: "/admin/kontrak/pedagang/" + id,
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
                        location('/admin/kontrak');
                     },
               });
            }
         })
      });
   </script>
@endpush