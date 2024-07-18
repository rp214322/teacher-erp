<form id="editable-form" action="{{ route('admin.hotelbooking.update', ['id' => $hotelbooking->id]) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Edit Hotel</h5>
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
                            <option value="{{ $id }}" {!! $id == $hotelbooking->hotel_id ? 'selected' : '' !!}>{{ $name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label for="check_in-date" class="col-sm-3 col-form-label">Check-in Date</label>
                <div class="col-sm-9">
                    <input type="date" id="check_in" name="check_in" class="form-control" value="{{ $hotelbooking->check_in }}">
                </div>
            </div>
            <div class="form-group row">
                <label for="check_out-date" class="col-sm-3 col-form-label">Check-out Date</label>
                <div class="col-sm-9">
                    <input type="date" id="check_out" name="check_out" class="form-control" value="{{ $hotelbooking->check_out }}">
                </div>
            </div>
            <div class="form-group row">
                <label for="no-of-passengers" class="col-sm-3 col-form-label">No Of Passengers</label>
                <div class="col-sm-9">
                    <input type="text" id="no-of-passengers" name="no_of_passengers" class="form-control" value="{{ $hotelbooking->no_of_passengers }}">
                </div>
            </div>
            <div class="form-group row">
                <label for="no-of-rooms" class="col-sm-3 col-form-label">No Of Rooms</label>
                <div class="col-sm-9">
                    <input type="text" id="no-of-rooms" name="no_of_rooms" class="form-control" value="{{ $hotelbooking->no_of_rooms }}">
                </div>
            </div>
            <div class="form-group row">
                <label for="Room Type" class="col-sm-3 col-form-label">Room Type</label>
                <div class="col-sm-9">
                    <input type="text" id="room_type" name="type" class="form-control" value="{{ $hotelbooking->type }}">
                </div>
            </div>
            <div class="form-group row">
                <label for="currency" class="col-sm-3 col-form-label">Meal Plan</label>
                <div class="col-sm-9">
                    <select name="meal_plan" id="meal_plan" class="form-control" required>
                        @foreach (App\Models\HotelBooking::$meal_plan as $key => $value)
                            <option value="{!! $key !!}"{!! $key == $hotelbooking->meal_plan ? 'selected' : '' !!}>{!! $value !!}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label for="Inclusions" class="col-sm-3 col-form-label">Inclusions</label>
                <div class="col-sm-9">
                    <textarea name="Inclusions" id="Inclusions" class="form-control" placeholder="Inclusions">{{ $hotelbooking->Inclusions }}</textarea>
                </div>
            </div>
            <div class="form-group row">
                <label for="Exclusions" class="col-sm-3 col-form-label">Exclusions</label>
                <div class="col-sm-9">
                    <textarea name="Exclusions" id="Exclusions" class="form-control" placeholder="Exclusions">{{ $hotelbooking->Exclusions }}</textarea>
                </div>
            </div>
            <div class="form-group row">
                <label for="Remarks" class="col-sm-3 col-form-label">Remarks</label>
                <div class="col-sm-9">
                    <textarea name="Remarks" id="Remarks" class="form-control" placeholder="Remarks">{{ $hotelbooking->Remarks }}</textarea>
                </div>
            </div>
            <div class="form-group row">
                <label for="status" class="col-sm-3 col-form-label">Status</label>
                <div class="col-sm-9">
                    <select name="status" class="form-control">
                        <option value="1" {!! $hotelbooking->status ? 'selected' : '' !!}>Active</option>
                        <option value="0" {!! !$hotelbooking->status ? 'selected' : '' !!}>Inactive</option>
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