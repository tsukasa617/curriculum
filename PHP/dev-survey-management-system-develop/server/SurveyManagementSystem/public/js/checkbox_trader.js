$(function() {
    var dele = document.getElementById('forget_value');

    // チェックボックスが変わったら、削除ボタンを表示
    $("input[name='chk[]']").on('click',function() {
      dele.style.display = "block";
    });

    // 1. 「全選択」する
    $('#all').on('click', function() {
      $("input[name='chk[]']").prop('checked', this.checked);
      var del = document.getElementById('forget_value');
      del.style.display = "block";
    });

    // 項目が変更された場合、チェックボックスにチェックを入れる
      $('select').on('change',function() {
        var val = $(this).closest("tr").find('input').val();
        $('input[value='+val+']').prop('checked',true);
    });

    //更新するためのプルダウンに切り替え
    $("i[class=material-icons]").on('click', function() {
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
            url: '/trader/check_delete/' + value,
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

});