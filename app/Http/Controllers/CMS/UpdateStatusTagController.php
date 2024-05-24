<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use Illuminate\Http\Request;

class UpdateStatusTagController extends Controller
{
   
    public function __invoke(Request $request, Tag $tag)
    {
        $this->authorize('update', $tag);

        $tag->update([
            'is_active' => !$tag->is_active
        ]);

        return redirect()->route('cms.tag.index')->with('success', 'Status tag berhasil diubah');
    }
}
