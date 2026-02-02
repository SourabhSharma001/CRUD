<div>
<form id="addUserForm">
    <input type="text" name="name" placeholder="Name"><br><br>
    <input type="number" name="age" placeholder="Age"><br><br>
    <input type="date" name="dob"><br><br>
    <input type="text" name="address" placeholder="Address"><br><br>

    <button type="submit">Add User</button>
</form>

<p id="msg"></p>
</div>

<script>
document.getElementById('addUserForm').addEventListener('submit', function (e) {
    e.preventDefault(); // 🔥 stop page reload

    let formData = new FormData(this);

    fetch('/ajax-add-user', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: formData
    })
    .then(res => res.json())
    .then(data => {
        document.getElementById('msg').innerText = data.message;
        console.log(data.data); // see sent data
    });
});
</script>
