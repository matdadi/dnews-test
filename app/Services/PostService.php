<?php

namespace App\Services;

use App\Models\File;
use App\Models\Post;
use App\Traits\FileHelper;
use Illuminate\Support\Facades\DB;

class PostService
{
    use FileHelper;

    public function storeData($request): array
    {
        DB::beginTransaction();

        try {

            $image = $request['image'];
            $base64 = $this->toBase64($image);

            $image_created = File::create([
                'filename' => $image->getClientOriginalName(),
                'content' => $base64,
                'filetype' => $image->getClientMimeType(),
                'created_by' => auth()->id(),
            ]);

            $post = Post::create($request + [
                    'image_id' => $image_created->id,
                    'created_by' => auth()->id(),
                    'updated_by' => auth()->id()
                ]);

            DB::commit();

            return [
                'status' => 'success',
                'post' => $post
            ];

        } catch (\Exception $e) {
            DB::rollBack();

            return [
                'status' => 'error',
                'message' => $e->getMessage()
            ];
        }
    }

    public function updateData($request, $post): array
    {
        DB::beginTransaction();

        try {
            if (array_key_exists('image', $request)) {
                $image = $request['image'];
                $base64 = $this->toBase64($image);

                $post->image->update([
                    'filename' => $image->getClientOriginalName(),
                    'content' => $base64,
                    'filetype' => $image->getClientMimeType()
                ]);
            }

            $post->update($request + [
                    'updated_by' => auth()->id()
                ]);

            DB::commit();

            return [
                'status' => 'success',
                'post' => $post
            ];

        } catch (\Exception $e) {
            DB::rollBack();

            return [
                'status' => 'error',
                'message' => $e->getMessage()
            ];
        }
    }

    public function deleteData($post): array
    {
        DB::beginTransaction();

        try {
            $post->delete();

            DB::commit();

            return [
                'status' => 'success',
                'post' => $post
            ];

        } catch (\Exception $e) {
            DB::rollBack();

            return [
                'status' => 'error',
                'message' => $e->getMessage()
            ];
        }
    }
}
