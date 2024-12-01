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
        
        <div class="col-lg-4">
          <h3 class="mb-4">{{ $podcast->title }}</h3>
          <p>By <a href="{{ route('podcasters.index', $podcast->podcaster->id) }}" class="podcaster-link">{{ $podcast->podcaster->name }}</a> / {{ $podcast->created_at->format('d M Y') }} / {{ gmdate('H:i:s', $podcast->duration) }}</p>
          <input type="submit" style="margin-bottom: 20px" class="btn-category" value="{{ $podcast->category->name }}">
          <div class="player">
            <audio id="player2" preload="none" controls style="max-width: 100%">
              <source src="{{ asset($podcast->audio) }}" type="audio/mp3">
            </audio>
          </div>
          @if(Auth::check())
              @php
                $isFollowing = \App\Models\PodcasterFollower::where('podcaster_id', $podcast->podcaster->id)
                                                            ->where('follower_id', Auth::id())
                                                            ->exists();
              @endphp
              <button id="follow-btn" class="btn btn-primary" style="margin-top: 20px; margin-bottom: 20px;">
                {{ $isFollowing ? 'UnFollow' : 'Follow' }}
              </button>
          @endif
        </div>
        <div class="col-lg-8">
          <img src="{{ asset($podcast->image) }}" alt="Image" class="img-fluid"> 
        </div>
        
        
      </div>
    </div>

    <div class="container pt-5 hero">
        <div class="comment-section">
          <h2>Comments</h2>
          <!-- Comment List -->
          <div class="comments">
            @foreach($podcast->comments as $comment)
                <div class="comment" data-id="{{ $comment->id }}">
                    <div class="comment-header">
                        <span class="comment-author">{{ $comment->podcaster->name }}</span>
                        <span class="comment-time">{{ $comment->created_at->diffForHumans() }}</span>
                    </div>
                    <p class="comment-content">{{ $comment->content }}</p>
                    @if(Auth::id() == $comment->podcaster_id)
                      <div class="comment-actions">
                        <button class="edit-btn">Edit</button>
                        <form action="{{ route('comments.destroy', $comment->id) }}" method="POST" style="display: inline;">
                          @csrf
                          @method('DELETE')
                          <button type="submit" class="delete-btn">Delete</button>
                        </form>
                      </div>
                    @endif
                </div>
            @endforeach
          </div>

          <!-- Comment Input -->
          @if(Auth::check())
            <div class="comment-input">
              <form action="{{ route('comments.store') }}" method="POST" id="comment_form" 
                  data-user-id="{{ Auth::user()->id }}"
                  data-user-name="{{ Auth::user()->name }}"
                  data-podcaster-id="{{ $podcast->podcaster->id }}"
                  >
                @csrf
                <input type="hidden" name="podcast_id" value="{{ $podcast->id }}">
                <textarea name="content" placeholder="Write a comment..." rows="5"></textarea>
                <button type="submit">Send</button>
              </form>
            </div>
          @endif
        </div>

    </div>
    

    <div class="site-section">
      <div class="container">

        <div class="row">
          <div class="col-lg-3">
          
            <div class="featured-user mb-5 mb-lg-0">
              <h3 class="mb-4">Popular Podcaster</h3>
              <ul class="list-unstyled">
                @foreach($podcasters as $podcaster)
                  <li>
                    <a href="#" class="d-flex align-items-center">
                    <img src="{{ asset('assets/images/person_1.jpg') }}" alt="Image" class="img-fluid mr-2">
                      <div class="podcaster">
                        <span class="d-block">{{ $podcaster->name }}</span>
                        <span class="small">{{ number_format($podcaster->podcasts_count) }} podcasts</span>
                      </div>
                    </a>
                  </li>
                @endforeach
              </ul>
            </div>

          </div>

          <div class="col-lg-9">

            <h3 class="mb-4">Other Podcasts</h3>
            @foreach($otherPodcasts as $otherPodcast)
              <div class="d-block d-md-flex podcast-entry bg-white mb-5" data-aos="fade-up">
                  <div class="image" style="background-image: url('{{ asset($otherPodcast->image) }}');"></div>
                  <div class="text">
                  <h3 class="font-weight-light"><a href="{{ route('podcast.podcast_detail', ['category' => $otherPodcast->category->name, 'id' => $otherPodcast->id]) }}">{{ $otherPodcast->title }}</a></h3>
                      <div class="text-white mb-3">
                          <span class="text-black-opacity-05">
                              <small>By <a href="{{ route('podcasters.index', $otherPodcast->podcaster->id) }}" class="podcaster-link">{{ $otherPodcast->podcaster->name }}</a> <span class="sep">/</span> {{ $otherPodcast->created_at->format('d M Y') }} <span class="sep">/</span> {{ gmdate('H:i:s', $otherPodcast->duration) }}</small>
                          </span>
                      </div>
                      <div class="player">
                          <audio id="player2" preload="none" controls style="max-width: 100%">
                              <source src="{{ asset($otherPodcast->audio) }}" type="audio/mp3">
                          </audio>
                      </div>
                  </div>
              </div>
          @endforeach

          <!-- Pagination (nếu cần) -->
          <div class="container" data-aos="fade-up">
              <div class="row">
                  <div class="col-md-12 text-center">
                      <div class="site-block-27">
                          <ul>
                              <li><a href="#" class="icon-keyboard_arrow_left"></a></li>
                              <li class="active"><span>1</span></li>
                              <li><a href="#">2</a></li>
                              <li><a href="#">3</a></li>
                              <li><a href="#">4</a></li>
                              <li><a href="#">5</a></li>
                              <li><a href="#" class="icon-keyboard_arrow_right"></a></li>
                          </ul>
                      </div>
                  </div>
              </div>
          </div>
        </div>
      </div>
    </div>

    <div class="site-section bg-light block-13">
      <div class="container">
        <div class="row mb-5">
          <div class="col-md-12 text-center">
            <h2 class="font-weight-bold text-black">Related Guests</h2>
          </div>
        </div>
        <div class="nonloop-block-13 owl-carousel">
          @foreach($podcasters as $podcaster)
            <div class="text-center p-3 p-md-5 bg-white">            
              <div class="mb-4">            
                <img src="{{ asset('assets/images/person_1.jpg') }}" alt="Image" class="w-50 mx-auto img-fluid rounded-circle">
              </div>
              <div class="">
                <h3 class="font-weight-light h5">{{ $podcaster->name }}</h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Et, iusto. Aliquam illo, cum sed ea? Ducimus quos, ea?</p>
              </div>
            </div>
          @endforeach 
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

  {{-- <script src="{{ asset('assets/js/comment.js') }}"></script> --}}
  <script>
    document.addEventListener("DOMContentLoaded", () => {
      const followBtn = document.getElementById('follow-btn');

      if (followBtn) {
          followBtn.addEventListener('click', () => {
              const isFollowing = followBtn.textContent.trim() === 'UnFollow';
              const url = isFollowing ? '{{ route('unfollow') }}' : '{{ route('follow') }}';
              const podcasterId = '{{ $podcast->podcaster->id }}';
              const token = '{{ csrf_token() }}';

              fetch(url, {
                method: 'POST',
                headers: {
                  'Content-Type': 'application/json',
                  'X-CSRF-TOKEN': token
                },
                body: JSON.stringify({ podcaster_id: podcasterId })
              })
              .then(response => response.json())
              .then(data => {
                if (data.status === 1) {
                  followBtn.textContent = isFollowing ? 'Follow' : 'UnFollow';
                } else {
                  alert(data.message);
                }
              })
              .catch(error => console.error('Error:', error));
          });
      }
    });
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