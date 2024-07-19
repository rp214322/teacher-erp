<form id="editable-form" action="{!! route('admin.supplier.update', [$supplier->id]) !!}" method="POST">
    @csrf
    @method('PATCH')
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Edit Details </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">
        <div class="modal_form">
            <div class="form-group">
                <label>Supplier Name</label>
                <input type="text" name="name" class="form-control" placeholder="Name"
                    value="{{ $supplier->name }}">
            </div>
            <div class="form-group">
                <label>Contact Person</label>
                <input type="text" name="contact_person" class="form-control" placeholder="Name" required value="{{ $supplier->contact_person }}">
            </div>
            <div class="form-group">
                <label>Supplier Type</label>
                <select name="type" id="Type" class="form-control">
                    @foreach (App\Models\Supplier::$type as $key => $value)
                        <option value="{!! $key !!}" {!! $key == $supplier->type ? 'selected' : '' !!}>{!! $value !!}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label>Country</label>
                <select name="country_id" id="CountryId" class="form-control">
                    @foreach (App\Models\Country::where('status', 1)->pluck('name', 'id')->toArray() as $id => $name)
                        <option value="{!! $id !!}" {!! $id == $supplier->country_id ? 'selected' : '' !!}>{!! $name !!}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label>City</label>
                <select name="city_id" id="CityId" class="form-control">
                    <option value="{!! $supplier->city_id !!}" selected>{!! $supplier ->city->name !!}</option>
                </select>
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" id="Email" class="form-control" value="{{ $supplier->email }}">
            </div>
            <div class="form-group">
                <label>Contact</label>
                <input type="text" name="contact" id="Contact" class="form-control" value="{{ $supplier->contact }}">
            </div>
            <div class="form-group">
                <label>Address</label>
                <textarea name="address" id="address" class="form-control">{{ $supplier->address }}</textarea>
            </div>
            <div class="form-group">
                <label>GST/VAT</label>
                <input type="text" name="tax" class="form-control" placeholder="18%" required value="{{ $supplier->tax }}">
            </div>
            <div class="form-group">
                <lable>Status</lable>
                <select name="status" class="form-control">
                    <option value="1" {!! $supplier->status ? 'selected' : '' !!}>Active</option>
                    <option value="0" {!! !$supplier->status ? 'selected' : '' !!}>InActive</option>
                </select>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <a href="javascript:;" type="submit" class="btn btn-primary btn-submit"
            data-id="suppliers_{!! $supplier->id !!}">Save changes</a>
    </div>
</form>
<script>