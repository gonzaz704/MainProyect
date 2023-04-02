$(document).ready(function () {
    $('#user-follow').on('click', function () {   //user-follow ejecuta el id del blade

        //get the id of the user to follow
        var id = $('#user-follow').data('userid');  //userid imprime el usuario que esta logueado
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            type: 'POST',
            url: 'http://localhost:8000/profile/'+ id +'/follow',
            data: {_token: CSRF_TOKEN},
            success: function (response) {
                if (response == 'success') {
                    alert("Successfully Following!");
                    //$("#user-follow").attr('disabled', true);
                    $("#user-follow").html('Following');
                }
            }
        });
    });
    $('#user-voted').on('click', function () {
        var id = $('#user-voted').data('userid');
        var paper_id = $('#user-voted').data('paper_id');
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            type: 'POST',
            url: 'http://localhost:8000/profile/' + id + '/vote/' + paper_id,
            data: {_token: CSRF_TOKEN},
            success: function (response) {
                if (response == 'success') {
                    alert("Successfully Voted!");
                    $("#user-voted").html('Voted');
                }
            }
        });
    });

});
