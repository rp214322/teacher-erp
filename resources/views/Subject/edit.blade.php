<form id="editable-form" action="{!! route('admin.subject.update', [$subject->id]) !!}" method="PUT">
    @csrf
    @method('PATCH')
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Edit Subject </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">
        <div class="modal_form">
            <div class="form-group row">
                <label for="program" class="col-sm-3 col-form-label">Program</label>
                <div class="col-sm-9">
                    <select name="program_id" class="form-control" id="programId">
                        @foreach (App\Models\Program::where('status', 1)->pluck('name', 'id') as $key => $name)
                        <option value="{!! $key !!}" {!! $key == $subject->program_id ? 'selected' : '' !!}>{!! $name !!}
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label for="semester" class="col-sm-3 col-form-label">Semester</label>
                <div class="col-sm-9">
                    <select name="semester" id="Semester" class="form-control" id="semester">
                        @foreach (App\Models\Subject::$semester as $key => $value)
                        <option value="{!! $key !!}" {!! $key == $subject->semester ? 'selected' : '' !!}>{!! $value !!}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <lable for="name" class="col-sm-3 col-form-label">Name</lable>
                <div class="col-sm-9">
                    <input type="text" name="name" class="form-control" value="{!! $subject->name !!}" required>
                </div>
            </div>
            <div class="form-group row">
                <lable for="status" class="col-sm-3 col-form-label">Status</lable>
                <div class="col-sm-9">
                    <select name="status" class="form-control">
                        <option value="1" {!! $subject->status ? 'selected' : '' !!}>Active</option>
                        <option value="0" {!! !$subject->status ? 'selected' : '' !!}>InActive</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <a href="javascript:;" type="submit" class="btn btn-primary btn-submit"
            data-id="subjects_{!! $subject->id !!}">Save changes</a>
    </div>
</form>
