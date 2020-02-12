$(window).on('load', function () {
    $('.add_form').draggable();
    $('#add_chat').on('click', function () {
        $('.add_form').toggleClass('vis');
    });

    $('#addChat').on('submit', function (event) {
        $.ajax({
            url: $(this).attr('action'),
            type: 'POST',
            data: $(this).serialize(),
            success: function (respon) {
                $('#chats').append(`<li><p>${respon}</p></li>`);
                location.reload();
            },
        });
        event.preventDefault();
    });

});