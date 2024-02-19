<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @yield("site_title")

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset("packages/fontawesome-6.5.1-free/css/all.css") }}">
    <link rel="stylesheet" href="{{ asset("css/main.css") }}">
    <link rel="stylesheet" href="{{ asset("css/sign.css") }}">
</head>
<body>
    @extends("layouts.navbar")
    @section("content")
    <div class="container">
        <div class="sign-container">
            <div class="sign-left">
                <div class="sign-img">
                    <img src="{{ asset("img/tools/e-commerce.png ")}}">
                </div>
            </div>
            <div class="sign-right">
                <div class="sign-box">
                    @yield("sign-content")
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset("js/profile/main.js") }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    @endsection
</body>
</html>