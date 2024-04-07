<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Banner;
class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $data=Banner::all();
        return view('backend_app.banners.all_banners',compact('data'));
        } catch (\Throwable $th) {
            return back()->with('errors',$th->getMessage());
        }

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        try {
            return view('backend_app.banners.add_banner');
        } catch (\Throwable $th) {
            return back()->with('errors',$th->getMessage());
        }

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        try {
            $data= new banner;
            if ($request->hasFile('img')) {
                $image = $request->file('img');
                $imageName = $image->getClientOriginalName();
                $destinationPath = public_path('assets/banners/');
                $image->move($destinationPath, $imageName);
                $data->img = $imageName; // Assign the image name to the 'img' attribute in the model
            }
            $data->url=$request->url;
            $data->save();
            return back()->with("success",'Banner has been added successfully');
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
            $data=Banner::find($id);
            return view('backend_app.banners.view_banner',compact('data'));
        } catch (\Throwable $th) {
            return back()->with('errors',$th->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        try {
            $data=Banner::find($id);
            return view('backend_app.banners.edit_banner',compact('data'));
        } catch (\Throwable $th) {
            return back()->with('errors',$th->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {
        try {
            $data=Banner::find($id);
            if($request->hasFile('img')){
                $image=$request->file('img');
                $imagename=$request->file('img')->getClientOriginalName();
                $destionation_path=public_path('assets/banners/');
                $image->move($destionation_path,$imagename);
                $data->img=$imagename;
            }
            $data->url=$request->url;
            $data->save();
            return redirect()->route('all-banners')->with("success",'Banner has been updated successfully');

        } catch (\Throwable $th) {
            return back()->with('errors',$th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
           Banner::destroy($id);
           return back()->with("success",'Banner has been deleted successfully');
        } catch (\Throwable $th) {
            return back()->with('errors',$th->getMessage());
        }
    }
}
