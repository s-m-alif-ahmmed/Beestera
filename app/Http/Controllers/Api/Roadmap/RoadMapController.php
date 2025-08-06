<?php

namespace App\Http\Controllers\Api\Roadmap;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Models\RoadMap;
use Illuminate\Support\Benchmark;

class RoadMapController extends Controller
{
    use ApiResponse;
    public function movement_index()
    {

        $movement = RoadMap::where('category' , 'MOVEMENT')->where('status' , 'active')->get();

        if(!$movement){
            return $this->error("Data not found!", 500);
        }

        return $this->success("Fetched Movement Data Successfully", $movement, 200);
    }
    public function manipulation_index()
    {

        $manipulation = RoadMap::where('category' , 'MANIPULATION')->where('status' , 'active')->get();

        if(!$manipulation){
            return $this->error("Data not found!", 500);
        }

        return $this->success("Fetched Manipulation Data Successfully", $manipulation, 200);
    }
    public function control_index()
    {

        $control = RoadMap::where('category' , 'CONTROL')->where('status' , 'active')->get();

        if(!$control){
            return $this->error("Data not found!", 500);
        }

        return $this->success("Fetched Control Data Successfully", $control, 200);
    }
    public function striking_index()
    {

        $striking = RoadMap::where('category' , 'STRIKING')->where('status' , 'active')->get();

        if(!$striking){
            return $this->error("Data not found!", 500);
        }

        return $this->success("Fetched Striking Data Successfully", $striking, 200);
    }
}
