<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class StudentController extends Controller
{
    public function index(Request $request, User $users)
    {
        if ($request->ajax()) {
            $users = $users->where('role', 'student')->orderBy('id', 'DESC');
            return DataTables::eloquent($users)
                ->editColumn('first_name', function ($user) {
                    return $user->first_name . $user->last_name;
                })
                ->editColumn('email', function ($user) {
                    return $user->email;
                })
                ->editColumn('enrollment_no', function ($user) {
                    return $user->enrollment_no;
                })
                ->addColumn('action', function (User $user) {

                    $editBtn = '<div class="dropdown"><a class="btn btn-user font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                                        <i class="dw dw-more"></i></a><div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">';
                    $editBtn .= '<a href="javascript:;" class="dropdown-item fill_data" data-url="' . route('admin.faculty.edit', $user->id) . '" data-method="get"><i class="dw dw-edit2"></i> Edit</a>';
                    $editBtn .= '<a href="javascript:;" class="dropdown-item btn-delete" data-url="' . route('admin.faculty.delete', $user->id) . '" data-method="delete"><i class="dw dw-delete-3"></i> Delete</a></div>';
                    return $editBtn;
                })
                ->toJson();
        } else {
            return view()->make('faculty.index');
        }
    }
}
