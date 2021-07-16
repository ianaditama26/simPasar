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
         @endrole
         @role('admin')
            <li>
               <a class="nav-link" href="/admin"><i class="fas fa-tachometer-alt"></i> <span>Dashboard</span></a>
            </li>
            <li>
               <a class="nav-link" href="{{ route('admin.pasar.index') }}"><i class="fa fa-sticky-note"></i> <span>Data Pasar</span></a>
            </li>
            <li>
               <a class="nav-link" href="{{ route('admin.lapak.index') }}"><i class="fa fa-sticky-note"></i> <span>Data Lapak</span></a>
            </li>
            <li>
               <a class="nav-link" href="{{ route('admin.pedagang.index') }}"><i class="fa fa-list-alt"></i> <span>Pendaftaran Pedagang</span></a>
            </li>

            <li>
               <a class="nav-link" href="{{ route('admin.kontrak.index') }}"><i class="fa fa-sticky-note"></i> <span>Kontrak Pedagang</span></a>
            </li>
            
            <li>
               <a class="nav-link" href="{{ route('admin.retribusi.index') }}"><i class="fa fa-hand-holding-usd" aria-hidden="true"></i> <span>Retribusi</span></a>
            </li>

            <li>
               <a class="nav-link" href="{{ route('admin.layout.lapak') }}"><i class="fa fa-map" aria-hidden="true"></i> <span>Layout Lapak</span></a>
            </li>

            <li>
               <a class="nav-link" href="{{ route('admin.riwayatPedagang.index') }}"><i class="fa fa-history" aria-hidden="true"></i> <span>Riwayat Pedagang</span></a>
            </li>
         @endrole
      </ul>
   </aside>
</div>
