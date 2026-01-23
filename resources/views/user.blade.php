<div>
    <form method="POST" action="/users/store">
@csrf
Name: <input type="text" name="name"><br>
Age: <input type="number" name="age"><br>
DOB: <input type="date" name="dob"><br>
Address: <textarea name="address"></textarea><br>
<button type="submit">Save</button>
</form>
<!-- Happiness is not something readymade. It comes from your own actions. - Dalai Lama -->
</div>
