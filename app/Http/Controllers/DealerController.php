<?php

namespace App\Http\Controllers;

use App\Models\Distributor;
use Illuminate\Http\Request;

class DealerController extends Controller
{

   public function index()
   {
       $data=Distributor::paginate(21);
       return view('backend_app.dealer.all_dealers',compact('data'));
   }

   /**
    * Show the form for creating a new resource.
    */
   public function create()
   {

       return view('backend_app.dealer.add_dealer');

   }

   /**
    * Store a newly created resource in storage.
    */
   public function store(Request $request)
   {


       $request->validate([
           'name'=>'required',
           'father_name'=>'required',
           'nationality'=>'required',
           'email'=>'required',
           'address'=>'required',
           'phone_no'=>'required',
           'date_of_birth'=>'required',
       ]);
       try {

       $data=new Distributor;
       $data->name=$request->name;
       $data->father_name=$request->father_name;
       $data->nationality=$request->nationality;
       $data->email=$request->email;
       $data->address =$request->address;
       $data->phone_no =$request->phone_no;
       $data->date_of_birth =$request->date_of_birth;
       $data->company=$request->company;
       $data->cnic_no=$request->cnic;

       $data->save();
       return back()->with('success','New Dealer has been added successfully');
        //code...
    } catch (\Throwable $th) {
        return back()->with('error',$th->getMessage());
       }
   }

   /**
    * Display the specified resource.
    */
   public function show(string $id)
   {
       //
   }

   /**
    * Show the form for editing the specified resource.
    */
   public function edit( $id)
   {
       $data=Distributor::find($id);
       return view('backend_app.dealer.edit_dealer',compact('data'));
   }

   /**
    * Update the specified resource in storage.
    */
   public function update(Request $request,$id)
   {

    $request->validate([
        'name'=>'required',
        'father_name'=>'required',
        'nationality'=>'required',
        'email'=>'required',
        'address'=>'required',
        'phone_no'=>'required',
        'date_of_birth'=>'required',
    ]);
    try {
        $data=Distributor::find($id);
        $data->name=$request->name;
        $data->father_name=$request->father_name;
        $data->nationality=$request->nationality;
        $data->email=$request->email;
        $data->address =$request->address;
        $data->phone_no =$request->phone_no;
        $data->date_of_birth =$request->date_of_birth;
        $data->company=$request->company;
        $data->cnic_no=$request->cnic;
        $data->save();
        return redirect(route('all-dealer'))->with('success','Dealer has been updated successfully');
         //code...
     } catch (\Throwable $th) {
         return back()->with('error',$th->getMessage());
        }
   }

   /**
    * Remove the specified resource from storage.
    */
   public function destroy($id)
   {
    Distributor::destroy($id);
    return back()->with('success','Client has been deleted succesfully');
   }
   public function search_dealers(Request $request){

    try {

        $data = Distributor::query();

        if ($request->has('search')) {
            $searchValue = $request->search;

            // Search by tracking_id
            $data->orWhere('company', 'LIKE', $searchValue . '%');

            // Search by serial_no if tracking_id not matched
            $data->orWhere('email', 'LIKE', $searchValue . '%');

            // Search by security_no if tracking_id and serial_no not matched
            $data->orWhere('phone_no', 'LIKE', $searchValue . '%');
            $data->orWhere('name', 'LIKE', $searchValue . '%');
            $data->orWhere('cnic_no', 'LIKE', $searchValue . '%');

        }

        $search_data=$data->paginate(16);
        $repsonse=[
            'data'=>$search_data,
            'pagination'=>$search_data->links()->toHtml()
        ];
        return response()->json($repsonse);
         //code...
        } catch (\Throwable $th) {
            return response()->json($th->getMessage());
            }
   }
}
