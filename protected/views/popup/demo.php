<?php
/* @var $this PopupController */

$this->pageTitle=Yii::app()->name;
?>

<h1>Demo page</h1>

<style>
    .modal-footer:before,
    .modal-footer:after {
        content: " ";
        display: table;
    }
    .modal-footer:after {
        clear: both;
    }
    .close {
        font-size: 16px;
        line-height: 1;
        color: #fff;
        text-shadow: 0 1px 0 #ffffff;
        background: #60a634;
        padding: 5px 10px;
        cursor: pointer;
        border: 0;
        -webkit-appearance: none;
    }
    .close:hover,
    .close:focus {
        text-decoration: none;
        cursor: pointer;
    }
    .modal {
        display: none;
        overflow: hidden;
        position: fixed;
        top: 50%;
        right: 0;
        bottom: 0;
        left: 0;
        -webkit-transform: translateY(-50%);
        -ms-transform: translateY(-50%);
        -o-transform: translateY(-50%);
        transform: translateY(-50%);
        z-index: 1050;
        -webkit-overflow-scrolling: touch;
        outline: 0;
    }
    .modal.fade .modal-dialog {
        -webkit-transform: translate(0, -25%);
        -ms-transform: translate(0, -25%);
        -o-transform: translate(0, -25%);
        transform: translate(0, -25%);
        -webkit-transition: -webkit-transform 0.3s ease-out;
        -moz-transition: -moz-transform 0.3s ease-out;
        -o-transition: -o-transform 0.3s ease-out;
        transition: transform 0.3s ease-out;
    }
    .modal.in .modal-dialog {
        -webkit-transform: translate(0, 0);
        -ms-transform: translate(0, 0);
        -o-transform: translate(0, 0);
        transform: translate(0, 0);
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
    }
    .modal-dialog {
        position: relative;
        width: auto;
        margin: 10px;
    }
    .modal-content {
        position: relative;
        background-color: #000;
        -webkit-box-shadow: 0 3px 9px rgba(0, 0, 0, 0.5);
        box-shadow: 0 3px 9px rgba(0, 0, 0, 0.5);
        background-clip: padding-box;
        outline: 0;
        color: #fff;
    }
    .modal-body {
        position: relative;
        padding: 50px 20px;
        text-align: center;
        font-size: 20px;
    }
    .modal-footer {
        padding: 30px 20px;
        text-align: center;
        border-top: 1px solid #e5e5e5;
        background-color: #ffffff;
    }
    #modal-window {
        height: 100%;
    }
    @media (min-width: 768px) {
        .modal-dialog {
            width: 600px;
            margin: 50px auto;
        }
        .modal-content {
            -webkit-box-shadow: 0 5px 15px rgba(0, 0, 0, 0.5);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.5);
        }
    }
</style>

<div id="modal-window" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <?= $popup->popup_text ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">Закрыть попап</button>
            </div>
        </div>
    </div>
</div>

<script src="/assets/js/getpopup.js"></script>

<script>
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
</script>
