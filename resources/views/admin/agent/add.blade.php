<form id="editable-form" action="{!! route('admin.agent.store') !!}" method="POST">
    @csrf
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Add Detail </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">
        <div class="modal_form">
            <div class="form-group">
                <label>Agency Name</label>
                <input type="text" name="agency_name" class="form-control" placeholder="Name" required>
            </div>
            <div class="form-group">
                <label>Agent Name</label>
                <input type="text" name="name" class="form-control" placeholder="Name" required>
            </div>
            <div class="form-group">
                <label>Country</label>
                <select name="country_id" id="CountryId" class="form-control" required>
                    <option value="">Select Country</option>
                    @foreach (App\Models\Country::where('status', 1)->pluck('name', 'id')->toArray() as $id => $name)
                        <option value="{!! $id !!}">{!! $name !!}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label>City</label>
                <select name="city_id" id="CityId" class="form-control" required>
                    <option value="">Select City</option>
                </select>
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" id="Email" class="form-control" placeholder="email@email.com"
                    required>
            </div>
            <div class="form-group">
                <label>Contact</label>
                <input type="text" name="contact" id="Contact" class="form-control" placeholder="contact" required>
            </div>
            <div class="form-group">
                <label>Address</label>
                <textarea name="address" id="address" class="form-control" placeholder="address"></textarea>
            </div>
            <div class="form-group">
                <label>GST/VAT</label>
                <input type="text" name="tax" class="form-control" placeholder="18%" required>
            </div>
            <div class="form-group">
                <lable>Status</lable>
                <select name="status" class="form-control">
                    <option value="1">Active</option>
                    <option value="0">InActive</option>
                </select>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <a href="javascript:;" type="submit" class="btn btn-primary btn-submit" data-type="details">Save changes</a>
    </div>
</form>
