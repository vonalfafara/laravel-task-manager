<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UploadController extends Controller
{
    function uploadImage(Request $request) {
        $fields = $request->validate([
            "image" => "required|image|mimes:jpeg,png,jpg,gif"
        ]);

        $image_name = time() . "." . $request->image->extension();
        $request->image->move(public_path("image"), $image_name);

        return response()->json([
            "image" => $image_name,
        ], 201, [], JSON_PRETTY_PRINT);
    }
}
