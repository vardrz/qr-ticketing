<?php

namespace App\Http\Controllers;

use App\Models\Barcode;
use Illuminate\Http\Request;

class BarcodeController extends Controller
{
    public function scan()
    {
        return view('scan');
    }

    public function generate()
    {
        $data = Barcode::paginate(10);
        // dd($data);
        return view('generate', [
            "data" => $data
        ]);
    }

    public function result($result = null)
    {
        $decoded = base64_decode($result);
        return view('scan_result', ["data" => $decoded]);
    }
}
