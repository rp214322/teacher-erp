<form id="editable-form" action="{!! route('admin.booking.update',array($booking->id)) !!}" method="PUT">
    @csrf
    @method('PATCH')
    <div class="modal-header">
      <h5 class="modal-title" id="exampleModalLongTitle">Edit Client Booking Details </h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <div class="modal-body">
      <div class="modal_form">
        <div class="form-group row">
            <label for="client-name" class="col-sm-3 col-form-label">Client Name</label>
            <div class="col-sm-9">
                <input type="text" id="client-name" name="name" class="form-control" value="{{ $booking->name }}" required>
            </div>
        </div>
        <div class="form-group row">
            <label for="contact-number" class="col-sm-3 col-form-label">Contact Number</label>
            <div class="col-sm-9">
                <input type="text" id="contact-number" name="contact" class="form-control" value="{{ $booking->contact }}" required>
            </div>
        </div>
        <div class="form-group row">
            <label for="client-email" class="col-sm-3 col-form-label">Client Email</label>
            <div class="col-sm-9">
                <input type="text" id="client-email" name="email" class="form-control" value="{{ $booking->email }}" required>
            </div>
        </div>
        <div class="form-group row">
            <label for="no-of-passengers" class="col-sm-3 col-form-label">No Of Passengers</label>
            <div class="col-sm-9">
                <input type="text" id="no-of-passengers" name="no_of_passengers" class="form-control" value="{{ $booking->no_of_passengers }}" required>
            </div>
        </div>
        <div class="form-group row">
            <label for="start-date" class="col-sm-3 col-form-label">Start Date</label>
            <div class="col-sm-9">
                <input type="date" id="start-date" name="start_date" class="form-control" value="{{ $booking->start_date }}" required>
            </div>
        </div>
        <div class="form-group row">
            <label for="end-date" class="col-sm-3 col-form-label">End Date</label>
            <div class="col-sm-9">
                <input type="date" id="end-date" name="end_date" class="form-control" value="{{ $booking->end_date }}" required>
            </div>
        </div>
        <div class="form-group row">
            <label for="agent-id" class="col-sm-3 col-form-label">Agency</label>
            <div class="col-sm-9">
                <select name="agent_id" id="agent-id" class="form-control" required>
                    @foreach (App\Models\Agent::where('status', 1)->pluck('agency_name', 'id')->toArray() as $id => $agency_name)
                        <option value="{!! $id !!}"{!! $id == $booking->agent_id ? 'selected' : '' !!}>{!! $agency_name !!}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-group row">
            <label for="currency" class="col-sm-3 col-form-label">Currency</label>
            <div class="col-sm-9">
                <select name="currency" id="currency" class="form-control" required>
                    @foreach (App\Models\Booking::$currency as $key => $value)
                        <option value="{!! $key !!}"{!! $key == $booking->currency ? 'selected' : '' !!}>{!! $value !!}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-group row">
            <label for="amount" class="col-sm-3 col-form-label">Amount</label>
            <div class="col-sm-9">
                <input type="text" id="amount" name="amount" class="form-control" value="{{ $booking->amount }}" required>
            </div>
        </div>
        <div class="form-group row">
            <lable for="status" class="col-sm-3 col-form-label">Status</lable>
            <div class="col-sm-9">
                <select name="status" class="form-control">
                    <option value="1" {!! $booking->status ? 'selected' : '' !!}>Active</option>
                    <option value="0" {!! !$booking->status ? 'selected' : '' !!}>InActive</option>
                </select>
            </div>
        </div>
    </div>
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      <a href="javascript:;" type="submit" class="btn btn-primary btn-submit" data-id="bookings_{!! $booking->id !!}">Save changes</a>
    </div>
    </form>
