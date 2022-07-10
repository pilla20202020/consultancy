<tr>
    <td>{{++$key}}</td>
    <td>{{ Str::limit($admission->student->name, 47) }}</td>
    <td>{{ Str::limit($admission->college, 47) }}</td>
    <td>{{ $admission->admission_date }}</td>
    <td>{{ Str::limit($admission->student->program, 47) }}</td>
    <td>{{ $admission->fees }}</td>

    <td>
        <a href="{{route('admission.edit', $admission->admissions_id)}}"  class="btn btn-icon-toggle btn-sm" title="edit">
            <i class="mdi mdi-pencil"></i>
        </a>
        <a href="{{ route('admission.destroy', $admission->admissions_id) }}">
            <button type="button"
            class="btn btn-icon-toggle">
                <i class="far fa-trash-alt"></i>
            </button>
        </a>
        <a href="{{route('admission.commission', $admission->admissions_id)}}"  class="btn btn-primary btn-sm" title="Add Commission">
            Add Commission
        </a>
    </td>
</tr>

