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

        {{-- <h1 style="font-size: 10em">  {{ $is_owner ? 'HELLO KITTY' : 'HELLO WORLD' }}</h1>
        <h2>{{ $podcaster->password }}</h2> --}}
 
        <header class="site-navbar py-4" role="banner">

            <div class="container">
                <div class="row align-items-center">

                    <div class="col-3">
                        <h1 class="site-logo"><a href="{{ url('/') }}" class="h2">Podcast<span
                                    class="text-primary">.</span> </a></h1>
                    </div>
                    <div class="col-9">
                        <nav class="site-navigation position-relative text-right text-md-right" role="navigation">

                            <div class="d-block d-lg-none ml-md-0 mr-auto"><a href="#"
                                    class="site-menu-toggle js-menu-toggle text-black"><span
                                        class="icon-menu h3"></span></a></div>

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

{{-- @section('content') --}}
<main class="profile_page">
    <div class="profile_page__image flex">
        <img src="{{ asset('/assets/images/' . $podcaster->image) }}" alt="{{ $podcaster->name }}">
        <div>
            <h3>{{ $podcaster->name }}</h3>
            <p>{{ $podcaster->email }}</p>
            <p>Followers: {{ $followersCount}}</p>

            @if ($is_owner)
                <a class="profile__link_btn" href="{{ route('podcasters.edit', $podcaster->id) }}">Update information</a>
                <a class="profile__link_btn" href="{{ route('podcast.crud', $podcaster->id) }}">Podcast Management</a>
            @endif

                @if (Auth::id() != $podcaster->id)
                    @if ($isSubscribed)
                        <!-- Nút hủy đăng ký -->
                        <form action="{{ route('podcasters.unsubscribe', $podcaster->id) }}" method="POST" style="display: inline;">
                            @csrf
                            <button type="submit" class="profile__link_btn">Unfollow</button>
                        </form>
                    @else
                        <!-- Nút đăng ký -->
                        <form action="{{ route('podcasters.subscribe', $podcaster->id) }}" method="POST" style="display: inline;">
                            @csrf
                            <button type="submit" class="profile__link_btn">Follow</button>
                        </form>
                    @endif
                @endif 
        </div>

    </div>

    <div class="site-section">
        <h3>Playlists</h3>
        <div class="container">

            <div class="row">

                <div class="col-lg-9-crud">

                    <!-- Search Form -->
                    <div class="d-flex justify-content-between mb-3">
                        <form action="" method="GET" class="flex-grow-1 mr-4 mt-2" data-aos="fade-up">
                            <input class="form-control w-100" type="search" name="search"
                                placeholder="Search Podcasts" aria-label="Search"
                                value="{{ request('search') }}">
                        </form>
                        <div class="profile_page__image flex">
                            <button type="button" style="margin-top: 0.45em;padding: 0.3em">Search</button>
                        </div>
                    </div>

                    @foreach ($podcasts as $item)
                        <div class="d-block d-md-flex podcast-entry bg-white mb-5" data-aos="fade-up">
                            <div class="image"
                                style="background-image: url('{{ $item->image }}');"></div>
                            <div class="text">

                                <h3 class="font-weight-light"><a href="single-post.html">{{ $item->title }}</a></h3>
                                <div class="text-white mb-3"><span class="text-black-opacity-05"><small>{{ $item->description }}<span class="sep">/</span>{{ $item->created_at->format('Y-m-d') }} <span
                                                class="sep">/</span> {{ gmdate('H:i:s', $item->duration) }}</small></span></div>

                                <div class="player">
                                    <audio id="player2" preload="none" controls style="max-width: 100%">
                                        <source src="{{ $item->audio }}"
                                            type="audio/mp3">
                                    </audio>
                                </div>

                            </div>
                        </div>
                    @endforeach

                </div>
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
</main>
{{-- @endsection --}}
        







        <footer class="site-footer">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4">
                        <h3>About Us</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Praesentium animi, odio beatae
                            aspernatur natus recusandae quasi magni eum voluptatem nam!</p>
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
                            Copyright &copy;
                            <script>
                                document.write(new Date().getFullYear());
                            </script> All rights reserved | This template is made with <i
                                class="icon-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com"
                                target="_blank">Colorlib</a>
                        </p>
                    </div>
                </div>
            </div>
        </footer>
    </div>

    @include('partials.scripts')

    <script src="{{ asset('assets/js/main.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const fullNameInput = document.getElementById('fullName');
            const editNameButton = document.getElementById('editName');

            editNameButton.addEventListener('click', function() {
                if (fullNameInput.readOnly) {
                    fullNameInput.readOnly = false;
                    fullNameInput.focus();
                    editNameButton.textContent = 'Save';
                } else {
                    fullNameInput.readOnly = true;
                    editNameButton.textContent = 'Edit the name';
                    alert(`Name updated to: ${fullNameInput.value}`);
                }
            });
        });
    </script>
</body>

</html>
