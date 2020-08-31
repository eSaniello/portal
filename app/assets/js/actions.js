function deleteRecord(id) {
    let _confirm = confirm("Are u sure you want to delete this?");

    if (_confirm)
        ajax_delete(id);
}

function deleteUser(id) {
    let _confirm = confirm("Are u sure you want to delete this?");

    if (_confirm)
        ajax_delete_user(id);
}

function ajax_delete(id) {
    if (id != undefined) {
        let form_data = new FormData();
        form_data.append('data_id', id);
        $.ajax({
            type: 'POST',
            url: 'actions.php',
            contentType: false,
            processData: false,
            data: form_data,
            success: function (response) {
                location.reload();
                alert(response);
            }
        });
    }
}

function ajax_delete_user(id) {
    if (id != undefined) {
        let form_data = new FormData();
        form_data.append('user_id', id);
        $.ajax({
            type: 'POST',
            url: 'actions.php',
            contentType: false,
            processData: false,
            data: form_data,
            success: function (response) {
                location.reload();
                alert(response);
            }
        });
    }
}

function updateRecord(id) {
    let url = new URL("http://localhost/portal/app/views/edit_data.php");
    url.searchParams.append('data_id', id);
    window.location.href = url;
}

function updateUser(id) {
    let url = new URL("http://localhost/portal/app/views/edit_user.php");
    url.searchParams.append('user_id', id);
    window.location.href = url;
}

function gotoAddPage() {
    let url = new URL("http://localhost/portal/app/views/add_data.php");
    window.location.href = url;
}

function gotoAddUserPage() {
    let url = new URL("http://localhost/portal/app/views/add_user.php");
    window.location.href = url;
}