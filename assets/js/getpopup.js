let popup = document.getElementById("custom-popup");
let url = new URL(popup.src);
let popup_id = url.searchParams.get("popup_id");
let popup_text = '';

let div = document.createElement('div');
div.innerHTML = '<style>\n' +
    '    .modal-footer:before,\n' +
    '    .modal-footer:after {\n' +
    '        content: " ";\n' +
    '        display: table;\n' +
    '    }\n' +
    '    .modal-footer:after {\n' +
    '        clear: both;\n' +
    '    }\n' +
    '    .close {\n' +
    '        font-size: 16px;\n' +
    '        line-height: 1;\n' +
    '        color: #fff;\n' +
    '        text-shadow: 0 1px 0 #ffffff;\n' +
    '        background: #60a634;\n' +
    '        padding: 5px 10px;\n' +
    '        cursor: pointer;\n' +
    '        border: 0;\n' +
    '        -webkit-appearance: none;\n' +
    '    }\n' +
    '    .close:hover,\n' +
    '    .close:focus {\n' +
    '        text-decoration: none;\n' +
    '        cursor: pointer;\n' +
    '    }\n' +
    '    .modal {\n' +
    '        display: none;\n' +
    '        overflow: hidden;\n' +
    '        position: fixed;\n' +
    '        top: 50%;\n' +
    '        right: 0;\n' +
    '        bottom: 0;\n' +
    '        left: 0;\n' +
    '        -webkit-transform: translateY(-50%);\n' +
    '        -ms-transform: translateY(-50%);\n' +
    '        -o-transform: translateY(-50%);\n' +
    '        transform: translateY(-50%);\n' +
    '        z-index: 1050;\n' +
    '        -webkit-overflow-scrolling: touch;\n' +
    '        outline: 0;\n' +
    '    }\n' +
    '    .modal.fade .modal-dialog {\n' +
    '        -webkit-transform: translate(0, -25%);\n' +
    '        -ms-transform: translate(0, -25%);\n' +
    '        -o-transform: translate(0, -25%);\n' +
    '        transform: translate(0, -25%);\n' +
    '        -webkit-transition: -webkit-transform 0.3s ease-out;\n' +
    '        -moz-transition: -moz-transform 0.3s ease-out;\n' +
    '        -o-transition: -o-transform 0.3s ease-out;\n' +
    '        transition: transform 0.3s ease-out;\n' +
    '    }\n' +
    '    .modal.in .modal-dialog {\n' +
    '        -webkit-transform: translate(0, 0);\n' +
    '        -ms-transform: translate(0, 0);\n' +
    '        -o-transform: translate(0, 0);\n' +
    '        transform: translate(0, 0);\n' +
    '        position: absolute;\n' +
    '        top: 50%;\n' +
    '        left: 50%;\n' +
    '        transform: translate(-50%, -50%);\n' +
    '    }\n' +
    '    .modal-dialog {\n' +
    '        position: relative;\n' +
    '        width: auto;\n' +
    '        margin: 10px;\n' +
    '    }\n' +
    '    .modal-content {\n' +
    '        position: relative;\n' +
    '        background-color: #000;\n' +
    '        -webkit-box-shadow: 0 3px 9px rgba(0, 0, 0, 0.5);\n' +
    '        box-shadow: 0 3px 9px rgba(0, 0, 0, 0.5);\n' +
    '        background-clip: padding-box;\n' +
    '        outline: 0;\n' +
    '        color: #fff;\n' +
    '    }\n' +
    '    .modal-body {\n' +
    '        position: relative;\n' +
    '        padding: 50px 20px;\n' +
    '        text-align: center;\n' +
    '        font-size: 20px;\n' +
    '    }\n' +
    '    .modal-footer {\n' +
    '        padding: 30px 20px;\n' +
    '        text-align: center;\n' +
    '        border-top: 1px solid #e5e5e5;\n' +
    '        background-color: #ffffff;\n' +
    '    }\n' +
    '    #modal-window {\n' +
    '        height: 100%;\n' +
    '    }\n' +
    '    @media (min-width: 768px) {\n' +
    '        .modal-dialog {\n' +
    '            width: 600px;\n' +
    '            margin: 50px auto;\n' +
    '        }\n' +
    '        .modal-content {\n' +
    '            -webkit-box-shadow: 0 5px 15px rgba(0, 0, 0, 0.5);\n' +
    '            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.5);\n' +
    '        }\n' +
    '    }\n' +
    '</style>';

async function get_popup() {
    let data = {'popup_id':popup_id};
    const response = await fetch("http://testsite/index.php/popup/getpopupbyscript", {
        method: 'POST',
        mode: 'no-cors',
        headers: {
            'Accept': 'application/json',
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(data)
    });
    let result = await response.json();
    if (result.status == 'ok') {
        popup_text = result.popup_text;
        if (popup_text !== '') {
            div.innerHTML += '<div id="modal-window" class="modal fade">\n' +
                '    <div class="modal-dialog">\n' +
                '        <div class="modal-content">\n' +
                '            <div class="modal-body">\n' + popup_text +
                '            </div>\n' +
                '            <div class="modal-footer">\n' +
                '                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">Закрыть попап</button>\n' +
                '            </div>\n' +
                '        </div>\n' +
                '    </div>\n' +
                '</div>';

            div.innerHTML += '<script src="https://code.jquery.com/jquery-1.12.4.min.js"\n' +
                '        integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ="\n' +
                '        crossorigin="anonymous"></script>';
            document.body.appendChild(div);
        }

    } else {
        console.log("Ошибка HTTP: " + response.status);
    }
};
get_popup();

window.onload = function() {
    setTimeout( function () {
        let modal = document.getElementById("modal-window");
        let btn = document.querySelector("#modal-window .close");
        if (modal && !modal.classList.contains('in')) {
            modal.classList.add('in');
            modal.style.display = "block";
        }
        if (btn) btn.addEventListener("click", function () {
            if (modal.classList.contains('in')) {
                modal.classList.remove('in');
                modal.style.display = "none";
            }
        });
    }, 10000);
};
