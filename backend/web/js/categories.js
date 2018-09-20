$(document).ready(function(){
    $('#delete').on('click',function () {
        $('#update_image').remove();
        $('#image_removed').val(1);
        $('.field-file').show();
    })
    if($('#update_image').length != 0){
        $('.field-file').hide();
    }
})