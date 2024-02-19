<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $settings["site_title"] }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset("packages/fontawesome-6.5.1-free/css/all.css") }}">
    <link rel="stylesheet" href="{{ asset("css/main.css") }}">
    <link rel="stylesheet" href="{{ asset("css/mini-product.css") }}">
    <link rel="stylesheet" href="{{ asset("css/profile.css") }}">
</head>
<body>
    @extends('layouts.navbar')
    @section("content")
    <div class="container">
        @if($user)
            <div class="profile-container">
                <div class="title-container" id="titleContainer">
                    <div class="title-box">
                        <div class="profile-title-img">
                            <img src="{{ asset("img/profile/default/user.png") }}">
                        </div>
                        <h1>{{ $user->name_surname }}</h1>
                        <p>{{ "@".$user->username }}</p>
                    </div>
                </div>
                @if($products)
                    <div class="mini-products-container">
                        @foreach($products as $row)
                        <div class="mini-product">
                            <a class="mini-product-col" href="{{ route("showProduct", $row->link) }}">
                                <div class="mini-product-container">
                                    <div class="mini-product-top">
                                        @if(Auth::id() == $row->userID)
                                       <form action="{{ route("destroyProduct", $row->id) }}" method="POST">
                                        @csrf
                                        @method("DELETE")
                                            <label for="destroyProduct" class="mini-product-top-btn destroy">
                                                <div class="mini-product-top-btn-inner">
                                                    <i class="fa-solid fa-trash"></i><p>Ürünü Sil</p>
                                                </div>
                                            </label>
                                            <input type="submit" id="destroyProduct" class="mini-product-top-btn d-none" value="">
                                       </form>
                                        <a href="{{ route("editProduct", $row->id) }}" class="mini-product-top-btn edit">
                                            <div class="mini-product-top-btn-inner">
                                                <i class="fa-solid fa-pen"></i><p>Düzenle</p>
                                            </div>
                                        </a>
                                        {{-- <button class="mini-product-top-btn copy" onclick="productCopyUrl(event,'{{ $row->link }}');">
                                            <div class="mini-product-top-btn-inner">
                                                <i class="fa-solid fa-clone"></i><p>Kopyala</p>
                                            </div>
                                        </button> --}}
                                        <a href="{{ route("showProduct", $row->link) }}" class="mini-product-top-btn gopage">
                                            <div class="mini-product-top-btn-inner">
                                                <i class="fa-solid fa-arrow-right"></i><p>Ürüne Git</p>
                                            </div>
                                        </a>
                                        @endif
                                    </div>
                                    <div class="mini-product-img">
                                        <img src="{{ asset("img/products/".$row->img) }}">
                                    </div>
                                    <div class="mini-product-text">
                                        <div class="mini-product-title">
                                            <h1>{{ Str::limit($row->title, 45 , '...') }}</h1>
                                        </div>
                                        <div class="mini-product-detail">
                                            <div class="price d-flex justify-content-end">
                                                <h3>{{ number_format($row->price,0,',','.') }}</h3><span>00{{ $settings["currency_type"] }}</span>
                                            </div>
                                            <div class="mini-product-detail-bottom">
                                                <div class="box">
                                                    <i class="fa-solid fa-calendar"></i> &nbsp;{{ $row->updated_at }}</p>
                                                </div>
                                                <div class="box">
                                                    <p><i class="fa-solid fa-eye"></i> {{ number_format($row->view,0,',','.') }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        @endforeach
                        @if(Auth::check() == false)
                            <div class="moreProductBtnBorder">
                                <a class="moreProductBtn" href="{{ route("login") }}">Daha Fazlası İçin Giriş Yapın</a>
                            </div>
                        @endif
                    </div>
                @else
                <div class="moreProductBtnBorder">
                    <a class="moreProductBtn" href="{{ route("login") }}">Şu anda sayfamızda ürün bulunmamaktadır. <br> Hemen bir ürün eklemek giriş yapın</a>
                </div>
                @endif
            </div>
            <div class="profile-sidemenu">
                <div class="profile-container-sidemenu">
                    <div class="profile-content">
                        <div class="profile-img">
                            <img src="{{ asset("img/profile/default/user.png") }}">
                        </div>
                        <div class="profile-details mt-5">
                            <div class="profile-about">
                                <div class="box">
                                    <p>{{ $settings["site_title"] }}</p>
                                </div>
                            </div>
                            <div class="profile-footer d-flex align-items-center px-4 @if($user->is_me == true) justify-content-between @else justify-content-center @endif">
                                @if($user->is_me == true)
                                <button onclick="alert('Profil bilgilerini düzenleme işlemleri henüz aktif değil. Yakında eklenecek..');" class="profile-change-btn"><i class="fa-solid fa-pen"></i> Profili Düzenle</button>
                                @endif
                                <div class="box">
                                    <i class="fa-solid fa-calendar"></i> &nbsp;{{ $user->created_at }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @else
        <a href="{{ route("home") }}">Kullanıcı Bulunamadı Lütfen Anasayfaya Dön</a>
        @endif
    </div>
    <script src="{{ asset("js/profile/main.js") }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    @endsection
</body>
</html>