<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\City;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, City $cities)
    {
        if ($request->ajax()) {
            $cities = $cities::with('country')
            ->select('cities.*')  // Select all columns from cities table
            ->orderBy('id', 'DESC');
            return DataTables::eloquent($cities)
                ->editColumn('country', function ($city) {
                    return $city->country->name;
                })
                ->editColumn('name', function ($city) {
                    return $city->name;
                })
                ->addColumn('action', function (City $city) {

                    $editBtn = '<div class="dropdown"><a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                                        <i class="dw dw-more"></i></a><div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">';
                    $editBtn .= '<a href="javascript:;" class="dropdown-item fill_data" data-url="' . route('admin.city.edit', $city->id) . '" data-method="get"><i class="dw dw-edit2"></i> Edit</a>';
                    $editBtn .= '<a href="javascript:;" class="dropdown-item btn-delete" data-url="' . route('admin.city.destroy', $city->id) . '" data-method="delete"><i class="dw dw-delete-3"></i> Delete</a></div>';
                    return $editBtn;
                })
                ->toJson();
        } else {
            return view()->make('admin.city.index');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view()->make('admin.city.add', compact('request'));
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
            'name' => 'required',
            'country_id' => 'required',
            'status' => 'required'
        );
        $messages = [
            'name.required' => 'Please enter city name.',
            'country_id.required' => 'Please select country.',
            'status' => 'Please select status.',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return response()->json($validator->getMessageBag()->toArray(), 422);
        }

        try {
            $city = new City;
            $city->country_id = $request->get('country_id');
            $city->name = $request->get('name');
            $city->status = $request->get('status');
            $city->save();
            return response()->json(['success', 'City added successfully.'], 200);
        } catch (\Exception $e) {
            return response()->json(["error" => "Something went wrong, Please try after sometime."], 422);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(City $city)
    {
        return view()->make('admin.city.edit',compact('city'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, City $city)
    {
        {
            try
            {
                $city->name=$request->get('name');
                $city->country_id=$request->get('country_id');
                $city->status=$request->get('status');
                $city->save();
                return response()->json(['success','City updated successfully.'], 200);
            }
            catch(\Exception $e)
            {
                return response()->json(["error" => "Something went wrong, Please try after sometime."], 422);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(City $city)
    {
        try
        {
            $city->delete();
            return response()->json(['success','City deleted successfully'], 200);
        }
        catch(\Exception $e)
        {
            return response()->json(["error" => "Something went wrong, Please try after sometime."], 422);
        }
    }
}
