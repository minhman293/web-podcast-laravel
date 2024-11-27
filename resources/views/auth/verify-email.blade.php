<!DOCTYPE html>
<html lang="en">

<head>
    <title>Verify Email &mdash; Podcast</title>
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
                                <li><a href="index.html">Home</a></li>
                                <li><a href="about.html">About</a></li>
                                <li><a href="contact.html">Contact</a></li>
                                @auth
                                <li class="has-children">
                                    <a href="#">Hello, {{ Auth::user()->name }}</a>
                                    <ul class="dropdown arrow-top">
                                        <li>
                                            <form method="POST" action="{{ route('logout') }}" class="logout-form">
                                                @csrf
                                                <button type="submit" class="logout-button">Logout</button>
                                            </form>
                                        </li>
                                    </ul>
                                </li>
                                @else
                                <li><a href="{{ route('get_login') }}">Login</a></li>
                                @endauth
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </header>

        <div class="site-section">
            <div class="container" data-aos="fade-up">
                <div class="row justify-content-center">
                    <div class="col-md-5 mb-5">
                        <h3 class="mb-5">Verify Your Email Address</h3>

                        @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            A fresh verification link has been sent to your email address.
                        </div>
                        @endif

                        Before proceeding, please check your email for a verification link.
                        If you did not receive the email,
                        <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                            @csrf
                            <button type="submit" class="btn btn-link p-0 m-0 align-baseline">click here to request another</button>.
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>

    @include('partials.scripts')

    <script src="{{ asset('assets/js/main.js') }}"></script>

</body>

</html>