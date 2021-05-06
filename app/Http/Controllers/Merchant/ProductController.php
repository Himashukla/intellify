<?php

namespace App\Http\Controllers\Merchant;

use App\Products;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use Yajra\DataTables\Facades\DataTables;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Products::select('id','name','price','quantity','status','description');
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $btn = view('merchant.product.buttons',compact('row'));
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('merchant.product.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('merchant.product.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        $data = $request->except(['_token','_method']);
        $create = Products::create($data);
        if ($create) {
            return redirect()->route('products.index')->with('success', 'Product created Successfully.');
        } else {
            return redirect()->back()->with('message', 'Product couldn\'t created.');
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
    public function edit($id)
    {
        $product = Products::find($id);
        return view('merchant.product.edit',compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, $id)
    {
        $data = $request->except(['_token','_method']);
        $update = Products::where('id',$id)->update($data);
        if ($update) {
            return redirect()->back()->with('success', 'Product updated Successfully.');
        } else {
            return redirect()->back()->with('message', 'Product couldn\'t updated.');
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
        $delete = Products::find($id)->delete();
        if ($delete) {
            return redirect()->back()->with('success', 'Product deleted Successfully.');
        } else {
            return redirect()->back()->with('message', 'Product couldn\'t deleted.');
        }
    }

    public function ChangeStatus($id){
        $user = Products::find($id);
        if($user->status == 'Enable'){
            $user->status = 'Disable';
            $user->save();
            return redirect()->route('products.index')->with('success','Product Disabled successfully.');
        }else{
            $user->status = 'Enable';
            $user->save();
            return redirect()->route('products.index')->with('success','Product Enabled successfully.');
        }
    }
}
