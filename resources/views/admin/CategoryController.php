<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
class CategoryController extends Controller
{

    protected $successStatus;
    protected $notfound;
    protected $unauthorisedStatus;
    protected $internalServererror;
    protected $imageUrl;

    protected $dataNotFound;

    protected $baseUrl;


    public function __construct()
    {
        $this->successStatus = 200;
        $this->notfound = 404;
        $this->unauthorisedStatus = 400;
        $this->internalServererror = 500;
        $this->dataNotFound = "Data not found";
        $this->baseUrl = env('STORAGE_URL');
    }


    public function tourCategory()
    {
        $categoryData = DB::table('categories')->select('id','title','image','cat_type','slug')->get();

        if(count($categoryData) > 0)
        {
            return response()->json([
                'status' => $this->successStatus,
                'categoryImage' => $this->baseUrl,
                'data' => $categoryData,
            ], 200);
        }
        else{
            return response()->json([
                'status' => $this->notfound,
                'data' => $this->dataNotFound
            ], 200);
        }

    }
}
