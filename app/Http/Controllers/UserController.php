<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Designation;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $designations = Designation::where('status',1)
                        ->orderBy('title')
                        ->get();

        return view('users.index',compact('designations'));
    }

    public function create()
    {
        $designations = Designation::where('status',1)
                        ->orderBy('title')
                        ->get();

        return view('users.create', compact('designations'));
    }

    public function list(Request $request)
    {
    $users = User::with('designation');

    if ($request->filled('designation')) {
        $users->where('designation_id', $request->designation);
    }

    if ($request->has('status') && $request->status !== '') {
        $users->where('status', $request->status);
    }

    return response()->json(
        $users->orderBy('name')->get()
    );
}
public function store(Request $request)
{
    $request->validate([
        'name'=>'required',
        'email'=>'required|email|unique:users,email',
        'contact_number'=>'required',
        'alternative_contact_number'=>'nullable',
        'address'=>'required',
        'designation_id'=>'required',
        'status'=>'required',
        'password'=>'required|min:6'
    ]);

    User::create([
        'name'=>$request->name,
        'email'=>$request->email,
        'contact_number'=>$request->contact_number,
        'alternative_contact_number'=>$request->alternative_contact_number,
        'address'=>$request->address,
        'designation_id'=>$request->designation_id,
        'status'=>$request->status,
        'password'=>Hash::make($request->password)
    ]);

    return response()->json([
        'message'=>'User Added Successfully'
    ]);
}
public function edit($id)
{
    $user = User::findOrFail($id);
    $designations = Designation::where('status',1)
                        ->orderBy('title')
                        ->get();

    return view('users.edit', compact('user','designations'));
}

public function update(Request $request,$id)
{
    $request->validate([
        'name'=>'required',
        'email'=>'required|email|unique:users,email,'.$id,
        'contact_number'=>'required',
        'alternative_contact_number'=>'nullable',
        'address'=>'required',
        'designation_id'=>'required',
        'status'=>'required',
        'password'=>'nullable|min:6'
    ]);

    $user=User::findOrFail($id);

    $user->name=$request->name;
    $user->email=$request->email;
    $user->contact_number=$request->contact_number;
    $user->alternative_contact_number=$request->alternative_contact_number;
    $user->address=$request->address;
    $user->designation_id=$request->designation_id;
    $user->status=$request->status;

    if($request->filled('password')){
        $user->password=Hash::make($request->password);
    }

    $user->save();

    return response()->json([
        'message'=>'User Updated Successfully'
    ]);
}
public function destroy($id)
{
    User::findOrFail($id)->delete();

    return response()->json([
        'message'=>'User Deleted Successfully'
    ]);
}
}
