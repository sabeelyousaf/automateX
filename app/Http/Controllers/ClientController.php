<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\File;
use App\Models\Distributor;

use Illuminate\Support\Facades\Auth;
class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data=Client::with('distributor')->latest()->paginate(21);
        return view('backend_app.client.all_clients',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $dealers=Distributor::all();
        $files=File::all();
        return view('backend_app.client.add_client',compact('dealers','files'));

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
            'cnic'=>'required',

        ]);
        $user=Auth::user();
        $data=new Client;
        $data->name=$request->name;
        $data->father_name=$request->father_name;
        $data->nationality=$request->nationality;
        $data->email=$request->email;
        $data->address =$request->address;
        $data->phone_no =$request->phone_no;
        $data->date_of_birth =$request->date_of_birth;
        $data->cnic =$request->cnic;
        $data->nominee =$request->nominee;
        $data->nominee_relation =$request->nominee_relationship;
        $data->cnic =$request->cnic;
        $data->files = json_encode($request->input('files'));

        foreach($request->input('files') as $key=>$item){
            $file=File::find($item);
            $data->assigned_to = $file->distributor_id;
            $file->file_status = "closed";
            $file->file_location = "Project Office";
            $file->save();
        }

        $data->save();
        return back()->with('success','New Client has been added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show( $id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data=Client::find($id);
        $dealers=Distributor::all();
        $files=File::all();
        return view('backend_app.client.edit_client',compact('data','dealers','files'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,  $id)
    {
        $request->validate([
            'name'=>'required',
            'father_name'=>'required',
            'nationality'=>'required',
            'email'=>'required',
            'address'=>'required',
            'phone_no'=>'required',
            'date_of_birth'=>'required',
            'cnic'=>'required',

        ]);
        $user=Auth::user();
        $data=Client::find($id);
        $data->name=$request->name;
        $data->father_name=$request->father_name;
        $data->nationality=$request->nationality;
        $data->email=$request->email;
        $data->address =$request->address;
        $data->phone_no =$request->phone_no;
        $data->date_of_birth =$request->date_of_birth;
        $data->assigned_to =$request->assigned_to;
        $data->cnic =$request->cnic;
        $data->nominee =$request->nominee;
        $data->nominee_relation =$request->nominee_relationship;
        $data->cnic =$request->cnic;

        $data->files = json_encode($request->input('files'));

        $data->save();
        return back()->with('success','Client has been updated successfully');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Client::destroy($id);
        return back()->with('success','Client has been deleted succesfully');
    }

    public function search_clients(Request $request) {
        try {



            if ($request->filled('search')) {
                $data = Client::with('distributor')->query();
                $searchValue = $request->search;
                $data->where(function ($query) use ($searchValue) {
                    $query->where('name', 'LIKE', '%' . $searchValue . '%')
                        ->orWhere('email', 'LIKE', '%' . $searchValue . '%')
                        ->orWhere('phone_no', 'LIKE', '%' . $searchValue . '%');
                });
                $search_data = $data->latest()->paginate(16);
            }
            else{
                $search_data = Client::with('distributor')->latest()->paginate(16);
            }


            $response = [
                'data' => $search_data,
                'pagination' => $search_data->links()->toHtml()
            ];
            return response()->json($response);
        } catch (\Throwable $th) {
            return response()->json($th->getMessage());
        }
    }


}
