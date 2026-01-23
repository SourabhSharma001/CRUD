<div>
    <form method="POST" action="/users/update/{{ $user->id }}">
@csrf
Name: <input type="text" name="name" value="{{ $user->name }}"><br>
Age: <input type="number" name="age" value="{{ $user->age }}"><br>
DOB: <input type="date" name="dob" value="{{ $user->dob }}"><br>
Address: <textarea name="address">{{ $user->address }}</textarea><br>
<button type="submit">Update</button>
</form>
<!-- Act only according to that maxim whereby you can, at the same time, will that it should become a universal law. - Immanuel Kant -->
</div>
