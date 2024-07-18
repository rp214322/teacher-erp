<form id="editable-form" action="{{ route('admin.tourbooking.update', ['id' => $tourbooking->id]) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Edit Tour</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">
        <div class="modal_form">
            <div class="form-group row">
                <label for="hotel-id" class="col-sm-3 col-form-label">Tour</label>
                <div class="col-sm-9">
                    <select name="tour_id" id="tour-id" class="form-control" required>
                        <option value="">Select Tour</option>
                        @foreach (App\Models\Tour::where('status', 1)->pluck('name', 'id')->toArray() as $id => $name)
                            <option value="{{ $id }}"{!! $id == $tourbooking->tour_id ? 'selected' : '' !!}>{{ $name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label for="tour-date" class="col-sm-3 col-form-label">Tour Date</label>
                <div class="col-sm-9">
                    <input type="date" id="tour_date" name="tour_date" class="form-control" placeholder="30-03-2024" value="{{ $tourbooking->tour_date }}"
                        required>
                </div>
            </div>
            <div class="form-group row">
                <label for="tour-time" class="col-sm-3 col-form-label">Tour Time</label>
                <div class="col-sm-9">
                    <input type="time" id="tour_time" name="tour_time" class="form-control" value="{{ $tourbooking->tour_time }}" required>
                </div>
            </div>
            <div class="form-group row">
                <label for="no-of-passengers" class="col-sm-3 col-form-label">No Of Passengers</label>
                <div class="col-sm-9">
                    <input type="text" id="no-of-passengers" name="no_of_passengers" class="form-control"
                        placeholder="5" value="{{ $tourbooking->no_of_passengers }}" required>
                </div>
            </div>
            <div class="form-group row">
                <label for="Inclusions" class="col-sm-3 col-form-label">Inclusions</label>
                <div class="col-sm-9">
                    <textarea name="Inclusions" id="Inclusions" class="form-control" placeholder="Inclusions">{{ $tourbooking->Inclusions }}</textarea>
                </div>
            </div>
            <div class="form-group row">
                <label for="Exclusions" class="col-sm-3 col-form-label">Exclusions</label>
                <div class="col-sm-9">
                    <textarea name="Exclusions" id="Exclusions" class="form-control" placeholder="Exclusions">{{ $tourbooking->Exclusions }}</textarea>
                </div>
            </div>
            <div class="form-group row">
                <label for="Remarks" class="col-sm-3 col-form-label">Remarks</label>
                <div class="col-sm-9">
                    <textarea name="Remarks" id="Remarks" class="form-control" placeholder="Remarks">{{ $tourbooking->Remarks }}</textarea>
                </div>
            </div>
            <div class="form-group row">
                <label for="status" class="col-sm-3 col-form-label">Status</label>
                <div class="col-sm-9">
                    <select name="status" class="form-control">
                        <option value="1" {!! $tourbooking->status ? 'selected' : '' !!}>Active</option>
                        <option value="0" {!! !$tourbooking->status ? 'selected' : '' !!}>Inactive</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary btn-submit_tour" data-type="details">Save changes</button>
    </div>
</form>
