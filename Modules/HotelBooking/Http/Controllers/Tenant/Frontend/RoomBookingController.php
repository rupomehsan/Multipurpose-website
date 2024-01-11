<?php

namespace Modules\HotelBooking\Http\Controllers\Tenant\Frontend;


use Carbon\Carbon;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\CountryManage\Entities\Country;
use Modules\HotelBooking\Entities\Amenity;
use Modules\HotelBooking\Entities\Hotel;
use Modules\HotelBooking\Entities\HotelReview;
use Modules\HotelBooking\Entities\Room;
use Modules\HotelBooking\Http\Services\BookingServices;
use Modules\HotelBooking\Http\Services\RoomSearchService;


class RoomBookingController extends Controller
{
    private const BASE_PATH = 'hotel-booking.';

    public function hotel_details($slug)
    {
        $hotel_details = Hotel::where('status',1)->where('slug',$slug)->first();
        return themeView(self::BASE_PATH.'hotel-details',compact('hotel_details'));
    }

    public function search_room(Request $request)
    {
       $search_data = $request->all();
        if($request->check_in && $request->check_out){
            session()->put(['search_data' => $search_data]);
        }else
        {
            session()->forget("search_data");
        }

       // pass all rooms, if search available pass filtered room
        $all_rooms = !empty(\request()->all()) ?
        RoomSearchService::search($search_data):
        Room::orderBy("id","DESC")->with("room_types","room_types.country","room_types.state")->paginate(4);
        $ratting = $request->ratting ? $request->ratting : '';
        $all_amenities = Amenity::get();

        return themeView(self::BASE_PATH.'room-search',compact('all_rooms','search_data','all_amenities','ratting'));
    }


    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('hotelbooking::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        //
    }

    public function confirmation(Request $request)
    {
        return themeView(self::BASE_PATH.'confirmation');
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('hotelbooking::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('hotelbooking::edit');
    }

    public function room_details($slug)
    {
        $search_room_data = session("search_data");
        $room = Room::with('room_types','room_image','room_types.hotel','room_types.country','room_types.state')->withCount('reviews')->where('slug',$slug)->first();
        $room_type_id = $room->room_types->id;

        $related_rooms = Room::whereHas('room_types',function($query) use($room_type_id)
        {
            $query->where('room_type_id',$room_type_id);
        })
        ->where('id','!=',$room->id)
//        ->whereNot('id',$room->id)
        ->with('room_types.country','room_types.state')
        ->get();
        $hotel_room_reviews = HotelReview::where('room_id',$room->id)->get();

        $reviewAvailability = BookingServices::reviewAvailability($room_type_id);

        return themeView(self::BASE_PATH.'room-details',compact('room','related_rooms','search_room_data','hotel_room_reviews','reviewAvailability'));
    }

    public function checkout(Request $request)
    {
       // Checking available room quantity bas on search date range
        $booking_sell_info = [
            'booking_date'=>$request->from_date,
            'booking_expiry_date' => $request->to_date,
            'room_type_id' => $request->room_type_id
        ];
       $inventories = BookingServices::get_inventories_by_date_range($booking_sell_info);

        $check_in_obj = Carbon::parse($request->from_date);
        $check_out_obj = Carbon::parse($request->to_date);

        $diff1 = $check_in_obj->lessThan(Carbon::today());
        $diff2 = $check_out_obj->lessThan($check_in_obj);
        $diff3 = $check_out_obj->equalTo($check_in_obj);

        if(!$request->from_date || !$request->to_date || !$request->person || !$request->children){
            return response()->json([
                'type' => 'worning',
                'warning_msg' => __('Please fill all data correctly'),
            ]);
        }

        if($diff1 || $diff2 || $diff3) {
            return response()->json([
                'type' => 'worning',
                'warning_msg' => __('Please Select Correct Date Range ')
            ]);
        }
           $room = Room::with('inventory','room_types','room_inventory.inventories')->where('id',$request->room_id)->first();

            if(!($request->room_type_person >= $request->person)){
                return response()->json([
                    'type' => 'worning',
                    'warning_msg' => __('Maximum Adult'.' '.$room->room_types->max_adult)
                ]);
            }
           if(!($request->room_type_children >= $request->children)){
                return response()->json([
                    'type' => 'working',
                    'warning_msg' => __('Maximum Children'.' '.$request->room_type_children)
                ]);
           }

        foreach ($inventories as $item){
            if($request->room > $item->available_room){
                return response()->json([
                    'type' => 'worning',
                    'warning_msg' => __('Max Room Available for this date range'.' '.$item->available_room)
                ]);
            }
        }
           $booking_sell_info = [
               "room_type_id" => $request->room_type_id,
               "booking_date" => $request->from_date,
               "booking_expiry_date" => $request->to_date
           ];

        // get available room data
        $available_room = BookingServices::get_available_room($booking_sell_info + ["created_by" => auth("admin")->user()->id]);

        if($available_room == null){
            return response()->json([
                'type' => 'worning',
                'warning_msg' => __('No Room Available for this date range')
            ]);
        }
        $request['room_type_id'] = $request->room_type_id;
        $all_info = BookingServices::get_day_wise_room_amount($request);
        $data = $request->all();
        $data['hotel_id'] = $request->hotel_id;
        $per_room_amount = array_sum(array_column($all_info,"today_charge"));
        $data['total_amount'] = $per_room_amount * $request->room;
        $data['room_details'] = Room::with('room_image','room_types')->where('id',$request->room_id)->first();
        $data['countries'] = Country::get();
        session(['data' => $data]);
        return response()->json(['redirect_url' => route('tenant.frontend.checkout-view'),'data'=> $data]);
    }

    public  function checkout_view(){
        return  themeView(self::BASE_PATH.'checkout');
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function price_filter(Request $request)
    {
        dd($request->all());
    }

    public function destroy($id)
    {
        //
    }
}
