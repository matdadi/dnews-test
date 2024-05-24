<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTagRequest;
use App\Http\Requests\UpdateTagRequest;
use App\Models\Tag;

class TagController extends Controller
{
    public function index(): \Illuminate\View\View
    {
        $this->authorize('viewAny', Tag::class);

        $tags = Tag::get();
        return view('cms.tag.index', compact('tags'));
    }

    public function create(): \Illuminate\View\View
    {
        $this->authorize('create', Tag::class);

        return view('cms.tag.create');
    }

    public function store(StoreTagRequest $request)
    {
        $this->authorize('create', Tag::class);

        Tag::create($request->validated() + [
                'created_by' => auth()->id(),
                'updated_by' => auth()->id()
            ]);

        return redirect()->route('cms.tag.index')->with('success', 'Tag berhasil dibuat');
    }


    public function show(Tag $tag)
    {
        return abort(404);
    }


    public function edit(Tag $tag): \Illuminate\View\View
    {
        $this->authorize('update', $tag);
        return view('cms.tag.edit', compact('tag'));
    }

    public function update(UpdateTagRequest $request, Tag $tag): \Illuminate\Http\RedirectResponse
    {
        $this->authorize('update', $tag);

        $tag->update($request->validated() + [
                'updated_by' => auth()->id()
            ]);

        return redirect()->route('cms.tag.index')->with('success', 'Tag berhasil diubah');
    }

    public function destroy(Tag $tag): \Illuminate\Http\RedirectResponse
    {
        $this->authorize('delete', $tag);

        $tag->delete();

        return redirect()->route('cms.tag.index')->with('success', 'Tag berhasil dihapus');
    }
}
