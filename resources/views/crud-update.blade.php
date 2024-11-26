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
                  <a href="index.html">Home</a>
                </li>
                <li class="has-children">
                  <a href="#">Dropdown</a>
                  <ul class="dropdown arrow-top">
                    <li><a href="#">Menu One</a></li>
                    <li><a href="#">Menu Two</a></li>
                    <li><a href="#">Menu Three</a></li>
                  </ul>
                </li>
                <li><a href="about.html">About</a></li>
                <li><a href="contact.html">Contact</a></li>
                <li><a href="login-register.html">Login / Register</a></li>
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
             
              <form action="{{ route('podcast.updatePodcast', $podcast->id) }}" method="POST" enctype="multipart/form-data">
                  @csrf
                  @method('PUT')
                  
                  <div class="form-group">
                      <label for="title">Podcast Title</label>
                      <input type="text" class="form-control" id="title" name="title" value="{{ $podcast->title }}" required>
                  </div>
                  
                  <div class="form-group">
                      <label for="description">Podcast Description</label>
                      <textarea class="form-control" id="description" name="description" required>{{ $podcast->description }}</textarea>
                  </div>
                  
                  <div class="form-group">
                      <label for="podcaster_id">Podcast Author</label>
                      <input type="text" class="form-control" id="podcaster_id" name="podcaster_id" value="{{ $podcast->podcaster_id }}" readonly>
                  </div>

                  <div class="form-group">
                      <label for="category_id">Category</label>
                      <select class="form-control" id="category_id" name="category_id" required>
                          @foreach($categories as $category)
                              <option value="{{ $category->id }}" {{ $podcast->category_id == $category->id ? 'selected' : '' }}>
                                  {{ $category->name }}
                              </option>
                          @endforeach
                      </select>
                  </div>

                  <div class="form-group">
                      <label for="duration">Duration (in seconds)</label>
                      <input type="number" class="form-control" id="duration" name="duration" value="{{ $podcast->duration }}" required>
                  </div>

                  <div class="form-group">
                      <label for="audio">New Podcast Audio File (optional)</label>
                      <input type="file" class="form-control-file" id="audio" name="audio" accept="audio/mp3,audio/wav,audio/ogg">
                      <small class="form-text text-muted">Maximum file size: 50MB. Leave empty to keep existing audio.</small>
                      <div class="mt-2">Current audio: {{ $podcast->audio }}</div>
                  </div>
                  <script>
                    document.getElementById('audio').addEventListener('change', function(e) {
                        const file = e.target.files[0];
                        const audio = document.createElement('audio');
                        const reader = new FileReader();

                        reader.onload = function(e) {
                            audio.src = e.target.result;
                            
                            // When audio metadata is loaded, get duration
                            audio.addEventListener('loadedmetadata', function() {
                                // Round duration to whole number
                                const duration = Math.round(audio.duration);
                                document.getElementById('duration').value = duration;
                            });
                        };

                        reader.readAsDataURL(file);
                    });
                  </script>

                  <div class="form-group">
                      <label for="image">New Podcast Image (optional)</label>
                      <input type="file" class="form-control-file" id="image" name="image" accept="image/*">
                      <small class="form-text text-muted">Leave empty to keep existing image.</small>
                      @if($podcast->image)
                          <div class="mt-2">
                              <img src="{{ asset('storage/podcasts/images/' . $podcast->image) }}" alt="Current image" style="max-width: 200px">
                          </div>
                      @endif
                  </div>

                  <div class="d-flex justify-content-center mb-4">
                      <button type="submit" class="btn btn-primary">Update Podcast</button>
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