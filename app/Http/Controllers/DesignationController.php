<?php

namespace App\Http\Controllers;

use App\Models\Designation;
use Illuminate\Http\Request;

class DesignationController extends Controller
{
    public function index()
    {
        $designations = Designation::latest()->get();

        return view('designations.index', compact('designations'));
    }

    public function create()
    {
        return view('designations.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|unique:designations,title',
            'status' => 'required'
        ]);

        Designation::create([
            'title' => $request->title,
            'status' => $request->status
        ]);

        return response()->json([
            'message' => 'Designation Added Successfully'
        ]);
    }

    public function edit($id)
    {
        $designation = Designation::findOrFail($id);
        return view('designations.edit', compact('designation'));
    }

    public function update(Request $request, $id)
    {
    $request->validate([
        'title' => 'required|unique:designations,title,' . $id,
        'status' => 'required'
    ]);

    $designation = Designation::findOrFail($id);

    $designation->update([
        'title' => $request->title,
        'status' => $request->status
    ]);

    return response()->json([
        'message' => 'Designation Updated Successfully'
    ]);
}
public function destroy($id)
{
    Designation::findOrFail($id)->delete();

    return response()->json([
        'message' => 'Designation Deleted Successfully'
    ]);
}

}

