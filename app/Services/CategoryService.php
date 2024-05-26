<?php

namespace App\Services;

use App\Models\Category;
use App\Models\File;
use App\Traits\FileHelper;
use Illuminate\Support\Facades\DB;

class CategoryService
{
    use FileHelper;

    public function storeData($request): array
    {
        DB::beginTransaction();

        try {
            $icon = $request['icon'];
            $base64 = $this->toBase64($icon);

            $icon_created = File::create([
                'filename' => $icon->getClientOriginalName(),
                'content' => $base64,
                'filetype' => $icon->getClientMimeType(),
                'created_by' => auth()->id(),
            ]);

            $category = Category::create($request + [
                    'icon_id' => $icon_created->id,
                    'created_by' => auth()->id(),
                    'updated_by' => auth()->id()
                ]);


            DB::commit();

            return [
                'status' => 'success',
                'category' => $category,
                'icon' => $icon_created
            ];

        } catch (\Exception $e) {
            DB::rollBack();

            return [
                'status' => 'error',
                'message' => $e->getMessage()
            ];

        }
    }

    public function updateData($request, $category): array
    {
        DB::beginTransaction();

        try {
            if (array_key_exists('icon', $request)) {
                $icon = $request['icon'];
                $base64 = $this->toBase64($icon);

                $category->icon->update([
                    'filename' => $icon->getClientOriginalName(),
                    'content' => $base64,
                    'filetype' => $icon->getClientMimeType(),
                ]);
            }

            $category->update($request);

            DB::commit();

            return [
                'status' => 'success',
                'category' => $category
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
