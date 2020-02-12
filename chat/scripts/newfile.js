$('.window_user').on('click',function () {
    $('.newf').toggleClass('viss')
});
$('.newf').draggable();
$('#newfile').on('submit',function (event) {

    $.ajax({
        url: $(this).attr('action'),
        type: 'POST',
        data: $(this).serialize(),
        success: function (respon) {
            console.log(respon)

        },
    });
    event.preventDefault();
});