<?php

namespace App\Traits;

use Illuminate\Support\Facades\Response;

trait FileHelper
{
    public function toBase64($file): string
    {
        $path = $file->getRealPath();
        $icon = file_get_contents($path);
        return base64_encode($icon);
    }

    public function base64Response($base64String): \Illuminate\Http\Response
    {
        // Extract the mime type and base64 data
        $matches = [];
        preg_match('/^data:(.*?);base64,(.*)$/', $base64String, $matches);
        $mimeType = $matches[1];
        $base64Data = $matches[2];

        // Decode the base64 string
        $imageData = base64_decode($base64Data);

        if ($imageData === false) {
            return response(['message' => 'Invalid base64 data'], 400);
        }

        // Create a response with the decoded image data
        return Response::make($imageData, 200, [
            'Content-Type' => $mimeType,
            'Content-Disposition' => 'inline; filename="image.' . explode('/', $mimeType)[1] . '"'
        ]);
    }

}
