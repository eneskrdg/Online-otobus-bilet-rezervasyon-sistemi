//______________________________________________________________________________
$(function(){
    var http = location.protocol;
    var slashes = http.concat("//");
    var host = slashes.concat(window.location.hostname);
    getSessionSelectin_s();
    function getSessionSelectin_s() {
        $.ajax({
            type:'POST',
            url:'/ybsotobus/booker/getSessionSelectin_s',
            dataType:'json',
            beforeSend:function(o){
            },
            success:function(o){
                $('#passenger_info').append('<table>');
                $('#passenger_info').append('<tr><th class="table-bordered">Koltuk No </th><th class="table-bordered">Yolcu Adı Soyadı</th><th></th><th></th></th><th class="table-bordered">Cinsiyet</th></tr>');
                for (var i=0;i<o.length;i++){
                    $('#passenger_info').append('<tr><td>'+ o[i]+'<input type="hidden" name="seat'+i+'" value="'+ o[i]+'"/></td><td><input id="" class="" type="text" name="passenger'+i+'"  value="" ></td><td></td><td></td><td><input name="gender'+i+'" type="radio" value="E" checked=""/>ERKEK<br><input name="gender'+i+'" type="radio" value="K"/>KADIN</td></tr>');
                }
                $('#passenger_info').append('</table>');
            },
            error : function(XMLHttpRequest, textStatus, errorThrown){
                
            }
        });
    }   

    $('#booker_data').live('click',function(){
        var booker_tc = document.getElementById("booker_tc").value;
        $.ajax({
            type:'POST',
            url:'/ybsotobus/booker/xhrserchBookerInfo',
            data:{
                booker_tc:booker_tc
            },
            dataType:'json',
            beforeSend:function(o){
            },
            success:function(o){
                document.getElementById("bookername").value = o[0].bookerName;
                document.getElementById("booker_mno").value = o[0].bookerMNo;
            },
            error : function(XMLHttpRequest, textStatus, errorThrown){
            }
        });
    });
    
    timeOut();
    function timeOut() {
        timer = setTimeout(timeOut,1000);
        $.ajax({
            type:'POST',
            url:'/ybsotobus/booker/xhrtimeOut',
            dataType:'json',
            beforeSend:function(o){
            },
            success:function(o){
                if(o == 1){
                    $('#timeOutBooking').html('Rezervasyon Ve Bilet Alımı İçin Kalan Süre ['+parseInt(o)+'] (s)');
                    $('#timeOutBooking').html('');
                    clearTimeout(timer);
                    if(host+'/ybsotobus/booker/booking/' != window.location){
                    window.location.replace(host+"/ybsotobus/index");
                    }
                }else
                    $('#timeOutBooking').html('Rezervasyon Ve Bilet Alımı İçin Kalan Süre ['+parseInt(o)+'] (s)');
            },
            error : function(XMLHttpRequest, textStatus, errorThrown){
                clearTimeout(timer);
            }
        });
    }   

});