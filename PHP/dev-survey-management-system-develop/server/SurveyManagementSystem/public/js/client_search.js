
function openwindow() {
    window.open('','new_window','widrh=600,height=400,scrollbars=yes');
    document.form1.action = 'create_search';
    document.form1.method = 'POST';
    document.form1.target = 'new_window';
    document.form1.submit();
};

//子ウィンドウで選択したデータを親ウィンドウに移行する
var val = "";
$(function(){
    $(".btn-sm").click(function(e){
        val = $(this).parents('tr').attr('id');
    
        //console.log(val);
        //console.log($('#' + val).find('#zipcode').attr('value'));
        var member_id = $('#' + val).find('#member_id').attr('value');
        var contractor_contact = $('#' + val).find('#contractor_contact').attr('value');
        var zipcode = $('#' + val).find('#zipcode').attr('value');
        var prefectures = $('#' + val).find('#prefectures').attr('value');
        var city = $('#' + val).find('#city').attr('value');
        var town_area = $('#' + val).find('#town_area').attr('value');
        var buildingname_roomnumber = $('#' + val).find('#buildingname_roomnumber').attr('value');

        var trader = $('#' + val).find('#trader').attr('value');
        var survey = $('#' + val).find('#survey').attr('value');

        window.opener.document.getElementById("survey").options[survey].selected = true;
        window.opener.document.getElementById("trader").options[trader].selected = true;
    
        window.opener.document.getElementById("member_id").value = member_id;
        window.opener.document.getElementById("contractor_contact").value = contractor_contact;
        window.opener.document.getElementById("zipcode").value = zipcode;
        window.opener.document.getElementById("prefectures").value = prefectures;
        window.opener.document.getElementById("city").value = city;
        window.opener.document.getElementById("town_area").value = town_area;
        window.opener.document.getElementById("buildingname_roomnumber").value = buildingname_roomnumber;
        window.close();
    });
});

//業者セレクトボックスが選択されたら紐づいている調査会社を選択可能に
document.addEventListener("DOMContentLoaded",function(){
    var first = ($(".survey").val() == "");

    $(".trader").on("change",function(){
        if(first){
            $(".survey option[value='']").prop('selected',true);
        }
        first = true;

        $(".survey option").hide();
        $(".survey option[data-val='']").show();
        $('.survey option[data-val="' + this.value + '"]').show();
    }).change();
});
