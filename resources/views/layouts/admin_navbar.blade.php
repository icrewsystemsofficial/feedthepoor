<nav class="navbar navbar-expand navbar-light navbar-bg">
    <a class="sidebar-toggle js-sidebar-toggle">
    <i class="hamburger align-self-center"></i>
    </a>
    <div class="navbar-collapse collapse">
       <ul class="navbar-nav navbar-align">
          <li class="nav-item dropdown">
             <a class="nav-icon dropdown-toggle" href="#" id="alertsDropdown" data-bs-toggle="dropdown">
                <div class="position-relative">
                   <i class="align-middle" data-feather="bell"></i>
                   <span class="indicator">4</span>
                </div>
             </a>
             <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end py-0" aria-labelledby="alertsDropdown">
                <div class="dropdown-menu-header">
                   4 New Notifications
                </div>
                <div class="list-group">
                   <a href="#" class="list-group-item">
                      <div class="row g-0 align-items-center">
                         <div class="col-2">
                            <i class="text-danger" data-feather="alert-circle"></i>
                         </div>
                         <div class="col-10">
                            <div class="text-dark">Update completed</div>
                            <div class="text-muted small mt-1">Restart server 12 to complete the update.</div>
                            <div class="text-muted small mt-1">30m ago</div>
                         </div>
                      </div>
                   </a>
                   <a href="#" class="list-group-item">
                      <div class="row g-0 align-items-center">
                         <div class="col-2">
                            <i class="text-warning" data-feather="bell"></i>
                         </div>
                         <div class="col-10">
                            <div class="text-dark">Lorem ipsum</div>
                            <div class="text-muted small mt-1">Aliquam ex eros, imperdiet vulputate hendrerit et.</div>
                            <div class="text-muted small mt-1">2h ago</div>
                         </div>
                      </div>
                   </a>
                   <a href="#" class="list-group-item">
                      <div class="row g-0 align-items-center">
                         <div class="col-2">
                            <i class="text-primary" data-feather="home"></i>
                         </div>
                         <div class="col-10">
                            <div class="text-dark">Login from 192.186.1.8</div>
                            <div class="text-muted small mt-1">5h ago</div>
                         </div>
                      </div>
                   </a>
                   <a href="#" class="list-group-item">
                      <div class="row g-0 align-items-center">
                         <div class="col-2">
                            <i class="text-success" data-feather="user-plus"></i>
                         </div>
                         <div class="col-10">
                            <div class="text-dark">New connection</div>
                            <div class="text-muted small mt-1">Christina accepted your request.</div>
                            <div class="text-muted small mt-1">14h ago</div>
                         </div>
                      </div>
                   </a>
                </div>
                <div class="dropdown-menu-footer">
                   <a href="#" class="text-muted">Show all notifications</a>
                </div>
             </div>
          </li>
          <li class="nav-item dropdown">
             <a class="nav-icon dropdown-toggle d-inline-block d-sm-none" href="#" data-bs-toggle="dropdown">
                 <i class="align-middle" data-feather="settings"></i>
             </a>
             <a class="nav-link dropdown-toggle d-none d-sm-inline-block" href="#" data-bs-toggle="dropdown">
                 <img src="{{ asset('adminkit/static/img/avatars/avatar.jpg') }}" class="avatar img-fluid rounded me-1" alt="Charles Hall" />
                <span class="text-dark">
                    {{ auth()->user()->name }}
                </span>
             </a>

             <div class="dropdown-menu dropdown-menu-end">
                <a class="dropdown-item" href=""><i class="align-middle me-1" data-feather="user"></i> Profile</a>
                <div class="dropdown-divider"></div>
                <form action="{{ route('logout') }}" id="logoutForm" method="POST">@csrf</form>
                <a class="dropdown-item" onclick="document.getElementById('logoutForm').submit();">Log out</a>
             </div>
          </li>
       </ul>
    </div>
 </nav>
