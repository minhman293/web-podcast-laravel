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

    <main class="profile_page">
      <h2>Profile Podcaster</h2>
      <div class="profile_page__image flex">
          <img src="{{ asset('/assets/images/person_1.jpg') }}" alt="">
          <button>Change photo</button>
      </div>

      <div class="profile_page__name grid-3">
        <p>Full Name</p>
        <p>Le Ngoc Hao</p>
        <a class="profile_page__edit_name">Edit the name</a>
      </div>

      <div class="profile_page__email grid-3">
        <p>Email Address</p>
        <p>haodeptrai123@gmail.com</p>
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
    document.addEventListener('DOMContentLoaded', function () {
        const fullNameInput = document.getElementById('fullName');
        const editNameButton = document.getElementById('editName');
        
        editNameButton.addEventListener('click', function () {
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
