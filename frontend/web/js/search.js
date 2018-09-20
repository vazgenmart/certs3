$(document).ready(function () {
    $('#search').on('submit',function (e) {
        e.preventDefault();
        var $form =  $('#search').serialize();
        if($('.field-search-date .help-block').text() == '' && $('.field-search-term .help-block').text() == '')
        $.ajax({
            url: '/site/search',
            method: 'POST',
            data:$form,
            success: function (data) {
                $('.results').html(data);
            }
        })
    })
})