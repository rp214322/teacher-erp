<form id="editable-form" action="{!! route('admin.train.update', [$train->id]) !!}" method="POST">
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
                <label>Name</label>
                <input type="text" name="name" class="form-control" placeholder="Name"
                    value="{{ $train->name }}">
            </div>
            <div class="form-group">
                <label>Country</label>
                <select name="country_id" id="CountryId" class="form-control">
                    @foreach (App\Models\Country::where('status', 1)->pluck('name', 'id')->toArray() as $id => $name)
                        <option value="{!! $id !!}" {!! $id == $train->country_id ? 'selected' : '' !!}>{!! $name !!}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label>City</label>
                <select name="city_id" id="CityId" class="form-control">
                    <option value="{!! $train->city_id !!}" selected>{!! $train ->city->name !!}</option>
                </select>
            </div>
            <div class="form-group">
                <lable>Status</lable>
                <select name="status" class="form-control">
                    <option value="1" {!! $train->status ? 'selected' : '' !!}>Active</option>
                    <option value="0" {!! !$train->status ? 'selected' : '' !!}>InActive</option>
                </select>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <a href="javascript:;" type="submit" class="btn btn-primary btn-submit"
            data-id="trains_{!! $train->id !!}">Save changes</a>
    </div>
</form>
