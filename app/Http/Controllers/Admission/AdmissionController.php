<?php

namespace App\Http\Controllers\Admission;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admission\AdmissionRequest;
use App\Modules\Models\Admission\Admission;
use App\Modules\Models\Commission\Commission;
use App\Modules\Models\Student\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdmissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    protected $admission, $students, $commission;

    function __construct(Admission $admission, Student $students, Commission $commission)
    {
        $this->admission = $admission;
        $this->students = $students;
        $this->commission = $commission;
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
        try {
            $admission = $this->verifyAdmissionofStudent($request);
            if($admission == true){
                $admission = $this->admission->create($request->data());
                Toastr()->success('Admission Created Successfully','Success');
                return redirect()->route('admission.index');
            } else {
                return redirect()->back();
            }

        } catch (Exception $e) {
            return false;
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
        try {
            $admission = $this->admission->where('admissions_id',$admission);
            if($admission->update($request->data())) {
                Toastr()->success('Admission Updated Successfully','Success');
                return redirect()->route('admission.index');
            } else {
                Toastr()->error('There was error while updating.','Sorry');
                return redirect()->route('admission.index');
            }
        } catch (Exception $e) {
            return false;
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

    public function verifyAdmissionofStudent($request){
        $student_id = $request->student_id;
        $admission = $this->admission->where('student_id',$student_id)->first();
        if(isset($admission)) {
            Toastr()->error('The student has already admitted to the college.','Sorry');
            return false;
        }
        return true;
    }

    public function commissionRate($admission) {
        $admission = $this->admission->where('admissions_id',$admission)->first();
        return view('admission.commission', compact('admission'));

    }

    public function storeCommissionRate(Request $request) {
        try{
            $commissions = $this->commission->where('admission_id', $request->admission_id);
            $commissions->delete();
            $p = 0;
            dd($request->all());
            foreach($request->title as $content) {
                $commissions = new Commission();
                $commissions['admission_id'] = $request->admission_id;
                $commissions['student_id'] = $request->student_id;
                $commissions['title'] = $content;
                $commissions['fees'] = $request->fees[$p];
                $commissions['claim_date'] = $request->claim_date[$p];
                $commissions['created_by'] = Auth::user()->users_id;
                $commissions->save();
                $p = $p + 1;
            }
            Toastr()->success('Commission Updated Successfully','Success');
            return redirect()->route('admission.index');
        } catch(Exception $e) {
            return null;
        }
    }

    public function deleteCommission($id) {

        try {
            $commission = $this->commission->where('commissions_id',$id);
            if($commission = $commission->delete()) {
                Toastr()->success('Commission has been deleted successfully','Success');
                return redirect()->back();
            } else {
                Toastr()->success('Commission cannot be deleted at the moment','Error');
                return redirect()->back();
            }

        } catch (Exception $e) {
            return false;
        }

    }
}
