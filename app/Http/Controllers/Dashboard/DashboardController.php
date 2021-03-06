<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Modules\Models\Admission\Admission;
use App\Modules\Models\Candidate\Candidate;
use App\Modules\Service\Candidate\CandidateService;
use App\Modules\Service\Permission\PermissionService;
use App\Modules\Service\role\RoleService;
use App\Modules\Service\User\UserService;
use App\Modules\Models\User;
use App\Modules\Models\Batch\Batch;
use App\Modules\Models\Candidate\SelectedCandidate;
use App\Modules\Models\CheckIn\CheckIn;
use App\Modules\Models\Commission\Commission;
use App\Modules\Models\Customer\Customer;
use App\Modules\Models\FollowUp\FollowUp;
use App\Modules\Models\Student\Student;
use App\Modules\Service\Customer\CustomerService;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $user, $role, $permission, $student, $admission, $commission, $followups;

    function __construct(UserService $user, Student $student, Admission $admission, Commission $commission, FollowUp $followup)
    {
        $this->user = $user;
        $this->student = $student;
        $this->admission = $admission;
        $this->commission = $commission;
        $this->followup = $followup;
    }
    public function index()
    {
        $date = Carbon::now()->addDays(30);
        $users_count = User::count();
        $commissions = $this->commission->where('claim_date', '>', date('Y-m-d'))->whereBetween('claim_date', [date('Y-m-d'),$date])->orderBy('claim_date', 'ASC')->where('commissions_status','pending')->get();
        // $commissions = $commissions->unique('student_id');
        $followups = $this->followup->where('next_schedule', '>', date('Y-m-d'))->orderBy('next_schedule', 'ASC')->get();
        return view('dashboard.index',compact('users_count','commissions','followups'));

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
        //
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
        //
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
    }
}
