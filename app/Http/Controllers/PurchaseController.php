<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Purchase;
use App\Models\Supplier;
use App\Models\Product;
use App\Models\ProductVariant;
use DB;

class PurchaseController extends Controller
{
    
    public function index()
    {
        return view('purchase/purchase_list', [
            'title'     => 'Pembelian',
            'purchases' => Purchase::orderBy("purchase_id", 'desc')->get()
        ]);
    }

    public function create()
    {
        return view('purchase/purchase_create', [
            'title'     => 'Tambah Pembelian',
            'suppliers' => Supplier::all(),
            'products'  => Product::all()
        ]);
    }

    public function getVariant($id)
    {
        $variants = ProductVariant::where('product_id', $id)->get();

        if(empty($variants)) {
            $option = '<option value="0">No Varian</option>';
        } else {
            $option = '<option value="" selected disabled>Pilih Varian</option>';
            foreach($variants as $var) {
                $option .= '<option value="'.$var->id.'">'.$var->size->name.'</option>';
            }
        }

       echo $option;
    }

    public function chooseProduct(Request $request) {
        $variant = DB::table('product_variants AS A')
            ->select('A.id', 'A.product_id', 'A.size_id', 'A.stock', 'A.capital_price', 'A.selling_price', 'B.name AS product_name', 'C.name AS size_name')
            ->leftJoin('products AS B', 'B.id', '=', 'A.product_id')
            ->leftJoin('sizes AS C', 'C.id', '=', 'A.size_id')
            ->where(['A.id' => $request->id])
            ->first();

        return json_encode($variant);
    }

    public function store(Request $request) {
        ddd($request);
        $transDate  = $request->purchase_date;
        $supplierId = $request->supplier_id;
        $note       = $request->note;

        $productId = $request->product_id;
        $capPrice  = $request->capital_price;
        $qty       = $request->qty;

        
    }

}
