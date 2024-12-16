<?php

namespace App\Http\Controllers\Catogry;

use App\Http\Controllers\Controller;
use App\Services\CatogryService;
use Illuminate\Http\Request;

class CatogryController extends Controller
{
    //

    public function __construct(protected CatogryService $catogryService){}

    public function getCatogry(){
        return $this->catogryService->getCatogry();
    }

    public function createCatogry(Request $request){
        return $this->catogryService->createCatogry($request);
    }

    public function getCatogryById($id){
        return $this->catogryService->getCatogryById($id);
    }

    public function updateCatogry(Request $request , $id){
        return $this->catogryService->updateCatogry($request , $id);
    }

    public function deleteCatogry($id){
        return $this->catogryService->deleteCatogry($id);
    }

    public function restore($id){
        return $this->catogryService->restore($id);
    }

    public function getDeletedCategories(){
        return $this->catogryService->getDeletedCategories();
    }

    public function forceDelete($id){
        return $this->catogryService->forceDelete($id);
    }
}
