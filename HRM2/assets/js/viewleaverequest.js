$(document).ready(function() {
    $('#table').DataTable({
        ordering: false,
        searching: false,
        info: false
    });
});

$(document).ready(function() {
    $('#table1').DataTable({
        ordering: false,
        searching: false,
        info: false,
        pageLength: 5,
        lengthMenu: [
            [5, 10, 20],
            [5, 10, 20],
        ],
    });
});

$(document).ready(function() {
    $('#table2').DataTable({
        ordering: false,
        searching: false,
        info: false,
        pageLength: 5,
        lengthMenu: [
            [5, 10, 20],
            [5, 10, 20],
        ],
    });
});