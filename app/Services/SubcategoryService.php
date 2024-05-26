<?php

namespace App\Services;

use App\Models\File;
use App\Models\Subcategory;
use App\Traits\FileHelper;
use Illuminate\Support\Facades\DB;

class SubcategoryService
{
    use FileHelper;

    public function storeData($request)
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

            $subcategory = Subcategory::create($request + [
                    'icon_id' => $icon_created->id,
                    'created_by' => auth()->id(),
                    'updated_by' => auth()->id()
                ]);

            DB::commit();

            return [
                'status' => 'success',
                'subcategory' => $subcategory,
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

    public function updateData($request, $subcategory): array
    {
        DB::beginTransaction();
        try {

            if (array_key_exists('icon', $request)) {
                $icon = $request['icon'];
                $base64 = $this->toBase64($icon);
                $icon_created = File::create([
                    'filename' => $icon->getClientOriginalName(),
                    'content' => $base64,
                    'filetype' => $icon->getClientMimeType(),
                    'created_by' => auth()->id(),
                ]);
                $request['icon_id'] = $icon_created->id;
            }

            $subcategory->update($request + [
                    'updated_by' => auth()->id()
                ]);
            
            DB::commit();

            return [
                'status' => 'success',
                'subcategory' => $subcategory,
                'icon' => $icon_created ?? null
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
