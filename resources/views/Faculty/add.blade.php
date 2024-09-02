@section('title', 'Faculty')
<form id="editable-form" action="{!! route('admin.faculty.store') !!}" method="POST">
    @csrf
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Add Faculty</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">
        <div class="modal_form">
            <div class="form-group row">
                <label for="program" class="col-sm-3 col-form-label">Department</label>
                <div class="col-sm-9">
                    <select name="program_id" class="form-control" id="program" required>
                        <option value="">Select Department</option>
                        @foreach (App\Models\Program::where('status', 1)->pluck('name', 'id') as $key => $program)
                            <option value="{!! $key !!}">{!! $program !!}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label for="subjects" class="col-sm-3 col-form-label">Subject</label>
                <div class="col-sm-9">
                    <select name="subjects[]" id="subjects" class="form-control" multiple required>
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label for="first_name" class="col-sm-3 col-form-label">First Name</label>
                <div class="col-sm-9">
                    <input type="text" name="first_name" class="form-control" id="first_name"
                        placeholder="First Name" required>
                </div>
            </div>
            <div class="form-group row">
                <label for="middle_name" class="col-sm-3 col-form-label">Middle Name</label>
                <div class="col-sm-9">
                    <input type="text" name="middle_name" class="form-control" id="middle_name"
                        placeholder="Middle Name">
                </div>
            </div>
            <div class="form-group row">
                <label for="last_name" class="col-sm-3 col-form-label">Last Name</label>
                <div class="col-sm-9">
                    <input type="text" name="last_name" class="form-control" id="last_name" placeholder="Last Name"
                        required>
                </div>
            </div>
            <div class="form-group row">
                <label for="phone1" class="col-sm-3 col-form-label">Contact Number</label>
                <div class="col-sm-9">
                    <input type="text" name="phone1" class="form-control" id="phone1" placeholder="Phone"
                        required>
                </div>
            </div>
            <div class="form-group row">
                <label for="phone2" class="col-sm-3 col-form-label">Contact Number 2</label>
                <div class="col-sm-9">
                    <input type="text" name="phone2" class="form-control" id="phone2" placeholder="Phone 2">
                </div>
            </div>
            <div class="form-group row">
                <label for="email" class="col-sm-3 col-form-label">Email</label>
                <div class="col-sm-9">
                    <input type="email" name="email" class="form-control" id="email" placeholder="Email"
                        required>
                </div>
            </div>
            <div class="form-group row">
                <label for="password" class="col-sm-3 col-form-label">Password</label>
                <div class="col-sm-9">
                    <input type="password" name="password" class="form-control" id="password" placeholder="********"
                        required>
                </div>
            </div>
            <div class="form-group row">
                <label for="password_confirmation" class="col-sm-3 col-form-label">Confirm Password</label>
                <div class="col-sm-9">
                    <input type="password" name="password_confirmation" class="form-control" id="password_confirmation"
                        placeholder="********" required>
                </div>
            </div>
            <div class="form-group row">
                <label for="date_of_joining" class="col-sm-3 col-form-label">Date of Joining</label>
                <div class="col-sm-9">
                    <input type="date" name="date_of_joining" class="form-control" id="date_of_joining" required>
                </div>
            </div>
            <div class="form-group row">
                <label for="qualification" class="col-sm-3 col-form-label">Qualification</label>
                <div class="col-sm-9">
                    <input type="text" name="qualification" class="form-control" id="qualification"
                        placeholder="MSC-IT" required>
                </div>
            </div>
            <div class="form-group row">
                <label for="dob" class="col-sm-3 col-form-label">Date of Birth</label>
                <div class="col-sm-9">
                    <input type="date" name="dob" class="form-control" id="dob" required>
                </div>
            </div>
            <div class="form-group row">
                <label for="address" class="col-sm-3 col-form-label">Address</label>
                <div class="col-sm-9">
                    <textarea name="address" class="form-control" id="address" rows="4"></textarea>
                </div>
            </div>
            <div class="form-group row">
                <label for="city" class="col-sm-3 col-form-label">City</label>
                <div class="col-sm-9">
                    <input type="text" name="city" class="form-control" id="city"
                        placeholder="Ahmedabad" required>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
</form>
