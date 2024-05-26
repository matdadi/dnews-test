<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;
use App\Services\CategoryService;
use App\Traits\FileHelper;

class CategoryController extends Controller
{
    use FileHelper;

    protected CategoryService $service;

    public function __construct(CategoryService $service)
    {
        $this->service = $service;
    }

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

    public function store(StoreCategoryRequest $request): \Illuminate\Http\RedirectResponse
    {
        $this->authorize('create', Category::class);

        $store = $this->service->storeData($request->validated());

        if ($store['status'] === 'error') {
            return redirect()->back()->with('error', $store['message'])->withInput();
        }

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

        $update = $this->service->updateData($request->validated(), $category);

        if ($update['status'] === 'error') {
            return redirect()->back()->with('error', $update['message'])->withInput();
        }

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
