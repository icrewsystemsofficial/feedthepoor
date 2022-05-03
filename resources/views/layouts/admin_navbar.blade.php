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

                   @if(App\Helpers\NotificationHelper::getUnreadCount() > 0)
                   <span class="indicator">{{ App\Helpers\NotificationHelper::getUnreadCount() }}</span>
                   @endif
                </div>
             </a>
             <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end py-0" aria-labelledby="alertsDropdown">
                <div class="list-group">
                   @forelse (App\Helpers\NotificationHelper::getNotifications(5) as $notification)
                   <a href="{{ url($notification->data['action']) }}" class="list-group-item"
                     @if (!$notification->read_at)
                        style="background-color: rgb(229 229 229)"                         
                     @endif

                      >
                      <div class="row g-0 align-items-center">
                         <div class="col-2">
                            <i class="text-{{ $notification->data['color'] }}" data-feather="{{ $notification->data['icon'] }}"></i>
                         </div>
                         <div class="col-10">
                            <div class="text-dark">{{$notification->data['title']}}</div>
                            <div class="text-muted small mt-1">{{ $notification->data['body'] }}.</div>
                            <div class="text-muted small mt-1">{{ $notification->created_at->diffForHumans() }} &bull; {{ $notification->created_at->format('H:i A, d/m/Y') }}</div>
                         </div>
                      </div>
                   </a>
                  @empty
                  <div class="container mt-3">
                    <p>
                        There are no new notifications 😀
                    </p>
                  </div>

                  @endforelse
                   @if(App\Helpers\NotificationHelper::getUnreadCount() > 0)
                     <div class="dropdown-menu-footer">
                        <a href="#"  onclick="markNotificationsAsRead();" class="text-muted">Mark All Read</a>
                     </div>
                  @endif
                  
                     <div class="dropdown-menu-footer">
                        <a href="{{ route('admin.notifications.index') }}" class="text-muted">See All</a>
                     </div>
                </div>
             </div>
          </li>
          <li class="nav-item dropdown">
             <a class="nav-icon dropdown-toggle d-inline-block d-sm-none" href="#" data-bs-toggle="dropdown">
                 <i class="align-middle" data-feather="settings"></i>
             </a>
             <a class="nav-link dropdown-toggle d-none d-sm-inline-block" href="#" data-bs-toggle="dropdown">
               <img src="
               @if(Auth::user()->avatar == null) https://ui-avatars.com/api/?name={{ auth()->user()->name }}
               @else
                  {{ asset(Auth::user()->avatar) }}
               @endif
               " class="avatar img-fluid rounded me-1" alt="Charles Hall" />
               <span class="text-dark">
                  {{ auth()->user()->name }}
               </span>
             </a>

             <div class="dropdown-menu dropdown-menu-end">
                <a class="dropdown-item" href="{{ route('admin.profile.view', Auth::user()->id) }}"><i class="align-middle me-1" data-feather="user"></i> Profile</a>
                <div class="dropdown-divider"></div>
                <form action="{{ route('logout') }}" id="logoutForm" method="POST">@csrf</form>
                <a class="dropdown-item" onclick="document.getElementById('logoutForm').submit();">Log out</a>
             </div>
          </li>
       </ul>
    </div>
 </nav>
