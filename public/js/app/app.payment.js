$(function() {

    $('#table-payment tfoot th').each(function() {
        var title = $(this).text();
        $(this).html('<input type="text" style="text-align: center;" placeholder="' + title + '" />');
    });


    var table = $("#table-payment").DataTable({
        "pageLength": 30,
        "dom": '<"top"flp<"clear">>rt<"bottom"ifp<"clear">>',
        "order": [
            [0, "asc"]
        ]
    });

    table.columns().every(function() {
        var that = this;

        $('input', this.footer()).on('keyup change', function() {
            if (that.search() !== this.value) {
                that
                    .search(this.value)
                    .draw();
            }
        });
    });
    
});