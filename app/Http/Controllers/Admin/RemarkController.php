<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Remark;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RemarkController extends Controller
{
    public function store(Request $request, $booking_id)
    {
        $rules = array(
            'remarks' => 'required',
            'status' => 'required|boolean',
        );
        $messages = [
            'remarks.required' => 'Please select agency.',
            'status.required' => 'Please select email',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return response()->json($validator->getMessageBag()->toArray(), 422);
        }
        try {
            $remark = new Remark();
            $remark->booking_id = $booking_id;
            $remark->remarks = $request->get('remarks');
            $remark->status = $request->get('status');
            $remark->save();
            return redirect()->route('admin.booking.show', ['id' => $booking_id])
                ->with('success', 'Remark created successfully.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Something went wrong, please try again later.');
        }
    }
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'status' => 'required|boolean',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        try {
            $remark = Remark::findOrFail($id);
            if (!$remark) {
                return redirect()->back()->with('error', 'Remark not found.');
            }
            $remark = Remark::findOrFail($id);
            $remark->status = $request->status;
            $remark->save();
            return redirect()->route('admin.booking.show', ['id' => $remark->booking_id])
                ->with('success', 'Remark updated successfully.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Something went wrong, please try again later.');
        }
    }
    public function destroy($id)
    {
        try {
            $remark = Remark::findOrFail($id);
            if (!$remark) {
                return response()->json(['error' => 'Remark not found'], 404);
            }
            $remark->delete();
            return response()->json(['success' => 'Remark deleted successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(["error" => "Something went wrong, please try again later."], 422);
        }
    }
}
