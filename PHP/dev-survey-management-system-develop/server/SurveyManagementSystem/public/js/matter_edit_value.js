$(function() {

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