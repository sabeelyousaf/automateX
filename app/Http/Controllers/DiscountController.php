<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Rap2hpoutre\FastExcel\FastExcel;
use App\Models\DiscountForm;
class DiscountController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {


        $data=DiscountForm::paginate(16);
        return view('backend_app.discount_forms.all',compact('data'));
           //code...
        } catch (\Throwable $th) {
        return back()->with('error',$th->getMessage());
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        try {
            return view('backend_app.discount_forms.add');
        } catch (\Throwable $th) {
            return back()->with('error',$th->getMessage());
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'tracking_id'=>"required",
            'serial_no'=>"required",
            'security_no'=>"required",
            'status'=>"required",
            'face_value'=>"required",
            'adjusted_value'=>"required",
        ]);
        try {


            DiscountForm::create([
                'tracking_id'=>$request->tracking_id,
                'serial_no'=>$request->serial_no,
                'security_no'=>$request->security_no,
                'status'=>$request->status,
                'face_value'=>$request->face_value,
                'adjusted_value'=>$request->adjusted_value,
            ]);
            return back()->with('success','Discount form has been added successfully');
               //code...
            } catch (\Throwable $th) {
            return back()->with('error',$th->getMessage());
            }
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
    public function edit($id)
    {
        try {
            $data=DiscountForm::find($id);
            return view('backend_app.discount_forms.edit',compact('data'));
        } catch (\Throwable $th) {
            return back()->with('error',$th->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {
        try {
            $request->validate([
                'tracking_id' => 'required',
                'serial_no' => 'required',
                'security_no' => 'required',
                'status' => 'required',
                'face_value'=>"required",
                'adjusted_value'=>"required",
            ]);
            $data = DiscountForm::find($id);
            $data->update([
                'tracking_id' => $request->tracking_id,
                'serial_no' => $request->serial_no,
                'security_no' => $request->security_no,
                'status' => $request->status,
            ]);
            return back()->with('success', 'Discount form has been updated successfully');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        DiscountForm::destroy($id);
        return back()->with('error','Discount form has been deleted successfully');
    }

    public function import_excel(Request $request){
            try {
                $collections = (new FastExcel)->import($request->file('excel_file'));

                $required_fields = ['tracking_id', 'serial_no', 'security_no' , 'status', 'face_value', 'adjusted_value'];
                foreach ($collections as $collection) {
                    foreach ($required_fields as $field) {
                        if (!array_key_exists($field, $collection) || $collection[$field] === "") {
                            return back()->with("error", "Please ensure all required fields are filled.");
                        }
                    }

                    // Check if the form_no already exists
                    $existingFile = DiscountForm::where('Tracking_id', $collection['tracking_id'])->first();

                    if ($existingFile) {
                        // Update existing file data
                        $existingFile->update([
                            'Serial_no' => $collection['serial_no'],
                            'status' => $collection['status'],
                            'face_value' => $collection['face_value'],
                            'security_no' => $collection['security_no'],
                            'adjusted_value' => $collection['adjusted_value'],
                        ]);

                        // Create new ledger entry

                    } else {

                        $discount_form = DiscountForm::create([
                            'Tracking_id' => $collection['tracking_id'],
                            'Serial_no' => $collection['serial_no'],
                            'status' => $collection['status'],
                            'security_no' => $collection['security_no'],
                            'face_value' => $collection['face_value'],
                            'adjusted_value' => $collection['adjusted_value'],
                        ]);

                    }
                }

                return back()->with("success", "Excel data has been imported successfully");
            } catch (\Exception $exception) {
                return back()->with("error", "Error occurred: ".$exception->getMessage());
            }
        }

public function search_discount_forms(Request $request){


    try {

    $data = DiscountForm::query();

    if ($request->has('search')) {
        $searchValue = $request->search;

        // Search by tracking_id
        $data->orWhere('tracking_id', 'LIKE', $searchValue . '%');

        // Search by serial_no if tracking_id not matched
        $data->orWhere('serial_no', 'LIKE', $searchValue . '%');

        // Search by security_no if tracking_id and serial_no not matched
        $data->orWhere('security_no', 'LIKE', $searchValue . '%');
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
