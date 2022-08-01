<tr>
    <td>{{++$key}}</td>
    <td>{{ Str::limit($branch->name, 47) }}</td>
    <td>{{ $branch->email }}</td>
    <td>{{ Str::limit($branch->phone, 47) }}</td>
    <td>{{ Str::limit($branch->address, 47) }}</td>
    <td>
        <a href="{{route('branch.edit', $branch->id)}}"  class="btn btn-icon-toggle btn-sm" title="edit">
            <i class="mdi mdi-pencil"></i>
        </a>
        <button type="button" class="btn btn-icon-toggle" onclick="deleteThis(this); return false;" link="{{ route('branch.destroy', $branch->id) }}">
            <i class="far fa-trash-alt"></i>
        </button>
    </td>
</tr>

