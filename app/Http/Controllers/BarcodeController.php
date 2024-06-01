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

    public function generate(Request $request)
    {
        if ($request->has("search")) {
            $data = Barcode::where("code", "like", "%" . $request->search . "%")->paginate(10);
            return view('generate', [
                "data" => $data
            ]);
        }

        $data = Barcode::paginate(10);
        // dd($data);
        return view('generate', [
            "data" => $data
        ]);
    }

    public function result($result = null)
    {
        if ($result == null) {
            return redirect()->route("scan");
        }

        $decoded = base64_decode($result);
        $data = Barcode::where("code", $decoded)->first();

        if ($data["status"] == "unused") {
            Barcode::where("code", $decoded)->update([
                "status" => "used"
            ]);
        }

        // $data = [
        //     "status" => "used"
        // ];

        return view('scan_result', ["data" => $data]);
    }
}
