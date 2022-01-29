<?php

namespace App\Http\Controllers\API\Backend\Stall;

use Auth;

use App\Models\Company\CompanyUser;
use App\Models\Stall\Stall;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Company\Company;
use App\Models\Stall\StallLayout;
use App\Http\Controllers\Controller;
use App\Models\EventCategory\EventSubCategory;
use App\Http\Requests\Backend\Stall\StallRequest;
use App\Http\Resources\Backend\Stall\StallResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class StallController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index(Request $request): AnonymousResourceCollection
    {
       
        $companyId = CompanyUser::where('user_id', Auth::user()->id)->first()->company_id;
       
        $search = $request->search;
        $dataSorting = $request->sorting == 'false'?10:$request->sorting;
        $data =$search == 'false'?Stall::where('company_id', $companyId)->orderBy('id', 'desc')->paginate($dataSorting):Stall::where('company_id', $companyId)->where(function($query) use($search){
            $query->orWhere('stall_name', 'LIKE', "%{$search}%")
            ->orWhere('brand_name', 'LIKE', "%{$search}%")
            ->orWhere('manufacturer_name', 'LIKE', "%{$search}%")
            ->orWhere('open_time', 'LIKE', "%{$search}%")
            ->orWhere('close_time', 'LIKE', "%{$search}%")
            ->orWhere('stall_brochure', 'LIKE', "%{$search}%")
            ->orWhere('stall_description', 'LIKE', "%{$search}%")
            ->orWhere('stall_live_boardcust', 'LIKE', "%{$search}%")
            ->orWhere('stall_announcement', 'LIKE', "%{$search}%");
        })->orderBy('id', 'desc')->paginate($dataSorting);

        $eventSubCategories = EventSubCategory::select('id', 'event_sub_category_name')->get();
        $companyId = CompanyUser::where('user_id', Auth::user()->id)->first()->company_id;
        $companyName = Company::where('id', $companyId)->select('id', 'company_name')->get();
        $stallLayout = StallLayout::where('company_id', $companyId)->select('id', 'layout_name')->get();
        $stall = Stall::where('company_id', $companyId)->get();

        return StallResource::collection($data)->additional([
            'eventSubCategories' => $eventSubCategories , 
            'companyName' => $companyName,
            'stallLayout' => $stallLayout,
            'stall' => $stall
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StallRequest $request
     * @return StallResource
     */
    public function store(StallRequest $request): StallResource
    {
        
        $stall                        = new Stall();
        $stall->company_id            = $request->company_id;
        $stall->stall_layout_id       = $request->stall_layout_id;
        $stall->event_sub_category_id = $request->event_sub_category_id;
        $stall->stall_name            = $request->stall_name;
        $stall->brand_name            = $request->brand_name;
        $stall->manufacturer_name     = $request->manufacturer_name;
        $stall->open_time             = $request->open_time;
        $stall->close_time            = $request->close_time;
        $stall->stall_brochure        = $request->stall_brochure;
        $stall->stall_description     = $request->stall_description;
        $stall->stall_live_boardcust  = $request->stall_live_boardcust;
        $stall->stall_announcement    = $request->stall_announcement;
        $stall->status                = $request->status;
        $stall->created_by            = Auth::id();

        if ($stall->save()){
            return new StallResource($stall);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return StallResource
     */
    public function show(int $id): StallResource
    {
        $stall = Stall::findOrFail($id);
        return new StallResource($stall);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param StallRequest $request
     * @param int $id
     * @return StallResource
     */
    public function update(StallRequest $request, int $id): StallResource
    {
        $stall = Stall::findOrFail($id);
        $stall->company_id = $request->company_id;
        $stall->stall_layout_id = $request->stall_layout_id;
        $stall->event_sub_category_id = $request->event_sub_category_id;
        $stall->stall_name = $request->stall_name;
        $stall->brand_name = $request->brand_name;
        $stall->manufacturer_name = $request->manufacturer_name;
        $stall->open_time = $request->open_time;
        $stall->close_time = $request->close_time;
        $stall->stall_brochure = $request->stall_brochure;
        $stall->stall_description = $request->stall_description;
        $stall->stall_live_boardcust = $request->stall_live_boardcust;
        $stall->stall_announcement = $request->stall_announcement;
        $stall->status = $request->status;
        $stall->created_by = $request->created_by;
        $stall->updated_by = Auth::user()->id;

        if ($stall->save()){
            return new StallResource($stall);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return StallResource
     */
    public function destroy(int $id): StallResource
    {
        $stall = Stall::findOrFail($id);
        if ($stall->delete()){
            return new StallResource($stall);
        }
    }
}
