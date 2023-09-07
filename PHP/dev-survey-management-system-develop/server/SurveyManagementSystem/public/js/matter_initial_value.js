$(function() {
   
    //validateに引っかからないように0を入れておく。
    document.getElementById("quotation_money").value = 0;
　  document.getElementById("certification_money").value = 0;
    document.getElementById("fee").value = 0;
    document.getElementById("referral_rate").value = 0;
    document.getElementById("referral_rate_2").value = 0;
　  document.getElementById("referral_rate_3").value = 0;
    document.getElementById("survey_referral").value = 0;
    document.getElementById("riguranto_fee").value = 0;


    //取次店が変わったら、紹介率を5％にする
    $("#trader_name").on('change',function() {
        document.getElementById("referral_rate").value = 5;
    });

　//取次店2が変わったら、紹介率を1％にする
    $("#agency_store_2").on('change',function() {
        document.getElementById("referral_rate_2").value = 1;
    });

　　//取次店3が変わったら、紹介率を1％にする
    $("#agency_store_3").on('change',function() {
        document.getElementById("referral_rate_3").value = 1;
    });


  });