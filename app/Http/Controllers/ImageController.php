<?php

namespace App\Http\Controllers;

use App\Models\File;
use App\Traits\FileHelper;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    use FileHelper;

    public function show(Request $request, $id)
    {
        $file = File::findOrFail($id);

        $base64String = $file->content;

        return $this->base64Response($base64String);
    }
}
