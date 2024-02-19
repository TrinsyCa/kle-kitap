<nav class="navbar fixed-top navbar-expand-lg bg-body-tertiary user-select-none" id="navbar">
  <div class="container-fluid container">
  <a class="navbar-brand navbarAnimX" href="{{ route("home") }}">
    <img src="{{ asset("img/logo/logo.png") }}" alt="Logo" height="30px" class="d-inline-block align-text-center pointer-events-none">
    {{ $settings["site_title"] }}
</a>
  <button class="navbar-toggler navbarAnimX-reverse" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse navbarAnimX-reverse" id="navbarText">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0 d-flex justify-content-end align-items-center">
          <li class="nav-item">
              <a class="nav-link" aria-current="page" href="{{ route("home") }}">Anasayfa</a>
          </li>
          <li class="nav-item">
              <a class="nav-link" href="{{ route("createProduct") }}">Ürün Ekle</a>
          </li>
              @if(Auth::check())
              <li class="nav-item">
                <a class="nav-link" href="{{ route("logout") }}">Çıkış Yap</a>
            </li>
              <li class="nav-item">
                  <a class="nav-link login" href="{{ route("showProfile", Auth::user()->username) }}">Profil</a>
              </li>
              @else
              <li class="nav-item">
                  <a class="nav-link" href="{{ route("signup") }}">Kayıt Ol</a>
              </li>
              <li class="nav-item">
                  <a class="nav-link login" href="{{ route("login") }}">Giriş Yap</a>
              </li>
              @endif
          </li>
      </ul>
  </div>
  </div>
</nav>
@yield("content")
<script src="{{ asset("js/main.js") }}"></script>