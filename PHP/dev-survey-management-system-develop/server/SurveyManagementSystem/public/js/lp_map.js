import { normalize } from 'https://cdn.skypack.dev/@geolonia/normalize-japanese-addresses';

$(function() {
  
  //フォーム送信された住所
  var address = document.getElementById('address').defaultValue;

  //おすすめ調査会社ID
  var id_0 = document.getElementById('id_0').defaultValue;
  var id_1 = document.getElementById('id_1').defaultValue;
  var id_2 = document.getElementById('id_2').defaultValue;
  var id = [id_0, id_1, id_2];

  //おすすめ調査会社住所
  var add_0 = document.getElementById('add_0').defaultValue;
  var add_1 = document.getElementById('add_1').defaultValue;
  var add_2 = document.getElementById('add_2').defaultValue;
  var add = [add_0, add_1, add_2];

  var normalize_lats = [];
  var normalize_lngs = [];
  var map = '';
  
  //ピンのデザイン変更
  var sampleIcon = L.icon({
    iconUrl: '/image/fire.png',
    iconRetinaUrl: '/image/fire.png',
    iconSize: [50, 50],
    iconAnchor: [25, 50],
    popupAnchor: [0, -50],
  });
    
  //住所から緯度経度の取得
  normalize(address).then(result => {
    const address_lat = result.lat;
    const address_lng = result.lng;
    map = L.map('mapid', {
      center: [address_lat, address_lng],
      zoom: 17,
    });

    //Google Mapの読み込みと参照元の記載
    var tileLayer = L.tileLayer('https://mt1.google.com/vt/lyrs=r&x={x}&y={y}&z={z}', {
    attribution: "<a href='https://developers.google.com/maps/documentation' target='_blank'>Google Map</a>"
    });
    tileLayer.addTo(map);
  
    L.marker([address_lat, address_lng]).addTo(map);
    
    //調査会社のマッピング
    add.forEach(function(element,index) {
      normalize(element).then(result => {
        //緯度と軽度を指定
        normalize_lats[index] = result.lat;
        normalize_lngs[index] = result.lng;
        
        //調査会社IDを取り出してJsonを取得する
        var survey_id = id[index];
        var url=('/api/lp/map_popup/survey='+survey_id);

        //非同期処理
        fetch(url)
          .then(response => response.json())
          .then(data => {

              //ポップアップに表示するテキスト
              var popup_text = '<p style=font-weight:bold;>調査実績<br>あなたの周辺(50km)で発生した自然災害の事例です。</p>'
                              +'<table><thead><tr>'
                              + '<th>保険申請日</th><th>入金額</th><th>備考</th>'
                              + '</tr></thead><tbody>';

              //保険申請日と入金額どちらのデータも存在する場合テーブルに書き込む
              data["client_infos"].forEach(function(element,index){
                if(data["client_infos"][index]["insurance_policy_date"] != null && data["client_infos"][index]["payment_money"] != null){
                  popup_text  += '<tr><th>'+ data["client_infos"][index]["insurance_policy_date"] +'</th>'
                              +'<th>'+ data["client_infos"][index]["payment_money"] +'</th>'
                              +'<th>風災による</th></tr>';
                }
              })

              //データがなければ下記をテーブルに書き込む
              if(data["case_count"]==0){
                popup_text  += "<tr><th>データがありません。</th></tr></tbody></table>";
              }else{
                //その他の件数を算出し表示する
                var other_count = data["case_count"] - data["client_infos"].length;
                popup_text  += "</tbody></table><p style=text-align:right;font-weight:bold;>その他：" + other_count + "件</p>";
              }
            
            //popupの表示内容をセット
            const popup = L.popup().setContent(popup_text);
            // ピンを作成、ポップアップを作成
            const marker = L.marker([result.lat, result.lng],{icon: sampleIcon}).bindPopup(popup); 
            // 地図にピンを立てる
            marker.addTo(map); 
          });
      });
    });
  });


  //検索をクリックすると地図が住所の位置に移動
  $('#search_0').on('click',function() {
    map.flyTo([normalize_lats[0], normalize_lngs[0]]);
  });
  $('#search_1').on('click',function() {
    map.flyTo([normalize_lats[1], normalize_lngs[1]]);
  });
  $('#search_2').on('click',function() {
    map.flyTo([normalize_lats[2], normalize_lngs[2]]);
  });
});

