<?php

namespace App\Http\Controllers;

use App\Models\Data;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class DataController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Data::paginate(10);

        return view('data-list', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'mobile' => 'required|digits:10', // 'digits:10' checks for exactly 10 digits
            'image' => 'required|mimes:png,jpg,jpeg',
            'password' => 'required|string|min:8',
            'confirm_password' => 'required|same:password'
        ]);


        $data = new Data();
        $data->name = $request['name'];
        $data->email = $request['email'];
        $data->mobile = $request['mobile'];
        
         // Handle file upload for the image
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/profile'), $imageName);
            $data->image = $imageName;
        }
        $data->password = Hash::make($request['password']);

        try{
            $data->save();
            return back()->with('success', 'Data added successfully');
        }catch(Exception $e){
            return back()->with('error', $e->getMessage());
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
    public function edit(string $id)
    {
        $findData = Data::find($id);
        if(!$findData) return back()->with('error', 'Data not found!');
        
        $data = Data::paginate(10);
        return view('data-list', compact('data', 'findData'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $findData = Data::find($id);
        if(!$findData) return back()->with('error', 'Data not found!');

        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'mobile' => 'required|digits:10', // 'digits:10' checks for exactly 10 digits
            'image' => 'nullable|mimes:png,jpg,jpeg',
            'password' => 'nullable|string|min:8',
            'confirm_password' => 'nullable|same:password'
        ]);

        $findData->name = $request['name'];
        $findData->email = $request['email'];
        $findData->mobile = $request['mobile'];
        
         // Handle file upload for the image
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/profile'), $imageName);
            $findData->image = $imageName;
        }
        
         // Update the password if provided
        if ($request->filled('password')) {
            $findData->password = Hash::make($request['password']);
        }

        try{
            $findData->update();
            return Redirect::route('data.index')->with('success', 'Data updated successfully');
        }catch(Exception $e){
            return back()->with('error', $e->getMessage());
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = Data::find($id);

        if(!$data) return Redirect::back()->with('error', 'Data not found!',404);

        try{
            $data->delete();
            return Redirect::route('data.index')->with('success', 'Data has been deleted!');
        }catch(Exception $e){
            return Redirect::back()->with('error', $e->getMessage());
        }
    }
}
