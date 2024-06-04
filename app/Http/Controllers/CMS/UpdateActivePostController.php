<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class UpdateActivePostController extends Controller
{
    public function __invoke(Request $request, Post $post)
    {
        $this->authorize('update', $post);

        $post->update([
            'is_active' => !$post->is_active
        ]);

        return redirect()->route('cms.post.index')->with('success', 'Status active post berhasil diubah');
    }
}
