<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Models\Subcategory;
use Illuminate\Http\Request;

class UpdateStatusSubcategoryController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, Subcategory $subcategory)
    {
        $this->authorize('update', $subcategory);

        $subcategory->update([
            'is_active' => !$subcategory->is_active
        ]);

        return redirect()->route('cms.subcategory.index')->with('success', 'Status subkategori berhasil diubah');
    }
}
