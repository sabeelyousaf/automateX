<?php

namespace App\Http\Controllers;

use App\Models\DiscountForm;
use App\Models\Form;
use App\Models\Tweet;
use Illuminate\Http\Request;
use App\Models\File;
use App\Models\Client;
use App\Models\Distributor;
use App\Models\Ledger;


class MainController extends Controller
{
    public function index(){
        $total_files=File::all()->count();
        $total_dealers=Distributor::all()->count();
        $total_clients=Client::all()->count();

        $pending_files=File::where('file_status','processing')->get()->count();
        $reserved_files=File::where('file_status','reserved')->get()->count();
        $closed_files=File::where('file_status','closed')->get()->count();
        $open_files=File::where('file_status','open')->get()->count();
        $ready_files=File::where('file_status','ready')->get()->count();
        $delivered_files=File::where('file_status','delivered')->get()->count();
        $processing_files=File::where('file_status','processing')->get()->count();
        $blocked_files=File::where('file_status','blocked')->get()->count();
        $total_files_amount = File::sum('total_amount');
        $total_paid_amount=Ledger::sum('paid_amount');
        $total_unpaid_amount=$total_files_amount - $total_paid_amount;
        $total_booking_amount=File::sum('total_amount');
        $total_paid_amount=Ledger::sum('paid_amount');
        $balance_amount=$total_booking_amount - $total_paid_amount;
        $total_sales_partners=Distributor::all()->count();
        $total_clients=Client::all()->count();
        //Files Size
        $total_4marla=File::where('size',4)->get()->count();
        $total_5marla=File::where('size',5)->get()->count();
        $total_6marla=File::where('size',6)->get()->count();
        $total_8marla=File::where('size',8)->get()->count();
        $total_10marla=File::where('size',10)->get()->count();
        $total_12marla=File::where('size',12)->get()->count();
        $total_18marla=File::where('size',18)->get()->count();
        $total_20marla=File::where('size',20)->get()->count();
        //Open Files

        $open_total_4marla=File::where('file_status','open')->where('size',4)->get()->count();
        $open_total_5marla=File::where('file_status','open')->where('size',5)->get()->count();
        $open_total_6marla=File::where('file_status','open')->where('size',6)->get()->count();
        $open_total_8marla=File::where('file_status','open')->where('size',8)->get()->count();
        $open_total_10marla=File::where('file_status','open')->where('size',10)->get()->count();
        $open_total_12marla=File::where('file_status','open')->where('size',12)->get()->count();
        $open_total_18marla=File::where('file_status','open')->where('size',18)->get()->count();
        $open_total_20marla=File::where('file_status','open')->where('size',20)->get()->count();

        $discount_total_forms=DiscountForm::all()->count();
        $adjusted_discount_forms=DiscountForm::where('status','adjusted')->get()->count();
        $adjusted_blocked_forms=DiscountForm::where('status','blocked')->get()->count();






        return view('backend_app.index',compact(
            'total_files',
            'total_dealers',
            'total_clients',
            'pending_files',
            'closed_files',
            'open_files',
            'reserved_files',
            'total_files_amount',
            'total_paid_amount',
            'total_unpaid_amount',
            'ready_files',
            'delivered_files',
            'processing_files',
            'blocked_files',
            'total_paid_amount',
            'balance_amount',
            'total_booking_amount',
            'total_sales_partners',
            'total_clients',
            'total_4marla',
            'total_5marla',
            'total_6marla',
            'total_8marla',
            'total_10marla',
            'total_12marla',
            'total_18marla',
            'total_20marla',

            'open_total_4marla',
            'open_total_5marla',
            'open_total_6marla',
            'open_total_8marla',
            'open_total_10marla',
            'open_total_12marla',
            'open_total_18marla',
            'open_total_20marla',

            'discount_total_forms',
            'adjusted_discount_forms',
            'adjusted_blocked_forms',
    ));
    }

    public function delete_all(Request $request){

        if($request->datafrom==="files"){
            foreach ($request->items as $key => $value) {
                Tweet::destroy($value);
            }
        }
        elseif($request->datafrom==="dealers"){

            foreach ($request->items as $key => $value) {
                File::where('distributor_id',$value)->update(['distributor_id' => null]);
                Distributor::destroy($value);
            }

        }
        elseif($request->datafrom==="clients"){

            foreach ($request->items as $key => $value) {
                Client::destroy($value);
            }

        }

        elseif($request->datafrom==="discounted"){

            foreach ($request->items as $key => $value) {
                DiscountForm::destroy($value);
            }
        }

        elseif($request->datafrom==="customer"){

            foreach ($request->items as $key => $value) {
                Form::destroy($value);
            }
        }

        $response=[
            "success"=>true,
            "message"=>"Your Files has been deleted successfully"
        ];
        return response()->json($response);
        }

    }

