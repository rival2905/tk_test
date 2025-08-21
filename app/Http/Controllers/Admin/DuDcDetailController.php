<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DuDcDetail;
use App\Models\DataUmumDocumentCategory;
use Illuminate\Support\Facades\Storage;

class DuDcDetailController extends Controller
{
    public function index($du_dc_id)
    {
        $du_dc = DataUmumDocumentCategory::with('details', 'documentCategory')->findOrFail($du_dc_id);

        return view('admin.du_dc_detail.index', compact('du_dc'));
    }

    public function store(Request $request, $du_dc_id)
{
    $request->validate([
        'files' => 'required|file|max:10240',
        'score' => 'nullable|integer',
    ]);

    $originalName = $request->file('files')->getClientOriginalName();

    $filePath = $request->file('files')->store('du_dc_files', 'public');

    $save = DuDcDetail::create([
        'du_dc_id' => $du_dc_id,
        'name' => $originalName,
        'files' => $filePath,
        'score' => $request->score ?? 0,
    ]);

    return $save
        ? redirect()->back()->with('success', 'File berhasil ditambahkan!')
        : redirect()->back()->with('error', 'Gagal menambahkan file!');
}

    public function destroy($id)
    {
        $file = DuDcDetail::findOrFail($id);

        if ($file->files && Storage::disk('public')->exists($file->files)) {
            Storage::disk('public')->delete($file->files);
        }

        $delete = $file->delete();

        return $delete
            ? redirect()->back()->with('success', 'File berhasil dihapus!')
            : redirect()->back()->with('error', 'Gagal menghapus file!');
    }
}
