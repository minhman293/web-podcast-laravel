<meta name="user-id" content="{{ auth()->check() ? auth()->id() : '' }}">
<meta name="user-name" content="{{ auth()->check() ? auth()->user()->id : '' }}">
<meta name="csrf-token" content="{{ csrf_token() }}">
<meta name="ws-client" content="{{ $WS_CLIENT }}">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,700,900"> 
<link rel="stylesheet" href="{{asset('assets/fonts/icomoon/style.css')}}">

<link rel="stylesheet" href="{{asset('assets/css/bootstrap.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/css/magnific-popup.css')}}">
<link rel="stylesheet" href="{{asset('assets/css/jquery-ui.css')}}">
<link rel="stylesheet" href="{{asset('assets/css/owl.carousel.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/css/owl.theme.default.min.css')}}">

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/mediaelement@4.2.7/build/mediaelementplayer.min.css">


<link rel="stylesheet" href="{{asset('assets/css/aos.css')}}">

<link rel="stylesheet" href="{{asset('assets/css/style.css')}}">

<style>
    .podcaster-link {
        color: inherit; /* Giữ nguyên màu chữ hiện tại */
        text-decoration: none; /* Loại bỏ gạch chân */
    }

    .podcaster-link:hover {
        color: red; /* Màu chữ khi hover */
    }
    .notification_label {
        position: relative;
    }
    .notification_counts {
        position: absolute;
        top: 0.2em;
        right: -0.7em;
        background-color: #eb1c0f;
        color: white;
        padding: 5px;
        border-radius: 50%;
        font-size: 12px;
        font-weight: bold;
        height: 2em;
        width: 2em;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .notification_counts.hide {
        display: none;
    }
</style>

<link rel="stylesheet" href="{{asset('assets/css/custom.css')}}">

