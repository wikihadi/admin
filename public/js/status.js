$(function () {
    $(".btn-add").click(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: 'POST',
            url: '/statuses/store',
            data: {
                comment: $("#frmAddTask input[name=comment]").val(),
                // description: $("#frmAddTask input[name=description]").val(),
            },
            dataType: 'json',
            // success: function(data) {
            //     $('#frmAddTask').trigger("reset");
            //     $("#frmAddTask .close").click();
            //     window.location.reload();
            // },
            // error: function(data) {
            //     var errors = $.parseJSON(data.responseText);
            //     $('#add-task-errors').html('');
            //     $.each(errors.messages, function(key, value) {
            //         $('#add-task-errors').append('<li>' + value + '</li>');
            //     });
            //     $("#add-error-bag").show();
            // }
        });
    });
});