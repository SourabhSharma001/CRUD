<div>

   
<!-- Add User Button -->
{{-- <button id="addRowBtn" class="add-btn">Add User</button> --}}


<div>

    <table border="1" width="100%">
        <tr>
            <th>Name</th>
            <th>Age</th>
            <th>DOB</th>
            <th>Address</th>
            <th>Action</th>
        </tr>

        <tbody id="userTable">
        @foreach($users as $u)
        <tr data-id="{{ $u->id }}">
            <td>{{ $u->name }}</td>
            <td>{{ $u->age }}</td>
            <td>{{ \Carbon\Carbon::parse($u->dob)->format('d-m-Y') }}</td>
            <td>{{ $u->address }}</td>
            <td>
                <button class="btn-edit" onclick="editRow(this)">Edit</button>
                <button class="btn-delete" onclick="deleteUser({{ $u->id }}, this)">Delete</button>
            </td>
        </tr>
        @endforeach
        </tbody>
    </table>

    <br>
                     
                    <!-- Buttons -->
    <button id="addRowBtn" class="add-btn">Add User</button>
    <button id="saveBtn" class="btn-save">Save</button>

</div>









<!-- ================= CSS ================= -->
<style>
    table{
        width: 50%;
        text-align: center;
        font-family: Arial, Helvetica, sans-serif;
        border-coll
    }
.add-btn {
    background: #22c55e;
    color: white;
    padding: 6px 12px;
    border: none;
    border-radius: 4px;
    font-family: Arial, Helvetica, sans-serif;
}
.add-btn:hover {
    background: #33935d;
}
.btn-save {
    background: #0165d7;
    color: white;
    padding: 6px 12px;
    border: none;
    border-radius: 4px;
    font-family: Arial, Helvetica, sans-serif;
}
.btn-save:hover {
    background: #94a3b8;
}
.btn-edit {
    background: #2563eb;
    color: white;
    padding: 4px 10px;
    border: none;
    border-radius: 4px;
}
.btn-edit:hover {
    background: #3b82f6;
}
.btn-delete {
    background: #dc2626;
    color: white;
    padding: 4px 10px;
    border: none;
    border-radius: 4px;
}
.btn-delete:hover {
    background: #ef4444;
}
</style>









<!-- ================= JS ================= -->
<script>
/* ===== GLOBAL STATE ===== */
const saveBtn = document.getElementById('saveBtn');
const addBtn  = document.getElementById('addRowBtn');

let mode = null;        // "add" | "edit"
let activeRow = null;
let activeId  = null;

/* ===== ADD USER ===== */
addBtn.addEventListener('click', () => {

    if (mode) {
        alert('Finish current edit first');
        return;
    }

    const tbody = document.getElementById('userTable');

    tbody.insertAdjacentHTML('afterbegin', `
        <tr id="activeRow">
            <td><input type="text" id="name"></td>
            <td><input type="number" id="age"></td>
            <td><input type="date" id="dob"></td>
            <td><input type="text" id="address"></td>
            <td>—</td>
        </tr>
    `);

    mode = 'add';
    activeRow = document.getElementById('activeRow');
    activeId = null;
    saveBtn.disabled = false;
});

/* ===== EDIT USER ===== */
function editRow(btn) {

    if (mode) {
        alert('Finish current edit first');
        return;
    }

    const row = btn.closest('tr');
    const cells = row.children;

    cells[0].innerHTML = `<input id="name" value="${cells[0].innerText}">`;
    cells[1].innerHTML = `<input id="age" type="number" value="${cells[1].innerText}">`;
    cells[2].innerHTML = `<input id="dob" type="date"
        value="${cells[2].innerText.split('-').reverse().join('-')}">`;
    cells[3].innerHTML = `<input id="address" value="${cells[3].innerText}">`;

    mode = 'edit';
    activeRow = row;
    activeId = row.dataset.id;
    saveBtn.disabled = false;
}

/* ===== UNIVERSAL SAVE ===== */
saveBtn.addEventListener('click', () => {

    if (!mode || !activeRow) {
        alert('Nothing to save');
        return;
    }

    const data = {
        name: document.getElementById('name').value,
        age: document.getElementById('age').value,
        dob: document.getElementById('dob').value,
        address: document.getElementById('address').value
    };

    const url = (mode === 'add')
        ? '/ajax-add-user'
        : `/ajax-update-user/${activeId}`;

    fetch(url, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify(data)
    })
    .then(res => res.json())
    .then(user => {

        activeRow.innerHTML = `
            <td>${user.name}</td>
            <td>${user.age}</td>
            <td>${user.dob}</td>
            <td>${user.address}</td>
            <td>
                <button class="btn-edit" onclick="editRow(this)">Edit</button>
                <button class="btn-delete" onclick="deleteUser(${user.id}, this)">Delete</button>
            </td>
        `;

        mode = null;
        activeRow = null;
        activeId = null;
        saveBtn.disabled = true;
    });
});

/* ===== DELETE ===== */
function deleteUser(id, btn) {
    fetch(`/ajax-delete-user/${id}`, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        }
    }).then(() => btn.closest('tr').remove());
}
</script>



