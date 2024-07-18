<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Train;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class TrainController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Train $trains)
    {
        if($request->ajax())
        {
            $trains = $trains::with(['country','city'])->select('trains.*')->orderBy('id','DESC');
            return DataTables::eloquent($trains)
                        ->editColumn('name',function($train){
                            return $train->name;
                        })
                        ->editColumn('country', function ($train) {
                            return $train->country->name;
                        })
                        ->editColumn('city', function ($train) {
                            return $train->city->name;
                        })
                       ->addColumn('action', function (Train $train) {

                            $editBtn = '<div class="dropdown"><a class="btn btn-user font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                                        <i class="dw dw-more"></i></a><div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">';
                            $editBtn .= '<a href="javascript:;" class="dropdown-item fill_data" data-url="'.route('admin.train.edit',$train->id).'" data-method="get"><i class="dw dw-edit2"></i> Edit</a>';
                            $editBtn .= '<a href="javascript:;" class="dropdown-item btn-delete" data-url="'.route('admin.train.destroy',$train->id).'" data-method="delete"><i class="dw dw-delete-3"></i> Delete</a></div>';
                            return $editBtn;

                        })
                        ->toJson();
        }
        else {
            return view()->make('admin.train.index');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view()->make('admin.train.add',compact('request'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = array(
            'country_id' => 'required',
            'city_id' => 'required',
            'name' => 'required',
            'status' => 'required'


            );
        $messages = [
            'country_id.required' => 'Please select country.',
            'city_id.required' => 'Please select city.',
            'name.required' => 'Please enter name.',
            'status.required' => 'Please select status.'
            ];
            $validator = Validator::make($request->all(), $rules, $messages);
            if ($validator->fails())
            {
                return response()->json($validator->getMessageBag()->toArray(), 422);
            }
            try{
                $train=New Train();
                $train->country_id=$request->get('country_id');
                $train->city_id=$request->get('city_id');
                $train->name=$request->get('name');
                $train->status=$request->get('status');
                $train->save();
                return response()->json(['success','Train created successfully.'], 200);
            }
            catch(\Exception $e)
            {
              return response()->json(["error" => "Something went wrong, Please try after sometime."], 422);
            }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Train  $train
     * @return \Illuminate\Http\Response
     */
    public function show(Train $train)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Train  $train
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $train = Train::find($id);
        return view()->make('admin.train.edit',compact('train'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Train  $train
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try{
            $train=Train::find($id);
            $train->country_id=$request->get('country_id');
            $train->city_id=$request->get('city_id');
            $train->name=$request->get('name');
            $train->status=$request->get('status');
            $train->save();
            return response()->json(['success','Train Updated successfully.'], 200);
        }
        catch(\Exception $e)
        {
          return response()->json(["error" => "Something went wrong, Please try after sometime."], 422);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Train  $train
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try
        {
            $train = Train::find($id);
            $train->delete();
            return response()->json(['success','Train deleted successfully'], 200);
        }
        catch(\Exception $e)
        {
            return response()->json(["error" => "Something went wrong, Please try after sometime."], 422);
        }
    }
}
