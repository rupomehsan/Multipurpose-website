<?php

namespace Modules\HotelBooking\Http\Controllers\Tenant\Admin;


use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Modules\CountryManage\Entities\Country;
use Modules\CountryManage\Entities\State;
use Modules\HotelBooking\Entities\BookingInformation;
use Modules\HotelBooking\Entities\Hotel;
use Modules\HotelBooking\Entities\HotelBookingPaymentLog;
use Modules\HotelBooking\Entities\Room;
use Modules\HotelBooking\Entities\RoomType;
use Modules\HotelBooking\Http\Requests\StoreBookingInformationRequest;
use Modules\HotelBooking\Http\Services\BookingServices;
use Modules\HotelBooking\Http\Services\ServicesHelpers;

class HotelBookingController extends Controller
{

    private const BASE_PATH = 'hotel-booking.';
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $bookingInformation = BookingInformation::with(["hotel","room_type","city","booking_payment_log","country"])
            ->orderBy('id','desc')
            ->where('payment_status',0)->get();
        return view("hotelbooking::admin.hotelbooking.index",compact("bookingInformation"));

    }
    public function cancel_booking()
    {
        $bookingInformation = BookingInformation::with(["hotel","room_type","city","booking_payment_log","country"])->orderBy('id','desc')
            ->where('payment_status',4)->orWhere('payment_status',3)->get();

        return view("hotelbooking::admin.hotelbooking.index",compact("bookingInformation"));

    }
    public function approved_booking()
    {
        $bookingInformation = BookingInformation::with(["hotel","room_type","city","booking_payment_log","country"])->orderBy('id','desc')
            ->where('payment_status',1)->get();

        return view("hotelbooking::admin.hotelbooking.index",compact("bookingInformation"));
    }
    public function cancel_requested_booking()
    {
        $bookingInformation = BookingInformation::with(["hotel","room_type","city","booking_payment_log","country"])->orderBy('id','desc')
            ->where('payment_status',4)->get();

        return view("hotelbooking::admin.hotelbooking.index",compact("bookingInformation"));
    }
    public function canceled_booking()
    {
        $bookingInformation = BookingInformation::with(["hotel","room_type","city","booking_payment_log","country"])->orderBy('id','desc')
            ->where('payment_status',3)->get();

        return view("hotelbooking::admin.hotelbooking.index",compact("bookingInformation"));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $countries = Country::select("id","name")->get();
        // get all hotels
        $hotels = Hotel::without(["hotel_amenities","hotel_images"])->select("id","name")->get();

        return view('hotelbooking::admin.hotelbooking.create',compact('countries','hotels'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(StoreBookingInformationRequest $request)
    {
        $booking_sell_info = $request->validated();
        $booking_sell_info['lang'] = $request->lang;
        if(!$booking_sell_info){

            return redirect()->back()->withErrors(["msg" => "Please selecte correct data"]);
        }
        // get all available room base on selected date range
        $available_room = BookingServices::get_available_room($booking_sell_info + ["created_by" => auth("admin")->user()->id]);

        // if room not have then user will be redirected with error message
        if($available_room == null){

            return redirect()->back()->withErrors(['msg' => "Room Not available",'type' => 'danger' ]);
        }
        // now get all inventories list that are available for book
        $inventories_date = BookingServices::get_inventories_by_date_range($booking_sell_info)->toArray();

        // remove last booking date
        array_pop($inventories_date);

        try {
            DB::beginTransaction();

            //Store Booking Information
            $booking_information  = BookingServices::createBookingInformation($booking_sell_info);

            $payment_details = HotelBookingPaymentLog::create([
                'booking_information_id' => $booking_information->id,
                'user_id' => $auth_user->id ?? null,
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->mobile,
                'booking_date'=> $request->booking_date,
                'booking_expiry_date'=> $request->booking_expiry_date,
                'total_amount' => $request->amount,
                'coupon_type' => null,
                'coupon_code' => null,
                'coupon_discount' => null,
                'tax_amount' => null,
                'subtotal' => null,
                'payment_status' => 'pending'
            ]);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();

            Log::error('Error: ' . $e->getMessage());

            return redirect()->back()->with(ServicesHelpers::send_response(false,"create"));
        }

        //RoomInventory create and Inventory update
        $booking_information  =  BookingServices::inventoryCreateAndUpdate($inventories_date, $available_room);

       session()->put(["type"=>"success"]);

       return back()->with(ServicesHelpers::send_response(true,"create"));

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
    public function country_city($country_id)
    {
        // fetch state_id using country id
        $cities = State::where("country_id",$country_id)->get();
        return  response()->json($cities);
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

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function payment_status_updated(Request $request){
        // make validation
        $request->validate([
            "booking_id" => "required",
            "payment_status" => "required"
        ]);

        // update payment status information
        $bool = BookingInformation::where("id",$request->booking_id)->update(["payment_status" => $request->payment_status]);

        return back()->with(ServicesHelpers::send_response($bool,"update"));

    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
    }
    public function hotel_room_type($id){

        // fetch room type using hotel id
        $room_types = RoomType::without(["room_type_amenities","bed_type","hotel"])
            ->where("hotel_id",$id)->get();
        return  response()->json($room_types);
    }
    public function hotel_rooms($id){

        // fetch room type using hotel id
        $hotel_rooms = Room::without(["room_types","room_inventory","room_image"])
            ->where("room_type_id",$id)->get();
        return  response()->json($hotel_rooms);
    }

    public function calculate_amount(Request $request){
        // get all information about inventory price date wise
        $all_info = BookingServices::get_day_wise_room_amount($request);
        $view = view("hotelbooking::admin.hotelbooking.booking-range-table",compact('all_info'))->render();

        return response()->json([
            "success" => true,
            "view" => $view,
            "amount" => array_sum(array_column($all_info,"today_charge"))
        ]);
    }
}
