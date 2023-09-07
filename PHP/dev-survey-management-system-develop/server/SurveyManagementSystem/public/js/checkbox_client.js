$(function() {
    var cost = document.getElementById('get_value');
    var dele = document.getElementById('forget_value');
    var import_class = document.getElementsByClassName('important_check');
    var import_val = document.getElementsByClassName('important_val');
    var status_all = document.getElementsByClassName('status_all_id');

    var status_name = null;
    var status_name_target = null;
    var status_all_id = [];
    var important_value = [];
    
    // チェックボックスが変わったら、更新ボタンと削除ボタンを表示
    function disp_block(){
        cost.style.display = "block";
        dele.style.display = "block";
    }

   // チェックボックスが変わったら、更新ボタンと削除ボタンを表示
    $("input[name='chk[]']").on('click',function() {
        cost.style.display = "block";
        dele.style.display = "block";
    });

    // 1. 「全選択」する
    $('#all').on('click', function() {
        $("input[name='chk[]']").prop('checked', this.checked);
        var del = document.getElementById('forget_value');
        del.style.display = "block";
    });

    /* 星マークがクリックされたとき、チェックボックスにチェックを入れる,、星マークの色とvalueを変える*/
    $('.important_check').on('click', function() {
        var val = $(this).closest("tr").find('input').val();
        $('input[value='+val+']').prop('checked',true);
        disp_block();

        if(this.innerHTML == "star_border"){
            import_class.item(val - 1).innerHTML = "<span class='import_color'>star_rate</span>";
            return import_val.item(val - 1).defaultValue = '★';
        }else {
            import_class.item(val - 1).innerHTML = "star_border";
            return import_val.item(val - 1).defaultValue = '☆';
        }
    });

    // 項目が変更された場合、チェックボックスにチェックを入れる
    $('select').on('change',function() {
        var val = $(this).closest("tr").find('input').val();
        $('input[value='+val+']').prop('checked',true);
        disp_block();
    });

    //現状STで変更を加えたものの一番先頭に来る値を取得
    $(document).on('change',".status_name",function() {
        status_name = $("input[name='chk[]']:checked").map(function() {
            return $(this).closest("tr").find(".status_name option:selected").val();
        }).get();
        status_name_target = status_name[0];
    });

    //更新するためのプルダウンに切り替え
    $("i[class=material-icons]").click(function() {
        var value = $(this).prevAll().get(0);
        var icon = $(this).get(0);
        icon.style.display = "none";
        value.style.display = "none";
        var pulldown = $(this).next().get(0);
        pulldown.style.display = "block";
    });

    /* ------------------------------
    Loading イメージ表示関数
    引数： msg 画面に表示する文言
    ------------------------------ */
    function dispLoading(msg){
        // 引数なし（メッセージなし）を許容
        if( msg == undefined ){
          msg = "";
        }
        // 画面表示メッセージ
        var dispMsg = "<div class='loadingMsg'>" + msg + "</div>";
        // ローディング画像が表示されていない場合のみ出力
        if($("#loading").length == 0){
          $("body").append("<div id='loading'>" + dispMsg + "</div>");
        }
      }
       
      /* ------------------------------
       Loading イメージ削除関数
       ------------------------------ */
      function removeLoading(){
        $("#loading").remove();
      }

    //情報の削除
    $(document).on("click","#forget_value",function() {
        
       var result = window.confirm('本当に削除しますか？');
    
        if( result == false) {
        } else {

        //選択したチェックボックスのidを配列で取得
        var value = $("input[name='chk[]']:checked").map(function() {
            return $(this).val();
        }).get();

        //チェックボックスにチェックが入ってない場合の処理
        if(value == '') {
            alert('項目が選択されていません');
            return false;
        }
        
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'POST',
            url: '/client/check_delete/' + value,
            cache: false,
            dataType: 'json',
            timeout: 30000,
            beforeSend: function(){
                dispLoading("処理中...");
              }
        })
        .done(function(){
            alert("削除しました");
            location.reload();
        })
        .fail(function(XMLHttpRequest, textStatus, errorThrown){
            alert("通信に失敗しました。管理者に報告してください。");
            console.log("XMLHttpRequest : " + XMLHttpRequest.status);
            console.log("textStatus     : " + textStatus);
            console.log("errorThrown    : " + errorThrown.message);
        })
        .always(function(data) {
            // Lading 画像を消す
            removeLoading();
          })};
    });

    //情報の更新
    $(document).on("click","#get_value",function() {

        var result = window.confirm('本当に更新しますか？');

        if( result == false) {
        } else {

        //選択したチェックボックスのidを配列で取得
        var value = $("input[name='chk[]']:checked").map(function() {
            return $(this).val();
        }).get();

        //チェックボックスにチェックが入ってない場合の処理
        if(value == '') {
            alert('項目が選択されていません');
            return false;
        }

        value.forEach(function(element) {
            status_all_id[element - 1] = status_all[0].defaultValue;
            if(import_val[1].defaultValue == '☆'){
                important_value[element - 1] = 0;
            }else if(import_val[1].defaultValue == '★'){
                important_value[element - 1] = 1;
            }
        });

        if(status_name == null){
            status_name = status_all_id;
        }

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'POST',
            url: '/client/check_edit/' + value + '/status_name/' + status_name + '/important_value/' + important_value,
            cache: false,
            dataType: 'json',
            timeout: 30000,
            beforeSend: function(){
                dispLoading("処理中...");
            }
        })
        .done(function(){
            alert("更新しました");
            location.reload();
        })
        .fail(function(XMLHttpRequest, textStatus, errorThrown){
            alert("通信に失敗しました。管理者に報告してください。");
            console.log("XMLHttpRequest : " + XMLHttpRequest.status);
            console.log("textStatus     : " + textStatus);
            console.log("errorThrown    : " + errorThrown.message);
        })
        .always(function(data) {
            // Lading 画像を消す
            removeLoading();
        })};
    });
});