<tr>
    <td>{{++$key}}</td>
    <td>{{ Str::limit($admission->student->name, 47) }}</td>
    <td>{{ $admission->country->country_name }}, {{$admission->state->state_name}}</td>
    <td>{{ $admission->college->name }}</td>
    <td>
        {{ $admission->intake_month }}, {{$admission->intake_year}}
    </td>
    <td>{{ Str::limit($admission->student->program, 47) }}</td>
    <td>{{ $admission->fees }}</td>

    <td>

        <a href="{{route('admission.commission', $admission->admissions_id)}}"  class="btn btn-primary btn-sm" title="Add Commission">
            Add Commission
        </a>

        <button data-admission_id="{{$admission->admissions_id}}"  class="btn btn-warning btn-sm viewhistory" title="Add Commission">
            View Payment
        </button>

        {{-- @if(!$admission->claimCommission->isEmpty())
            <button data-commission_id="{{$admission->claimCommission->first()->commissions_id}}"  class="btn btn-warning btn-sm changestatus" title="Claim Commission">
                Claim Commission
            </button>
            <input type="hidden" class="upcoming_commission_date" value="{{$admission->claimCommission->first()->claim_date}}">
            <input type="hidden" class="upcoming_commission_title" value="{{$admission->claimCommission->first()->title}}">
        @endif --}}
    </td>
</tr>

