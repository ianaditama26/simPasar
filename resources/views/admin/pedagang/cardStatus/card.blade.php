@if(isset($pedagang->statusPedagang))
   <div class="row">
      {{-- @if($pedagang->status == 'request')
         <div class="col-sm-3">
            <div class="alert alert-primary">
                  Status request lapak.
                  Pedagang telah mendaftar
            </div>
         </div>
      @else
         <div class="col-sm-3">
            <div class="alert alert-secondary">
                  Status request lapak.
                  Pedagang telah mendaftar
            </div>
         </div>
      @endif --}}

      @if($pedagang->statusPedagang->isProcess_pasar == 'ok')
         <div class="col-sm-3">
            <div class="alert alert-success">
                  Status pedagang telah diproses. <br>
            </div>
         </div>
      @else
         <div class="col-sm-3">
            <div class="alert alert-secondary">
                  Status pedagang belum diproses.
            </div>
         </div>
      @endif

      @if($pedagang->statusPedagang->isVerified_upt == 'ok')
         <div class="col-sm-3">
            <div class="alert alert-success">
               Status pedagang telah di verifikasi oleh UPT.
            </div>
         </div>
      @elseif($pedagang->statusPedagang->isVerified_upt == 'denied')
         <div class="col-sm-3">
            <div class="alert alert-danger">
                  Status pedagang di tolak oleh UPT.
            </div>
         </div>
      @else
         <div class="col-sm-3">
            <div class="alert alert-secondary">
               Status pedagang belum di verifikasi oleh UPT.
            </div>
         </div>
      @endif

      @if($pedagang->statusPedagang->isVerified_diskomindag == 'ok')
         <div class="col-sm-3">
            <div class="alert alert-success">
               Status pedagang telah di verifikasi oleh dikomindag.
            </div>
         </div>
      @elseif($pedagang->statusPedagang->isVerified_diskomindag == 'denied')
         <div class="col-sm-3">
            <div class="alert alert-danger">
                  Status pedagang di tolak oleh diskomindag.
            </div>
         </div>
      @else
         <div class="col-sm-3">
            <div class="alert alert-secondary">
               Status pedagang belum di verifikasi oleh dikomindag.
            </div>
         </div>
      @endif

      @if($pedagang->status == 'verified')
         <div class="col-sm-3">
            <div class="alert alert-success alert-has-icon">
               <div class="alert-icon"><i class="fa fa-user-check"></i></div>
               <div class="alert-body">
                  Status pedagang telah aktif.
               </div>
            </div>
         </div>
      @elseif($pedagang->status == 'revoke')
         <div class="col-sm-3">
            <div class="alert alert-warning alert-has-icon">
               <div class="alert-icon"><i class="fa fa-user-times"></i></div>
               <div class="alert-body">
                  Status pedagang telah dicabut.
               </div>
            </div>
         </div>
      @elseif($pedagang->status == 'denied')
         <div class="col-sm-3">
            <div class="alert alert-danger alert-has-icon">
               <div class="alert-icon"><i class="fa fa-user-times"></i></div>
               <div class="alert-body">
                  Status pedagang ditolak.
               </div>
            </div>
         </div>
      @else
         <div class="col-sm-3">
            <div class="alert alert-secondary alert-has-icon">
                  <div class="alert-icon"><i class="fa fa-user-times"></i></div>
                  <div class="alert-body">
                     Status pedagang belum aktif.
                  </div>
            </div>
         </div>
      @endif

      {{-- @if($pedagang->status == 'revoke')
         <div class="col-sm-3">
            <div class="alert alert-danger">
               Status pedagang di cabut.
            </div>
         </div>
      @elseif($pedagang->status == 'denied')
         <div class="col-sm-3">
            <div class="alert alert-danger">
               Status pedagang di ditolak.
            </div>
         </div>
      @endif --}}
   </div>
@endif