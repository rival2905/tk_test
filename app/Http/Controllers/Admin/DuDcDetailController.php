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
        'files' => 'required|file|mimes:pdf,doc,docx,xls,xlsx|max:5120', // max 5MB misalnya
        'score' => 'required|integer|min:0|max:100',
    ]);

    $file = $request->file('files');
    $filename = time().'_'.$file->getClientOriginalName();
    $path = $file->storeAs('uploads/du_dc_details', $filename, 'public');

    DuDcDetail::create([
        'du_dc_id' => $du_dc_id,
        'name'     => $file->getClientOriginalName(),
        'files'    => $path,
        'score'    => $request->score,
    ]);

    $this->updateAverageScore($du_dc_id);

    return redirect()->back()->with('success', 'File berhasil ditambahkan.');
}


   public function destroy($id)
{
    $file = DuDcDetail::findOrFail($id);
    $du_dc_id = $file->du_dc_id;

    if ($file->files && Storage::disk('public')->exists($file->files)) {
        Storage::disk('public')->delete($file->files);
    }

    $file->delete();

    $this->updateAverageScore($du_dc_id);

    return redirect()
        ->route('admin.du-dc.index', $du_dc_id)
        ->with('success', 'File berhasil dihapus!');
}

    private function updateAverageScore($du_dc_id)
    {
        $du_dc = DataUmumDocumentCategory::findOrFail($du_dc_id);
        $avgScore = $du_dc->details()->avg('score') ?? 0;
        $du_dc->update(['score' => round($avgScore)]);
    }
}
