<header class="main-header">

<!-- Logo -->
<a href="{{ route('dashboard') }}" class="logo">
  <!-- mini logo for sidebar mini 50x50 pixels -->
  <span class="logo-mini"><b>R</b>UO</span>
  <!-- logo for regular state and mobile devices -->
  <span class="logo-lg"><b>{{ strtoupper(config('app.name')) }}</b></span>
</a>
<!-- Header Navbar -->
<nav class="navbar navbar-static-top" role="navigation">
  <!-- Sidebar toggle button-->
  <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
    <span class="sr-only">Toggle navigation</span>
  </a>
  <a href="javascript:history.back()" class="back-btn" title="Reculer d'une page"> <i class="fa fa-fw fa-arrow-left"></i></a>
  <a href="javascript:document.location.reload(true)" class="refresh-btn" title="Actualiser la page courante"><i class="fa fa-fw fa-refresh"></i></a>
  <a href="javascript:history.forward()" class="back-btn" title="Avancer d'un page"> <i class="fa fa-fw fa-arrow-right"></i></a>
  {{-- <a href="{{ url()->previous() }}" class="back-link"> <i class="fa fa-fw fa-arrow-left"></i> Retour</a> --}}
  <!-- Navbar Right Menu -->
  <div class="navbar-custom-menu">
    <ul class="nav navbar-nav">
      <!-- Toggle availability -->
      @if (isset($_restaurant))
        <li>
          <a href="#" title="Ouverture --- Fermeture" data-toggle="tooltip" data-placement="bottom">
              <input type="checkbox" class="open-js-switch"{{ $_restaurant->is_open ? 'checked' : '' }} data-restaurant-id={{$_restaurant->id}} />
          </a>
        </li>
      @endif
      <!-- Notifications Menu -->
      <li class="dropdown notifications-menu">
        <!-- Menu toggle button -->
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
          <i class="fa fa-bell-o"></i>
          <span class="label label-danger notif-count">{{ Auth::user()->unreadNotifications->count() }}</span>
        </a>
        <ul class="dropdown-menu">
          <li class="header">Vous avez <span class="notif-count">{{ Auth::user()->unreadNotifications->count() }}</span> notification(s)</li>
          <li>
            <!-- Inner Menu: contains the notifications -->
            <ul class="menu">
              @if(Auth::user()->unreadNotifications->count())
                @foreach (Auth::user()->unreadNotifications as $notification)
                @if(isset($notification->data['order']) && $notification->data['order'])
                  <li><!-- start notification -->
                    <a href="{{ route('orders.show', $notification->data['order']['id']) }}?read={{$notification->id}}">
                      <i class="fa fa-shopping-cart text-aqua"></i>Une nouvelle commande : {{ $notification->data['order']['number'] }}
                    </a>
                  </li>
                  @elseif(isset($notification->data['restaurant']) && $notification->data['restaurant'])
                  <li class="messages-notif-style">
                    <!-- start message -->
                    <a href="{{ route('restaurants.show', $notification->data['restaurant']['id']) }}?read={{$notification->id}}">
                      <div class="pull-left">
                        <img src="{{ asset($notification->data['restaurant']['profile_img']) }}" class="img-circle" alt="User Image">
                      </div>
                      <h4>
                        {{ str_limit($notification->data['restaurant']['name'], 12, '...') }}
                        <small><i class="fa fa-clock-o"></i> {{ diffDateForHumans($notification->data['restaurant']['created_at']) }}</small>
                      </h4>
                      <p>{{ str_limit($notification->data['restaurant']['location'], 20, '...') }}</p>
                      <small class="label pull-right bg-green">{{ __('new shop') }}</small>
                    </a>
                  </li>
                  @elseif(isset($notification->data['user']) && $notification->data['user'] && Auth::user()->isSuperAdmin())
                  <li class="messages-notif-style">
                    <!-- start message -->
                    <a href="{{ route('users.show', $notification->data['user']['id']) }}?read={{$notification->id}}">
                      <div class="pull-left">
                        <img src="{{ asset($notification->data['user']['profile_img']) }}" class="img-circle" alt="User Image">
                      </div>
                      <h4>
                        {{ str_limit($notification->data['user']['full_name'], 12, '...') }}
                        <small><i class="fa fa-clock-o"></i> {{ diffDateForHumans($notification->data['user']['created_at']) }}</small>
                      </h4>
                      <p>{{ str_limit($notification->data['user']['location'], 20, '...') }}</p>
                      <small class="label pull-right bg-green">{{ __('new user') }}</small>
                    </a>
                  </li>
                  @endif
                @endforeach
              @else
                  <li><!-- start notification -->
                    <a href="#">
                      <i class="fa fa-bell text-aqua"></i>Aucune notifications
                    </a>
                  </li>
              @endif
              <!-- end notification -->
            </ul>
          </li>
          {{-- <li class="footer"><a href="#">Tous les utilisateurs</a></li> --}}
        </ul>
      </li>
      <!-- User Account Menu -->
      <li class="dropdown user user-menu">
        <!-- Menu Toggle Button -->
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
          <!-- The user image in the navbar-->
        <img src="{{ asset(Auth::user()->profile_img) }}" class="user-image lazyload" alt="User Image">
          <!-- hidden-xs hides the username on small devices so only the image appears. -->
        <span class="hidden-xs">{{ Auth::user()->first_name }}</span>
        </a>
        <ul class="dropdown-menu">
          <!-- The user image in the menu -->
          <li class="user-header">
          <img src="{{ asset(Auth::user()->profile_img) }}" class="img-circle" alt="User Image">

            <p>
                {{ Auth::user()->first_name .'  '. Auth::user()->last_name }}
            <small>Inscrit le {{ auth()->user()->created_at->format('d M Y') }}</small>
            </p>
          </li>
          <!-- Menu Footer-->
          <li class="user-footer">
            <div class="pull-left">
              @if(auth()->user()->isShopAdmin() && auth()->user()->restaurant)
                <a href="{{ route('restaurants.show', Auth::user()->restaurant) }}" class="btn btn-default btn-flat">  {{ __('Profile') }}</a>
              @else
                <a href="{{ route('users.show', Auth::user()) }}" class="btn btn-default btn-flat">  {{ __('Profile') }}</a>
              @endif
            </div>
            <div class="pull-right">
              <a class="btn btn-default btn-flat" href="{{ route('logout') }}"
                  onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                  {{ __('Logout') }}
              </a>
              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                  @csrf
              </form>
            </div>
          </li>
        </ul>
      </li>
      <!-- Control Sidebar Toggle Button -->
      <li>
        <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
      </li>
    </ul>
  </div>
</nav>
</header>