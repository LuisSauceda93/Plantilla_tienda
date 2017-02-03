var slider = $('#slider');
var btnPrev = $('#btnPrev');
var btnNext= $('#btnNext');

    $('#slider section:last').insertBefore('#slider section:first');
    slider.css('margin-left', '-'+100+'%');

    function moveR() {
        slider.animate({ marginLeft:'-'+200+'%'}, 700, function() {
            $('#slider section:first').insertAfter('#slider section:last');
            slider.css('margin-left', '-'+100+'%');
        });
    }

    function moveL() {
        slider.animate({ marginLeft:0+'%'}, 700, function() {
            $('#slider section:last').insertBefore('#slider section:first');
            slider.css('margin-left', '-'+100+'%');
        });
    }

    btnNext.on('click', function() {
        moveR();
    });
    btnPrev.on('click', function () {
        moveL();
    })
