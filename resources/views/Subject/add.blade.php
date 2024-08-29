<form id="editable-form" action="{{ route('admin.subject.store') }}" method="POST">
    @csrf
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Subject</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">
        <div class="modal_form">
            <div class="form-group row">
                <label for="program" class="col-sm-3 col-form-label">Program</label>
                <div class="col-sm-9">
                    <select name="program_id" class="form-control" id="program">
                        <option value="">Select Program</option>
                        @foreach (App\Models\Program::where('status', 1)->pluck('name', 'id') as $key => $program)
                            <option value="{!! $key !!}">{!! $program !!}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label for="semester" class="col-sm-3 col-form-label">Semester</label>
                <div class="col-sm-9">
                    <select name="semester" id="Semester" class="form-control" id="semester">
                        <option value="">Select Semester</option>
                        @foreach (App\Models\Subject::$semester as $key => $value)
                            <option value="{!! $key !!}">{!! $value !!}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label for="name" class="col-sm-3 col-form-label">Name</label>
                <div class="col-sm-9">
                    <input type="text" name="name" class="form-control" id="name" placeholder="DBMS"
                        required>
                </div>
            </div>
            <div class="form-group row">
                <label for="status" class="col-sm-3 col-form-label">Status</label>
                <div class="col-sm-9">
                    <select name="status" class="form-control" id="status">
                        <option value="1">Active</option>
                        <option value="0">Inactive</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary btn-submit" data-type="subjects">Save changes</button>
    </div>
</form>
