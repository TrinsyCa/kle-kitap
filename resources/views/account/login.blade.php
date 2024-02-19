@extends("account.layout")
@section("site_title")
<title>Giriş Yap | {{ $settings["site_title"] }}</title>
@endsection

@section("sign-content")
    <header>
        <a class="active" href="{{ route("login") }}">Giriş Yap</a>
        <a href="{{ route("signup") }}">Kayıt Ol</a>
    </header>
    <div class="sign-detail">
        <form action="{{ route("loginFunc") }}" method="POST">
            @csrf
            <h1>Kullanıcı Girişi</h1>
            <div class="inputFrontName-container">
                <div class="inputBox d-flex">
                    <label for="email" class="input-group-text">E-Mail</label>
                    <input type="email" name="email" id="email" class="form-control first-text">
                </div>
            </div>
            <div class="inputFrontName-container">
                <div class="inputBox d-flex">
                    <label for="password" class="input-group-text">Şifre</label>
                    <input type="password" name="password" id="password" class="form-control">
                </div>
            </div>
            <div id="password_check"><p class="alert alert-danger"><i class="fa-solid fa-circle-xmark"></i> &nbsp;&nbsp;E-Posta Adresi Veya Parolanız Yanlış</p></div>
            <div class="inputBox submitBox">
                <input type="submit" value="Giriş Yap" class="form-control">
            </div>
        </form>
    </div>
@endsection