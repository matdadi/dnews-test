<?php

namespace App\Http\Controllers\CMS;

use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index(): \Illuminate\View\View
    {
        $categories = Category::with('icon')->get();

        return view('cms.category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('cms.category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    {
        Category::create($request->validated() + [
                'icon_id' => 2,
                'created_by' => auth()->id(),
                'updated_by' => auth()->id()
            ]);

        return redirect()->route('cms.category.index')->with('success', 'Category berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {

    }

    public function edit(Category $category)
    {
        return view('cms.category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        $category->update($request->validated() + [
                'icon_id' => 2,
                'updated_by' => auth()->id()
            ]);

        return redirect()->route('cms.category.index')->with('success', 'Category berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        if (!auth()->user()->can('category-delete')) {
            return abort(403);
        }

        if ($category->posts()->exists()) {
            return redirect()->route('cms.category.index')->with('error', 'Category tidak bisa dihapus karena memiliki produk');
        }

        $category->delete();

        return redirect()->route('cms.category.index')->with('success', 'Category berhasil dihapus');
    }
}
