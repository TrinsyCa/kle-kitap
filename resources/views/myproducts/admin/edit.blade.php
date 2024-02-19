@extends('myproducts.layout')
@section('content-detail')
<div class="create-container">
    <form action="{{ route('updateProduct',$product->id) }}" class="create-detail" method="post" enctype="multipart/form-data">
        @csrf
        @method("PUT")
        <div class="create-left">
            @if ($errors->any())
            <p class="alert alert-danger">Ürün eklenirken bir hata oluştu. Lütfen tekrar deneyin</p>
            @endif
            <div class="inputBox product-title">
                <input type="text" class="form-control" name="title" placeholder="Ürün Adı" value="{{$product->title}}">
            </div>
            <div class="inputBox product-description">
                <textarea name="description" class="form-control" cols="30" rows="10" placeholder="Ürün Açıklaması">{{$product->description }}</textarea>
            </div>
        </div>
        <div class="create-right">
            <label class="file-upload-container inputBox form-control @if($product->img == false) deactive @endif" id="file-container">
                <img id="preview" src="@if($product->img) {{ asset("img/products/$product->img") }} @endif">
                <p>Kapak Fotoğrafı</p>
                <i class="fa-solid fa-image"></i>
                <input type="file" name="img" id="img" class="file-upload d-none" onchange="previewImage()">
            </label>
            {{-- ? Ürün Kategorileri
            <div class="inputBorder inputFrontName-container">
                <p>Ürün Kategorisi</p>
                <div class="inputBox d-flex">
                    <label class="input-group-text" for="inputGroupSelect01">Kategori</label>
                    <select class="form-select" id="inputGroupSelect01">
                        <option selected disabled>Kategori Yok</option>
                    </select>
                </div>
            </div> --}}
            <div class="inputBorder inputLeft-container price">
                <p>Ürün Fiyatı</p>
                <div class="inputBox d-flex">
                    <input class="form-control" type="number" name="price" value="{{$product->price}}">
                    <p>{{ $settings["currency_type"] }}</p>
                </div>
            </div>
            <div class="inputBorder product-save-container">
                <div class="inputBox">
                    <p>Ürünü Güncelle</p>
                    <input class="form-control" type="submit" value="Güncelle">
                </div>
            </div>
        </div>
    </form>
</div>
@endsection