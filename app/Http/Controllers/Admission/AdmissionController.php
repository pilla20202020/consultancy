<?php

namespace App\Http\Controllers\Admission;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admission\AdmissionRequest;
use App\Modules\Models\Admission\Admission;
use App\Modules\Models\Student\Student;
use Illuminate\Http\Request;

class AdmissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    protected $admission, $students;

    function __construct(Admission $admission, Student $students)
    {
        $this->admission = $admission;
        $this->students = $students;
    }

    public function index()
    {
        //
        $admissions = $this->admission->paginate();
        return view('admission.index', compact('admissions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $students =$this->students->paginate();
        return view('admission.create',compact('students'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AdmissionRequest $request)
    {
        //
        $admission = $this->admission->create($request->data());
        Toastr()->success('Admission Created Successfully','Success');
        return redirect()->route('admission.index');
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
    public function edit($admission)
    {
        //
        $admission = $this->admission->where('admissions_id',$admission)->first();
        $students =$this->students->paginate();
        return view('admission.edit', compact('admission','students'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AdmissionRequest $request, $admission)
    {
        //
        $admission = $this->admission->where('admissions_id',$admission);
        if($admission->update($request->data())) {
            Toastr()->success('Admission Updated Successfully','Success');
            return redirect()->route('admission.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($admission)
    {
        //
        $admission = $this->admission->where('admissions_id',$admission);
        $admission->delete();
        return redirect()->route('admission.index')->withSuccess(trans('Admission has been deleted'));
    }
}
