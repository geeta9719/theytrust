@foreach($users as $user)
    <tr>
        <td>{{ $loop->iteration }}</td>
        <td>{{ $user->name }}</td>
        <td>{{ $user->email }}</td>
        <td>{{ $user->mobile }}</td>
        <td><img src="{{ asset('path-to-your-images-directory/' . $user->image) }}" alt="{{ $user->name }}" width="50"></td>
        <td>{{ $user->company }}</td>
        <td>{{ $user->bio }}</td>
        <td>{{ $user->twitter }}</td>
        <td>{{ $user->linkedin }}</td>
        <td>{{ $user->slug }}</td>
        <td>{{ $user->created_at }}</td>
        <td nowrap>
            <a href="{{route('admin.users.edit', $user)}}" class="btn btn-sm btn-primary">Edit</a>

            <form method="post" action="{{route('admin.user.destroy', $user)}}" style="display: inline-block;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this user?')">Delete</button>
            </form>
        </td>
    </tr>
@endforeach

<!-- Pagination links -->
<tr><td colspan="12" style="text-align:center">{!! $users->links() !!}</td></tr>

<!-- Check if there's no user data -->
@if(!$users->count())
    <tr>
        <td colspan="12" style="text-align:center">No Record Found</td>
    </tr>    
@endif
