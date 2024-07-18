<form id="editable-form" action="{{ route('admin.miscbooking.update', ['id' => $miscbooking->id]) }}" method="POST">
    @csrf
    @method('PUT')
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
                    <input type="text" id="services-name" name="services_name" class="form-control" value="{{ $miscbooking->services_name }}">
                </div>
            </div>
            <div class="form-group row">
                <label for="services-date" class="col-sm-3 col-form-label">Services Date</label>
                <div class="col-sm-9">
                    <input type="date" id="services_date" name="services_date" class="form-control" value="{{ $miscbooking->services_date }}">
                </div>
            </div>
            <div class="form-group row">
                <label for="services-time" class="col-sm-3 col-form-label">Services Time</label>
                <div class="col-sm-9">
                    <input type="time" id="services_time" name="services_time" class="form-control" value="{{ $miscbooking->services_time }}">
                </div>
            </div>
            <div class="form-group row">
                <label for="no-of-passengers" class="col-sm-3 col-form-label">No Of Passengers</label>
                <div class="col-sm-9">
                    <input type="text" id="no-of-passengers" name="no_of_passengers" class="form-control"
                    value="{{ $miscbooking->no_of_passengers }}">
                </div>
            </div>
            <div class="form-group row">
                <label for="country" class="col-sm-3 col-form-label">Country</label>
                <div class="col-sm-9">
                    <select name="country_id" id="CountryId" class="form-control" required>
                        <option value="">Select Country</option>
                        @foreach (App\Models\Country::where('status', 1)->pluck('name', 'id')->toArray() as $id => $name)
                            <option value="{!! $id !!}"{!! $id == $miscbooking->country_id ? 'selected' : '' !!}>{!! $name !!}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label for="city" class="col-sm-3 col-form-label">City</label>
                <div class="col-sm-9">
                    <select name="city_id" id="CityId" class="form-control">
                        {{-- <option value="{!! $miscbooking->city_id !!}" selected>{!! $miscbooking ->city->name !!}</option> --}}
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label for="Inclusions" class="col-sm-3 col-form-label">Inclusions</label>
                <div class="col-sm-9">
                    <textarea name="Inclusions" id="Inclusions" class="form-control" placeholder="Inclusions">{{ $miscbooking->Inclusions }}</textarea>
                </div>
            </div>
            <div class="form-group row">
                <label for="Exclusions" class="col-sm-3 col-form-label">Exclusions</label>
                <div class="col-sm-9">
                    <textarea name="Exclusions" id="Exclusions" class="form-control" placeholder="Exclusions">{{ $miscbooking->Exclusions }}</textarea>
                </div>
            </div>
            <div class="form-group row">
                <label for="Remarks" class="col-sm-3 col-form-label">Remarks</label>
                <div class="col-sm-9">
                    <textarea name="Remarks" id="Remarks" class="form-control" placeholder="Remarks">{{ $miscbooking->Remarks }}</textarea>
                </div>
            </div>
            <div class="form-group row">
                <label for="status" class="col-sm-3 col-form-label">Status</label>
                <div class="col-sm-9">
                    <select name="status" class="form-control">
                        <option value="1" {!! $miscbooking->status ? 'selected' : '' !!}>Active</option>
                        <option value="0" {!! !$miscbooking->status ? 'selected' : '' !!}>Inactive</option>
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
