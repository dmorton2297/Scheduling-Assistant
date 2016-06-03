jQuery(document).ready(function () {
    $('#btn-active-users').on('click', function(e) {
        $(this).toggleClass('active');

        var isActive = $(this).hasClass('active');
        if (!isActive) {
            $('#hdn-inactive-users').val(1);
            $('#btn-inactive-users').toggleClass('active', true);
        }


        $('#hdn-active-users').val(isActive ? 1 : 0).trigger('change');
        //$.pjax.reload({container:'#gridPjax'});
    });
    $('#btn-inactive-users').on('click', function(e) {
        $(this).toggleClass('active');

        var isActive = $(this).hasClass('active');
        if (!isActive) {
            $('#hdn-active-users').val(1);
            $('#btn-active-users').toggleClass('active', true);
        }


        $('#hdn-inactive-users').val(isActive ? 1 : 0).trigger('change');
        //$.pjax.reload({container:'#gridPjax'});
    });

});