<header class="site-navbar py-4" role="banner">

    <div class="container">
      <div class="row align-items-center">


        <div class="col-3">
          <h1 class="site-logo"><a href="{{ url('/') }}" class="h2">Podcast<span class="text-primary">.</span> </a></h1>
        </div>
        <div class="col-9">
          <nav class="site-navigation position-relative text-right text-md-right" role="navigation">



            <div class="d-block d-lg-none ml-md-0 mr-auto"><a href="#" class="site-menu-toggle js-menu-toggle text-black"><span class="icon-menu h3"></span></a></div>

            <ul class="site-menu js-clone-nav d-none d-lg-block">
              <li class="active">
                <a href="{{ url('/') }}">Home</a>
              </li>
              <li class="has-children">
                <a href="#" id="__notification_label" class="notification_label">Notifications
                  <sup id="__notification_counts" class="notification_counts {{ $unreadNotificationsCount == 0 ? 'hide' : '' }}">
                    {{ $unreadNotificationsCount }}</sup>
                </a>
                <ul class="dropdown arrow-top" id="__notification_list" class="notification_list">
                  @foreach($notifications as $notification)
                      <li><a href="{{ route('podcast.redirect', ['podcast' => $notification->podcast_id]) }}">{{$notification->content}}</a></li>
                  @endforeach
                </ul>
              </li>
              <li><a href="{{ route('about') }}">About</a></li>
              <li><a href="{{ route('contact') }}">Contact</a></li>

              @auth
              <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      Hello, {{ Auth::user()->name }}
                  </a>
                  <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                      <a class="dropdown-item" href="{{ route('podcasters.index', Auth::id()) }}">View profile</a>
                      <a class="dropdown-item" href="{{ route('podcasters.edit', Auth::id()) }}">Update profile</a>
                      <div class="dropdown-divider"></div>
                      <form method="POST" action="{{ route('logout') }}" class="logout-form">
                          @csrf
                          <button type="submit" class="dropdown-item">Log out</button>
                      </form>
                  </div>
              </li>
              @else
              <li><a href="{{ route('login') }}">Login</a></li>
              @endauth

            </ul>
          </nav>


        </div>

      </div>
    </div>
    
  </header>