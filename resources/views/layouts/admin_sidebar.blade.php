<ul class="sidebar-nav">
    <li class="sidebar-header">
       Administration
    </li>


    <li class="sidebar-item {{ Nav::isRoute('admin.dashboard') }}">
       <a class="sidebar-link" href="{{ route('admin.dashboard') }}">
       <i class="align-middle" data-feather="sliders"></i> <span class="align-middle">Dashboard</span>
       </a>
    </li>

    <li class="sidebar-item {{ Nav::isRoute('admin.settings.index') }}">
        <a data-bs-target="#missions" data-bs-toggle="collapse" class="sidebar-link collapsed" aria-expanded="false">
            <i class="align-middle" data-feather="briefcase"></i>
            <span class="align-middle">Missions</span>
        </a>
        <ul id="missions" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar" style="">
            <li class="sidebar-item">
                <a class="sidebar-link" href="#">Mission Status</a>
            </li>
            <li class="sidebar-item">
                <a class="sidebar-link" href="#">Past Missions</a>
            </li>
        </ul>
    </li>


    <li class="sidebar-item {{ Nav::isRoute('admin.settings.index') }}">
        <a data-bs-target="#donations" data-bs-toggle="collapse" class="sidebar-link collapsed" aria-expanded="false">
            <i class="align-middle" data-feather="dollar-sign"></i>
            <span class="align-middle">Donations</span>
        </a>
        <ul id="donations" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar" style="">
            <li class="sidebar-item">
                <a class="sidebar-link" href="#">All Donations</a>
            </li>
            <li class="sidebar-item">
                <a class="sidebar-link" href="#">Recipts</a>
            </li>
        </ul>
    </li>

    <li class="sidebar-item {{ Nav::isRoute('admin.users.index') }}">
        <a data-bs-target="#dashboards" data-bs-toggle="collapse" class="sidebar-link collapsed" aria-expanded="false">
            <i class="align-middle" data-feather="users"></i>
            <span class="align-middle">Users</span>
        </a>
        <ul id="dashboards" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar" style="">
            <li class="sidebar-item">
                <a class="sidebar-link" href="{{ route('admin.users.index', 'donor') }}">Donors</a>
            </li>
            <li class="sidebar-item">
                <a class="sidebar-link" href="{{ route('admin.users.index', 'volunteer') }}">Volunteers</a>
            </li>
            <li class="sidebar-item">
                <a class="sidebar-link" href="#">Volunteer Applications</a>
            </li>
        </ul>
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