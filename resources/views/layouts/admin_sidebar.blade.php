<ul class="sidebar-nav">
    <li class="sidebar-header">
       Administration
    </li>


    <li class="sidebar-item">
       <a class="sidebar-link" href="#">
       <i class="align-middle" data-feather="sliders"></i> <span class="align-middle">Dashboard</span>
       </a>
    </li>

    <li class="sidebar-item {{ Nav::isRoute('admin.settings.index') }}">
        <a class="sidebar-link" href="{{ route('admin.settings.index') }}">
        <i class="align-middle" data-feather="settings"></i> <span class="align-middle">Settings</span>
        </a>
   </li>

   <li class="sidebar-item {{ Nav::isRoute('admin.location.index') }}">
        <a class="sidebar-link" href="{{ route('admin.location.index') }}">
        <i class="align-middle" data-feather="map-pin"></i> <span class="align-middle">Locations</span>
        </a>
   </li>
 </ul>