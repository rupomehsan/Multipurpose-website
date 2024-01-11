<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Brand;
use App\Models\PaymentLogs;
use App\Models\PricePlan;
use App\Models\Testimonial;
use App\Models\User;
use Illuminate\Http\Request;
// use Analytics;
use Spatie\Analytics\Period;

class AnalyticsController extends Controller
{
    private const BASE_VIEW_PATH = 'landlord.admin.';
    public function __construct()
    {
        $this->middleware('permission:google-analytics', ['only' => ['analytics']]);
        $this->middleware('permission:google-search-console',['only' => ['searchConsole']]);
        $this->middleware('permission:google-tag-manager',['only' => ['tagManager']]);
        $this->middleware('permission:google-ad-manager',['only' => ['adManager']]);
        $this->middleware('permission:google-settings-update',['only' => ['googleSettingsUpdate']]);
        // $this->middleware('permission:page-edit',['only' => ['edit_page','update']]);
        // $this->middleware('permission:page-delete',['only' => ['delete']]);
    }

    public function analytics()
    {
        //fetch visitors and page views for the past week
        $visitors = \Analytics::fetchVisitorsAndPageViews(Period::days(7));
        $total_admin = Admin::count();
        $total_user = User::count();
        $all_blogs = 0; //Blog::count() ?? 0;
        $total_price_plan = PricePlan::count();
        $total_brand = Brand::all()->count();
        $total_testimonial = Testimonial::all()->count();
        $recent_order_logs = PaymentLogs::orderBy('id', 'desc')->take(5)->get();

        return view(self::BASE_VIEW_PATH . 'google.analytics', compact('total_admin', 'total_user', 'all_blogs', 'total_brand', 'total_price_plan', 'total_testimonial', 'recent_order_logs'));
    }
    public function searchConsole(){
        return view('landlord.admin.google.search-console');
    }
    public function tagManager(){
        return view(self::BASE_VIEW_PATH . 'google.tag-manager');
    }
    
    public function adManager(){
        return view(self::BASE_VIEW_PATH . 'google.ad-manager');
    }
    public function googleSettingsUpdate(Request $request){
        $fields = array_keys($request->except('_token'));
        
        foreach($fields as $field){
            update_static_option($field, $request[$field]);
        }
        return redirect()->back()->with(['msg' => __('Google Settings Updated..'), 'type' => 'success']);
    }
}
