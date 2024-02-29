<table class="table table-hover">
    <thead>
        <tr>
            <th width="10%">Action</th>
            <th>User Name</th>
            <th>Email</th>
        </tr>
    </thead>
    <tbody>
        @if(isset($users_data))
        @foreach ($users_data as $users)
        <tr class="user_row_{{$users->id}}">
            <td>
                <a href="{{ route('user-profile', ['id' => $users->id]) }}"><i class="fa fa-solid fa fa-edit fa-lg"></i></a>&nbsp;
                <i class="fa fa-solid fa fa-trash fa-lg" onclick="delete_user({{$users->id}})"></i>
            </td>
            <td>{{ ucfirst($users->name) }}</td>
            <td>{{ $users->email }}</td>
        </tr>
        @endforeach
        @endif
    </tbody>
</table>