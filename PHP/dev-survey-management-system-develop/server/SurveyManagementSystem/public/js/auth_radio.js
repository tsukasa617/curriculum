$(function() {  
  //インプット要素を取得する
    var inputs = $('input');
    //読み込み時に「:checked」の疑似クラスを持っているinputの値を取得する
    var checked = inputs.filter(':checked').val();

    //インプット要素がクリックされたら
    inputs.on('click', function(){
        
        //クリックされたinputとcheckedを比較
        if($(this).val() === checked) {
            //inputの「:checked」をfalse
            $(this).prop('checked', false);
            //checkedを初期化
            checked = '';          
        } else {
            //inputの「:checked」をtrue
            $(this).prop('checked', true);
            //inputの値をcheckedに代入
            checked = $(this).val();
        }
    });
});