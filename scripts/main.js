let changedoor = -100, a = $(".door_content:nth-of-type(1)"), b = $(".door_content:nth-of-type(2)");
$(window).on('load', function () {
    a.fadeOut(0);
    b.fadeIn();

    $('#changedoor').on('click', () => {
        $('#changedoor').removeClass('animate');
        if (changedoor === -100) {


            b.fadeOut(300);
            a.delay(300).fadeIn();
            $('#changedoor').animate({"width": "150px"}, 600, function () {
                $(this).animate({"width": "125px"}, 600)
            });
            $('#changedoor').find('span').text('Sign Up').slideUp(300).fadeOut();
            $('#changedoor').find('span').text('Sign In').slideDown(300).fadeIn();
            $('.door').attr('style', `transform :translate(${changedoor}%,0); background-position-x: 0%;`);
            changedoor = 100;
        } else {
            a.fadeOut(300);
            b.delay(300).fadeIn();


            $('#changedoor').animate({"width": "150px"}, 600, function () {
                $(this).animate({"width": "125px"}, 600)
            });
            $('#changedoor').find('span').text('Sign In').slideUp(300).fadeOut();
            $('#changedoor').find('span').text('Sign Up').slideDown(300).fadeIn();
            $('.door').attr('style', '');
            changedoor = -100;
        }
    });


    $('#signup').on('submit', function (event) {
        $.ajax({
            url: $(this).attr('action'),
            type: 'POST',
            data: $(this).serialize(),
            success: function (respon) {
                respon = JSON.parse(respon);
                if ( respon[0]['username'] === "" &&   respon[0]['password']=== "" &&   respon[0]['email']=== ""){
                    $(location).attr('href', 'chat/menuchat.php');
                }else{
                    $('#username').text(respon[0]['username']);
                    $('#email').text(respon[0]['email']);
                    $('#password').text(respon[0]['password']);
                }

            },
        });
        event.preventDefault();
    });

    $('#signin').on('submit', function (event) {
        $.ajax({
            url: $(this).attr('action'),
            type: 'POST',
            data: $(this).serialize(),
            success: function (respon) {
                respon = JSON.parse(respon);
                if (respon[0]['email'] === "" &&  respon[0]['password']=== ""){
                    $(location).attr('href', 'chat/menuchat.php');
                }else{

                    $('#emailsig').text(respon[0]['email']);
                    $('#passwordsing').text(respon[0]['password']);
                }
            },
        });
        event.preventDefault();
    });
});


