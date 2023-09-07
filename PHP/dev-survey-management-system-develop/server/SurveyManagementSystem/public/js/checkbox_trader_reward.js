$(function() {
    var cost = document.getElementById('get_value');
    var dele = document.getElementById('forget_value');
    var client_status_name = '';
    var matter_status_name = '';

    // チェックボックスが変わったら、削除ボタンを表示
    $("input[name='client_chk[]']").on('click',function() {
      cost.style.display = "block";
      dele.style.display = "block";
    });

    // チェックボックスが変わったら、削除ボタンを表示
    $("input[name='matter_chk[]']").on('click',function() {
      cost.style.display = "block";
      dele.style.display = "block";
    });

    // 1. 「全選択」する
    $('#all').on('click', function() {
      $("input[name='chk[]']").prop('checked', this.checked);
      var del = document.getElementById('forget_value');
      del.style.display = "block";
    });

    // 項目が変更された場合、個人案件チェックボックスにチェックを入れる
    $('select[name="client_status_name"]').on('change',function() {
      var val = $(this).closest("tr").find('input').val();
      $(this).closest("tr").find('input').prop('checked',true);
    });

    // 項目が変更された場合、法人案件チェックボックスにチェックを入れる
    $('select[name="matter_status_name"]').on('change',function() {
      var val = $(this).closest("tr").find('input').val();
      $(this).closest("tr").find('input').prop('checked',true);
    });

    //個人顧客・進捗状況で変更を加えたものの一番先頭に来る値を取得
    $(document).on('change',".client_status_name",function() {
      client_status_name = $("input[name='client_chk[]']:checked").map(function() {
        return $(this).closest("tr").find(".client_status_name option:selected").val();
      }).get();
    });

    //法人顧客・進捗状況で変更を加えたものの一番先頭に来る値を取得
    $(document).on('change',".matter_status_name",function() {
      matter_status_name = $("input[name='matter_chk[]']:checked").map(function() {
        return $(this).closest("tr").find(".matter_status_name option:selected").val();
      }).get();
    });

    //セレクトボックスが変わったら、更新ボタンを表示
    $("select").one('change',function() {
        cost.style.display = "block";
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

        //選択した個人チェックボックスのidを配列で取得
        var client_value = $("input[name='client_chk[]']:checked").map(function() {
          return $(this).val();
        }).get();
        if(client_value == ''){
          client_value = 0;
        }

        //選択した法人チェックボックスのidを配列で取得
        var matter_value = $("input[name='matter_chk[]']:checked").map(function() {
          return $(this).val();
        }).get();
        if(matter_value == ''){
          matter_value = 0;
        }

        //チェックボックスにチェックが入ってない場合の処理
        if(client_value == 0 && matter_value == 0) {
            alert('項目が選択されていません');
            return false;
        }
        
        $.ajax({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          type: 'POST',
          url: '/trader/reward_check_delete/client_value/' + client_value + '/matter_value/' + matter_value,
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

      //選択した個人チェックボックスのidを配列で取得
      var client_value = $("input[name='client_chk[]']:checked").map(function() {
        return $(this).val();
      }).get();
      if(client_value == ''){
        client_value = 0;
      }

      //選択した法人チェックボックスのidを配列で取得
      var matter_value = $("input[name='matter_chk[]']:checked").map(function() {
        return $(this).val();
      }).get();
      if(matter_value == ''){
        matter_value = 0;
      }

      //チェックボックスにチェックが入ってない場合の処理
      if(client_value == '' && matter_value == '') {
          alert('項目が選択されていません');
          return false;
      }

      if(client_status_name == ''){
        client_status_name = 0;
      }
      if(matter_status_name == ''){
        matter_status_name = 0;
      }
      //チェックボックスにチェックが入ってない場合の処理
      if(client_status_name == 0 && matter_status_name == 0) {
        alert('項目が選択されていません');
        return false;
    }

      $.ajax({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
          type: 'POST',
          url: '/trader/reward_check_edit/client_value/' + client_value + '/matter_value/' + matter_value + '/client_status_name/' + client_status_name + '/matter_status_name/' + matter_status_name,
          
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