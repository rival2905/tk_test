<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\DocumentCategory;

class DocumentCategoryController extends Controller
{
    //
    public function index()
    {
        $categories = DocumentCategory::get();
        return view('admin.category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $action = "store";

        return view('admin.category.form',compact('action'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $this->validate($request,[
            'code'   => 'required|unique:document_categories',
            'name'   => 'required|unique:document_categories',
        ]);
      
        $data = [
            'code'       => $request->code,
            'name'       => $request->input('name'),
            'slug'        => Str::slug($request->input('name'), '-')
        ];

        $save = DocumentCategory::Create($data);

        if($save){
            //redirect dengan pesan sukses
            return redirect()->route('admin.category.index')->with(['success' => 'Data Berhasil Disimpan!']);
        }else{
            //redirect dengan pesan error
            return redirect()->route('admin.category.index')->with(['error' => 'Data Gagal Disimpan!']);
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
        //
        $action = "update";
        $data = DocumentCategory::find($id);
        return view('admin.category.form',compact('data','action'));


    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        //
        $temp = DocumentCategory::findOrFail($id);

        $this->validate($request,[
            'code'   => 'required|unique:document_categories,code,'.$temp->id,
            'name'   => 'required|unique:document_categories,name,'.$temp->id,
        ]);
      
        $data = [
            'code'       => $request->code,
            'name'       => $request->input('name'),
            'slug'        => Str::slug($request->input('name'), '-')
        ];

        $save = $temp->update($data);

        if($save){
            //redirect dengan pesan sukses
            return redirect()->route('admin.category.index')->with(['success' => 'Data Berhasil Diperbaharui!']);
        }else{
            //redirect dengan pesan error
            return redirect()->route('admin.category.index')->with(['error' => 'Data Gagal Diperbaharui!']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
