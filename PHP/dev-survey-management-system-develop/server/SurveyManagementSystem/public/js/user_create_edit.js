$(".auths").change(function() {
    var value = $(".auths").val();
    if(value == 2) {
        $('.survey_select').css('display', 'none');
        $('.trader_select').css('display', 'block');
    }else if(value == 3) {
        $('.survey_select').css('display', 'block');
        $('.trader_select').css('display', 'none');
    }else{
        $('.survey_select').css('display', 'none');
        $('.trader_select').css('display', 'none');
    }
});

// $('.chosen-select').chosen({
//     width: "320px",
// });