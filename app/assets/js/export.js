function sendPdf() {
    let from = document.getElementsByName("from_pdf")[0].value;
    let to = document.getElementsByName("to_pdf")[0].value;
    let subject = document.getElementsByName("subject_pdf")[0].value;
    let body = document.getElementsByName("body_pdf")[0].value;

    if (from != "" && to != "" && subject != "" && body != "")
        ajax_export_and_send("PDF", from, to, subject, body);
    else
        alert("Please fill in every field.");
}

function sendWord() {
    let from = document.getElementsByName("from_word")[0].value;
    let to = document.getElementsByName("to_word")[0].value;
    let subject = document.getElementsByName("subject_word")[0].value;
    let body = document.getElementsByName("body_word")[0].value;

    if (from != "" && to != "" && subject != "" && body != "")
        ajax_export_and_send("WORD", from, to, subject, body);
    else
        alert("Please fill in every field.");
}

function sendExcel() {
    let from = document.getElementsByName("from_excel")[0].value;
    let to = document.getElementsByName("to_excel")[0].value;
    let subject = document.getElementsByName("subject_excel")[0].value;
    let body = document.getElementsByName("body_excel")[0].value;

    if (from != "" && to != "" && subject != "" && body != "")
        ajax_export_and_send("EXCEL", from, to, subject, body);
    else
        alert("Please fill in every field.");
}

function sendCsv() {
    let from = document.getElementsByName("from_csv")[0].value;
    let to = document.getElementsByName("to_csv")[0].value;
    let subject = document.getElementsByName("subject_csv")[0].value;
    let body = document.getElementsByName("body_csv")[0].value;

    if (from != "" && to != "" && subject != "" && body != "")
        ajax_export_and_send("CSV", from, to, subject, body);
    else
        alert("Please fill in every field.");
}

function sendJson() {
    let from = document.getElementsByName("from_json")[0].value;
    let to = document.getElementsByName("to_json")[0].value;
    let subject = document.getElementsByName("subject_json")[0].value;
    let body = document.getElementsByName("body_json")[0].value;

    if (from != "" && to != "" && subject != "" && body != "")
        ajax_export_and_send("JSON", from, to, subject, body);
    else
        alert("Please fill in every field.");
}

function ajax_export_and_send(type, from, to, subject, body) {
    let form_data = new FormData();
    form_data.append('type', type);
    form_data.append('from', from);
    form_data.append('to', to);
    form_data.append('subject', subject);
    form_data.append('body', body);

    $.ajax({
        type: 'POST',
        url: 'export.php',
        contentType: false,
        processData: false,
        data: form_data,
        success: function (response) {
            location.reload();
            alert(response);
        }
    });

}