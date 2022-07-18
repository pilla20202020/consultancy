<?php

namespace App\Http\Controllers\CommissionClaim;

use App\Http\Controllers\Controller;
use App\Modules\Models\Admission\Admission;
use App\Modules\Models\ClaimCommission\ClaimCommission;
use App\Modules\Models\Commission\Commission;
use App\Modules\Models\Student\Student;
use Illuminate\Http\Request;

class CommissionClaimController extends Controller
{

    protected $admission, $students, $commission, $claimCommission;

    function __construct(Admission $admission, Student $students, Commission $commission, ClaimCommission $claimCommission)
    {
        $this->admission = $admission;
        $this->students = $students;
        $this->commission = $commission;
        $this->claimCommission = $claimCommission;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $commissions = $this->commission->where('commissions_status','!=','paid')->paginate();
        return view('claimcommission.index', compact('commissions'));
    }

    public function claimed()
    {
        $commissions = $this->commission->where('commissions_status','paid')->paginate();
        return view('claimcommission.claimed', compact('commissions'));
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
