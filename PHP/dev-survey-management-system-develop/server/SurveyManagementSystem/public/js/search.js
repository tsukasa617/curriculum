$(function(){

    $("select").on("change",function(){
        var val = $(this).val();
        //console.log(val);

        $.ajaxSetup({
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
                });

        if(val == 'client'){

            $("#search_info").html('');

            $.ajax({
                url:'ajax/search_client.html',
                type: 'GET',
                dataType: 'html',
                success: function(data){
                    $("#parent").after(data);
                },
                error: function(XMLHttpRequest, textStatus, errorThrown) {
                    //alert('error!!!');
                　　console.log("XMLHttpRequest : " + XMLHttpRequest.status);
                　　console.log("textStatus     : " + textStatus);
                　　console.log("errorThrown    : " + errorThrown.message);
                }
            });

            //$("#search_info").load('ajax/search_client.html')

        }else if(val == 'employee'){

            $("#search_info").html('');

            $.ajax({
                url:'ajax/search_employee.html',
                type: 'GET',
                dataType: 'html',
                success: function(data){
                    $("#parent").after(data);
                },
                error: function(XMLHttpRequest, textStatus, errorThrown) {
                    //alert('error!!!');
                　　console.log("XMLHttpRequest : " + XMLHttpRequest.status);
                　　console.log("textStatus     : " + textStatus);
                　　console.log("errorThrown    : " + errorThrown.message);
                }
            });

            //$("#search_info").load('search_detail_employee.html')

        }else if(val == 'negotiation'){
            
            $("#search_info").html('');

            $.ajax({
                url:'ajax/search_negotiation.html',
                type: 'GET',
                dataType: 'html',
                success: function(data){
                    $("#parent").after(data);
                },
                error: function(XMLHttpRequest, textStatus, errorThrown) {
                    //alert('error!!!');
                　　console.log("XMLHttpRequest : " + XMLHttpRequest.status);
                　　console.log("textStatus     : " + textStatus);
                　　console.log("errorThrown    : " + errorThrown.message);
                }
            });
            
            //$("#search_info").load('search_detail_negotiation.html')

        }else{
            $("#search_info").html('');
        }
    });
});


            /*$.ajax({
                url:'ajax/search_client.html',
                type: 'GET',
                dataType: 'html',
                success: function(data){
                    $("#parent").after(data);
                }
            })*/


