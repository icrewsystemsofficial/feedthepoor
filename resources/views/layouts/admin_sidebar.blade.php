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
        <a data-bs-target="#dashboards" data-bs-toggle="collapse" class="sidebar-link collapsed" aria-expanded="false">
            <i class="align-middle" data-feather="users"></i>
            <span class="align-middle">Users</span>
        </a>
        <ul id="dashboards" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar" style="">
            <li class="sidebar-item">
                <a class="sidebar-link" href="#">Donors</a>
            </li>
            <li class="sidebar-item">
                <a class="sidebar-link" href="#">Volunteers</a>
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

    <a data-bs-target="#operations" data-bs-toggle="collapse" class="sidebar-link collapsed" aria-expanded="false">
        <i class="align-middle" data-feather="truck"></i>
        <span class="align-middle">Operations</span>
    </a>
    <ul id="operations" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar" style="">
        <li class="sidebar-item">
            <a class="sidebar-link" href="#">Status</a>
        </li>
        <li class="sidebar-item">
            <a class="sidebar-link" href="{{ route('admin.operations.procurement.index') }}">Procurement list</a>
        </li>
        <li class="sidebar-item">
            <a class="sidebar-link" href="#">Missions</a>
        </li>
        <li class="sidebar-item">
            <a class="sidebar-link" href="#">Volunteer roster</a>
        </li>
    </ul>


    <li class="sidebar-item {{ Nav::isRoute('admin.donations.index') }}">
        <a class="sidebar-link" href="{{ route('admin.donations.index') }}">
            <i class="align-middle" data-feather="dollar-sign"></i> <span class="align-middle">Donations</span>
        </a>
    </li>


   <li class="sidebar-item {{ Nav::isRoute('admin.location.index') }}">
        <a class="sidebar-link" href="{{ route('admin.location.index') }}">
        <i class="align-middle" data-feather="map-pin"></i> <span class="align-middle">Locations</span>
        </a>
   </li>

   <li class="sidebar-item {{ Nav::isRoute('admin.contact.index') }}">
        <a class="sidebar-link" href="{{ route('admin.contact.index') }}">
            <i class="align-middle" data-feather="mail"></i> <span class="align-middle">Contacts</span>
        </a>
    </li>

   <li class="sidebar-item {{ Nav::isRoute('admin.causes.index') }}">
      <a class="sidebar-link" href="{{ route('admin.causes.index') }}">
        <i class="align-middle" data-feather="shopping-bag"></i> <span class="align-middle">Causes</span>
      </a>
    </li>

    <li class="sidebar-item {{ Nav::isRoute('admin.campaigns.index') }}">
        <a class="sidebar-link" href="{{ route('admin.campaigns.index') }}">
            <i class="align-middle" data-feather="volume"></i> <span class="align-middle">Campaigns</span>
        </a>
    </li>

    <li class="sidebar-item">
        <a data-bs-target="#faqs" data-bs-toggle="collapse" class="sidebar-link collapsed" aria-expanded="false">
            <i class="align-middle" data-feather="help-circle"></i>
            <span class="align-middle">FAQs</span>
        </a>
        <ul id="faqs" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar" style="">
            <li class="sidebar-item">
                <a class="sidebar-link" href="{{ route('admin.faq.questions.index') }}">Questions</a>
            </li>
            <li class="sidebar-item">
                <a class="sidebar-link" href="{{ route('admin.faq.categories.index') }}">Categories</a>
            </li>
        </ul>
    </li>

    <li class="sidebar-item">
        <a data-bs-target="#admin_tools" data-bs-toggle="collapse" class="sidebar-link collapsed" aria-expanded="false">
            <i class="align-middle" data-feather="activity"></i>
            <span class="align-middle">Admin Tools</span>
        </a>
        <ul id="admin_tools" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar" style="">
            <li class="sidebar-item">
                <a class="sidebar-link" href="{{ route('queue-monitor::index') }}">Jobs</a>
            </li>
            <li class="sidebar-item">
                <a class="sidebar-link" href="#">Server Monitor (WIP)</a>
            </li>
        </ul>
    </li>
 </ul>
