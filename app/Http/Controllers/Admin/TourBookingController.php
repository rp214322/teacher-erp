<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\City;
use App\Models\TourBooking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TourBookingController extends Controller
{
    public function create(Request $request, $booking_id)
    {
        $booking = Booking::find($booking_id);
        return view('admin.booking.addtour', compact('booking'));
    }
    public function store(Request $request, $booking_id)
    {
        $rules = array(
            'tour_id' => 'required',
            'tour_date' => 'required',
            'tour_time' => 'required',
            'no_of_passengers' => 'required',
            'status' => 'required',
        );
        $messages = [
            'tour_id.required' => 'Please select agency.',
            'tour_date.required' => 'Please select currency.',
            'tour_time.required' => 'Please enter amount.',
            'status.required' => 'Please select email',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return response()->json($validator->getMessageBag()->toArray(), 422);
        }
        try {
            $tourbooking = new TourBooking();
            $tourbooking->booking_id = $booking_id;
            $tourbooking->tour_id = $request->get('tour_id');
            $tourbooking->tour_date = $request->get('tour_date');
            $tourbooking->tour_time = $request->get('tour_time');
            $tourbooking->no_of_passengers = $request->get('no_of_passengers');
            $tourbooking->Inclusions = $request->get('Inclusions');
            $tourbooking->Exclusions = $request->get('Exclusions');
            $tourbooking->Remarks = $request->get('Remarks');
            $tourbooking->status = $request->get('status');
            $tourbooking->save();
            return redirect()->route('admin.booking.show', ['id' => $booking_id])
                ->with('success', 'Hotel booking created successfully.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Something went wrong, please try again later.');
        }
    }
    public function edit(Request $request, $id)
    {
        $tourbooking = TourBooking::find($id);
        if (!$tourbooking) {
            return redirect()->back()->with('error', 'Tour Booking not found.');
        }

        $booking = Booking::find($tourbooking->booking_id);
        if (!$booking) {
            return redirect()->back()->with('error', 'Booking not found.');
        }

        return view('admin.booking.edittour', compact('booking', 'tourbooking'));
    }
    public function update(Request $request, $id)
    {
        try {
            $tourbooking = TourBooking::find($id);
            if (!$tourbooking) {
                return redirect()->back()->with('error', 'Tour booking not found.');
            }
            $tourbooking->tour_id = $request->get('tour_id');
            $tourbooking->tour_date = $request->get('tour_date');
            $tourbooking->tour_time = $request->get('tour_time');
            $tourbooking->no_of_passengers = $request->get('no_of_passengers');
            $tourbooking->Inclusions = $request->get('Inclusions');
            $tourbooking->Exclusions = $request->get('Exclusions');
            $tourbooking->Remarks = $request->get('Remarks');
            $tourbooking->status = $request->get('status');
            $tourbooking->save();
            return redirect()->route('admin.booking.show', ['id' => $tourbooking->booking_id])
                ->with('success', 'Tour booking updated successfully.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Something went wrong, please try again later.');
        }
    }
    public function destroy($id)
    {
        try {
            $tourbooking = TourBooking::find($id);
            if (!$tourbooking) {
                return response()->json(['error' => 'Booking not found'], 404);
            }
            $tourbooking->delete();
            return response()->json(['success' => 'Booking deleted successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(["error" => "Something went wrong, please try again later."], 422);
        }
    }
}
