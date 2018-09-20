$(document).ready(function () {
    /**
     * save images in content functionality
     */
    $('#createPost').submit(function (e) {
        e.preventDefault();
        var $sources = [];
        var $count = 0;
        $.each($('.field-posts-text_am img'), function (i, e) {
            var $name = $(this).attr('src').split('/')
            $sources[$count++] = $name[$name.length - 1];
        })

        $.each($('.field-posts-text_en img'), function (m, e) {
            var $name = $(this).attr('src').split('/')
            $sources[$count++] = $name[$name.length - 1];
        })




        $('#posts_files').val(JSON.stringify($sources));
        setTimeout($('#createPost').unbind(), 300);
    })

    $('#cat').on('click',function () {
        $('.cat').toggleClass('hidden');
        $('.post').addClass('hidden');
    })
    $('#post').on('click',function () {
        $('.cat').addClass('hidden');
        $('.post').toggleClass('hidden');
    })
    /**
     * delete Image
     */
    $('#delete').on('click', function () {
        $('#update_image').remove();
        $('#image_removed').val(1);
        $('#file').show();
    })
    
    if ($('#update_image').length != 0) {
        $('#file').hide();
    }
    

    
})
