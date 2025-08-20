<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DataUmum;

class DataUmumController extends Controller
{
    //
    public function index()
    {
        $data_umums = DataUmum::get()->take(10);
        // dd($data_umums);
        return view('admin.data_umum.index', compact('data_umums'));

    }
}
