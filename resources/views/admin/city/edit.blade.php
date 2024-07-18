<form id="editable-form" action="{!! route('admin.city.update', [$city->id]) !!}" method="POST">
    @csrf
    @method('PATCH')
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Edit City </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">
        <div class="modal_form">
            <div class="form-group row">
                <lable for="country" class="col-sm-3 col-form-label">Country</lable>
                <div class="col-sm-9">
                    <select name="country_id" class="form-control">
                        @foreach (App\Models\Country::where('status', 1)->pluck('name', 'id') as $key => $country)
                            <option value="{!! $key !!}" {!! $key == $city->country_id ? 'selected' : '' !!}>{!! $country !!}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <lable for="name" class="col-sm-3 col-form-label">Name</lable>
                <div class="col-sm-9">
                    <input type="text" name="name" class="form-control" placeholder="City Name"
                        value="{!! $city->name !!}" required>
                </div>
            </div>
            <div class="form-group row">
                <lable for="status" class="col-sm-3 col-form-label">Status</lable>
                <div class="col-sm-9">
                    <select name="status" class="form-control">
                        <option value="1" {!! $city->status ? 'selected' : '' !!}>Active</option>
                        <option value="0" {!! !$city->status ? 'selected' : '' !!}>InActive</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <a href="javascript:;" type="submit" class="btn btn-primary btn-submit"
            data-id="cities_{!! $city->id !!}">Save changes</a>
    </div>
</form>
