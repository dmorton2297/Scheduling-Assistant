$(function() {
    $('#assignRole').on('click', function() {
        window.location = 'add-user-role?id=' + $('#userId').val() + '&role=' + $('#roleList').val();

    });
});