<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tour;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class TourController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Tour $tours)
    {
        if($request->ajax())
        {
            $tours = $tours::with(['country','city'])->select('tours.*')->orderBy('id','DESC');
            return DataTables::eloquent($tours)
                        ->editColumn('name',function($tour){
                            return $tour->name;
                        })
                        ->editColumn('type',function($tour){
                            return $tour->type;
                        })
                        ->editColumn('country', function ($tour) {
                            return $tour->country->name;
                        })
                        ->editColumn('city', function ($tour) {
                            return $tour->city->name;
                        })

                       ->addColumn('action', function (Tour $tour) {

                            $editBtn = '<div class="dropdown"><a class="btn btn-user font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                                        <i class="dw dw-more"></i></a><div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">';
                            $editBtn .= '<a href="javascript:;" class="dropdown-item fill_data" data-url="'.route('admin.tour.edit',$tour->id).'" data-method="get"><i class="dw dw-edit2"></i> Edit</a>';
                            $editBtn .= '<a href="javascript:;" class="dropdown-item btn-delete" data-url="'.route('admin.tour.destroy',$tour->id).'" data-method="delete"><i class="dw dw-delete-3"></i> Delete</a></div>';
                            return $editBtn;

                        })
                        ->toJson();
        }
        else {
            return view()->make('admin.tour.index');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view()->make('admin.tour.add',compact('request'));
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
            'type' => 'required',
            'email' => 'required',
            'contact' => 'required',
            'address' => 'required',
            'status' => 'required'


            );
        $messages = [
            'country_id.required' => 'Please select country.',
            'city_id.required' => 'Please select city.',
            'name.required' => 'Please enter name.',
            'type.required' => 'Please select type.',
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
                $tour=New Tour();
                $tour->country_id=$request->get('country_id');
                $tour->city_id=$request->get('city_id');
                $tour->name=$request->get('name');
                $tour->type=$request->get('type');
                $tour->email=$request->get('email');
                $tour->contact=$request->get('contact');
                $tour->address=$request->get('address');
                $tour->status=$request->get('status');
                $tour->save();
                return response()->json(['success','Tour created successfully.'], 200);
            }
            catch(\Exception $e)
            {
              return response()->json(["error" => "Something went wrong, Please try after sometime."], 422);
            }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tour  $tour
     * @return \Illuminate\Http\Response
     */
    public function show(Tour $tour)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tour  $tour
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tour = Tour::find($id);
        return view()->make('admin.tour.edit',compact('tour'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tour  $tour
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try{
            $tour= Tour::find($id);
            $tour->country_id=$request->get('country_id');
            $tour->city_id=$request->get('city_id');
            $tour->name=$request->get('name');
            $tour->type=$request->get('type');
            // $tour->email=$request->get('email');
            // $tour->contact=$request->get('contact');
            // $tour->address=$request->get('address');
            $tour->status=$request->get('status');
            $tour->save();
            return response()->json(['success','Tour updated successfully.'], 200);
        }
        catch(\Exception $e)
        {
          return response()->json(["error" => "Something went wrong, Please try after sometime."], 422);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tour  $tour
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try
        {
            $tour = Tour::find($id);
            $tour->delete();
            return response()->json(['success','Tour deleted successfully'], 200);
        }
        catch(\Exception $e)
        {
            return response()->json(["error" => "Something went wrong, Please try after sometime."], 422);
        }
    }
}
