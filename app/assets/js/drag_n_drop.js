let fileobj;

function upload_file(e) {
    e.preventDefault();
    fileobj = e.dataTransfer.files[0];
    ajax_file_upload(fileobj);
}

function file_explorer() {
    document.getElementById('selectfile').click();
    document.getElementById('selectfile').onchange = function () {
        fileobj = document.getElementById('selectfile').files[0];
        ajax_file_upload(fileobj);
    };
}

function ajax_file_upload(file_obj) {
    if (file_obj != undefined) {
        let form_data = new FormData();
        form_data.append('file', file_obj);
        $.ajax({
            type: 'POST',
            url: 'upload_file.php',
            contentType: false,
            processData: false,
            data: form_data,
            success: function (response) {
                $('#selectfile').val('');
                location.reload();
                alert(response);
            }
        });
    }
}