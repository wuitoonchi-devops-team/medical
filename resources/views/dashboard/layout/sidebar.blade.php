<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('home') }}">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-calendar"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Medical <sup>V1</sup></div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('home') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider"> 

    <!-- Nav Item - Charts -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('consultas') }}">
            <i class="fas fa-fw fa-calendar-alt"></i>
            <span>Consultas</span></a>
    </li>

    <!-- Nav Item - Charts -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('pacientes') }}">
            <i class="fas fa-fw fa-users"></i>
            <span>Pacientes</span></a>
    </li>

    <!-- Nav Item - Charts -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('configuracion') }}">
            <i class="fas fa-fw fa-cogs"></i>
            <span>Configuración</span></a>
    </li>
	
	<!-- Nav Item - Charts -->
     <li class="nav-item">
        <a class="nav-link" href="{{ route('configuracion-estados') }}">
            <i class="mdi mdi-map-marker"></i>
            <span>Estados</span></a>
    </li>
    
    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->