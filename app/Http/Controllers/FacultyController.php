<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class FacultyController extends Controller
{
    public function index(Request $request, User $users)
    {
        if ($request->ajax()) {
            $users = $users::with('program')->where('role', 'teacher')->orderBy('id', 'DESC');
            return DataTables::eloquent($users)
                ->editColumn('first_name', function ($user) {
                    return $user->first_name ." " .$user->last_name;
                })
                ->editColumn('email', function ($user) {
                    return $user->email;
                })
                ->editColumn('program', function ($user) {
                    return $user->program->name;
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
    public function create(Request $request)
    {
        return view()->make('faculty.add', compact('request'));
    }
    public function store(Request $request)
    {
        $rules = [
            'first_name' => 'required',
            'last_name' => 'required',
            'middle_name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed',
            'password_confirmation' => 'required'
        ];

        $messages = [
            'first_name.required' => 'Please enter first name.',
            'last_name.required' => 'Please enter last name.',
            'middle_name.required' => 'Please enter middle name.',
            'email.required' => 'Please enter email address.',
            'email.email' => 'Please enter a valid email address.',
            'password.required' => 'Please enter password.',
            'password.confirmed' => 'Password confirmation does not match.'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            $user = new User;
            $user->first_name = $request->get('first_name');
            $user->last_name = $request->get('last_name');
            $user->phone = $request->get('phone');
            $user->email = $request->get('email');
            $user->role = $request->get('role');
            $user->email_verified_at = now();
            $user->password = Hash::make($request->get('password'));
            $user->save();

            return redirect()->back()
                ->with('success', 'User created successfully.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Something went wrong. Please try again later.');
        }
    }
}
