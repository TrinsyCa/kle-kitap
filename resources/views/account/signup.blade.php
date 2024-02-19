@extends("account.layout")
@section("site_title")
<title>Kayıt Ol | {{ $settings["site_title"] }}</title>
@endsection

@section("sign-content")
    <header>
        <a href="{{ route("login") }}">Giriş Yap</a>
        <a class="active" href="{{ route("signup") }}">Kayıt Ol</a>
    </header>
    <div class="sign-detail">
        <form action="{{ route("signupFunc") }}" method="POST">
            @csrf
            <h1>Kayıt Ol</h1>
            <div class="inputFrontName-container">
                <div class="inputBox d-flex">
                    <label for="name_surname" class="input-group-text">İsim Soyisim</label>
                    <input type="text" name="name_surname" id="name_surname" class="form-control first-text" maxlength="30">
                </div>
            </div>
            <div class="inputFrontName-container">
                <div class="inputBox d-flex">
                    <label for="email" class="input-group-text">E-Mail</label>
                    <input type="email" name="email" id="email" class="form-control" maxlength="255">
                </div>
            </div>
            <div class="inputFrontName-container">
                <div class="inputBox d-flex">
                    <label for="password" class="input-group-text">Şifre</label>
                    <input type="password" name="password" id="password" class="form-control" maxlength="50">
                </div>
            </div>
            <div class="inputFrontName-container">
                <div class="inputBox d-flex">
                    <label for="password_verify" class="input-group-text">Şifreyi Doğrula</label>
                    <input type="password" name="password_verify" id="password_verify" class="form-control" maxlength="50">
                </div>
            </div>
            <span id="password_check"></span>
            <div class="inputBox submitBox">
                <input type="submit" value="Kayıt Ol" class="form-control">
            </div>
        </form>
    </div>
    <script src="{{ asset("js/account/password-check.js") }}"></script>
@endsection