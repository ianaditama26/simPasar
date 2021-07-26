<div class="main-sidebar">
   <aside id="sidebar-wrapper">
      <div class="sidebar-brand">
         <a href="index.html">Sim Pasar</a>
      </div>
      <div class="sidebar-brand sidebar-brand-sm">
         <a href="index.html">St</a>
      </div>
      <ul class="sidebar-menu">
         @role('superAdmin')
            <li>
               <a class="nav-link" href="/super_admin"><i class="fa fa-home"></i> <span>Dashboard</span></a>
            </li>
            <li class="nav-item dropdown">
               <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fa fa-sticky-note"></i> <span>Master Data</span></a>
               <ul class="dropdown-menu">
                  <li>
                     <a class="nav-link" href="{{ route('super_admin.master-zona-lapak.index') }}">Master zona lapak</a>
                     <a class="nav-link" href="{{ route('super_admin.master-komoditas.index') }}">Master komoditas</a>
                     <a class="nav-link" href="{{ route('super_admin.master-kelas.index') }}">Master Kelas</a>
                     <a class="nav-link" href="{{ route('super_admin.pasar.index') }}">Data pasar</a>
                  </li>
               </ul>
            </li>
            <li>
               <a class="nav-link" href="{{ route('super_admin.user.index') }}"><i class="fa fa-user"></i> <span>User</span></a>
            </li>
            <li>
               <a class="nav-link" href="{{ route('super_admin.log-activity.index') }}"><i class="fas fa-skating"></i> <span>Logs Activity</span></a>
            </li>
         @endrole
         @role('admin')
            <li>
               <a class="nav-link" href="/admin"><i class="fas fa-tachometer-alt"></i> <span>Dashboard</span></a>
            </li>
            <li class="nav-item dropdown">
               <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fa fa-sticky-note"></i> <span>Master Data</span></a>
               <ul class="dropdown-menu">
                  <li>
                     <a class="nav-link" href="{{ route('admin.pasar.index') }}"> <span>Data Pasar</span></a>

                     <a class="nav-link" href="{{ route('admin.lapak.index') }}"> <span>Data Lapak</span></a>
                  </li>
               </ul>
            </li>
            <li class="nav-item dropdown">
               <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fa fa-sticky-note"></i> <span>Pedagang</span></a>
               <ul class="dropdown-menu">
                  <li>
                     <a class="nav-link" href="{{ route('admin.pedagang.index') }}"></i><span>Pendaftaran Pedagang</span></a>
                  </li>
                  <li>
                     <a class="nav-link" href="{{ route('admin.kontrak.index') }}"><span>Kontrak Pedagang</span></a>
                  </li>
                  <li>
                     <a class="nav-link" href="{{ route('admin.riwayatPedagang.index') }}"><span>Riwayat pedagang</span></a>
                  </li>
                  <li>
                     <a href="{{ route('admin.pedagang.recyclePedagang') }}" class="nav-link">Daur ulang pedagang</a>
                  </li>
                  <li>
                     <a href="{{ route('admin.pelanggaran.index') }}">Pelanggaran pedagang</a>
                  </li>
               </ul>
            </li>

            <li class="nav-item dropdown">
               <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fa fa-hand-holding-usd"></i> <span>Retribusi</span></a>
               <ul class="dropdown-menu">
                  <li>
                     <a class="nav-link" href="{{ route('admin.retribusi.index') }}"></i><span>Pembayaran Retribusi</span></a>
                  </li>
                  <li>
                     <a href="" class="nav-link">Dashboard</a>
                  </li>
               </ul>
            </li>

            <li>
               <a class="nav-link" href="{{ route('admin.layout.lapak') }}"><i class="fa fa-map" aria-hidden="true"></i> <span>Layout Lapak</span></a>
            </li>
         @endrole

         @role('diskomindag')
            <li>
               <a class="nav-link" href="{{ route('diskomindag.data.pedagang') }}"><i class="fa fa-list-alt"></i> <span>Data Pedagang</span></a>
            </li>
         @endrole

         @role('upt')
            <li class="nav-item dropdown">
               <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fa fa-sticky-note"></i> <span>Pedagang</span></a>
               <ul class="dropdown-menu">
                  <li>
                     <a class="nav-link" href="{{ route('upt.data.pedagang') }}"></i><span>Pendaftaran Pedagang</span></a>
                  </li>
                  <li>
                     <a class="nav-link" href="{{ route('upt.kontrak.index') }}"><span>Kontrak Pedagang</span></a>
                  </li>
                  <li>
                     <a class="nav-link" href="{{ route('upt.riwayatPedagang.index') }}"><span>Riwayat pedagang</span></a>
                  </li>
                  <li>
                     <a href="{{ route('upt.pelanggaran.index') }}">Pelanggaran pedagang</a>
                  </li>
               </ul>
            </li>
         @endrole
      </ul>
   </aside>
</div>
