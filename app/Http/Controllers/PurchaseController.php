<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Purchase;
use App\Models\Supplier;
use App\Models\Product;
use App\Models\ProductVariant;
use DB;
use Dompdf\Dompdf;
use Dompdf\Options;

class PurchaseController extends Controller
{
    
    public function index()
    {
        return view('purchase/purchase_list', [
            'title'     => 'Pembelian',
            'purchases' => Purchase::orderBy("purchase_id", 'desc')->get()
        ]);
    }

    public function purchase_create() {
        return view('purchase/purchase_create', [
            'title'     => 'Tambah Pembelian',
            'suppliers' => Supplier::all(),
            'products'  => DB::table('product_view')->select('*')->orderBy('product_variant_name')->get()
        ]);
    }

    public function double_product_check(Request $request) {
        $product_code_alias = $request->product_code_alias;        

        foreach($product_code_alias as $key => $value) {
            if(!empty($product_code_alias[$key])) {
                $cek_data[] = $product_code_alias[$key];
            }
        }

        $get_data = array_diff_key($cek_data, array_unique($cek_data));

        $status = (empty($get_data)) ? "ok" : "duplicate";

        $result = [];

        $explode = explode('-', $request->get_product_code);

        if(count($explode) == 1) {
            // product no variant
            $product_code = $explode[0];
            $product = DB::table('products as a')->select('a.capital_price', 'a.unit_id', 'b.name')->leftJoin('units as b', 'b.unit_id', '=', 'a.unit_id')
                       ->where('a.product_code', $product_code)->get();

            $capital_price = $product[0]->capital_price;
            $unit_id       = $product[0]->unit_id;
            $unit_name     = $product[0]->name;
        } else {
            // product variant
            $variant_id = $explode[1];
            $product_variant = DB::table('product_variants as a')
                               ->select('a.variant_capital_price', 'b.unit_id', 'c.name')
                               ->leftJoin('products as b', 'b.product_code', '=', 'a.product_code')
                               ->leftJoin('units as c', 'c.unit_id', '=', 'b.unit_id')
                               ->where('a.variant_id', $variant_id)->get();

            $capital_price = $product_variant[0]->variant_capital_price;
            $unit_id       = $product_variant[0]->unit_id;
            $unit_name     = $product_variant[0]->name;
        }

        $result = [
            'status'        => $status,
            'capital_price' => $capital_price,
            'unit_id'       => $unit_id,
            'unit_name'     => $unit_name
        ];

        return response()->json($result);
    }

    public function purchase_edit(Request $request) {
        $purchase_id = $request->purchase_id;

        $purchase_status = Purchase::where("purchase_id", $purchase_id)->first(['status'])->status;

        if($purchase_status == '0') {
            $view = 'purchase/purchase_edit';

            $purchase_items = DB::table('purchase_items as a')
                          ->select('a.*'
                            , DB::raw("CASE
                                           WHEN a.variant_id = 0 THEN a.product_code
                                           ELSE CONCAT(a.product_code, '-', a.variant_id)
                                       END as product_code_alias")
                            , 'b.name')
                          ->leftJoin('units as b', 'b.unit_id', '=', 'a.unit_id')
                          ->where('a.purchase_id', '=' , $purchase_id)
                          ->orderBy('a.num_order')->get();
        } else {
            $view = 'purchase/purchase_po';

            $purchase_items = DB::table('purchase_items as a')
                              ->select('a.*', 'b.name',
                                    DB::raw("CASE
                                               WHEN a.variant_id = 0 THEN (SELECT name FROM products WHERE product_code=a.product_code)
                                               ELSE (SELECT product_variant_name FROM product_view WHERE variant_id=a.variant_id)
                                             END as product_name")
                                )
                              ->leftJoin('units as b', 'b.unit_id', '=', 'a.unit_id')
                              ->where('a.purchase_id', $purchase_id)
                              ->orderBy('a.num_order')
                              ->get();
        }

        return view($view, [
            'title'          => 'Edit Pembelian',
            'purchase'       => Purchase::where("purchase_id", $purchase_id)->first(),
            'purchase_items' => $purchase_items,
            'purchase_rows'  => $purchase_items->count(),
            'suppliers'      => Supplier::all(),
            'products'       => DB::table('product_view')->select('*')->orderBy('product_variant_name')->get()
        ]);
    }

    public function get_product(Request $request) {
        $like_product = strtolower( empty($request->term) ? "" : $request->term );
        $supplier_id  = $request->supplier_id;

        $products = DB::table('products')
                    ->select('product_code', 'name')
                    ->where(DB::raw('LOWER(name)'), 'like', '%'.$like_product.'%')
                    ->get();

        $json = [];
        foreach($products as $product) {
            $json[] = ["id" => $product->product_code, "text" => $product->name];
        }
        
        return response()->json($json);
    }

    public function get_variant(Request $request) {
        $product_code = $request->product_code;

        $result = [];

        // cek status variant
        $variant = DB::table('products')
                   ->select('capital_price','status_variant', 'variant_size', 'variant_color')
                   ->where('product_code', '=', $product_code)
                   ->get();
        $status_variant = $variant[0]->status_variant;
        $variant_size   = $variant[0]->variant_size;
        $variant_color  = $variant[0]->variant_color;
        $price          = 0;

        if($status_variant == 0) {
            $set_status        = 0;
            $opt_size_variant  = '<option value="novariant">No Variant</option>';
            $opt_color_variant = '<option value="novariant">No Variant</option>';
            $price             = $variant[0]->capital_price;
        } else {
            $set_status  = 1;

            $variants = DB::table('product_variants AS A')
                        ->select('A.variant_id', 'A.variant_capital_price', 'B.name AS size_name', 'C.name AS color_name')
                        ->leftJoin('sizes AS B', 'B.size_code', '=', 'A.size_code')
                        ->leftJoin('colors AS C', 'C.color_code', '=', 'A.color_code')
                        ->where('A.product_code', '=', $product_code)
                        ->get();

            if($variant_size == 1 && $variant_color == 0) {
                $opt_color_variant = '<option value="novariant">No Variant</option>';

                $opt_size_variant = '<option value="">-PILIH-</option>';
                foreach($variants as $vrn) {
                    $opt_size_variant .= '<option value="'.$vrn->variant_id.'">'.$vrn->size_name.'</option>';
                }

                $price = $variants[0]->variant_capital_price;
            } else if($variant_size == 0 && $variant_color == 1) {
                $opt_size_variant = '<option value="novariant">No Variant</option>';

                $opt_color_variant = '<option value="">-PILIH-</option>';
                foreach($variants as $vrn) {
                    $opt_color_variant .= '<option value="'.$vrn->variant_id.'">'.$vrn->color_name.'</option>';
                }

                $price = $variants[0]->variant_capital_price;
            } else if($variant_size == 1 && $variant_color == 1) {

            }
        }

        $result = [
            'status'        => $set_status,
            'size_variant'  => $opt_size_variant,
            'color_variant' => $opt_color_variant,
            'price'         => $price
        ];

        return response()->json($result);
    }

    public function purchase_save(Request $request) {
        // header
        $purchase_date    = $request->purchase_date;
        $purchase_duedate = $request->purchase_duedate;
        $supplier_id      = $request->supplier_id;
        $note             = $request->note;

        // summary
        $set_val_total_amount = $request->set_val_total_amount;
        $discount             = str_replace(',', '', $request->discount);
        $delivery             = str_replace(',', '', $request->delivery);
        $ppn_check            = $request->ppn_check;
        $set_val_ppn          = empty($ppn_check) ? 0 : $request->set_val_ppn;
        $total_pay            = ($set_val_total_amount + $set_val_ppn) - $discount + $delivery;

        $purchase = Purchase::where('purchase_date', $purchase_date)->max('counter');
        $kode     = ($purchase == null) ? 1 : $purchase+1;
        $kodemax  = str_pad($kode, 4, "0", STR_PAD_LEFT);

        $today = date('Ymd', strtotime($purchase_date));
        $year  = substr($today, 2, 2);
        $date  = substr($today, 6);
        $month = substr($today, 4, 2);
        
        $set_purchase_id = 'PO'.$year.$month.$date.$kodemax;

        DB::beginTransaction();
            DB::table('purchases')->insert([
                'purchase_id'      => $set_purchase_id,
                'purchase_date'    => $purchase_date,
                'purchase_duedate' => $purchase_duedate,
                'supplier_code'    => $supplier_id,
                'note'             => $note,
                'status'           => '0',
                'amount_total'     => $set_val_total_amount,
                'ppn'              => $set_val_ppn,
                'discount'         => $discount,
                'delivery'         => $delivery,
                'total_pay'        => $total_pay,
                'counter'          => $kodemax,
                'input_user'       => auth()->user()->user_code,
                'input_date'       => date('Y-m-d H:i:s'),
                'update_user'      => auth()->user()->user_code,
                'update_date'      => date('Y-m-d H:i:s'),
            ]);

            // detail
            $product_code_alias = $request->product_code_alias;
            $unit_id            = $request->unit_id;
            $purchase_qty       = $request->purchase_qty;
            $purchase_price     = $request->purchase_price;
            $amount             = $request->amount;

            $num = 0;
            foreach($product_code_alias as $key => $value) {
                $num++;
                $set_purchase_price = str_replace(',', '', $purchase_price[$key]);

                $explode = explode('-', $product_code_alias[$key]);

                if(count($explode) == 1) {
                    $set_product_code = $explode[0];
                    $variant_id       = 0;
                } else {
                    $set_product_code = $explode[0];
                    $variant_id       = $explode[1];
                }
                
                DB::table('purchase_items')->insert([
                    'purchase_id'    => $set_purchase_id,
                    'num_order'      => $num,
                    'product_code'   => $set_product_code,
                    'variant_id'     => $variant_id,
                    'unit_id'        => $unit_id[$key],
                    'purchase_qty'   => $purchase_qty[$key], 
                    'purchase_price' => $set_purchase_price,
                    'amount'         => $amount[$key]
                ]);
            }
        DB::commit();

        $result['status'] = "ok";

        return response()->json($result);
    }

    public function purchase_update(Request $request) {
        // header
        $purchase_id      = $request->purchase_id;
        $purchase_date    = $request->purchase_date;
        $purchase_duedate = $request->purchase_duedate;
        $supplier_id      = $request->supplier_id;
        $note             = $request->note;
        $process_type     = $request->process_type;

        // summary
        $set_val_total_amount = $request->set_val_total_amount;
        $discount             = str_replace(',', '', $request->discount);
        $delivery             = str_replace(',', '', $request->delivery);
        $ppn_check            = $request->ppn_check;
        $set_val_ppn          = empty($ppn_check) ? 0 : $request->set_val_ppn;
        $total_pay            = ($set_val_total_amount + $set_val_ppn) - $discount + $delivery;

        DB::beginTransaction();
            DB::table('purchases')
            ->where('purchase_id', '=', $purchase_id)
            ->update([
                'purchase_date'    => $purchase_date,
                'purchase_duedate' => $purchase_duedate,
                'supplier_code'    => $supplier_id,
                'note'             => $note,
                'status'           => ($process_type == 'po') ? '1' : '0',
                'amount_total'     => $set_val_total_amount,
                'ppn'              => $set_val_ppn,
                'discount'         => $discount,
                'delivery'         => $delivery,
                'total_pay'        => $total_pay,
                'update_user'      => auth()->user()->user_code,
                'update_date'      => date('Y-m-d H:i:s'),
            ]);

            // detail
            $product_code_alias = $request->product_code_alias;
            $unit_id            = $request->unit_id;
            $purchase_qty       = $request->purchase_qty;
            $purchase_price     = $request->purchase_price;
            $amount             = $request->amount;

            if(count($product_code_alias) > 0) {
                DB::table('purchase_items')->where('purchase_id', $purchase_id)->delete();

                $num = 0;
                foreach($product_code_alias as $key => $value) {
                    $num++;
                    $set_purchase_price = str_replace(',', '', $purchase_price[$key]);

                    $explode = explode('-', $product_code_alias[$key]);

                    if(count($explode) == 1) {
                        $set_product_code = $explode[0];
                        $variant_id       = 0;
                    } else {
                        $set_product_code = $explode[0];
                        $variant_id       = $explode[1];
                    }
                    
                    DB::table('purchase_items')->insert([
                        'purchase_id'    => $purchase_id,
                        'num_order'      => $num,
                        'product_code'   => $set_product_code,
                        'variant_id'     => $variant_id,
                        'unit_id'        => $unit_id[$key],
                        'purchase_qty'   => $purchase_qty[$key], 
                        'purchase_price' => $set_purchase_price,
                        'amount'         => $amount[$key]
                    ]);
                }
            }
        DB::commit();

        $result['status'] = "ok";

        return response()->json($result);
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

    public function purchase_print() {
        $file_pdf    = 'Tes Print';
        $paper       = "A4";
        $orientation = "portrait";
        $html        = view('purchase/purchase_print');
        $this->generate($html, $file_pdf, $paper, $orientation, TRUE);
    }

    public function generate($html, $filename='', $paper = '', $orientation = '', $stream="") {
        $options = new Options();
        $options->set('isRemoteEnabled', TRUE);
        $dompdf = new Dompdf($options);
        $contxt = stream_context_create([
            'ssl' => [
                'verify_peer'       => FALSE,
                'verify_peer_name'  => FALSE,
                'allow_self_signed' => TRUE
            ]
        ]);

        $dompdf->setHttpContext($contxt);
        $dompdf->set_option("isPhpEnabled", true);
        $dompdf->filename = $filename.".pdf";
        $dompdf->loadHtml($html);
        // $dompdf->setPaper($paper, $orientation);
        // $dompdf->setPaper($paper, $orientation);
        $dompdf->render();
        if ($stream) {
            $dompdf->stream($filename.".pdf", ['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true,"Attachment" => false]);
        } else {
            return $dompdf->output();
        }
    }

}
