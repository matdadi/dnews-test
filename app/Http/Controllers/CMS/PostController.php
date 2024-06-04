<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Post;
use App\Models\Subcategory;
use App\Services\PostService;

class PostController extends Controller
{
    protected PostService $service;

    public function __construct(PostService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        $this->authorize('viewAny', Post::class);

        $posts = Post::get();
        return view('cms.post.index', compact('posts'));
    }

    public function create()
    {
        $this->authorize('create', Post::class);

        $subcategories = Subcategory::get();
        $subcategories->load('category');

        return view('cms.post.create', compact('subcategories'));
    }


    public function store(StorePostRequest $request)
    {
        $this->authorize('create', Post::class);

        $response = $this->service->storeData($request->validated());

        if ($response['status'] === 'success') {
            return redirect()->route('cms.post.index')->with('success', 'Post created successfully');
        }

        return back()->with('error', $response['message']);
    }


    public function show(Post $post)
    {
        return abort(404);
    }


    public function edit(Post $post)
    {
        $this->authorize('update', $post);
        $subcategories = Subcategory::get();
        $subcategories->load('category');

        return view('cms.post.edit', compact('post', 'subcategories'));
    }


    public function update(UpdatePostRequest $request, Post $post)
    {
        $this->authorize('update', $post);

        $response = $this->service->updateData($request->validated(), $post);

        if ($response['status'] === 'success') {
            return redirect()->route('cms.post.index')->with('success', 'Post updated successfully');
        }

        return back()->with('error', $response['message']);
    }


    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);

        $response = $this->service->deleteData($post);

        if ($response['status'] === 'success') {
            return redirect()->route('cms.post.index')->with('success', 'Post deleted successfully');
        }

        return back()->with('error', $response['message']);
    }
}
