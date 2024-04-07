<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Partner;
class PartnerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $data=Partner::all();
        return view('backend_app.sales_partners.all_partner',compact('data'));
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
            return view('backend_app.sales_partners.add_partner');
        } catch (\Throwable $th) {
            return back()->with('error',$th->getMessage());
        }

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        try {
            $data= new Partner;
            if ($request->hasFile('img')) {
                $image = $request->file('img');
                $imageName = $image->getClientOriginalName();
                $destinationPath = public_path('assets/partners/');
                $image->move($destinationPath, $imageName);
                $data->img = $imageName; // Assign the image name to the 'img' attribute in the model
            }
            $data->url=$request->url;
            $data->save();
            return back()->with("success",'Partner has been added successfully');
        } catch (\Throwable $th) {
            return back()->with('error',$th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try {
            $data=Partner::find($id);
            return view('backend_app.banners.view_banner',compact('data'));
        } catch (\Throwable $th) {
            return back()->with('error',$th->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        try {
            $data=Partner::find($id);
            return view('backend_app.sales_partners.edit_partner',compact('data'));
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

            $data=Partner::find($id);
            if($request->hasFile('img')){
                $image=$request->file('img');

                $imagename=$request->file('img')->getClientOriginalName();

                $destionation_path=public_path('assets/partners/');
                $image->move($destionation_path,$imagename);
                $data->img=$imagename;
            }
            $data->url=$request->url;
            $data->save();
            return redirect()->route('all-partners')->with("success",'Partners has been updated successfully');

        } catch (\Throwable $th) {
            return back()->with('error',$th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
           Partner::destroy($id);
           return back()->with("success",'Partners has been deleted successfully');
        } catch (\Throwable $th) {
            return back()->with('error',$th->getMessage());
        }
    }

}
