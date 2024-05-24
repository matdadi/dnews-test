<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index(): \Illuminate\View\View
    {
        $this->authorize('viewAny', Category::class);

        $categories = Category::with('icon')
            ->orderBy('sort', 'desc')
            ->get();

        return view('cms.category.index', compact('categories'));
    }


    public function create()
    {
        $this->authorize('create', Category::class);

        return view('cms.category.create');
    }

    public function store(StoreCategoryRequest $request)
    {
        $this->authorize('create', Category::class);

        Category::create($request->validated() + [
                'icon_id' => 2,
                'created_by' => auth()->id(),
                'updated_by' => auth()->id()
            ]);

        return redirect()->route('cms.category.index')->with('success', 'Category berhasil ditambahkan');
    }

    public function show(Category $category)
    {

    }

    public function edit(Category $category)
    {
        $this->authorize('update', $category);
        return view('cms.category.edit', compact('category'));
    }

    public function update(UpdateCategoryRequest $request, Category $category)
    {
        $this->authorize('update', $category);

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
        $this->authorize('delete', $category);

        $category->delete();

        return redirect()->route('cms.category.index')->with('success', 'Category berhasil dihapus');
    }
}
