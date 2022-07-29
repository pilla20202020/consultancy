<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Http\Requests\Student\StudentRequest;
use App\Modules\Models\Country\Country;
use App\Modules\Models\Student\Student;
use App\Modules\Models\Student\StudentEducation;
use App\Modules\Models\Student\StudentField;
use App\Modules\Models\Student\StudentLanguage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $students, $country;

    function __construct(Student $students,Country $country)
    {
        $this->students = $students;
        $this->country = $country;
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
        $countries = $this->country->where('status','Active')->get();
        return view('student.create',compact('countries'));
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
        try {
            $data = $request->all();
            $student = DB::transaction(function () use ($data) {
                $studentData = [
                    'applicant' => $data['applicant'],
                    'first_name' => $data['first_name'],
                    'middle_name' => $data['middle_name'],
                    'last_name' => $data['last_name'],
                    'gender' => $data['gender'],
                    'dob' => $data['dob'],
                    'material_status' => $data['material_status'] ?? null,
                    'father_name' => $data['father_name'],
                    'mother_name' => $data['mother_name'],
                    'spouse_name' => $data['material_status'] == 'Yes' ? $data['spouse_name']:null,
                    'mobile_no' => $data['mobile_no'],
                    'alternate_mobile_no' => $data['alternate_mobile_no'],
                    'email' => $data['email'],
                    'country_id' => $data['country_id'] ?? null,
                    'province_id' => $data['province_id'] ?? null,
                    'district_id' => $data['district_id'] ?? null,
                    'municipality_name' => $data['municipality_name'],
                    'ward_no' => $data['ward_no'],
                    'village_name' => $data['village_name'],
                    'full_address' => $data['full_address'],
                    'created_by' => Auth::user()->id,
                ];
                $student = $this->students->create($studentData);


                // Student Education
                $documentsPath = [];
                if (!empty($data['documents'])) {
                    foreach ($data['documents'] as $value) {
                        $documentsPath[] = uploadCommonFile($value, 'qualification/');
                    }
                }

                if (!empty($data['level'])) {
                    foreach ($data['level'] as $key => $value) {
                        $quali = [
                            'student_id' => $student->id,
                            'level' => $data['level'][$key],
                            'university' => $data['university'][$key],
                            'percentage' => $data['percentage'][$key],
                            'documents' => $documentsPath[$key] ?? null
                        ];
                        // dd($quali);
                        StudentEducation::create($quali);
                    }
                }
                // Student Education

                // Student Language
                $languageDocumentsPath = [];
                if (!empty($data['language_documents'])) {
                    foreach ($data['language_documents'] as $value) {
                        $languageDocumentsPath[] = uploadCommonFile($value, 'language/');
                    }
                }
                if (!empty($data['language'])) {
                    foreach ($data['language'] as  $key => $value) {
                        $lang = [
                            'student_id' => $student->id,
                            'language' => $data['language'][$key],
                            'score' => $data['score'][$key],
                            'language_documents' => $languageDocumentsPath[$key] ?? null
                        ];
                        // dd($quali);
                        StudentLanguage::create($lang);
                    }
                }

                if (!empty($data['preferred_field'])) {
                    foreach ($data['preferred_field'] as  $key => $value) {
                        $field = [
                            'student_id' => $student->id,
                            'name' => $data['preferred_field'][$key],
                        ];
                        // dd($quali);
                        StudentField::create($field);
                    }
                }
                // Student Language

            });
            Toastr()->success('Student Created Successfully','Success');
            return redirect()->route('student.index');

        } catch (Exception $e) {
            return null;
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
    public function edit($student)
    {
        //
        $student = $this->students->where('students_id',$student)->first();
        $countries = $this->country->where('status','Active')->get();
        $states = getStatesByCountryId($student->country_id);
        $districts = getDistrictsByProvinceId($student->state_id);
        $issue_districts = getDistricts();
        $fields = StudentField::where('student_id',$student->students_id)->pluck('name')->toArray();
        return view('student.edit', compact('student','countries','fields','states','districts','issue_districts'));

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
