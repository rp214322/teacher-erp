<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Supplier $suppliers)
    {
        if($request->ajax())
        {
            $suppliers = $suppliers::with(['country','city'])->select('suppliers.*')->orderBy('id','DESC');
            return DataTables::eloquent($suppliers)
                        ->editColumn('name',function($supplier){
                            return $supplier->name;
                        })
                        ->editColumn('type',function($supplier){
                            return $supplier->type;
                        })
                        ->editColumn('email',function($supplier){
                            return $supplier->email;
                        })
                        ->editColumn('contact',function($supplier){
                            return $supplier->contact;
                        })
                        ->editColumn('country', function ($supplier) {
                            return $supplier->country->name;
                        })
                        ->editColumn('city', function ($supplier) {
                            return $supplier->city->name;
                        })
                       ->addColumn('action', function (Supplier $supplier) {

                            $editBtn = '<div class="dropdown"><a class="btn btn-user font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                                        <i class="dw dw-more"></i></a><div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">';
                            $editBtn .= '<a href="javascript:;" class="dropdown-item fill_data" data-url="'.route('admin.supplier.edit',$supplier->id).'" data-method="get"><i class="dw dw-edit2"></i> Edit</a>';
                            $editBtn .= '<a href="javascript:;" class="dropdown-item btn-delete" data-url="'.route('admin.supplier.destroy',$supplier->id).'" data-method="delete"><i class="dw dw-delete-3"></i> Delete</a></div>';
                            return $editBtn;

                        })
                        ->toJson();
        }
        else {
            return view()->make('admin.supplier.index');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view()->make('admin.supplier.add',compact('request'));
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
            'contact_person' => 'required',
            'type' => 'required',
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
            'contact_person.required' => 'Please enter name.',
            'type.required' => 'Please enter name.',
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
                $supplier=New Supplier();
                $supplier->country_id=$request->get('country_id');
                $supplier->city_id=$request->get('city_id');
                $supplier->name=$request->get('name');
                $supplier->contact_person=$request->get('contact_person');
                $supplier->type=$request->get('type');
                $supplier->email=$request->get('email');
                $supplier->contact=$request->get('contact');
                $supplier->address=$request->get('address');
                $supplier->status=$request->get('status');
                $supplier->tax=$request->get('tax');
                $supplier->save();
                return response()->json(['success','Supplier created successfully.'], 200);
            }
            catch(\Exception $e)
            {
              return response()->json(["error" => "Something went wrong, Please try after sometime."], 422);
            }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function show(Supplier $supplier)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $supplier = Supplier::find($id);
        return view()->make('admin.supplier.edit',compact('supplier'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try{
            $supplier=Supplier::find($id);
            $supplier->country_id=$request->get('country_id');
            $supplier->city_id=$request->get('city_id');
            $supplier->name=$request->get('name');
            $supplier->contact_person=$request->get('contact_person');
            $supplier->type=$request->get('type');
            $supplier->email=$request->get('email');
            $supplier->contact=$request->get('contact');
            $supplier->address=$request->get('address');
            $supplier->status=$request->get('status');
            $supplier->tax=$request->get('tax');
            $supplier->save();
            return response()->json(['success','Supplier updated successfully.'], 200);
        }
        catch(\Exception $e)
        {
          return response()->json(["error" => "Something went wrong, Please try after sometime."], 422);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try
        {
            $supplier = Supplier::find($id);
            $supplier->delete();
            return response()->json(['success','supplier deleted successfully'], 200);
        }
        catch(\Exception $e)
        {
            return response()->json(["error" => "Something went wrong, Please try after sometime."], 422);
        }
    }
}
