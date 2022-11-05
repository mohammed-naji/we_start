<h1>{{ $abc }}</h1>
<h3>{{ $my_age }}</h3>

<table border="1">
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Email</th>
    </tr>

    @forelse ($users as $user)
    <tr {{ $loop->odd ? 'style=background:red' : '' }}>
        <td>{{ $user['id'] }}</td>
        <td>{{ $user['name'] }}</td>
        <td>{{ $user['email'] }}</td>
    </tr>
    @empty
    <tr>
        <td colspan="3">No Data Found</td>
    </tr>
    @endforelse

    {{-- @if (count($users) > 0)
        @foreach($users as $user)
        <tr {{ $loop->odd ? 'style=background:red' : '' }}>
            <td>{{ $user['id'] }}</td>
            <td>{{ $user['name'] }}</td>
            <td>{{ $user['email'] }}</td>
        </tr>
        @endforeach
    @else
    <tr>
        <td colspan="3">No Data Found</td>
    </tr>
    @endif --}}


</table>
