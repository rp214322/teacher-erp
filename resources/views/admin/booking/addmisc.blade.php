<form id="editable-form" action="{{ route('admin.miscbooking.store', ['booking_id' => $booking->id]) }}" method="POST">
    @csrf
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Add Tour</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">
        <div class="modal_form">
            <div class="form-group row">
                <label for="services-name" class="col-sm-3 col-form-label">Services Name</label>
                <div class="col-sm-9">
                    <input type="text" id="services-name" name="services_name" class="form-control" placeholder="etc"
                        required>
                </div>
            </div>
            <div class="form-group row">
                <label for="services-date" class="col-sm-3 col-form-label">Services Date</label>
                <div class="col-sm-9">
                    <input type="date" id="services_date" name="services_date" class="form-control" placeholder="30-03-2024"
                        required>
                </div>
            </div>
            <div class="form-group row">
                <label for="services-time" class="col-sm-3 col-form-label">Services Time</label>
                <div class="col-sm-9">
                    <input type="time" id="services_time" name="services_time" class="form-control" required>
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
                <label for="country" class="col-sm-3 col-form-label">Country</label>
                <div class="col-sm-9">
                    <select name="country_id" id="CountryId" class="form-control" required>
                        <option value="">Select Country</option>
                        @foreach (App\Models\Country::where('status', 1)->pluck('name', 'id')->toArray() as $id => $name)
                            <option value="{!! $id !!}">{!! $name !!}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label for="city" class="col-sm-3 col-form-label">City</label>
                <div class="col-sm-9">
                    <select name="city_id" id="CityId" class="form-control">
                        <option value="">Select City</option>
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
        <button type="submit" class="btn btn-primary btn-submit_misc" data-type="details">Save changes</button>
    </div>
</form>
