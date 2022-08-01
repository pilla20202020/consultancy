<?php

namespace App\Http\Controllers\Branch;

use App\Http\Controllers\Controller;
use App\Http\Requests\Branch\BranchRequest;
use App\Modules\Models\Branch\Branch;
use Illuminate\Http\Request;

class BranchController extends Controller
{
    protected $branch;

    function __construct(Branch $branch)
    {
        $this->branch = $branch;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $branches = $this->branch->paginate();
        return view('branch.index', compact('branches'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('branch.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BranchRequest $request)
    {
        //
        $branch = $this->branch->create($request->data());
        Toastr()->success('Branch Created Successfully','Success');
        return redirect()->route('branch.index');
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
        //
        $branch = $this->branch->where('id',$id)->first();
        return view('branch.edit', compact('branch'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BranchRequest $request, $id)
    {
        //
        $branch = $this->branch->where('id',$id);
        if($branch->update($request->data())) {
            Toastr()->success('Branch Updated Successfully','Success');
            return redirect()->route('branch.index');
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
        //
        $branch = $this->branch->where('id',$id);
        $branch->delete();
        Toastr()->success('Branch Deleted Successfully','Success');
        return redirect()->route('branch.index');
    }
}
