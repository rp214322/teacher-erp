<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Agent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class AgentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Agent $agents)
    {
        if($request->ajax())
        {
            $agents = $agents::with(['country','city'])->select('agents.*')->orderBy('id','DESC');
            return DataTables::eloquent($agents)
                        ->editColumn('name',function($agent){
                            return $agent->agency_name;
                        })
                        ->editColumn('agency_name',function($agent){
                            return $agent->name;
                        })
                        ->editColumn('country', function ($agent) {
                            return $agent->country->name;
                        })
                        ->editColumn('city', function ($agent) {
                            return $agent->city->name;
                        })
                       ->addColumn('action', function (Agent $agent) {

                            $editBtn = '<div class="dropdown"><a class="btn btn-user font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                                        <i class="dw dw-more"></i></a><div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">';
                            $editBtn .= '<a href="javascript:;" class="dropdown-item fill_data" data-url="'.route('admin.agent.edit',$agent->id).'" data-method="get"><i class="dw dw-edit2"></i> Edit</a>';
                            $editBtn .= '<a href="javascript:;" class="dropdown-item btn-delete" data-url="'.route('admin.agent.destroy',$agent->id).'" data-method="delete"><i class="dw dw-delete-3"></i> Delete</a></div>';
                            return $editBtn;

                        })
                        ->toJson();
        }
        else {
            return view()->make('admin.agent.index');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view()->make('admin.agent.add',compact('request'));
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
            'agency_name' => 'required',
            'email' => 'required',
            'contact' => 'required',
            'address' => 'required',
            'status' => 'required',
            'tax' => 'required',


            );
        $messages = [
            'country_id.required' => 'Please select country.',
            'city_id.required' => 'Please select city.',
            'name.required' => 'Please enter name.',
            'agency_name.required' => 'Please enter name.',
            'email.required' => 'Please enter email.',
            'contact.required' => 'Please enter contact number.',
            'address.required' => 'Please enter address.',
            'status.required' => 'Please select status.',
            'tax.required' => 'Please enter tax',
            ];
            $validator = Validator::make($request->all(), $rules, $messages);
            if ($validator->fails())
            {
                return response()->json($validator->getMessageBag()->toArray(), 422);
            }
            try{
                $agent=New Agent();
                $agent->country_id=$request->get('country_id');
                $agent->city_id=$request->get('city_id');
                $agent->name=$request->get('name');
                $agent->agency_name=$request->get('agency_name');
                $agent->email=$request->get('email');
                $agent->contact=$request->get('contact');
                $agent->address=$request->get('address');
                $agent->status=$request->get('status');
                $agent->tax=$request->get('tax');
                $agent->save();
                return response()->json(['success','agent created successfully.'], 200);
            }
            catch(\Exception $e)
            {
              return response()->json(["error" => "Something went wrong, Please try after sometime."], 422);
            }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Agent  $agent
     * @return \Illuminate\Http\Response
     */
    public function show(Agent $agent)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Agent  $agent
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $agent = Agent::find($id);
        return view()->make('admin.agent.edit',compact('agent'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Agent  $agent
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try{
            $agent=Agent::find($id);
            $agent->country_id=$request->get('country_id');
            $agent->city_id=$request->get('city_id');
            $agent->name=$request->get('name');
            $agent->agency_name=$request->get('agency_name');
            $agent->email=$request->get('email');
            $agent->contact=$request->get('contact');
            $agent->address=$request->get('address');
            $agent->status=$request->get('status');
            $agent->tax=$request->get('tax');
            $agent->save();
            return response()->json(['success','agent updated successfully.'], 200);
        }
        catch(\Exception $e)
        {
          return response()->json(["error" => "Something went wrong, Please try after sometime."], 422);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Agent  $agent
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try
        {
            $agent = Agent::find($id);
            $agent->delete();
            return response()->json(['success','agent deleted successfully'], 200);
        }
        catch(\Exception $e)
        {
            return response()->json(["error" => "Something went wrong, Please try after sometime."], 422);
        }
    }
}
