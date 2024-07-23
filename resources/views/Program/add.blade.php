<form id="editable-form" action="{{ route('admin.program.store') }}" method="POST">
    @csrf
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Program </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">
        <div class="modal_form">
            <div class="form-group row">
                <lable for="name" class="col-sm-3 col-form-label">Name</lable>
                <div class="col-sm-9">
                    <input type="text" name="name" class="form-control" placeholder="MCA" required>
                </div>
            </div>
            <div class="form-group row">
                <lable for="status" class="col-sm-3 col-form-label">Status</lable>
                <div class="col-sm-9">
                    <select name="status" class="form-control">
                        <option value="1">Active</option>
                        <option value="0">InActive</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <a href="javascript:;" type="submit" class="btn btn-primary btn-submit" data-type="countries">Save
                changes</a>
        </div>
</form>
