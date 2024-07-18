<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Hotel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class HotelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Hotel $hotels)
    {
        if($request->ajax())
        {
            $hotels = $hotels::with(['country','city'])->select('hotels.*')->orderBy('id','DESC');
            return DataTables::eloquent($hotels)
                        ->editColumn('name',function($hotel){
                            return $hotel->name;
                        })
                        ->editColumn('category',function($hotel){
                            return $hotel->category;
                        })
                        ->editColumn('email',function($hotel){
                            return $hotel->email;
                        })
                        ->editColumn('contact',function($hotel){
                            return $hotel->contact;
                        })
                        ->editColumn('country', function ($hotel) {
                            return $hotel->country->name;
                        })
                        ->editColumn('city', function ($hotel) {
                            return $hotel->city->name;
                        })

                       ->addColumn('action', function (Hotel $hotel) {

                            $editBtn = '<div class="dropdown"><a class="btn btn-user font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                                        <i class="dw dw-more"></i></a><div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">';
                            $editBtn .= '<a href="javascript:;" class="dropdown-item fill_data" data-url="'.route('admin.hotel.edit',$hotel->id).'" data-method="get"><i class="dw dw-edit2"></i> Edit</a>';
                            $editBtn .= '<a href="javascript:;" class="dropdown-item btn-delete" data-url="'.route('admin.hotel.destroy',$hotel->id).'" data-method="delete"><i class="dw dw-delete-3"></i> Delete</a></div>';
                            return $editBtn;

                        })
                        ->toJson();
        }
        else {
            return view()->make('admin.hotel.index');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view()->make('admin.hotel.add',compact('request'));
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
            'category' => 'required',
            'email' => 'required',
            'contact' => 'required',
            'address' => 'required',
            'status' => 'required'


            );
        $messages = [
            'country_id.required' => 'Please select country.',
            'city_id.required' => 'Please select city.',
            'name.required' => 'Please enter name.',
            'category.required' => 'Please select category.',
            'email.required' => 'Please enter email.',
            'contact.required' => 'Please enter contact number.',
            'address.required' => 'Please enter address.',
            'status.required' => 'Please select status.'
            ];
            $validator = Validator::make($request->all(), $rules, $messages);
            if ($validator->fails())
            {
                return response()->json($validator->getMessageBag()->toArray(), 422);
            }
            try{
                $hotel=New Hotel();
                $hotel->country_id=$request->get('country_id');
                $hotel->city_id=$request->get('city_id');
                $hotel->name=$request->get('name');
                $hotel->category=$request->get('category');
                $hotel->email=$request->get('email');
                $hotel->contact=$request->get('contact');
                $hotel->address=$request->get('address');
                $hotel->status=$request->get('status');
                $hotel->save();
                return response()->json(['success','Hotel created successfully.'], 200);
            }
            catch(\Exception $e)
            {
              return response()->json(["error" => "Something went wrong, Please try after sometime."], 422);
            }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Hotel  $hotel
     * @return \Illuminate\Http\Response
     */
    public function show(Hotel $hotel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Hotel  $hotel
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $hotel = Hotel::find($id);
        return view()->make('admin.hotel.edit',compact('hotel'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Hotel  $hotel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try{
            $hotel= Hotel::find($id);
            $hotel->country_id=$request->get('country_id');
            $hotel->city_id=$request->get('city_id');
            $hotel->name=$request->get('name');
            $hotel->category=$request->get('category');
            $hotel->email=$request->get('email');
            $hotel->contact=$request->get('contact');
            $hotel->address=$request->get('address');
            $hotel->status=$request->get('status');
            $hotel->save();
            return response()->json(['success','Hotel updated successfully.'], 200);
        }
        catch(\Exception $e)
        {
          return response()->json(["error" => "Something went wrong, Please try after sometime."], 422);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Hotel  $hotel
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try
        {
            $hotel = Hotel::find($id);
            $hotel->delete();
            return response()->json(['success','Hotel deleted successfully'], 200);
        }
        catch(\Exception $e)
        {
            return response()->json(["error" => "Something went wrong, Please try after sometime."], 422);
        }
    }
    public function fetch(Request $request)
    {
        $option = '<option value="">Select City</option>';
        if ($request->has('id') && $request->has('type')) {
            $data = [];
            if ($request->type == "city") {
                $data = City::where('country_id', $request->id)->where('status',1)->pluck('name', 'id')->toArray();
            }
            foreach ($data as $key => $value) {
                $option .= '<option value="' . $key . '">' . $value . '</option>';
            }
        }
        return $option;
    }
    public function getHotelAddress(Request $request)
    {
        $hotel = Hotel::find($request->id);

        if ($hotel) {
            return response()->json(['address' => $hotel->address]);
        }

        return response()->json(['address' => '']);
    }
}
