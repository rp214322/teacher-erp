<form id="editable-form" action="{{ route('admin.hotelbooking.store', ['booking_id' => $booking->id]) }}" method="POST">
    @csrf
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Add Hotel</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">
        <div class="modal_form">
            <div class="form-group row">
                <label for="hotel-id" class="col-sm-3 col-form-label">Hotel</label>
                <div class="col-sm-9">
                    <select name="hotel_id" id="hotel-id" class="form-control" required>
                        <option value="">Select Hotel</option>
                        @foreach (App\Models\Hotel::where('status', 1)->pluck('name', 'id')->toArray() as $id => $name)
                            <option value="{{ $id }}">{{ $name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label for="hotel-address" class="col-sm-3 col-form-label">Address</label>
                <div class="col-sm-9">
                    <textarea name="address" id="hotel-address" class="form-control" placeholder="Address" readonly></textarea>
                </div>
            </div>
            <div class="form-group row">
                <label for="check_in-date" class="col-sm-3 col-form-label">Check-in Date</label>
                <div class="col-sm-9">
                    <input type="date" id="check_in" name="check_in" class="form-control" placeholder="30-03-2024"
                        required>
                </div>
            </div>
            <div class="form-group row">
                <label for="check_out-date" class="col-sm-3 col-form-label">Check-out Date</label>
                <div class="col-sm-9">
                    <input type="date" id="check_out" name="check_out" class="form-control" placeholder="30-03-2024"
                        required>
                </div>
            </div>
            <div class="form-group row">
                <label for="no-of-passengers" class="col-sm-3 col-form-label">No Of Passengers</label>
                <div class="col-sm-9">
                    <input type="text" id="no-of-passengers" name="no_of_passengers" class="form-control"
                        placeholder="5" required>
                </div>
            </div>
            <div class="form-group row">
                <label for="no-of-rooms" class="col-sm-3 col-form-label">No Of Rooms</label>
                <div class="col-sm-9">
                    <input type="text" id="no-of-rooms" name="no_of_rooms" class="form-control" placeholder="5"
                        required>
                </div>
            </div>
            <div class="form-group row">
                <label for="Room Type" class="col-sm-3 col-form-label">Room Type</label>
                <div class="col-sm-9">
                    <input type="text" id="room_type" name="type" class="form-control" placeholder="delux"
                        required>
                </div>
            </div>
            <div class="form-group row">
                <label for="meal_plan" class="col-sm-3 col-form-label">Meal Plan</label>
                <div class="col-sm-9">
                    <select name="meal_plan" id="Meal-plan" class="form-control" required>
                        <option value="">Select Meal Plan</option>
                        @foreach (App\Models\HotelBooking::$meal_plan as $key => $value)
                            <option value="{!! $key !!}">{!! $value !!}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label for="Inclusions" class="col-sm-3 col-form-label">Inclusions</label>
                <div class="col-sm-9">
                    <textarea name="Inclusions" id="Inclusions" class="form-control" placeholder="Inclusions"></textarea>
                </div>
            </div>
            <div class="form-group row">
                <label for="Exclusions" class="col-sm-3 col-form-label">Exclusions</label>
                <div class="col-sm-9">
                    <textarea name="Exclusions" id="Exclusions" class="form-control" placeholder="Exclusions"></textarea>
                </div>
            </div>
            <div class="form-group row">
                <label for="Remarks" class="col-sm-3 col-form-label">Remarks</label>
                <div class="col-sm-9">
                    <textarea name="Remarks" id="Remarks" class="form-control" placeholder="Remarks"></textarea>
                </div>
            </div>
            <div class="form-group row">
                <label for="status" class="col-sm-3 col-form-label">Status</label>
                <div class="col-sm-9">
                    <select name="status" class="form-control">
                        <option value="1">Active</option>
                        <option value="0">Inactive</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary btn-submit_hotel" data-type="details">Save changes</button>
    </div>
</form>
