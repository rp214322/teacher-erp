<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class SubjectController extends Controller
{
    public function index(Request $request, Subject $subjects)
    {
        if ($request->ajax()) {
            $subjects = $subjects::with('program')->orderBy('id', 'DESC');
            return DataTables::eloquent($subjects)
                ->editColumn('name', function ($subject) {
                    return $subject->name;
                })
                ->editColumn('semester', function ($subject) {
                    return $subject->semester;
                })
                ->editColumn('program', function ($subject) {
                    return $subject->program->name;
                })
                ->addColumn('action', function (Subject $subject) {

                    $editBtn = '<div class="dropdown"><a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                                        <i class="dw dw-more"></i></a><div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">';
                    $editBtn .= '<a href="javascript:;" class="dropdown-item fill_data" data-url="' . route('admin.subject.edit', $subject->id) . '" data-method="get"><i class="dw dw-edit2"></i> Edit</a>';
                    $editBtn .= '<a href="javascript:;" class="dropdown-item btn-delete" data-url="' . route('admin.subject.delete', $subject->id) . '" data-method="delete"><i class="dw dw-delete-3"></i> Delete</a></div>';
                    return $editBtn;
                })
                ->toJson();
        } else {
            return view()->make('subject.index');
        }
    }
    public function create(Request $request)
    {
        return view()->make('subject.add', compact('request'));
    }
    public function store(Request $request)
    {
        $rules = array(
            'name' => 'required',
            'program_id' => 'required',
            'semester' => 'required',
            'status' => 'required'
        );
        $messages = [
            'name.required' => 'Please enter subject name.',
            'program_id.required' => 'Please enter program id.',
            'semester.required' => 'Please Select semester.',
            'status' => 'Please enter status.',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return response()->json($validator->getMessageBag()->toArray(), 422);
        }

        try {
            $subject = new Subject;
            $subject->program_id = $request->get('program_id');
            $subject->name = $request->get('name');
            $subject->semester = $request->get('semester');
            $subject->status = $request->get('status');
            $subject->save();
            return response()->json(['success', 'Subject created successfully.'], 200);
        } catch (\Exception $e) {
            return response()->json(["error" => "Something went wrong, Please try after sometime."], 422);
        }
    }
    public function edit($id)
    {
        $subject = Subject::find($id);
        return view()->make('subject.edit', compact('subject'));
    }
    public function update(Request $request, $id)
    {
        try {
            $subject = Subject::find($id);
            $subject->name = $request->get('name');
            $subject->program_id = $request->get('program_id');
            $subject->semester = $request->get('semester');
            $subject->status = $request->get('status');
            $subject->save();
            return response()->json(['success', 'Subject updated successfully.'], 200);
        } catch (\Exception $e) {
            return response()->json(["error" => "Something went wrong, Please try after sometime."], 422);
        }
    }
    public function destroy($id)
    {
        try {
            $subject = Subject::find($id);
            $subject->delete();
            return response()->json(['success', 'Subject deleted successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(["error" => "Something went wrong, Please try after sometime."], 422);
        }
    }
}
