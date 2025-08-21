<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DataUmum;
use App\Models\DataUmumDocumentCategory;
use App\Models\DocumentCategory;

class DataUmumDocumentCategoryController extends Controller
{

    public function show($data_umum_id)
    {
        $data_umum = DataUmum::with([
            'duDc.documentCategory',
            'duDc.details'
        ])->findOrFail($data_umum_id);

        $document_categories = DocumentCategory::all();

        return view('admin.data_umum.show', compact('data_umum', 'document_categories'));
    }

    public function store(Request $request, $data_umum_id)
    {
        $this->validate($request, [
            'document_category_id' => 'required|exists:document_categories,id',
            'score' => 'nullable|integer',
            'deskripsi' => 'nullable|string',
            'is_active' => 'required|boolean',
        ]);

        $data = [
            'data_umum_id' => $data_umum_id,
            'document_category_id' => $request->document_category_id,
            'score' => $request->score ?? 0,
            'deskripsi' => $request->deskripsi ?? null,
             'is_active' => $request->is_active == '1' ? 1 : 0,
        ];

        $save = DataUmumDocumentCategory::create($data);

        if ($save) {
            return redirect()->back()->with(['success' => 'Relasi kategori berhasil ditambahkan!']);
        } else {
            return redirect()->back()->with(['error' => 'Gagal menambahkan relasi kategori!']);
        }
    }

    public function edit($id)
    {
        $data = DataUmumDocumentCategory::findOrFail($id);
        $document_categories = DocumentCategory::get();
        $action = 'update';

        return view('admin.data_umum.form', compact('data', 'document_categories', 'action'));
    }

    public function update(Request $request, $id)
    {
        $temp = DataUmumDocumentCategory::findOrFail($id);

        $this->validate($request, [
            'document_category_id' => 'required|exists:document_categories,id',
            'score' => 'nullable|integer',
            'deskripsi' => 'nullable|string',
            'is_active' => 'required|boolean',
        ]);

        $data = [
            'document_category_id' => $request->document_category_id,
            'score' => $request->score ?? 0,
            'deskripsi' => $request->deskripsi ?? null,
            'is_active' => $request->is_active,
        ];

        $save = $temp->update($data);

        if ($save) {
            return redirect()->back()->with(['success' => 'Relasi kategori berhasil diperbarui!']);
        } else {
            return redirect()->back()->with(['error' => 'Gagal memperbarui relasi kategori!']);
        }
    }

    public function destroy($id)
    {
        $temp = DataUmumDocumentCategory::findOrFail($id);
        $delete = $temp->delete();

        if ($delete) {
            return redirect()->back()->with(['success' => 'Relasi kategori berhasil dihapus!']);
        } else {
            return redirect()->back()->with(['error' => 'Gagal menghapus relasi kategori!']);
        }
    }

    public function detailFiles($id)
    {
        $du_dc = DataUmumDocumentCategory::with('details', 'documentCategory')->findOrFail($id);

        return view('admin.du_dc_detail.index', compact('du_dc'));
    }
}
