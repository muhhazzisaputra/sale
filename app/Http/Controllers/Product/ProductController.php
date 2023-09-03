<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Product;
use App\Models\Category;
use App\Models\Size;
use App\Models\ProductImage;
use App\Models\ProductVariant;
use App\Models\ProductGroup;
use App\Models\Unit;
use App\Models\Color;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Image;

class ProductController extends Controller
{

    public function index()
    {
        $products = DB::table('products as A')
            ->select('A.product_code', 'A.image', 'A.name', 'A.weight', 'A.stock', 'A.capital_price', 'A.selling_price', 'A.product_sku', 'A.min_stock', 'A.status_variant', 'B.name as group_name', 'C.name as category_name', 'D.name as unit_name')
            ->leftJoin('product_groups as B', 'B.group_code', '=', 'A.group_code')
            ->leftJoin('categories as C', 'C.category_code', '=', 'A.category_code')
            ->leftJoin('units as D', 'D.unit_id', '=', 'A.unit_id')
            ->orderBy('A.name')
            ->get();

        return view('product/data/product_list', [
            'title'    => 'Produk',
            'products' => $products
        ]);
    }

    public function create()
    {
        return view('product/data/product_create', [
            'title'      => 'Tambah Produk',
            'categories' => Category::orderBy("name", 'asc')->get(),
            'groups'     => ProductGroup::orderBy("name", 'asc')->get(),
            'units'      => Unit::orderBy("name", 'asc')->get()
        ]);
    }

    public function set_sku_default(Request $request) {
        $category_code = $request->category_code;
        $group_code    = $request->group_code;

        $product = Product::where(['category_code' => $category_code, 'group_code' => $group_code])->max('counter');
        $kode    = ($product == null) ? 1 : $product+1;
        $kodemax = str_pad($kode, 3, "0", STR_PAD_LEFT);

        $set_product_sku = $group_code.$category_code.$kodemax.random_int(10000, 99999);

        echo $set_product_sku;
    }

    public function store(Request $request) {
        $file = $request->file('prim_image');
        // echo 'File Name : '.$file->getClientOriginalName();
        // echo '<br>';
        // echo 'File Extension : '.$file->getClientOriginalExtension();
        // echo '<br>';
        // echo 'File Real Path : '.$file->getRealPath();
        // echo '<br>';
        // echo 'File Size : '.$file->getSize();
        // echo '<br>';
        // echo 'File Mime Type : '.$file->getMimeType();
        // die;
        $category_code  = $request->category_code;
        $group_code     = $request->group_code;
        $status_variant = $request->variant;
        $varian_color   = empty($request->warna) ? 0 : 1;
        $varian_size    = empty($request->ukuran) ? 0 : 1;

        DB::beginTransaction();
            $validator = Validator::make($request->all(), [
                'prim_image' => 'image|file|max:1024'
            ]);

            $result = [];
            if($validator->fails()) {
                $result['status'] = 'error';
            } else {
                $today = date("Y-m-d H:i:s");

                $product = Product::where(['category_code' => $category_code, 'group_code' => $group_code])->max('counter');
                $kode    = ($product == null) ? 1 : $product+1;
                $kodemax = str_pad($kode, 4, "0", STR_PAD_LEFT);

                $today = date('Ymd');
                $date  = substr($today, 6);
                $month = substr($today, 4, 2);
                
                $set_product_code   = $date.$month.$kodemax.random_int(10000, 99999);

                $data['product_code'] = $set_product_code;

                // upload image
                $request->file('prim_image')->storeAs('product-images', $set_product_code.'.'.$file->getClientOriginalExtension());

                $data['image']          = $set_product_code.'.'.$file->getClientOriginalExtension();
                $data['name']           = $request->name;
                $data['category_code']  = $request->category_code;
                $data['group_code']     = $request->group_code;
                $data['weight']         = str_replace(',', '', $request->weight);
                $data['stock']          = str_replace(',', '', $request->stock);
                $data['capital_price']  = str_replace(',', '', $request->capital_price);
                $data['selling_price']  = str_replace(',', '', $request->selling_price);
                $data['description']    = $request->description;
                $data['product_sku']    = $request->product_sku;
                $data['unit_id']        = $request->unit_id;
                $data['min_stock']      = str_replace('.', '', $request->min_stock);
                $data['status_variant'] = ($status_variant == 'ya') ? 1 : 0;
                $data['variant_color']  = $varian_color;
                $data['variant_size']   = $varian_size;
                $data['input_user']     = auth()->user()->id;
                $data['input_date']     = $today;
                $data['update_user']    = auth()->user()->id;
                $data['updated_at']     = $today;
                $data['counter']        = $kode;

                Product::insert($data);

                $result['status'] = 'success';
            }
        DB::commit();

        return response()->json($result);
    }

    public function show(Product $product)
    {
        //
    }

    public function edit($id) {
        $product = Product::where('product_code', $id)->first();

        return view('product/data/product_edit', [
            'title'      => 'Edit Produk',
            'product'    => $product,
            'categories' => Category::orderBy("name", 'asc')->get(),
            'groups'     => ProductGroup::orderBy("name", 'asc')->get(),
            'units'      => Unit::orderBy("name", 'asc')->get()
        ]);
    }

    public function update(Request $request) {
        $file = $request->file('prim_image');
        // echo 'File Name : '.$file->getClientOriginalName();
        // echo '<br>';
        // echo 'File Extension : '.$file->getClientOriginalExtension();
        // echo '<br>';
        // echo 'File Real Path : '.$file->getRealPath();
        // echo '<br>';
        // echo 'File Size : '.$file->getSize();
        // echo '<br>';
        // echo 'File Mime Type : '.$file->getMimeType();
        // die;
        $product_code = $request->product_code;
        $varian_color = empty($request->warna) ? 0 : 1;
        $varian_size  = empty($request->ukuran) ? 0 : 1;

        DB::beginTransaction();
            $validator = Validator::make($request->all(), [
                'prim_image' => 'image|file|max:1024'
            ]);

            $result = [];
            if($validator->fails()) {
                $result['status'] = 'error';
            } else {
                 $today = date("Y-m-d H:i:s");
                // upload image
                // $request->file('prim_image')->storeAs('product-images', $set_product_code.'.'.$file->getClientOriginalExtension());

                // $data['image']          = $set_product_code.'.'.$file->getClientOriginalExtension();
                $data['name']           = $request->name;
                $data['category_code']  = $request->category_code;
                $data['group_code']     = $request->group_code;
                $data['weight']         = str_replace('.', '', $request->weight);
                $data['stock']          = str_replace('.', '', $request->stock);
                $data['capital_price']  = str_replace('.', '', $request->capital_price);
                $data['selling_price']  = str_replace('.', '', $request->selling_price);
                $data['description']    = $request->description;
                $data['product_sku']    = $request->product_sku;
                $data['unit_id']        = $request->unit_id;
                $data['min_stock']      = str_replace('.', '', $request->min_stock);
                $data['status_variant'] = ($request->variant == 'ya') ? 1 : 0;
                $data['input_user']     = auth()->user()->id;
                $data['input_date']     = $today;
                $data['update_user']    = auth()->user()->id;
                $data['updated_at']     = $today;
                $data['variant_color']  = $varian_color;
                $data['variant_size']   = $varian_size;

                Product::where('product_code', $product_code)->update($data);

                $result['status'] = 'success';
            }
        DB::commit();

        return response()->json($result);
    }

    public function get_gallery(Request $request) {
        $_token       = $request->_token;
        $product_code = $request->product_code;

        $product_images = DB::table('product_images')
            ->select('product_image_id', 'product_code', 'product_image')
            ->where('product_code', $product_code)
            ->orderBy('input_date')
            ->get();

        return view('product/data/product_gallery', [
            'product_code'   => $product_code,
            'product_images' => $product_images
        ]);
    }

    public function get_variant(Request $request) {
        $product_code = $request->product_code;

        $check_variant = $this->check_variant($product_code);

        $variants = '';

        if($check_variant['type_variant'] == 1) {
            // warna

            $variants = DB::table('products as A')
            ->select('A.product_code', 'A.name', 'B.variant_id', 'B.variant_stock', 'B.variant_capital_price', 'B.variant_selling_price', 'C.name as color_name')
            ->leftJoin('product_variants as B', 'B.product_code', '=', 'A.product_code')
            ->leftJoin('colors as C', 'C.color_code', '=', 'B.color_code')
            ->where('B.product_code', $product_code)
            ->orderBy('B.input_date')
            ->get();
        } else if($check_variant['type_variant'] == 2) {
            // ukuran
            $variants = DB::table('products as A')
            ->select('A.product_code', 'A.name', 'B.variant_id', 'B.variant_stock', 'B.variant_capital_price', 'B.variant_selling_price', 'C.name as size_name')
            ->leftJoin('product_variants as B', 'B.product_code', '=', 'A.product_code')
            ->leftJoin('sizes as C', 'C.size_code', '=', 'B.size_code')
            ->where('B.product_code', $product_code)
            ->orderBy('B.input_date')
            ->get();
        } else if($check_variant['type_variant'] == 3) {
            // warna dan ukuran
            $variants = DB::table('products as A')
            ->select('A.product_code', 'A.name', 'B.variant_id', 'B.variant_stock', 'B.variant_capital_price', 'B.variant_selling_price', 'C.name as size_name', 'D.name as color_name')
            ->leftJoin('product_variants as B', 'B.product_code', '=', 'A.product_code')
            ->leftJoin('sizes as C', 'C.size_code', '=', 'B.size_code')
            ->leftJoin('colors as D', 'D.color_code', '=', 'B.color_code')
            ->where('B.product_code', $product_code)
            ->orderBy('B.input_date')
            ->get();
        }

        return view('product/data/product_variant', [
            'product_code'   => $product_code,
            'variants'       => $variants,
            'status_variant' => $check_variant['status_variant'],
            'text_variant'   => $check_variant['text_variant'],
            'type_variant'   => $check_variant['type_variant'],
        ]);
    }

    public function variant_add(Request $request) {
        $product_code = $request->product_code;

        $check_variant = $this->check_variant($product_code);

        $variants = [
            'product_code'   => $product_code,
            'status_variant' => $check_variant['status_variant'],
            'text_variant'   => $check_variant['text_variant'],
            'type_variant'   => $check_variant['type_variant']
        ];

        if($check_variant['type_variant'] == 1) {
            // warna
            $colors = Color::orderBy("name", "asc")->get();

            $variants['colors'] = $colors;

            return view('product/data/product_variant_color_add', $variants);
        } else if($check_variant['type_variant'] == 2) {
            // ukuran
            $sizes = Size::orderBy("name", "asc")->get();

            $variants['sizes'] = $sizes;

            return view('product/data/product_variant_size_add', $variants);
        } else {
            // warna dan ukuran
            $variants['sizes']  = Size::orderBy("name", "asc")->get();
            $variants['colors'] = Color::orderBy("name", "asc")->get();

            return view('product/data/product_variant_all_add', $variants);
        }
    }

    public function save_variants(Request $request) {
        $today = date("Y-m-d H:i:s");

        $type = $request->type;

        if($type == "size") {
            $size_code  = $request->size_code;
            $color_code = '0';
        } else if($type == "color") {
            $size_code  = '0';
            $color_code = $request->color_code;
        } else {
            $size_code  = $request->size_code;
            $color_code = $request->color_code;
        }

        DB::beginTransaction();
            $data['product_code']          = $request->product_code;
            $data['size_code']             = $size_code;
            $data['color_code']            = $color_code;
            $data['variant_stock']         = str_replace(',', '', $request->stock);
            $data['variant_capital_price'] = str_replace(',', '', $request->capital_price);    
            $data['variant_selling_price'] = str_replace(',', '', $request->selling_price); 
            $data['input_user']            = auth()->user()->id;
            $data['input_date']            = $today;
            $data['update_user']           = auth()->user()->id;
            $data['updated_at']            = $today;   

            ProductVariant::insert($data);

            $result['status'] = 'success';
        DB::commit();

        return response()->json($result);
    }


    public function get_supplier(Request $request) {
        $product_code = $request->product_code;

        $suppliers = DB::table('product_suppliers as A')
        ->select('A.product_supplier_id', 'B.supplier_code', 'B.name', 'B.phone', 'B.address')
        ->leftJoin('suppliers as B', 'B.supplier_code', '=', 'A.supplier_code')
        ->where('A.product_code', '=', $product_code)
        ->orderBy('B.name')
        ->get();

        return view('product/data/product_supplier',[
            'product_code' => $product_code,
            'suppliers'    => $suppliers
        ]);
    }

    public function supplier_add(Request $request) {
        $product_code = $request->product_code;

        $suppliers = DB::table('suppliers')->select('supplier_code', 'name')->orderBy('name')->get();

        return view('product/data/product_supplier_add', [
            'product_code' => $product_code,
            'suppliers'    => $suppliers
        ]);
    }

    public function save_supplier(Request $request) {
        $product_code  = $request->product_code;
        $supplier_code = $request->supplier_code;
        $today         = date("Y-m-d H:i:s");

        DB::beginTransaction();
            DB::table('product_suppliers')->insert([
                'product_code'  => $product_code,
                'supplier_code' => $supplier_code,
                'input_user'   => auth()->user()->id,
                'input_date'   => $today
            ]);

            $result['status'] = 'success';
        DB::commit();

        return response()->json($result);
    }

    public function get_discount(Request $request) {
        $product_code = $request->product_code;

        $product = DB::table('products')->select('status_variant')->where('product_code', '=', $product_code)->get();

        return view('product/data/product_discount', [
            'product_code' => $product_code
        ]);
    }

    public function destroy(Product $product)
    {
        if($product->image) {
            Storage::delete($product->image);
        }

        Product::destroy($product->id);

        return redirect('/product')->with('success', 'Data berhasil dihapus.');
    }

    public function uploadImage(Request $request) {
        $file         = $request->file('gallery_add');
        $product_code = $request->product_code;

        DB::beginTransaction();
            $validator = Validator::make($request->all(), [
                'gallery_add' => 'image|file|max:1024'
            ]);

            $result = [];
            if($validator->fails()) {
                $result['status'] = 'error';
            } else {
                $set_file = $product_code.time().'.'.$file->getClientOriginalExtension();

                // upload image
                $file->storeAs('product-images', $set_file);

                DB::table('product_images')->insert([
                    'product_code'  => $product_code,
                    'product_image' => $set_file,
                    'input_user'    => auth()->user()->id,
                    'input_date'    => date('Y-m-d')
                ]);

                $result['status'] = 'success';
            }
        DB::commit();

        return response()->json($result);
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

    public function check_variant($product_code) {
        $product = DB::table('products')->select('status_variant', 'variant_color', 'variant_size')->where('product_code', '=', $product_code)->get();

        $status_variant = $product[0]->status_variant;

        $result = [];
        $text   = ' ';
        $type   = 0;
        if($status_variant == 1) {
            $variant_color = $product[0]->variant_color;
            $variant_size  = $product[0]->variant_size;

            if($variant_color == 1 && $variant_size == 0) {
                $text .= ' Warna ';
                $type = 1;
            } else if($variant_color == 0 && $variant_size == 1) {
                $text .= ' Ukuran ';
                $type = 2;
            } else if($variant_color == 1 && $variant_size == 1) {
                $text .= ' Warna & Ukuran ';
                $type = 3;
            }

            $result = [
                'product_code'   => $product_code,
                'status_variant' => 1,
                'text_variant'   => $text,
                'type_variant'   => $type
            ];
        } else {
            $result = [
                'product_code'   => $product_code,
                'status_variant' => 0,
                'text_variant'   => $text,
                'type_variant'   => $type
            ];
        }

        return $result;
    }

}