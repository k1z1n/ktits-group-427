<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Image;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function showMain()
    {
        return view('pages.main');
    }

    public function showProduct()
    {
        $products = Product::all();
        return view('pages.products', compact('products'));
    }

    public function showCreate()
    {
        return view('pages.create');
    }

    public function createProduct(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|min:2',
            'price' => 'required|numeric|min:2',
            'image*' => 'nullable|image|mimes:jpg,jpeg,png,svg|max:2048'
        ], [
            'title.required' => 'Поле названия пустое',
            'title.min' => 'Минимум 2 символа',
            'price.required' => 'Поле цены пустое',
            'price.numeric' => 'Поле цены должно быть числовым',
            'price.min' => 'Минимум 2 символа',
        ]);

        $product = Product::create($validated);

        if ($request->hasFile('image')) {

            foreach ($request->file('image') as $image) {
                $url = $image->store('images', 'public');
                Image::create([
                    'url' => $url,
                    'product_id' => $product->id
                ]);
            }
        }


        return redirect()->route('product');
    }

    public function showEdit($id)
    {
        $product = Product::findOrFail($id);
        return view('pages.update', compact('product'));
    }

    public function updateProduct(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|min:2',
            'price' => 'required|numeric|min:2',
            'image*' => 'nullable|image|mimes:jpg,jpeg,png,svg|max:2048'
        ], [
            'title.required' => 'Поле названия пустое',
            'title.min' => 'Минимум 2 символа',
            'price.required' => 'Поле цены пустое',
            'price.numeric' => 'Поле цены должно быть числовым',
            'price.min' => 'Минимум 2 символа',
        ]);

        // if($request->hasFile('image')){
        //     if($product->image && Storage::disk('public')->exists($product->image)){
        //         Storage::disk('public')->delete($product->image);
        //     }

        //     $validated['image'] = $request->file('image')->store('images', 'public');
        // }

        if ($request->hasFile('image')) {
            if ($product->images) {
                foreach ($product->images as $img) {
                    Storage::disk('public')->delete($img->url);
                    $img->delete();
                }
            }
            foreach ($request->file('image') as $image) {
                $url = $image->store('images', 'public');
                Image::create([
                    'url' => $url,
                    'product_id' => $product->id
                ]);
            }
        }

        $product->update($validated);

        return redirect()->route('product');
    }


    public function showDeleteProduct($id)
    {
        $product = Product::findOrFail($id);

        return view('pages.delete', compact('product'));
    }

    public function deleteProduct($id)
    {
        $product = Product::findOrFail($id);

        if ($product->images) {

            foreach ($product->images as $image) {
                Storage::disk('public')->delete($image->url);
                $image->delete();
            }

        }

        $product->delete();

        return redirect()->route('main');
    }

    public function addToCart($productId)
    {

        $cartItem = Cart::where('product_id', $productId)
            ->where('user_id', auth()->id())->first();

        if ($cartItem) {
            $cartItem->count++;
            $cartItem->save();
        } else {
            $cart = Cart::create([
                'product_id' => $productId,
                'user_id' => auth()->id(),
            ]);
        }

        return redirect()->route('view.cart');

    }
}
