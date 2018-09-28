$(document).ready(function() {
    $('.btn-success').on('click', function(e) {
        e.preventDefault();
        var $clicked_row = $(this).closest('td').parent()[0].sectionRowIndex;
        var $clicked_col = $('#tasks_list tr').eq($clicked_row).find('td').eq(1);

        $clicked_col.find('p').toggleClass('done');
    });
});
