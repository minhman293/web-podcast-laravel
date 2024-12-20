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

    @include('partials.header')

    <div class="container pt-5 hero">
      <div class="row align-items-center text-center text-md-left">
        <div class="col-lg-6">
          @auth
          <h1 class="mb-3 display-4">Welcome, {{ auth()->user()->name }}</h1>
          <p>{{ auth()->user()->email }}</p>
          @endauth
          <p>Below is your podcast that you uploaded, you can add, delete, update them when ever you want !</p>
          <div class="text-left mb-4">
            <p class=""> If you want to update your profile</p>
            <a href="{{ route('podcasters.edit', Auth::id()) }}" class="btn btn-primary">
              <i class="fas fa-user-edit mr-2"></i>Update Profile
            </a>
          </div>
        </div>
        <div class="col-lg-6">
          <img src="{{ asset('assets/images/1x/asset-1.png') }}" alt="Image" class="img-fluid">
        </div>
      </div>
    </div>


    <div class="site-section">
      <div class="container">

        <div class="row">

          <div class="col-lg-9-crud">
            <!-- Search Form -->
            <div class="d-flex justify-content-between mb-3">
              <form action="{{ route('podcast.crud') }}" method="GET" class="flex-grow-1 mr-4" data-aos="fade-up" id="searchForm">
                <div class="input-group">
                  <input class="form-control" type="search" name="search" placeholder="Search by title, description"
                    value="{{ request('search') }}" aria-label="Search">
                  <button class="btn btn-primary search-button" data-aos="fade-up" type="submit" style="Color: white">Search</button>
                  @if(request('search'))
                  <a href="{{ route('podcast.crud') }}" data-aos="fade-up" class="btn btn-secondary"> Clear </a>
                  @endif
                </div>
              </form>
              <a href="crud/add" class="btn btn-success" data-aos="fade-up">Add New Podcast</a>
            </div>
            @if($podcasts->isEmpty())
            <div class="alert alert-info" role="alert">
              No podcasts found{{ request('search') ? ' for "'.request('search').'"' : '' }}
            </div>
            @endif

            @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
              {{ session('success') }}
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            @endif

            @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
              {{ session('error') }}
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            @endif
            @if(Auth::check())
            <div class="mb-3">
              <form action="{{ route('podcast.crud') }}" method="GET">
                <div class="form-check">
                  <input type="checkbox" id="show_deleted" data-aos="fade-up"
                    name="show_deleted" value="1"
                    {{ request('show_deleted') ? 'checked' : '' }}
                    onChange="this.form.submit()">
                  <label class="form-check-label" for="show_deleted" data-aos="fade-up">
                    Show deleted podcasts
                  </label>
                </div>
              </form>
            </div>
            @if($podcasts->count() > 0)
            @foreach($podcasts as $podcast)
            <div class="d-block d-md-flex podcast-entry bg-white mb-5" data-aos="fade-up">
              @php
              $isImageUrl = filter_var($podcast->image, FILTER_VALIDATE_URL);
              $imageSource = $isImageUrl ? $podcast->image : asset('storage/podcasts/images/' . $podcast->image);
              @endphp
              <div class="image" style="background-image: url('{{ $imageSource }}');"></div>
              <div class="text">
                <h3 class="font-weight-light">
                  <a href="{{ route('podcast.podcast_detail', ['category' => $podcast->category->name, 'id' => $podcast->id]) }}">{{ $podcast->title }}</a>
                </h3>
                <p class="mb-4">{{ $podcast->description }}</p>
                <div class="player">
                  <audio id="player2" preload="none" controls style="max-width: 100%">
                    @php
                    $isUrl = filter_var($podcast->audio, FILTER_VALIDATE_URL);
                    $audioSource = $isUrl ? $podcast->audio : asset('storage/podcasts/audio/' . $podcast->audio);
                    @endphp
                    <source src="{{ $audioSource }}" type="audio/mp3">
                  </audio>
                </div>
                @if($podcast->trashed())
                <form action="{{ route('podcast.restore', $podcast->id) }}"
                  method="POST" class="d-inline">
                  @csrf
                  <button type="submit" class="btn btn-success delete-button mt-3">
                    Restore
                  </button>
                </form>
                @else
                <form action="{{ route('podcast.deletePodcast', $podcast->id) }}" method="POST" class="d-inline">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-danger delete-button mt-3" onclick="return confirm('Are you sure you want to delete this podcast?')">Delete</button>
                </form>
                <a href="{{ route('podcast.loadUpdatePage', $podcast->id) }}" type="submit" class="btn btn-info delete-button mt-3" style="color: white;">Update</a>
                @endif
              </div>
            </div>

            @endforeach

            @if($podcasts->total() > 5)
            <div class="container" data-aos="fade-up">
              <div class="row">
                <div class="col-md-12 text-center">
                  {{ $podcasts->links('pagination::bootstrap-4') }}
                </div>
              </div>
            </div>
            @endif
            @else
            <div class="alert alert-info text-center">
              You haven't add any podcast.
            </div>
            @endif
            @else
            <div class="alert alert-info">
              Please login to view your podcasts.
            </div>
            @endif

          </div>


        </div>


        <div class="site-section bg-light block-13">

          <div class="container">
            <div class="row mb-5">
              <div class="col-md-12 text-center">
                <h2 class="font-weight-bold text-black">Featured Guests</h2>
              </div>
            </div>
            <div class="nonloop-block-13 owl-carousel">

              <div class="text-center p-3 p-md-5 bg-white">
                <div class="mb-4">
                  <img src="{{ asset('assets/images/person_1.jpg') }}" alt="Image" class="w-50 mx-auto img-fluid rounded-circle">
                </div>
                <div class="">
                  <h3 class="font-weight-light h5">Megan Smith</h3>
                  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Et, iusto. Aliquam illo, cum sed ea? Ducimus quos, ea?</p>
                </div>
              </div>

              <div class="text-center p-3 p-md-5 bg-white">
                <div class="mb-4">
                  <img src="{{ asset('assets/images/person_2.jpg') }}" alt="Image" class="w-50 mx-auto img-fluid rounded-circle">
                </div>
                <div class="">
                  <h3 class="font-weight-light h5">Brooke Cagle</h3>
                  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Et, iusto. Aliquam illo, cum sed ea? Ducimus quos, ea?</p>
                </div>
              </div>

              <div class="text-center p-3 p-md-5 bg-white">
                <div class="mb-4">
                  <img src="{{ asset('assets/images/person_3.jpg') }}" alt="Image" class="w-50 mx-auto img-fluid rounded-circle">
                </div>
                <div class="">
                  <h3 class="font-weight-light h5">Philip Martin</h3>
                  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Et, iusto. Aliquam illo, cum sed ea? Ducimus quos, ea?</p>
                </div>
              </div>

              <div class="text-center p-3 p-md-5 bg-white">
                <div class="mb-4">
                  <img src="{{ asset('assets/images/person_4.jpg') }}" alt="Image" class="w-50 mx-auto img-fluid rounded-circle">
                </div>
                <div class="">
                  <h3 class="font-weight-light h5">Steven Ericson</h3>
                  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Et, iusto. Aliquam illo, cum sed ea? Ducimus quos, ea?</p>
                </div>
              </div>

              <div class="text-center p-3 p-md-5 bg-white">
                <div class="mb-4">
                  <img src="{{ asset('assets/images/person_5.jpg') }}" alt="Image" class="w-50 mx-auto img-fluid rounded-circle">
                </div>
                <div class="">
                  <h3 class="font-weight-light h5">Nathan Dumlao</h3>
                  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Et, iusto. Aliquam illo, cum sed ea? Ducimus quos, ea?</p>
                </div>
              </div>

              <div class="text-center p-3 p-md-5 bg-white">
                <div class="mb-4">
                  <img src="{{ asset('assets/images/person_6.jpg') }}" alt="Image" class="w-50 mx-auto img-fluid rounded-circle">
                </div>
                <div class="">
                  <h3 class="font-weight-light h5">Brook Smith</h3>
                  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Et, iusto. Aliquam illo, cum sed ea? Ducimus quos, ea?</p>
                </div>
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
                  Copyright &copy;<script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
                  <script>
                    document.write(new Date().getFullYear());
                  </script> All rights reserved | This template is made with <i class="icon-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
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
          var mediaElements = document.querySelectorAll('video, audio'),
            total = mediaElements.length;

          for (var i = 0; i < total; i++) {
            new MediaElementPlayer(mediaElements[i], {
              pluginPath: 'https://cdn.jsdelivr.net/npm/mediaelement@4.2.7/build/',
              shimScriptAccess: 'always',
              success: function() {
                var target = document.body.querySelectorAll('.player'),
                  targetTotal = target.length;
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