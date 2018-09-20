$(document).ready(function () {
    $('.post-img').on('click', function (e) {
        $(this).toggleClass('active');
    })

    $('#save-from-post').on('click', function (e) {
        e.preventDefault();

        var images = [];
        $.each($('.post-img.active'), function (i, e) {
            images[i] = {};
            images[i].post_id = $(this).data('p_id');
            images[i].image_id = $(this).data('i_id');
            images[i].category_id = $('#category_id').val();
        })
        if (images.length > 0)
            $.ajax({
                url: 'create',
                type: "POST",
                beforeSend: function (xhr) {
                    xhr.setRequestHeader('X-CSRF-Token', $('meta[name="csrf-token"]').attr('content'))
                },
                data: {'images': images},
                success: function (data) {
                    window.location.href = "index";
                }
            })
    })
    $('#gallery-content_type').on('change', function (e) {
        $.ajax({
            url: 'types',
            type: "POST",
            beforeSend: function (xhr) {
                xhr.setRequestHeader('X-CSRF-Token', $('meta[name="csrf-token"]').attr('content'))
            },
            data: {'type': $(this).val()},
            success: function (data) {
                $('#gallery-post_id').html(data);
            }
        })
    })
    $("#gallery-type").on('change', function (e) {
        if ($(this).val() == 'video') {
            $('.field-gallery-url').parent().removeClass('hidden');
            $('.field-gallery-file_id').parent().addClass('hidden');
        }
        else {
            $('.field-gallery-url').parent().addClass('hidden');
            $('.field-gallery-file_id').parent().removeClass('hidden');
        }

    })

})