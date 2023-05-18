<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Product;
use App\Models\Category;
use App\Models\Size;
use App\Models\ProductImage;
use App\Models\ProductVariant;
use Image;

class ProductController extends Controller
{

    public function index()
    {
        return view('product/product_list', [
            'title'    => 'Produk',
            'products' => Product::orderBy("name", 'desc')->get()
        ]);
    }

    public function create()
    {
        return view('product/product_create', [
            'title'      => 'Tambah Produk',
            'categories' => Category::all()
        ]);
    }

    public function store(Request $request)
    {
        $validate = $request->validate([
            'image'          => 'image|file|max:2048',
            'name'           => 'required|max:50',
            'category_id'    => 'required',
            'weight'         => 'required',
            'stock'          => 'required',
            'capital_price'  => 'required',
            'selling_price'  => 'required',
            'description'    => 'required'
        ]);

        if($request->file('image')) {
            $validate['image'] = $request->file('image')->store('product-images');
        }

        Product::create($validate);

        return redirect('/product')->with('success', 'Data berhasil disimpan.'); 
    }

    public function show(Product $product)
    {
        //
    }

    public function edit(Product $product)
    {
        $arrVar = [];
        $variants = ProductVariant::where('product_id', $product->id)->get();
        if($variants) {
            foreach($variants as $var) {
                $arrVar[] = $var->size_id;
            }
            $sizes = Size::whereNotIn('id', $arrVar)->get();
        } else {
            $sizes = Size::all();
        }

        return view('product/product_edit', [
            'title'      => 'Edit Produk',
            'product'    => $product,
            'categories' => Category::all(),
            'sizes'      => $sizes,
            'images'     => ProductImage::where('product_id', $product->id)->get(),
            'variants'   => ProductVariant::where('product_id', $product->id)->get()
        ]);
    }

    public function update(Request $request, Product $product)
    {
        $rules = [
            'image'         => 'image|file|max:2048',
            'name'          => 'required|max:30',
            'category_id'   => 'required',
            'weight'        => 'required',
            'stock'         => 'required',
            'capital_price' => 'required',
            'selling_price' => 'required',
            'description'   => 'required'
        ];

        $validate = $request->validate($rules);

        if($request->file('image')) {
            if($request->old_image) {
                Storage::delete($request->old_image);
            }
            $validate['image'] = $request->file('image')->store('product-images');
        }

        Product::where('id', $product->id)->update($validate);

        return redirect('/product')->with('success', 'Data berhasil diupdate.');
    }

    public function destroy(Product $product)
    {
        if($product->image) {
            Storage::delete($product->image);
        }

        Product::destroy($product->id);

        return redirect('/product')->with('success', 'Data berhasil dihapus.');
    }

    public function uploadImage(Request $request)
    {
        $validatedData = $request->validate([
            'product_id' => 'required',
            'image'      => 'required|image|mimes:jpg,png,jpeg|max:2048',
        ]);

        $validatedData['image_gallery'] = $request->file('image')->store('product-images');

        ProductImage::create($validatedData);

        return redirect('/product/'.$request->product_id.'/edit')->with('image', 'Gambar berhasil diupload.');
    }

    public function deleteImage($id)
    {
        $productImage = ProductImage::find($id);

        Storage::delete($productImage->image_gallery);

        ProductImage::destroy($id);

        return redirect('/product/'.$productImage->product_id.'/edit')->with('image', 'Gambar berhasil dihapus.');
    }

    public function storeVariant(Request $request)
    {
        $data = [
            'product_id'    => $request->product_id,
            'size_id'       => $request->size_id,
            'stock'         => $request->stock_variant,
            'capital_price' => $request->capital_price_variant,
            'selling_price' => $request->selling_price_variant
        ];

        $product = Product::find($request->product_id);
        
        ProductVariant::create($data);

        return redirect('/product/'.$request->product_id.'/edit')->with('variant', 'Data varian berhasil disimpan.');
    }

    public function showVariant($id)
    {
        $variant = ProductVariant::find($id);

        return json_encode($variant);
    }

    public function updateVariant(Request $request) 
    {
        $data['stock']          = $request->stock_variant;
        $data['purchase_price'] = $request->purchase_price_variant;
        $data['selling_price']  = $request->selling_price_variant;
        $data['updated_at']     = date('Y-m-d H:i:s');
        ProductVariant::where('id', $request->id)->update($data);

        $product = Product::find($request->product_id);

        return redirect('/product/'.$product->slug.'/edit')->with('variant', 'Data varian berhasil diupdate.');
    }

    public function deleteVariant($id)
    {
        $variant = ProductVariant::find($id);

        ProductVariant::destroy($id);

        return redirect('/product/'.$variant->product_id.'/edit')->with('variant', 'Data varian berhasil dihapus.');
    }

}