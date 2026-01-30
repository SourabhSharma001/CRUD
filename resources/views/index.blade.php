<div>
    <a href="/users/create">Add User</a>

<table border="20">
<tr>
<th>Name</th><th>Age</th><th>DOB</th><th>Address</th><th>Action</th>
</tr>

@foreach($users as $u)
<tr>
<td>{{ $u->name }}</td>
<td>{{ $u->age }}</td>
<td>{{ $u->dob }}</td>
<td>{{ $u->address }}</td>
<td>
<a href="/users/edit/{{ $u->id }}">Edit</a> |
<a href="/users/delete/{{ $u->id }}">Delete</a>
</td>
</tr>
@endforeach
</table>
<!-- It is not the man who has too little, but the man who craves more, that is poor. - Seneca -->
</div>
