<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class MerchantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = User::where('user_type','Merchant')->select('*');
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                        $btn = view('admin.buttons',compact('row'));
                        return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        return view('admin.index');
    }

    public function ChangeStatus($id){
        $user = User::find($id);
        if($user->status == 'Enable'){
            $user->status = 'Disable';
            $user->save();
            return redirect()->route('merchant.index')->with('success','Merchant Disabled successfully.');
        }else{
            $user->status = 'Enable';
            $user->save();
            return redirect()->route('merchant.index')->with('success','Merchant Enabled successfully.');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
    public function edit($id)
    {
        $merchant = User::find($id);
        return view('admin.edit',compact('merchant'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->except(['_token','_method']);
        $update = User::where('id',$id)->update($data);
        if ($update) {
            return redirect()->back()->with('success', 'Merchant data updated Successfully.');
        } else {
            return redirect()->back()->with('message', 'Merchant data couldn\'t updated.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {        
        $delete = User::find($id)->delete();
        if ($delete) {
            return redirect()->back()->with('success', 'Merchant deleted Successfully.');
        } else {
            return redirect()->back()->with('message', 'Merchant couldn\'t deleted.');
        }
    }
}
