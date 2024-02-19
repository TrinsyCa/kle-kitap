<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset("packages/fontawesome-6.5.1-free/css/all.css") }}">
    <link rel="stylesheet" href="{{ asset("css/main.css") }}">
    <link rel="stylesheet" href="{{ asset("css/product.css") }}">

    @if($product)
        <title> {{ $product->title }} | {{ $settings["site_title"] }} </title>
        <meta name="title" content="{{ Str::limit($product->title, 40, '...') }} | {{ $settings["site_title"] }}">
        <meta name="description" content="{{ Str::limit($product->description, 160, '...') }}">
        <meta property="og:site_name" content="{{ $settings["site_title"] }}">
    @else
        <title> Ürün Bulunamadı | {{ $settings["site_title"] }} </title>
    @endif
</head>
<body>
    @extends("layouts.navbar")
    @section("content")
    @if($product && $user)
        <div class="product-container container">
            <div class="product-detail">
                <div class="product-left">
                    <div class="product-img user-select-none">
                        <div class="imgBorder">
                            <img id="imgZoom" src="{{ asset("img/products/$product->img") }}">
                        </div>
                        <img class="imgBlur" src="{{ asset("img/products/$product->img") }}">
                    </div>
                </div>
                <div class="product-right">
                    <h1 class="product-title">{{ $product->title }}</h1>
                    <a href="{{ asset("$user->username") }}" class="profile d-flex align-items-center gap-2 user-select-none text-decoration-none">
                        <img src="{{ asset("img/profile/default/user.png") }}">
                        <h3>{{ $user->name_surname }}</h2>
                    </a>
                    <div class="d-flex align-items-center justify-content-between user-select-none"><p><i class="fa-solid fa-calendar"></i> {{ $product->updated_at }}</p><p><i class="fa-solid fa-eye"></i> {{ number_format($product->view,0,',','.') }}</p></div>
                    <hr>
                    <div class="price d-flex justify-content-end">
                        <h2>{{ number_format($product->price,0,',','.') }}</h2><span>00{{ $settings["currency_type"] }}</span>
                    </div>
                </div>
            </div>
            <div class="product-bottom">
                <h2>Ürün Açıklaması</h2>
                <p>{!! nl2br($product->description) !!}</p>
            </div>
        </div>
    @else
    <p class="alert alert-danger">Ürün bulunamadı <br> <a href="javascript:history.back();">Geri Dön</a></p>
    @endif
    @endsection
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>
