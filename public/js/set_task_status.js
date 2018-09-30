$(document).ready(function() {
    $('.btn-success').on('click', function(e) {
        e.preventDefault();
        var $clicked_row = $(this).closest('td').parent()[0].sectionRowIndex;
        var $clicked_col = $('#tasks_list tr').eq($clicked_row).find('td').eq(1);

        $clicked_col.find('p').toggleClass('done');
    });

    $('.js-like-task').on('click', function(e) {
        e.preventDefault();

        var $link = $(e.currentTarget);

        $link.toggleClass('fas fa-heart').toggleClass('far fa-heart');

        $.ajax({
            method : 'POST',
            url: $link.attr('href')
        }).done(function(data){
            $('.js-like-task-count').html(data.hearts);
        })

    });
});
