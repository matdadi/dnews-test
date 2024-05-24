<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Models\PostView;
use Illuminate\Http\Request;

class PostViewController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $views = PostView::get();
        return view('cms.post-view', compact('views'));
    }
}
