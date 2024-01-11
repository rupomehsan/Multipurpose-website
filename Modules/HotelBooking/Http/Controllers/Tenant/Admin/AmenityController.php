<?php

namespace Modules\HotelBooking\Http\Controllers\Tenant\Admin;

use Illuminate\Routing\Controller;
use Modules\HotelBooking\Entities\Amenity;
use Modules\HotelBooking\Http\Requests\AmenityRequest;
use Modules\HotelBooking\Http\Services\AmenityService;
use Modules\HotelBooking\Http\Services\ServicesHelpers;

class AmenityController extends Controller
{
    public function index()
    {
        $all_amenities = Amenity::orderBy('id','desc')->get();
        return view('hotelbooking::admin.amenity.index',compact('all_amenities'));
    }

    public function create()
    {
        return view('hotelbooking::admin.amenity.create');
    }

    public function store(AmenityRequest $request)
    {
        $data = $request->validated();
        $data['lang'] = $request->lang;
        $bool = AmenityService::createOrUpdate($data);
        return redirect(route('tenant.admin.amenities.index'))->with(ServicesHelpers::send_response($bool,'create'));
    }

    public function edit($id)
    {
        $amenity = Amenity::findOrFail($id);
        return view('hotelbooking::admin.amenity.edit',compact('amenity'));
    }

    public function update(AmenityRequest $request, $id)
    {
        $data = $request->validated();
        $data['lang'] = $request->lang;
        $amenity = Amenity::findOrFail($id);
        $bool = AmenityService::createOrUpdate($data,$amenity);
        return redirect(route('tenant.admin.amenities.index'))->with(ServicesHelpers::send_response($bool,'create'));
    }

    public function destroy($id)
    {
        $amenity = Amenity::findOrFail($id);
        $bool = $amenity->delete();
        return response()->json(["success" => $bool]);
    }
}
