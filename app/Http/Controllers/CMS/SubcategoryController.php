<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSubcategoryRequest;
use App\Http\Requests\UpdateSubcategoryRequest;
use App\Models\Category;
use App\Models\Subcategory;
use App\Services\SubcategoryService;

class SubcategoryController extends Controller
{
    protected SubcategoryService $service;

    public function __construct(SubcategoryService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        $this->authorize('viewAny', Subcategory::class);

        $subcategories = Subcategory::get();

        return view('cms.subcategory.index', compact('subcategories'));
    }


    public function create()
    {
        $this->authorize('create', Subcategory::class);

        $categories = Category::where('is_active', true)->get();

        return view('cms.subcategory.create', compact('categories'));
    }


    public function store(StoreSubcategoryRequest $request)
    {
        $this->authorize('create', Subcategory::class);

        $this->service->storeData($request->validated());

        return redirect()->route('cms.subcategory.index');
    }


    public function show(Subcategory $subcategory)
    {
        return abort(404);
    }


    public function edit(Subcategory $subcategory)
    {
        if (!auth()->user()->can('subcategory-update')) {
            abort(403);
        }

        $categories = Category::get();

        return view('cms.subcategory.edit', compact('subcategory', 'categories'));
    }


    public function update(UpdateSubcategoryRequest $request, Subcategory $subcategory)
    {
        if (!auth()->user()->can('subcategory-update')) {
            abort(403);
        }

        $update = $this->service->updateData($request->validated(), $subcategory);

        if ($update === 'error') {
            return redirect()->back()->with('error', $update['message'])->withInput();
        }

        return redirect()->route('cms.subcategory.index')->with('success', 'Subcategory berhasil diupdate');
    }


    public function destroy(Subcategory $subcategory)
    {
        if (!auth()->user()->can('subcategory-delete')) {
            abort(403);
        }

        $subcategory->delete();

        return redirect()->route('cms.subcategory.index');
    }
}
