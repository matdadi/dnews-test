<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class UpdateStatusCategoryController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, Category $category)
    {
        $this->authorize('update', $category);

        $category->update([
            'is_active' => !$category->is_active
        ]);

        return redirect()->route('cms.category.index')->with('success', 'Status kategori berhasil diubah');
    }
}
