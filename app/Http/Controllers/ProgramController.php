<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Program;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class ProgramController extends Controller
{
    public function index(Request $request, Program $programs)
    {
        if ($request->ajax()) {
            $programs = $programs->orderBy('id', 'DESC');
            return DataTables::eloquent($programs)
                ->editColumn('name', function ($program) {
                    return $program->name;
                })
                ->addColumn('action', function (Program $program) {

                    $editBtn = '<div class="dropdown"><a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                                        <i class="dw dw-more"></i></a><div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">';
                    $editBtn .= '<a href="javascript:;" class="dropdown-item fill_data" data-url="'.route('admin.program.edit',$program->id).'" data-method="get"><i class="dw dw-edit2"></i> Edit</a>';
                    $editBtn .= '<a href="javascript:;" class="dropdown-item btn-delete" data-url="#" data-method="delete"><i class="dw dw-delete-3"></i> Delete</a></div>';
                    return $editBtn;
                })
                ->toJson();
        } else {
            return view()->make('program.index');
        }
    }
    public function create(Request $request)
    {
        return view()->make('program.add', compact('request'));
    }
    public function store(Request $request)
    {
        $rules = array(
            'name' => 'required',
            'status' => 'required'
        );
        $messages = [
            'name.required' => 'Please enter Program name.',
            'status' => 'Please select status.',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return response()->json($validator->getMessageBag()->toArray(), 422);
        }
        try {
            $program = new Program();
            $program->name = $request->get('name');
            $program->status = $request->get('status');
            $program->save();
            return response()->json(['success', 'Program Created successfully.'], 200);
        } catch (\Exception $e) {
            return response()->json(["error" => "Something went wrong, Please try after sometime."], 422);
        }
    }
    public function edit(Program $program) {
        return view()->make('program.edit', compact('program'));
    }
}
