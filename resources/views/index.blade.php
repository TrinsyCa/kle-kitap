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
</head>
<body>
    @extends("layouts.navbar")
    @section("content")
    <div class="container">
        <div class="title-container" id="titleContainer">
            <div class="title-box">
                <h1>{{ $settings["site_title"] }}</h1>
                <p>Kendin için ihtiyaçlar, senin için kolaylık!</p>
            </div>
        </div>
        @if($products)
            <div class="mini-products-container">
                @foreach($products as $row)
                <div class="mini-product" style="z-index: {{ $row->id }};">
                    <a class="mini-product-col" href="{{ route("showProduct", $row->link) }}">
                        <div class="mini-product-container">
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
            </div>
            @if(Auth::check() == false)
                <div class="moreProductBtnBorder">
                    <a class="moreProductBtn" href="{{ route("login") }}">Daha Fazlası İçin Giriş Yapın</a>
                </div>
            @endif
        @else
        <div class="moreProductBtnBorder">
            <a class="moreProductBtn" href="{{ route("login") }}">Şu anda sayfamızda ürün bulunmamaktadır. <br> Hemen bir ürün eklemek giriş yapın</a>
        </div>
        @endif
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    @endsection
</body>
</html>
