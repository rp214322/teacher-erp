<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Airport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class AirportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Airport $airports)
    {
        if($request->ajax())
        {
            $airports = $airports::with(['country','city'])->select('airports.*')->orderBy('id','DESC');
            return DataTables::eloquent($airports)
                        ->editColumn('name',function($airport){
                            return $airport->name;
                        })
                        ->editColumn('code',function($airport){
                            return $airport->code;
                        })
                        ->editColumn('country', function ($airport) {
                            return $airport->country->name;
                        })
                        ->editColumn('city', function ($airport) {
                            return $airport->city->name;
                        })
                       ->addColumn('action', function (Airport $airport) {
                            $editBtn = '<div class="dropdown"><a class="btn btn-user font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                                        <i class="dw dw-more"></i></a><div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">';
                            $editBtn .= '<a href="javascript:;" class="dropdown-item fill_data" data-url="'.route('admin.airport.edit',$airport->id).'" data-method="get"><i class="dw dw-edit2"></i> Edit</a>';
                            $editBtn .= '<a href="javascript:;" class="dropdown-item btn-delete" data-url="'.route('admin.airport.destroy',$airport->id).'" data-method="delete"><i class="dw dw-delete-3"></i> Delete</a></div>';
                            return $editBtn;

                        })
                        ->toJson();
        }
        else {
            return view()->make('admin.airport.index');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view()->make('admin.airport.add',compact('request'));
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
            'code' => 'required',
            'status' => 'required'


            );
        $messages = [
            'country_id.required' => 'Please select country.',
            'city_id.required' => 'Please select city.',
            'name.required' => 'Please enter name.',
            'code.required' => 'Please enter code.',
            'status.required' => 'Please select status.'
            ];
            $validator = Validator::make($request->all(), $rules, $messages);
            if ($validator->fails())
            {
                return response()->json($validator->getMessageBag()->toArray(), 422);
            }
            try{
                $airport=New Airport();
                $airport->country_id=$request->get('country_id');
                $airport->city_id=$request->get('city_id');
                $airport->name=$request->get('name');
                $airport->code=$request->get('code');
                $airport->status=$request->get('status');
                $airport->save();
                return response()->json(['success','Airport created successfully.'], 200);
            }
            catch(\Exception $e)
            {
              return response()->json(["error" => "Something went wrong, Please try after sometime."], 422);
            }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Airport  $airport
     * @return \Illuminate\Http\Response
     */
    public function show(Airport $airport)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Airport  $airport
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $airport = Airport::find($id);
        return view()->make('admin.airport.edit',compact('airport'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Airport  $airport
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try{
            $airport=Airport::find($id);
            $airport->country_id=$request->get('country_id');
            $airport->city_id=$request->get('city_id');
            $airport->name=$request->get('name');
            $airport->code=$request->get('code');
            $airport->status=$request->get('status');
            $airport->save();
            return response()->json(['success','Airport updated successfully.'], 200);
        }
        catch(\Exception $e)
        {
          return response()->json(["error" => "Something went wrong, Please try after sometime."], 422);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Airport  $airport
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try
        {
            $airport = Airport::find($id);
            $airport->delete();
            return response()->json(['success','airport deleted successfully'], 200);
        }
        catch(\Exception $e)
        {
            return response()->json(["error" => "Something went wrong, Please try after sometime."], 422);
        }
    }
}
