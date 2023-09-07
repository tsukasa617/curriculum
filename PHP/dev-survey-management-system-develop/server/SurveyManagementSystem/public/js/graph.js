//チャートの再描画時に古いのが残らないようにグローバル変数で定義する
var mychart ;

//ブラウザの大きさによってグラフサイズが変わるようにする
var w = $('.conten').width();
var h = $('.conten').height();
$('graphCanvas').attr('width',w);
$('graphCanvas').attr('height',h);

//業種統計
$(function(){
    $("#view_graph").on("click",function(){
        //var target = $(".graph_select").val();
        //var client = $(".client").val();
        //var min_date = $('.min_date').val();

        var request = $.ajax({
            type: 'GET',
            //url: '/graph/getGraph/' + target + '/client/' + client,
            url: '/graph/getGraph',
            cache: false,
            dataType: 'json',
            timeout: 30000  //30秒でタイムアウト
        });
        //成功時処理
        request.done(function(data){
            //alert("通信に成功しました");

            //業種の抽出
            //重複している業種を計算
            var counts = {};
            for(var i=0;i<data.length;i++){
                var key = data[i];
                counts[key['industry_name']] = (counts[key['industry_name']])?counts[key['industry_name']] + 1 : 1;
                //console.log(counts);
            };

            //業種名と該当数を別々の変数に分ける
            var value = [];
            var tar = [];
            for(key in counts){
                value.push(counts[key]);
                tar.push(key);
            }

            //$('#company_name').val(data[0]);
            //console.log(value);
            //console.log(tar);

            var ctx = document.getElementById("graphCanvas");
            
            //描画されているグラフがあれば破棄する
            if(mychart){
                mychart.destroy();
            }

            //グラフの生成
            mychart = new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: tar,
                    datasets: [{
                        data: value
                    }]
                },
                options: {
                    title:{
                        display:true,
                        text: '業種統計'
                    },
                    plugins: {
                        colorschemes: {
                            scheme: 'brewer.Paired12'
                        }
                    }
                }
            });
        });
        request.fail(function(){
            alert("通信に失敗しました。管理者に報告してください。");
        });
    })
})


//売り上げ統計
$(function(){
    $("#view_bar").on("click",function(){
        //var target = $(".graph_select").val();
        //var client = $(".client").val();

        //初期値にnullを設定
        var min_date = null;
        var max_date = null;

        //日付を選択されていたら代入
        if($('.min_date').val()){
            min_date = $('.min_date').val();
        }
        if($('.max_date').val()){
            max_date = $('.max_date').val();
        }

        var request = $.ajax({
            type: 'GET',
            url: '/graph/getBar/' + min_date + '/max_date/' + max_date,
            //url: '/graph/getGraph/' + client,
            cache: false,
            dataType: 'json',
            timeout: 30000
        });
        request.done(function(data){
            //alert("通信に成功しました");
            //console.log(data);

            var price = [];
            var company = [];
            var order_date = [];
            for(key in data){
                price.push(data[key].total_price);
                company.push(data[key].company_name);
                order_date.push(data[key].order_date);
            }

            var ctx = document.getElementById("graphCanvas");
            
            //描画されているグラフがあれば破棄する
            if(mychart){
                console.log('HELLO');
                mychart.destroy();
            }

            //グラフ生成
            mychart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: order_date,
                    datasets: [
                        {
                            data: price,
                            barPercentage: 0.8,           //棒グラフ幅
                            categoryPercentage: 0.8,      //棒グラフ幅
                        }
                    ]
                },
                options: {
                    responsive: true,                  //グラフ自動設定
                    legend: {                          //凡例設定
                        display: false                 //表示設定
                    },
                    title:{
                        display:true,
                        text: '日別売り上げ'
                    },
                    scales: {
                        yAxes: [{
                            display: true,
                            scaleLabel: {
                                display: true,
                                labelString: '円'
                            },
                            ticks: {
                                suggestedMax: 30000,      //表示最大値
                                suggestedMin: 0,          //表示最小値
                                stepSize: 1000,           //数値間隔
                            }
                        }],
                        xAxes: [{                         //x軸設定
                            display: true,                //表示設定

                            scaleLabel: {                 //軸ラベル設定
                               display: true,             //表示設定
                               fontSize: 18               //フォントサイズ
                            },
                            ticks: {
                                fontSize: 18             //フォントサイズ
                            },
                        }], 
                    },
                    layout: {                             //レイアウト
                        padding: {                          //余白設定
                            left: 100,
                            right: 50,
                            top: 0,
                            bottom: 0
                        }
                    },
                    //色の自動設定
                    plugins: {
                        colorschemes: {
                            scheme: 'brewer.Paired12'
                        }
                    }
                }
            });
        });

        request.fail(function(){
            alert("通信に失敗しました。管理者に報告してください。");
        });
    })
})
