<form id="editable-form" action="{!! route('admin.booking.store') !!}" method="POST">
    @csrf
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Add New Client Booking Detail</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">
        <div class="modal_form">
            <div class="form-group row">
                <label for="client-name" class="col-sm-3 col-form-label">Client Name</label>
                <div class="col-sm-9">
                    <input type="text" id="client-name" name="name" class="form-control" placeholder="Client Name" required>
                </div>
            </div>
            <div class="form-group row">
                <label for="contact-number" class="col-sm-3 col-form-label">Contact Number</label>
                <div class="col-sm-9">
                    <input type="text" id="contact-number" name="contact" class="form-control" placeholder="contact number" required>
                </div>
            </div>
            <div class="form-group row">
                <label for="client-email" class="col-sm-3 col-form-label">Client Email</label>
                <div class="col-sm-9">
                    <input type="text" id="client-email" name="email" class="form-control" placeholder="email@email.com" required>
                </div>
            </div>
            <div class="form-group row">
                <label for="no-of-passengers" class="col-sm-3 col-form-label">No Of Passengers</label>
                <div class="col-sm-9">
                    <input type="text" id="no-of-passengers" name="no_of_passengers" class="form-control" placeholder="5" required>
                </div>
            </div>
            <div class="form-group row">
                <label for="start-date" class="col-sm-3 col-form-label">Start Date</label>
                <div class="col-sm-9">
                    <input type="date" id="start-date" name="start_date" class="form-control" placeholder="30-03-2024" required>
                </div>
            </div>
            <div class="form-group row">
                <label for="end-date" class="col-sm-3 col-form-label">End Date</label>
                <div class="col-sm-9">
                    <input type="date" id="end-date" name="end_date" class="form-control" placeholder="30-03-2024" required>
                </div>
            </div>
            <div class="form-group row">
                <label for="agent-id" class="col-sm-3 col-form-label">Agency</label>
                <div class="col-sm-9">
                    <select name="agent_id" id="agent-id" class="form-control" required>
                        <option value="">Select Agency</option>
                        @foreach (App\Models\Agent::where('status', 1)->pluck('agency_name', 'id')->toArray() as $id => $agency_name)
                            <option value="{!! $id !!}">{!! $agency_name !!}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label for="currency" class="col-sm-3 col-form-label">Currency</label>
                <div class="col-sm-9">
                    <select name="currency" id="currency" class="form-control" required>
                        <option value="">Select Currency</option>
                        @foreach (App\Models\Booking::$currency as $key => $value)
                            <option value="{!! $key !!}">{!! $value !!}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label for="amount" class="col-sm-3 col-form-label">Amount</label>
                <div class="col-sm-9">
                    <input type="text" id="amount" name="amount" class="form-control" placeholder="50000" required>
                </div>
            </div>
            <div class="form-group row">
                <lable for="status" class="col-sm-3 col-form-label">Status</lable>
                <div class="col-sm-9">
                    <select name="status" class="form-control">
                        <option value="1" >Active</option>
                        <option value="0">InActive</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary btn-submit" data-type="details">Save changes</button>
    </div>
</form>
