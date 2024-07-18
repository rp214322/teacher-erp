<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\MiscBooking;
use App\Models\MiscBookingCosting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MiscController extends Controller
{
    public function create(Request $request, $booking_id)
    {
        $booking = Booking::find($booking_id);
        return view('admin.booking.addmisc', compact('booking'));
    }
    public function store(Request $request, $booking_id)
    {
        $rules = array(
            'services_name' => 'required',
            'services_date' => 'required',
            'services_time' => 'required',
            'no_of_passengers' => 'required',
            'status' => 'required',
        );
        $messages = [
            'services_name.required' => 'Please select agency.',
            'services_date.required' => 'Please select currency.',
            'services_time.required' => 'Please enter amount.',
            'no_of_passengers.required' => 'please enter no_of_passengers.',
            'status.required' => 'Please select email',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return response()->json($validator->getMessageBag()->toArray(), 422);
        }
        try {
            $miscbooking = new MiscBooking();
            $miscbooking->booking_id = $booking_id;
            $miscbooking->services_name = $request->get('services_name');
            $miscbooking->services_date = $request->get('services_date');
            $miscbooking->services_time = $request->get('services_time');
            $miscbooking->no_of_passengers = $request->get('no_of_passengers');
            $miscbooking->country_id = $request->get('country_id');
            $miscbooking->city_id = $request->get('city_id');
            $miscbooking->Inclusions = $request->get('Inclusions');
            $miscbooking->Exclusions = $request->get('Exclusions');
            $miscbooking->Remarks = $request->get('Remarks');
            $miscbooking->status = $request->get('status');
            $miscbooking->save();
            return redirect()->route('admin.booking.show', ['id' => $booking_id])
                ->with('success', 'Hotel booking created successfully.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Something went wrong, please try again later.');
        }
    }
    public function edit(Request $request, $id)
    {
        $miscbooking = MiscBooking::find($id);
        if (!$miscbooking) {
            return redirect()->back()->with('error', 'Misc Booking not found.');
        }

        $booking = Booking::find($miscbooking->booking_id);
        if (!$booking) {
            return redirect()->back()->with('error', 'Booking not found.');
        }

        return view('admin.booking.editmisc', compact('booking', 'miscbooking'));
    }
    public function update(Request $request, $id)
    {
        try {
            $miscbooking = MiscBooking::find($id);
            if (!$miscbooking) {
                return redirect()->back()->with('error', 'Tour booking not found.');
            }
            $miscbooking->services_name = $request->get('services_name');
            $miscbooking->services_date = $request->get('services_date');
            $miscbooking->services_time = $request->get('services_time');
            $miscbooking->no_of_passengers = $request->get('no_of_passengers');
            $miscbooking->country_id = $request->get('country_id');
            $miscbooking->city_id = $request->get('city_id');
            $miscbooking->Inclusions = $request->get('Inclusions');
            $miscbooking->Exclusions = $request->get('Exclusions');
            $miscbooking->Remarks = $request->get('Remarks');
            $miscbooking->status = $request->get('status');
            $miscbooking->save();
            return redirect()->route('admin.booking.show', ['id' => $miscbooking->booking_id])
                ->with('success', 'Misc booking updated successfully.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Something went wrong, please try again later.');
        }
    }
    public function destroy($id)
    {
        try {
            $miscbooking = MiscBooking::find($id);
            if (!$miscbooking) {
                return response()->json(['error' => 'Booking not found'], 404);
            }
            $miscbooking->delete();
            return response()->json(['success' => 'Booking deleted successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(["error" => "Something went wrong, please try again later."], 422);
        }
    }
    public function miscbookingcostingstore(Request $request, $booking_id)
    {
        dd($request->all());
        $rules = array(
            // 'misc_booking_id' => 'required',
            'supplier_id' => 'required',
            'booking_date' => 'required',
            'due_date' => 'required',
            'currency' => 'required',
            'amount' => 'required',
        );
        $messages = [
            // 'misc_booking_id.required' => 'Please select agency.',
            'supplier_id.required' => 'Please select currency.',
            'booking_date.required' => 'Please enter amount.',
            'due_date.required' => 'please enter no_of_passengers.',
            'currency.required' => 'Please select email',
            'amount.required' => 'Please select email',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return response()->json($validator->getMessageBag()->toArray(), 422);
        }
        try {
            $miscbookingcosting = new MiscBookingCosting();
            $miscbookingcosting->booking_id = $booking_id;
            $miscbookingcosting->misc_booking_id = $request->get('misc_booking_id');
            $miscbookingcosting->supplier_id = $request->get('supplier_id');
            $miscbookingcosting->booking_date = $request->get('booking_date');
            $miscbookingcosting->due_date = $request->get('due_date');
            $miscbookingcosting->currency = $request->get('currency');
            $miscbookingcosting->amount = $request->get('amount');
            $miscbookingcosting->save();
            return redirect()->route('admin.booking.cp', ['id' => $booking_id])
                ->with('success', 'Hotel booking created successfully.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Something went wrong, please try again later.');
        }
    }
}
