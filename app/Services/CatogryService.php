<?php
namespace App\Services;

use App\Http\Resources\CatogryResource;
use App\Models\Catogry\Catogry;

class CatogryService{
    public function getCatogry(){
        $catogries =  Catogry::all();
        return CatogryResource::collection($catogries);
    }

    public function createCatogry($request){
        $catogry = Catogry::create(
            ['title' => $request->title ?? '',
            'description' => $request->description ?? '',]
        );
        return response()->json(['message' => 'Catogry created successfully',
         'catogry' => $catogry],
          200);
    }

    public function getCatogryById($id){
        $catogry = Catogry::find($id);
        return new CatogryResource($catogry);
    }

    public function updateCatogry($request , $id){
        $catogry = Catogry::find($id);
        $catogry->update(
            ['title' => $request->title ?? '',
            'description' => $request->description ?? '',]
        );
        return response()->json(['message' => 'Catogry updated successfully',
         'catogry' => $catogry],
          200);
    }

    public function deleteCatogry($id){
        $catogry = Catogry::find($id);
        if(!$catogry){
            return response()->json(['message' => 'Catogry not found'],
             404);
        }
        $catogry->delete();
        return response()->json(['message' => 'Catogry deleted successfully',
         'catogry' => $catogry],
          200);
    }

    public function restore($id)
    {
        $category = Catogry::withTrashed()->findOrFail($id);  // Ensure it fetches even soft-deleted categories
        $category->restore();
        if ($category) {
            $category->restore();
            return response()->json([
                'message' => 'Category restored successfully'
            ], 200);
        }

        return response()->json([
            'message' => 'Category not found'
        ], 404);
    }

    public function getDeletedCategories(){
        $deletedCategories = Catogry::onlyTrashed()->get();
        return CatogryResource::collection($deletedCategories);
    }

    public function forceDelete($id){
        $category = Catogry::withTrashed()->findOrFail($id);
        $category->forceDelete();
        return response()->json([
            'message' => 'Category deleted permanently'
        ], 200);
    }
}
