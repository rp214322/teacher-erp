<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\HotelBooking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class HotelBookingController extends Controller
{
    public function create(Request $request, $booking_id)
    {
        $booking = Booking::find($booking_id);
        return view('admin.booking.addhotel', compact('booking'));
    }
    public function store(Request $request, $booking_id)
    {

        $rules = array(
            'hotel_id' => 'required',
            'check_in' => 'required',
            'check_out' => 'required',
            'no_of_passengers' => 'required',
            'no_of_rooms' => 'required',
            'type' => 'required',
            'meal_plan' => 'required',
            'status' => 'required',
        );
        $messages = [
            'hotel_id.required' => 'Please select agency.',
            'check_in.required' => 'Please select currency.',
            'check_out.required' => 'Please enter amount.',
            'name.required' => 'Please enter name.',
            'no_of_passengers.required' => 'Please enter no_of_passengers.',
            'no_of_rooms.required' => 'Please enter start date.',
            'type.required' => 'Please enter end date.',
            'meal_plan.required' => 'Please Enter Contact Number',
            'status.required' => 'Please select email',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return response()->json($validator->getMessageBag()->toArray(), 422);
        }
        try {
            $hotelbooking = new HotelBooking();
            $hotelbooking->booking_id = $booking_id;
            $hotelbooking->hotel_id = $request->get('hotel_id');
            $hotelbooking->check_in = $request->get('check_in');
            $hotelbooking->check_out = $request->get('check_out');
            $hotelbooking->no_of_passengers = $request->get('no_of_passengers');
            $hotelbooking->no_of_rooms = $request->get('no_of_rooms');
            $hotelbooking->type = $request->get('type');
            $hotelbooking->meal_plan = $request->get('meal_plan');
            $hotelbooking->Inclusions = $request->get('Inclusions');
            $hotelbooking->Exclusions = $request->get('Exclusions');
            $hotelbooking->Remarks = $request->get('Remarks');
            $hotelbooking->status = $request->get('status');
            $hotelbooking->save();
            return redirect()->route('admin.booking.show', ['id' => $booking_id])
                ->with('success', 'Hotel booking created successfully.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Something went wrong, please try again later.');
        }
    }
    public function edit(Request $request, $id)
    {
        $hotelbooking = HotelBooking::find($id);
        if (!$hotelbooking) {
            return redirect()->back()->with('error', 'Hotel Booking not found.');
        }

        $booking = Booking::find($hotelbooking->booking_id);
        if (!$booking) {
            return redirect()->back()->with('error', 'Booking not found.');
        }

        return view('admin.booking.edithotel', compact('booking', 'hotelbooking'));
    }
    public function update(Request $request, $id)
    {
        try {
            $hotelbooking = HotelBooking::find($id);
            if (!$hotelbooking) {
                return redirect()->back()->with('error', 'Hotel booking not found.');
            }
            $hotelbooking->hotel_id = $request->get('hotel_id');
            $hotelbooking->check_in = $request->get('check_in');
            $hotelbooking->check_out = $request->get('check_out');
            $hotelbooking->no_of_passengers = $request->get('no_of_passengers');
            $hotelbooking->no_of_rooms = $request->get('no_of_rooms');
            $hotelbooking->type = $request->get('type');
            $hotelbooking->meal_plan = $request->get('meal_plan');
            $hotelbooking->Inclusions = $request->get('Inclusions');
            $hotelbooking->Exclusions = $request->get('Exclusions');
            $hotelbooking->Remarks = $request->get('Remarks');
            $hotelbooking->status = $request->get('status');
            $hotelbooking->save();
            return redirect()->route('admin.booking.show', ['id' => $hotelbooking->booking_id])
                ->with('success', 'Hotel booking updated successfully.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Something went wrong, please try again later.');
        }

    }
    public function destroy($id)
    {
        try {
            $hotelbooking = HotelBooking::find($id);
            if (!$hotelbooking) {
                return response()->json(['error' => 'Booking not found'], 404);
            }
            $hotelbooking->delete();
            return response()->json(['success' => 'Booking deleted successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(["error" => "Something went wrong, please try again later."], 422);
        }
    }
}
