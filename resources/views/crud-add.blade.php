<!DOCTYPE html>
<html lang="en">
<head>
  <title>Podcast &mdash; Colorlib Website Template</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  @include('partials.styles')

</head>
<body>

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
            <h1 class="site-logo"><a href="index.html" class="h2">Podcast<span class="text-primary">.</span> </a></h1>
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

    

    <div class="container pt-5 hero">
      <div class="row align-items-center text-center text-md-left">
        <div class="col-lg-6">
          <h1 class="mb-3 display-3">Add Your Podcast</h1>
          <p>Please insert all requested infomation of your podcast below</p>
        </div>
        <div class="col-lg-6">
          <img src="{{ asset('assets/images/1x/asset-1.png') }}" alt="Image" class="img-fluid">    
        </div>
      </div>
    </div>
    

    <div class="site-section">
      <div class="container">

        <div class="row justify-content-center">

          <div class="col-lg-8">

            <div class="container pt-5">
             
                <form action="{{ route('podcast.addPodcast') }}" method="POST" enctype="multipart/form-data">
                  @csrf
                  <!-- Add validation messages here -->
                  @if ($errors->any())
                    <div class="alert alert-danger mb-4">
                      <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                          <li>{{ $error }}</li>
                        @endforeach
                      </ul>
                    </div>
                  @endif

                  @if (session('success'))
                    <div class="alert alert-success mb-4">
                      {{ session('success') }}
                    </div>
                  @endif
                  <div class="form-group">
                      <label for="title">Podcast Title</label>
                      <input type="text" class="form-control" id="title" name="title" required>
                  </div>
                  
                  <div class="form-group">
                      <label for="description">Podcast Description</label>
                      <input class="form-control" id="description" name="description" required></input>
                  </div>
                  
                  <div class="form-group">
                      <label for="podcaster_id">Podcast Author ID</label>
                      <input type="text" class="form-control" id="podcaster_id" name="podcaster_id" value="{{ Auth::user()->id }}" readonly>
                  </div>

                  <div class="form-group">
                      <label for="category_id">Category</label>
                      <select class="form-control" id="category_id" name="category_id" required>
                          @foreach($categories as $category)
                              <option value="{{ $category->id }}">{{ $category->name }}</option>
                          @endforeach
                      </select>
                  </div>

                  <div class="form-group">
                      <label for="duration">Duration (in seconds)</label>
                      <input type="number" class="form-control" id="duration" name="duration" required>
                  </div>

                  <!-- Thay đổi phần HTML cho audio và image uploads -->
                  <div class="form-group">
                      <label for="audio">Podcast Audio File (MP3)</label>
                      <button type="button" id="upload_audio" class="btn btn-secondary">Upload Audio</button>
                      <input type="hidden" id="audio_url" name="audio" required>
                      <small class="form-text text-muted" id="selected_audio"></small>
                  </div>

                  <div class="form-group">
                      <label for="image">Podcast Image</label>
                      <button type="button" id="upload_image" class="btn btn-secondary">Upload Image</button>
                      <input type="hidden" id="image_url" name="image" required>
                      <small class="form-text text-muted" id="selected_image"></small>
                  </div>

                  <div class="d-flex justify-content-center mb-4">
                      <button type="submit" class="btn btn-primary">Add Podcast</button>
                  </div>
              </form>
            </div>
            <!-- Search Form -->
          
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

  <!-- Add this in your <head> or before closing </body> -->
  <script src="https://upload-widget.cloudinary.com/global/all.js"></script>

  <!-- Your existing form HTML stays the same -->

  <!-- Update JavaScript -->
  <script>
  // Initialize Cloudinary configuration
  const cloudName = 'dkd1rcht5'; 
  const uploadPreset = 'web-podcast';

  // Create widgets first
  const audioWidget = cloudinary.createUploadWidget({
      cloudName: cloudName,
      uploadPreset: uploadPreset,
      sources: ['local'],
      resourceType: 'auto',
      folder: 'Podcast/audio',
      maxFileSize: 52428800,
      allowedFormats: ['mp3', 'wav', 'ogg']
  }, (error, result) => {
      if (error) {
          console.error('Upload error:', error);
          document.getElementById('selected_audio').textContent = 'Upload failed: ' + error.message;
          return;
      }
      if (result.event === "success") {
          const url = result.info.secure_url;
          document.getElementById('audio_url').value = url;
          document.getElementById('selected_audio').textContent = 'Audio uploaded: ' + result.info.original_filename;
          
          // Get duration
          const audio = new Audio(url);
          audio.addEventListener('loadedmetadata', () => {
              document.getElementById('duration').value = Math.round(audio.duration);
          });
      }
  });

  const imageWidget = cloudinary.createUploadWidget({
      cloudName: cloudName,
      uploadPreset: uploadPreset,
      sources: ['local'],
      folder: 'Podcast/images',
      maxFileSize: 2097152,
      allowedFormats: ['jpg', 'png', 'jpeg']
  }, (error, result) => {
      if (error) {
          console.error('Upload error:', error);
          document.getElementById('selected_image').textContent = 'Upload failed: ' + error.message;
          return;
      }
      if (result.event === "success") {
          const url = result.info.secure_url;
          document.getElementById('image_url').value = url;
          document.getElementById('selected_image').textContent = 'Image uploaded: ' + result.info.original_filename;
      }
  });

  // Add click handlers after widgets are created
  document.addEventListener('DOMContentLoaded', function() {
      document.getElementById('upload_audio').addEventListener('click', () => {
          audioWidget.open();
      });

      document.getElementById('upload_image').addEventListener('click', () => {
          imageWidget.open();
      });
  });
  </script>


  <script src="{{ asset('assets/js/main.js') }}"></script>

</body>
</html>