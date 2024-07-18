<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\HotelBooking;
use App\Models\MiscBooking;
use App\Models\Remark;
use App\Models\TourBooking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class BookingController extends Controller
{
    public function index(Request $request, Booking $bookings)
    {
        if($request->ajax())
        {
            $bookings = $bookings::with('agent')->select('bookings.*')->orderBy('id','DESC');
            return DataTables::eloquent($bookings)
                        ->editColumn('name', function ($booking) {
                            return $booking->name;
                        })
                        ->editColumn('agent', function ($booking) {
                            return $booking->agent->agency_name ;
                        })
                        ->editColumn('start_date', function ($booking) {
                            return $booking->start_date;
                        })
                        ->editColumn('currency', function ($booking) {
                            return $booking->currency;
                        })
                        ->editColumn('amount', function ($booking) {
                            return $booking->amount;
                        })
                       ->addColumn('action', function (Booking $booking) {
                            $editBtn = '<div class="dropdown"><a class="btn btn-user font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                                        <i class="dw dw-more"></i></a><div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">';
                            $editBtn .= '<a href="javascript:;" class="dropdown-item fill_data" data-url="'.route('admin.booking.edit',$booking->id).'" data-method="get"><i class="dw dw-edit2"></i> Edit</a>';
                            $editBtn .= '<a class="dropdown-item" href="'.route('admin.booking.show',$booking->id).'"><i class="dw dw-edit2"></i> Add Services</a>';
                            $editBtn .= '<a class="dropdown-item" href="'.route('admin.booking.cp',$booking->id).'"><i class="dw dw-edit2"></i> Costing & Payment</a>';
                            $editBtn .= '<a href="javascript:;" class="dropdown-item btn-delete" data-url="'.route('admin.booking.delete',$booking->id).'" data-method="delete"><i class="dw dw-delete-3"></i> Delete</a></div>';
                            return $editBtn;

                        })
                        ->toJson();
        }
        else {
            return view()->make('admin.booking.index');
        }
    }
    public function create(Request $request)
    {
        return view()->make('admin.booking.add',compact('request'));
    }
    public function store(Request $request)
    {
        $rules = array(
            'agent_id' => 'required',
            'name' => 'required',
            'no_of_passengers' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'currency' => 'required',
            'amount' => 'required',
            'contact' => 'required',
            'email' => 'required',
            'status' => 'required',
            );
        $messages = [
            'agency_id.required' => 'Please select agency.',
            'currency.required' => 'Please select currency.',
            'amount.required' => 'Please enter amount.',
            'name.required' => 'Please enter name.',
            'no_of_passengers.required' => 'Please enter no_of_passengers.',
            'start_date.required' => 'Please enter start date.',
            'end_date.required' => 'Please enter end date.',
            'contact.required' => 'Please Enter Contact Number',
            'email.required' => 'Please Enter email',
            'status.required' => 'Please select email',
            ];
            $validator = Validator::make($request->all(), $rules, $messages);
            if ($validator->fails())
            {
                return response()->json($validator->getMessageBag()->toArray(), 422);
            }
            try{
                $booking=New Booking();
                $booking->agent_id=$request->get('agent_id');
                $booking->name=$request->get('name');
                $booking->no_of_passengers=$request->get('no_of_passengers');
                $booking->start_date=$request->get('start_date');
                $booking->end_date=$request->get('end_date');
                $booking->currency=$request->get('currency');
                $booking->amount=$request->get('amount');
                $booking->contact=$request->get('contact');
                $booking->email=$request->get('email');
                $booking->status=$request->get('status');
                $booking->save();
                return response()->json(['success','Booking created successfully.'], 200);
            }
            catch(\Exception $e)
            {
              return response()->json(["error" => "Something went wrong, Please try after sometime."], 422);
            }
    }
    public function show($id)
    {
        $booking = Booking::with('agent')->findOrFail($id);
        return view('admin.booking.services', compact('booking'));
    }
    public function cp($id)
    {
        $booking = Booking::with('agent')->findOrFail($id);
        $miscbookings = MiscBooking::where('booking_id', $id)->get();
        return view('admin.booking.cp', compact('booking', 'miscbookings'));
    }
    public function edit($id)
    {
        $booking = Booking::find($id);
        return view()->make('admin.booking.edit',compact('booking'));
    }
    public function update(Request $request, $id)
    {
        try{
            $booking=Booking::find($id);
            $booking->agent_id=$request->get('agent_id');
            $booking->name=$request->get('name');
            $booking->no_of_passengers=$request->get('no_of_passengers');
            $booking->start_date=$request->get('start_date');
            $booking->end_date=$request->get('end_date');
            $booking->currency=$request->get('currency');
            $booking->amount=$request->get('amount');
            $booking->contact=$request->get('contact');
            $booking->email=$request->get('email');
            $booking->status=$request->get('status');
            $booking->save();
            return response()->json(['success','Booking updated successfully.'], 200);
        }
        catch(\Exception $e)
        {
          return response()->json(["error" => "Something went wrong, Please try after sometime."], 422);
        }
    }
    public function destroy($id)
    {
        try
        {
            $booking = Booking::find($id);
            $booking->delete();
            return response()->json(['success','Booking deleted successfully'], 200);
        }
        catch(\Exception $e)
        {
            return response()->json(["error" => "Something went wrong, Please try after sometime."], 422);
        }
    }
    public function hotelbooking(Request $request, $booking_id){
        if ($request->ajax()) {
            $hotelbookings = HotelBooking::with('hotel')->select('hotel_bookings.*')->where('booking_id', $booking_id)->orderBy('id', 'DESC');
            return DataTables::eloquent($hotelbookings)
                ->editColumn('hotel', function ($hotelbooking) {
                    return $hotelbooking->hotel->name;
                })
                ->editColumn('check_in', function ($hotelbooking) {
                    return $hotelbooking->check_in;
                })
                ->editColumn('check_out', function ($hotelbooking) {
                    return $hotelbooking->check_out;
                })
                ->editColumn('no_of_rooms', function ($hotelbooking) {
                    return $hotelbooking->no_of_rooms;
                })
                ->editColumn('type', function ($hotelbooking) {
                    return $hotelbooking->type;
                })
                ->editColumn('meal_plan', function ($hotelbooking) {
                    return $hotelbooking->meal_plan;
                })
                ->editColumn('voucher_ref', function ($hotelbooking) {
                    return $hotelbooking->voucher_ref;
                })
                ->addColumn('action', function (HotelBooking $hotelbooking) {
                    $editBtn = '<div class="dropdown"><a class="btn btn-user font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                                <i class="dw dw-more"></i></a><div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">';
                    $editBtn .= '<a href="javascript:;" class="dropdown-item fill_data_hotel" data-url="'.route('admin.hotelbooking.edit',$hotelbooking->id).'" data-method="get"><i class="dw dw-edit2"></i> Edit</a>';
                    $editBtn .= '<a href="javascript:;" class="dropdown-item btn-delete_hotel" data-url="'.route('admin.hotelbooking.delete',$hotelbooking->id).'" data-method="delete"><i class="dw dw-delete-3"></i> Delete</a></div>';
                    return $editBtn;

                })
                ->toJson();
        } else {
            return view()->make('admin.booking.services', compact('booking_id'));
        }
    }
    public function tourbooking(Request $request, $booking_id){
        if ($request->ajax()) {
            $tourbookings = TourBooking::with('tour')->select('tour_bookings.*')->where('booking_id', $booking_id)->orderBy('id', 'DESC');
            return DataTables::eloquent($tourbookings)
                ->editColumn('tour', function ($tourbooking) {
                    return $tourbooking->tour->name;
                })
                ->editColumn('tour_date', function ($tourbooking) {
                    return $tourbooking->tour_date;
                })
                ->editColumn('tour_time', function ($tourbooking) {
                    return $tourbooking->tour_time;
                })
                ->editColumn('no_of_passengers', function ($tourbooking) {
                    return $tourbooking->no_of_passengers;
                })
                ->editColumn('voucher_ref', function ($tourbooking) {
                    return $tourbooking->voucher_ref;
                })
                ->addColumn('action', function (TourBooking $tourbooking) {
                    $editBtn = '<div class="dropdown"><a class="btn btn-user font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                                <i class="dw dw-more"></i></a><div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">';
                    $editBtn .= '<a href="javascript:;" class="dropdown-item fill_data_tour" data-url="'.route('admin.tourbooking.edit',$tourbooking->id).'" data-method="get"><i class="dw dw-edit2"></i> Edit</a>';
                    $editBtn .= '<a href="javascript:;" class="dropdown-item btn-delete_tour" data-url="'.route('admin.tourbooking.delete',$tourbooking->id).'" data-method="delete"><i class="dw dw-delete-3"></i> Delete</a></div>';
                    return $editBtn;

                })
                ->toJson();
        } else {
            return view()->make('admin.booking.services', compact('booking_id'));
        }
    }
    public function servicesbooking(Request $request, $booking_id){
        if ($request->ajax()) {
            $servicesbookings = MiscBooking::with(['city','country'])->select('misc_bookings.*')->where('booking_id', $booking_id)->orderBy('id', 'DESC');
            return DataTables::eloquent($servicesbookings)
                ->editColumn('services_name', function ($servicesbooking) {
                    return $servicesbooking->services_name;
                })
                ->editColumn('services_date', function ($servicesbooking) {
                    return $servicesbooking->services_date;
                })
                ->editColumn('services_time', function ($servicesbooking) {
                    return $servicesbooking->services_time;
                })
                ->editColumn('no_of_passengers', function ($servicesbooking) {
                    return $servicesbooking->no_of_passengers;
                })
                // ->editColumn('city', function ($servicesbooking) {
                //     return $servicesbooking->city->name;
                // })
                ->editColumn('country', function ($servicesbooking) {
                    return $servicesbooking->country->name;
                })
                ->editColumn('voucher_ref', function ($servicesbooking) {
                    return $servicesbooking->voucher_ref;
                })
                ->addColumn('action', function (MiscBooking $servicesbooking) {
                    $editBtn = '<div class="dropdown"><a class="btn btn-user font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                                <i class="dw dw-more"></i></a><div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">';
                    $editBtn .= '<a href="javascript:;" class="dropdown-item fill_data_misc" data-url="'.route('admin.miscbooking.edit',$servicesbooking->id).'" data-method="get"><i class="dw dw-edit2"></i> Edit</a>';
                    $editBtn .= '<a href="javascript:;" class="dropdown-item btn-delete_misc" data-url="'.route('admin.miscbooking.delete',$servicesbooking->id).'" data-method="delete"><i class="dw dw-delete-3"></i> Delete</a></div>';
                    return $editBtn;

                })
                ->toJson();
        } else {
            return view()->make('admin.booking.services', compact('booking_id'));
        }
    }
}
