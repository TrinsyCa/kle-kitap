@extends('myproducts.layout')
@section('content-detail')
<div class="create-container">
    <form action="{{ route('createProduct') }}" class="create-detail" method="post" enctype="multipart/form-data">
        @csrf
        <div class="create-left">
            @if ($errors->any())
            <p class="alert alert-danger">Ürün eklenirken bir hata oluştu. Lütfen tekrar deneyin</p>
            @endif
            <div class="inputBox product-title productAnim">
                <input type="text" class="form-control" name="title" placeholder="Ürün Adı">
            </div>
            <div class="inputBox product-description productAnim">
                <textarea name="description" class="form-control" cols="30" rows="10" placeholder="Ürün Açıklaması"></textarea>
            </div>
        </div>
        <div class="create-right">
            <label class="file-upload-container inputBox form-control deactive productAnim" id="file-container">
                <img id="preview" src="">
                <p>Kapak Fotoğrafı</p>
                <i class="fa-solid fa-image"></i>
                <input type="file" name="img" id="img" class="file-upload d-none" onchange="previewImage()" accept="image/png, image/jpeg, image/webp">
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
            <div class="inputBorder inputLeft-container price productAnim">
                <p>Ürün Fiyatı</p>
                <div class="inputBox d-flex">
                    <input class="form-control" type="number" name="price">
                    <p>{{ $settings["currency_type"] }}</p>
                </div>
            </div>
            <div class="inputBorder product-save-container productAnim">
                <div class="inputBox">
                    <p>Ürünü Paylaş</p>
                    <input class="form-control" type="submit" value="Paylaş">
                </div>
            </div>
        </div>
    </form>
</div>
@endsection