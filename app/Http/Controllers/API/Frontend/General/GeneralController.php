<?php

namespace App\Http\Controllers\API\Frontend\General;

use App\Models\Stall\Stall;
use App\Models\Ads\Ads;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Stall\StallAds;
use App\Http\Resources\Backend\Stall\StallAdsResource;
use App\Http\Resources\Backend\Ads\AdsResource;
use App\Models\EventCategory\EventCategory;
use App\Models\EventCategory\EventSubCategory;
use App\Http\Resources\Backend\Stall\StallResource;
use App\Http\Resources\Frontend\AllCategory\ESCResource;
use App\Http\Resources\Backend\EventCategory\EventCategoryResource;
use App\Http\Resources\Backend\EventCategory\EventSubCategoryResource;

class GeneralController extends Controller
{
    public function eventCategory()
    {
        $eventCategory = EventCategory::all();
        return EventCategoryResource::collection($eventCategory);
    }

    public function eventSubCategory()
    {
        $eventSubCategory = EventSubCategory::all();
        return EventSubCategoryResource::collection($eventSubCategory);
    }

    public function subCategory()
    {
        $data = EventSubCategory::all();
        return ESCResource::collection($data);
    }

    public function getStall(Request $request)
    {
        $data = Stall::where('id', $request->stall_id)->first();
        return new StallResource($data);
    }
    
    public function getLobbyAds(){
        $ads = Ads::all();
        return AdsResource::collection($ads);
    }

    public function getExhibitionAds(){
        $ads = Ads::all();
        return AdsResource::collection($ads);
    }

    public function showAdsstall(){
        $stallads = StallAds::all();
        return StallAdsResource::collection($stallads);
    }

    public function searchStalls(){
        $searchstalls = Stall::all();
        return StallResource::collection($searchstalls);
    }
   
}
