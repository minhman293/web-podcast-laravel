<!DOCTYPE html>
<html lang="en">
<head>
  <title>Podcast &mdash; Colorlib Website Template</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  @include('partials.styles')
  <link rel="stylesheet" href="{{ asset('/assets/css/user_profile.css') }}">

</head>
<body>

  <div class="site-wrap">

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
                  <a href="#">Dropdown</a>
                  <ul class="dropdown arrow-top">
                    <li><a href="#">Menu One</a></li>
                    <li><a href="#">Menu Two</a></li>
                    <li><a href="#">Menu Three</a></li>
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

    <main class="profile_page">
        <div class="container pt-2 hero">
            <h2>Profile</h2>
            <form action="{{ route('podcasters.update', $podcaster->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row align-items-center text-center text-md-left">
                    <div class="col-lg-8">
                        <h3>Image</h3>
                        <p>Photos will appear with your channel in places like next to your profile comments.</p>
                        <div class="profile_page__image_change flex">
                            <img src="{{ asset('/assets/images/' . $podcaster->image) }}" alt="{{ $podcaster->name }}">
                            <div>
                                <p>We recommend images that are at least 98 x 98 pixels in resolution and 4 MB in size. Use PNG or GIF files (no animations).</p>
                                <!-- Hidden file input -->
                                <input type="file" name="image" id="imageInput" class="form-control" style="display: none;" onchange="showFileName()">
                                <button type="button" onclick="document.getElementById('imageInput').click()">Change photo</button>
                                <p id="fileName" style="margin-top: 10px; font-size: 14px; color: gray;"></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <h3 style="margin-top: 20px">Name</h3>
                            <p>Choose a name that reflects your personality and content. Changes to your name and avatar only appear on Podcasts and not on other services.</p>
                            <input 
                                type="text" 
                                id="channelName" 
                                name="channelName" 
                                value="{{ old('channelName', $podcaster->name) }}" 
                                placeholder="Nhập tên kênh của bạn" 
                                class="form-control">
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <img src="{{ asset('assets/images/1x/asset-1.png') }}" alt="Image" class="img-fluid">    
                    </div>
                </div>
                <button type="submit" class="profile__link_btn">Save</button>
            </form>
        </div>
    </main>
    
   


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
              Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="icon-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank" >Colorlib</a>
            </p>
          </div>
        </div>
      </div>
    </footer>
  </div>

  @include('partials.scripts')

  <script src="{{ asset('assets/js/main.js') }}"></script>
  <script>
    function showFileName() {
        const fileInput = document.getElementById('imageInput');
        const fileNameDisplay = document.getElementById('fileName');

        if (fileInput.files.length > 0) {
            fileNameDisplay.textContent = `Selected file: ${fileInput.files[0].name}`;
        } else {
            fileNameDisplay.textContent = '';
        }
    }
</script>
</body>
</html>