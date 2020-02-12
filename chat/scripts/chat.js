$(document).ready(function () {
    $('#otvet').scrollTop($('#otvet')[0].scrollHeight);
    let url = window.location.href;
    let id = url.substring(url.lastIndexOf('=') + 1);


    let ws = new WebSocket('ws://localhost:8008/?id='+id);
    ws.onopen = function () {
        $('#seendme').on('click', function () {
            console.log($('#chel').text());
            let msg = {
                type: "message",
                text: $('#seend').val(),
                tableid: id,
                from: $('#chel').text(),
            };
            msg = JSON.stringify(msg);
            ws.send(msg);
        });

    };

    ws.onmessage = function (evt) {

        let today=new Date();
        let day=today.getDate();
        let moth=today.getMonth();
        let year=today.getFullYear();
        let minutes=today.getMinutes();
        let sec=today.getSeconds()-1;
        let hour=today.getHours();
        let datee = `${year}-${moth}-${day} ${hour}:${minutes}:${sec}`;
        console.log(evt.data);
        let a = JSON.parse(evt.data);
        if (a['from'] !== $('#chel').text()) {
            $('#otvet').append(`         
         <div class="messang">
            <div>
            <p class='user_text'>${a['text']}</p>
            <p class='user_date'>${datee}</p>
            </div>
            <h4>${a['from']}</h4>
        </div>`);

        } else {

            $('#otvet').append(`                
                <div class="messangme">
               
            <div>
            <p class='user_text'>${a['text']}</p>
            <p class='user_date'>${datee}</p>
            </div>
             <h4>${a['from']}</h4>
                </div>
`);
        }
        $('#otvet').scrollTop($('#otvet')[0].scrollHeight);
    };

});


