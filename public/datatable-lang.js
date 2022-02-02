// Call the dataTables jQuery plugin
$(document).ready(function () {
    let lang = $("html").attr("lang");
    if (lang === "ar") {
        $('#example1').DataTable({
            "language": {
                // "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Arabic.json"
                "url": "http://127.0.0.1:8000/datatable-ar.json"
            }
        });
    }

    /*$('#dataTable').DataTable({
        "language": {
            // "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Arabic.json"
            "url": "http://127.0.0.1:8000/plugins/datatables/arabic.json"
            // "url": "http://localhost:8000/plugins/datatables/arabic.json"
        }
    });*/
});
