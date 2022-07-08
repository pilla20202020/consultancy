<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Http\Requests\Student\StudentRequest;
use App\Modules\Models\Student\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $students;

    function __construct(Student $students)
    {
        $this->students = $students;
    }

    public function index()
    {
        //
        $students = $this->students->paginate();
        return view('student.index', compact('students'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('student.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StudentRequest $request)
    {
        //
        $student = $this->students->create($request->data());
        Toastr()->success('Student Created Successfully','Success');
        return redirect()->route('student.index');
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
    public function edit($student)
    {
        //
        $student = $this->students->where('students_id',$student)->first();
        return view('student.edit', compact('student'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StudentRequest $request, $student)
    {
        //
        $student = $this->students->where('students_id',$student);
        if($student->update($request->data())) {
            Toastr()->success('Student Updated Successfully','Success');
            return redirect()->route('student.index')->withSuccess(trans('Student has been updated'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($student)
    {
        //
        $student = $this->students->where('students_id',$student);
        $student->delete();
        return redirect()->route('student.index')->withSuccess(trans('Student has been deleted'));
    }
}
