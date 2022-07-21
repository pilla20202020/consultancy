<tr>
    <td>{{++$key}}</td>
    <td>{{ Str::limit($student->name, 47) }}</td>
    <td>{{ $student->email }}</td>
    <td>{{ Str::limit($student->phone, 47) }}</td>
    <td>
        {{ ucfirst($student->intake_month) }}, {{$student->intake_year}}
    </td>

    <td>
        <a href="{{route('student.edit', $student->students_id)}}"  class="btn btn-icon-toggle btn-sm" title="edit">
            <i class="mdi mdi-pencil"></i>
        </a>
        <a href="{{ route('student.destroy', $student->students_id) }}">
            <button type="button"
            class="btn btn-icon-toggle">
                <i class="far fa-trash-alt"></i>
            </button>
    </td>
</tr>

