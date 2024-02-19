<?php

namespace App\Http\Controllers;

use App\Models\Products;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Testing\File;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File as FacadesFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductsController extends Controller
{
    function create_page()
    {
        $settings = Config::get("settings");
        if(Auth::check())
        {
            return view("myproducts.admin.create", compact("settings"));
        }
        else
        {
            return redirect()->to("login");
        }
    }
    function show(string $link)
    {
        if(Auth::check())
        {
            $settings = Config::get("settings");
            $product = Products::where("link", $link)->first();
            $user = User::select("name_surname","username","id")->where("id",$product->userID)->first();
            if($product)
            {
                $cookieName = 'viewed_product_' . $product->id;
                if (!isset($_COOKIE[$cookieName])) {
                    setcookie($cookieName, '1', time() + (60 * 24), "/");
                    $product->increment('view');
                }
            }
            return view("products.product", compact("settings", "product", "user"));
        }
        else
        {
            return redirect()->to("login");
        }
    }
    function create(Request $request)
    {
        try {
            $request->validate([
                'title' => 'required|min:3|max:255',
                'price' => 'required|numeric|min:1',
                'img' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp|max:10240',
            ]);
        }
        catch (\Illuminate\Validation\ValidationException $e) {
            // Handle validation exception
            return response()->json(['errors' => $e->errors()], 422);
        }
        
        $img = $request->img;
        $title = $request->title;
        $description = $request->description;
        $price = $request->price;
        $userID = Auth::id();

        $link = Str::slug($title, '-');

        $linkCheck = Products::where('link', $link)->exists();
        $linkCounter = Products::where('link',$link)->count();
        
        if($linkCheck) {
            $count = 1;
            while($linkCounter > 0) {
                $linkCounter--;
                $count++;
            }
            $link = $link . '-' . $count;
        }

        $mainFileName = "";
        if(!empty($img))
        {
            $characters = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";
            $random = '';
            for ($i = 0; $i < 100; $i++) {
                $random .= $characters[random_int(0, strlen($characters) - 1)];
            }


            $imgPath = $img->getPathName();
            $imgName = $img->getClientOriginalName();

            $imgExtension = $img->getClientOriginalExtension();

            $imgSize = getimagesize($imgPath);
            $width = $imgSize[0];
            $height = $imgSize[1];

            $imgSizeBytes = $img->getSize();
            $imgSizeMB = number_format(($imgSizeBytes / 1024 / 1024), 2);

            $fileMetaData = [
                'link' => $link,
                'id' => $random,
                'width' => $width . 'px',
                'height' => $height . 'px',
                'size' => $imgSizeMB . 'mb',
                'extension' => '.' . $imgExtension
            ];

            $mainFileName = json_encode($fileMetaData);

            $img = $img->move(public_path('img/products'),$mainFileName);
        }
        if(!empty($title) || !empty($description) || !empty($price) || !empty($img))
        {
            if(Auth::check())
            {
                Products::create([
                    "img" => $mainFileName,
                    "title" => $title,
                    "description" => $description,
                    "price" => $price,
                    "link" => $link,
                    "userID" => $userID
                ]);
    
                return redirect()->route('showProduct', ['link' => $link]);
            }
            else
            {
                return redirect()->to("login");
            }
        }
        return redirect()->back();
    }
    function update_page(string $id)
    {
        $settings = Config::get("settings");
        $product = Products::where("id",$id)->first();
        return view("myproducts.admin.edit", compact("settings","product"));
    }
    function update(string $id,Request $request)
    {
        $product = Products::where("id",$id)->first();

        /* $request->validate([
            'title' => 'required|min:3|max:255',
            'price' => 'required|numeric|min:1',
            'img' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp|max:10240',
        ]); */
        
        $img = $request->img;
        $title = $request->title;
        $description = $request->description;
        $price = $request->price;

        $link = Str::slug($title, '-');

        $linkCounter = Products::where('link',$link)->count();
        
        if($linkCounter) {
            $count = 0;
            while($linkCounter > 0) {
                $linkCheck = Products::where('link', $link)->where('id',$id)->count();
                if($linkCheck <= 0)
                {
                    $linkCounter--;
                    $count++;
                }
                else
                {
                    break;
                }
            }
            if($count > 0)
            {
                $link = $link . '-' . $count;
            }
        }

        $mainFileName = $product->img;
        
        if(!empty($img) && $product->img != $img)
        {
            $old_image_path = "img/public/".$product->img; 
            if(FacadesFile::exists($old_image_path)) {
                File::delete($old_image_path);
            }

            $characters = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";
            $random = '';
            for ($i = 0; $i < 100; $i++) {
                $random .= $characters[random_int(0, strlen($characters) - 1)];
            }


            $imgPath = $img->getPathName();
            $imgName = $img->getClientOriginalName();

            $imgExtension = $img->getClientOriginalExtension();

            $imgSize = getimagesize($imgPath);
            $width = $imgSize[0];
            $height = $imgSize[1];

            $imgSizeBytes = $img->getSize();
            $imgSizeMB = number_format(($imgSizeBytes / 1024 / 1024), 2);

            $fileMetaData = [
                'link' => $link,
                'id' => $random,
                'width' => $width . 'px',
                'height' => $height . 'px',
                'size' => $imgSizeMB . 'mb',
                'extension' => '.' . $imgExtension
            ];

            $mainFileName = json_encode($fileMetaData);

            $img = $img->move(public_path('img/products'),$mainFileName);
        }
        
        if(!empty($title) || !empty($description) || !empty($price) || !empty($img))
        {
            if((Auth::id() == $product->userID) && Auth::check())
            {
                $product->update([
                    "img" => $mainFileName,
                    "title" => $title,
                    "description" => $description,
                    "price" => $price,
                    "link" => $link
                ]);

                return redirect()->route('showProduct', ['link' => $link]);
            }
            return redirect()->to("login");
        }
        else
        {
            return redirect()->back();
        }
    }
    function destroy(string $id)
    {
        $product = Products::where("id",$id)->first();
        $user = User::where("id",$product->userID)->first();
        
        if(Auth::id() == $product->userID && Auth::check())
        {
            $product = Products::where('userID',Auth::id())->where('id',$id)->first();
            $product->delete();
        }
        else
        {
            return redirect()->to("login");
        }

        return redirect()->back();
    }
}
