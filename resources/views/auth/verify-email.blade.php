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

        @include('partials.header')

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