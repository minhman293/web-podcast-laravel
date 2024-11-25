<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Podcast &mdash; Colorlib Website Template</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    @include('partials.styles')
    
  </head>
  <body>
  
  <div id="notification" class="notification hidden">
    <span id="notification-message"></span>
  </div>

  <div class="site-wrap">

    <div class="site-mobile-menu">
      <div class="site-mobile-menu-header">
        <div class="site-mobile-menu-close mt-3">
          <span class="icon-close2 js-menu-toggle"></span>
        </div>
      </div>
      <div class="site-mobile-menu-body"></div>
    </div>


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
                  <li>
                    <a href="{{ url('/') }}">Home</a>
                  </li>
                  <li class="has-children">
                    <a href="#">Dropdown</a>
                    <ul class="dropdown arrow-top">
                      <li><a href="#">Menu One</a></li>
                      <li><a href="#">Menu Two</a></li>
                      <li><a href="#">Menu Three</a></li>
                    </ul>
                  </li>
                  <li><a href="{{ url('/about') }}">About</a></li>
                  <li><a href="{{ url('/contact') }}">Contact</a></li>

                  @if(session('name'))
                    <li class="active">
                      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                      </form>
                      <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        Hi, {{ session('name') }}
                      </a>
                    </li>
                  @else
                      <li class="active"><a href="{{ url('/login-register') }}">Login / Register</a></li>
                  @endif
                  
                </ul>
            </nav>


          </div>

        </div>
      </div>
      
    </header>
    

    <div class="site-blocks-cover overlay inner-page-cover" style="background-image: url({{ asset('assets/images/hero_bg_1.jpg') }});" data-aos="fade" data-stellar-background-ratio="0.5">
      <div class="container">
        <div class="row align-items-center justify-content-center text-center">

          <div class="col-md-6" data-aos="fade-up" data-aos-delay="400">
            <h1 class="text-white">Login / Register</h1>
            <a href="#">Home</a><span class="mx-2 text-white">&bullet;</span> <span class="text-white">Login / Register</span>
          </div>
        </div>
      </div>
    </div>  

    
    <div class="site-section">
      <div class="container" data-aos="fade-up">
        <div class="row justify-content-center">
          <div class="col-md-5 mb-5">
            <h3 class="mb-5">Register</h3>
            <form action="{{ route('register') }}" method="POST" class="bg-white">
              @csrf
              <div class="">
                <div class="form-group row">
                  <div class="col-md-12">
                    <label for="c_fname" class="text-black">Username <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="name" name="name">
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-md-12">
                    <label for="c_email" class="text-black">Email <span class="text-danger">*</span></label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="">
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-md-12">
                    <label for="c_pass" class="text-black">Password <span class="text-danger">*</span></label>
                    <input type="password" class="form-control" id="password" name="password">
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-md-12">
                    <label for="c_repass" class="text-black">Re-type Password <span class="text-danger">*</span></label>
                    <input type="password" class="form-control" id="confirm_password" name="confirm_password">
                  </div>
                </div>
                
                
                <div class="form-group row">
                  <div class="col-lg-12">
                    <input type="submit" class="btn btn-primary btn-lg" value="Register">
                  </div>
                </div>
              </div>
            </form>

            <!-- Thông báo đăng ký -->
            @if(session('success'))
              <script>
                document.addEventListener('DOMContentLoaded', function() {
                  showNotification("{{ session('success') }}", 'success');
                });
              </script>
            @endif

            @if(session('error'))
              <script>
                document.addEventListener('DOMContentLoaded', function() {
                  showNotification("{{ session('error') }}", 'error');
                });
              </script>
            @endif

            @if($errors->any())
              <script>
                document.addEventListener('DOMContentLoaded', function() {
                  let errorMessages = '';
                  @foreach ($errors->all() as $error)
                    errorMessages += '{{ $error }}\n';
                  @endforeach
                  showNotification(errorMessages, 'error');
                });
              </script>
            @endif

          </div>
          <div class="col-md-5 mb-5">
            <h3 class="mb-5">Login</h3>

            @if (session('success'))
              <div class="alert alert-success">
                  {{ session('success') }}
              </div>
            @endif

            @if ($errors->any())
              <div class="alert alert-danger">
                <ul>
                  @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                  @endforeach
                </ul>
              </div>
            @endif

            <form action="{{ route('login') }}" method="POST" class="bg-white">
              @csrf
              <div class="">
                <div class="form-group row">
                  <div class="col-md-12">
                    <label for="c_uname" class="text-black">Email <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="email" name="email">
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-md-12">
                    <label for="c_password" class="text-black">Password <span class="text-danger">*</span></label>
                    <input type="password" class="form-control" id="password" name="password">
                  </div>
                </div>
                
                <div class="form-group row">
                  <div class="col-lg-12">
                    <input type="submit" class="btn btn-primary btn-lg" value="Login" id="loginButton">
                  </div>
                </div>
              </div>
            </form>

            <!-- Thông báo đăng nhập -->
            @if(session('success'))
              <script>
                document.addEventListener('DOMContentLoaded', function() {
                  showNotification("{{ session('success') }}", 'success');
                });
              </script>
            @endif

            @if(session('error'))
              <script>
                document.addEventListener('DOMContentLoaded', function() {
                  showNotification("{{ session('error') }}", 'error');
                });
              </script>
            @endif

            @if($errors->any())
              <script>
                document.addEventListener('DOMContentLoaded', function() {
                  let errorMessages = '';
                  @foreach ($errors->all() as $error)
                    errorMessages += '{{ $error }}\n';
                  @endforeach
                  showNotification(errorMessages, 'error');
                });
              </script>
            @endif

          </div>
        </div>
      </div>
    </div>

    
    <div class="site-blocks-cover overlay inner-page-cover" style="background-image: url({{ asset('assets/images/hero_bg_1.jpg') }});" data-aos="fade" data-stellar-background-ratio="0.5">
      <div class="container">
        <div class="row align-items-center justify-content-center text-center">

          <div class="col-md-6" data-aos="fade-up" data-aos-delay="400">
            <h2>Subscribe</h2>
            <p class="mb-5">Lorem ipsum dolor sit amet, consectetur adipisicing elit nihil saepe libero sit odio obcaecati veniam.</p>
            <form action="#" method="post" class="site-block-subscribe">
                <div class="input-group mb-3">
                  <input type="text" class="form-control border-secondary text-white bg-transparent" placeholder="Enter Email" aria-label="Enter Email" aria-describedby="button-addon2">
                  <div class="input-group-append">
                    <button class="btn btn-primary" type="button" id="button-addon2">Send</button>
                  </div>
                </div>
              </form>
          </div>
        </div>
      </div>
    </div>  

    
    <footer class="site-footer">
      <div class="container">
        <div class="row">
          <div class="col-lg-4">
            <h3>About Us</h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Praesentium animi, odio beatae aspernatur natus recusandae quasi magni eum voluptatem nam!</p>
          </div>
          <div class="col-lg-3 mx-auto">
            <h3>Navigation</h3>
            <ul class="list-unstyled">
              <li><a href="#">Podcasts</a></li>
              <li><a href="#">Services</a></li>
              <li><a href="#">About Us</a></li>
              <li><a href="#">Blog</a></li>
              <li><a href="#">Contact</a></li>
            </ul>
          </div>
          <div class="col-lg-4">
            <h3>Subscribe</h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quod, quibusdam!</p>
            <form action="#" class="form-subscribe">
              <input type="email" class="form-control mb-3" placeholder="Enter Email">
              <input type="submit" class="btn btn-primary" value="Subscribe">
            </form>
          </div>
        </div>

        <div class="row pt-5 mt-5 text-center">
          <div class="col-md-12">
            <p>
            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
            Copyright &copy;<script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script><script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="icon-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank" >Colorlib</a>
            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
            </p>
          </div>
          
        </div>
      </div>
    </footer>
  </div>

  @include('partials.scripts')

  <script>
    function showNotification(message, type = 'success') {
      const notification = document.getElementById('notification');
      const notificationMessage = document.getElementById('notification-message');

      notificationMessage.textContent = message;
      notification.classList.remove('hidden');
      notification.classList.add(type === 'success' ? 'alert-success' : 'alert-danger');

      setTimeout(() => {
        notification.classList.add('hidden');
      }, 10000); // 10 giây
    }
  </script>

  <script>
      document.addEventListener('DOMContentLoaded', function() {
                var mediaElements = document.querySelectorAll('video, audio'), total = mediaElements.length;

                for (var i = 0; i < total; i++) {
                    new MediaElementPlayer(mediaElements[i], {
                        pluginPath: 'https://cdn.jsdelivr.net/npm/mediaelement@4.2.7/build/',
                        shimScriptAccess: 'always',
                        success: function () {
                            var target = document.body.querySelectorAll('.player'), targetTotal = target.length;
                            for (var j = 0; j < targetTotal; j++) {
                                target[j].style.visibility = 'visible';
                            }
                  }
                });
                }
            });
    </script>


  <script src="{{ asset('assets/js/main.js') }}"></script>
    
  </body>
</html>