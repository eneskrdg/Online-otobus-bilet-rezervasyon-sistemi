$(function(){
    var http = location.protocol;
    var slashes = http.concat("//");
    var host = slashes.concat(window.location.hostname);

    cliarPrint();
    sessionforSelectin_s();
    function cliarPrint() {
        $('.print').html('');
    }
    
    function sessionforSelectin_s() {
        $.ajax({
            type:'POST',
            url:'/ybsotobus/booker/xhrgetSessionforSelectin_s',
            data:{
            },
            dataType:'json',
            beforeSend:function(o){
            },
            success:function(o){
                if(host+'/ybsotobus/booker/booking/' == window.location)
                    document.getElementById("selecting_seate_for_booker").value = o;
            },
            error : function(XMLHttpRequest, textStatus, errorThrown){
            }
        });
        
        $.ajax({
            type:'POST',
            url:'/ybsotobus/booker/xhrgetSessionforSelectin_s_tot',
            data:{
            },
            dataType:'json',
            beforeSend:function(o){
            },
            success:function(o){
                if(o != null){
                    if(host+'/ybsotobus/booker/booking/' == window.location)
                        document.getElementById("total_price_for_selecting_seate").value = o;
                }
            },
            error : function(XMLHttpRequest, textStatus, errorThrown){
            }
        });
    }

    sessionTimeOut();
    function sessionTimeOut() {
        timer = setTimeout(sessionTimeOut,1000);
        $.ajax({
            type:'POST',
            url:'/ybsotobus/booker/xhrSessionTimeOut',
            dataType:'json',
            beforeSend:function(o){
            },
            success:function(o){
                if(o.length > 0){
                    clearAllSeateformDB(o);
                    $('.timeOut').html('');
                    clearTimeout(timer);
                    $("#passenger_info").remove();
                    $("#booker_info").remove();
                    if(host+'/ybsotobus/booker/booking/' == window.location){
                        document.getElementById("total_price_for_selecting_seate").value = 0;
                        document.getElementById("selecting_seate_for_booker").value = "";
                    }
                    $.each($('#place li.selectingSeat '), function (index, value) {
                        $(this).removeClass('selectingSeat');
                    });
                }else{
                    $.each($('#place li.selectingSeat '), function (index, value) {
                        if(($(this).hasClass('selectingSeat')))
                            $('.timeOut').html('Rezervasyon Ve Bilet Alımı İçin Kalan Süre ['+parseInt(o)+'] (s)'); //minute
                    });
                }
            },
            error : function(XMLHttpRequest, textStatus, errorThrown){
                clearTimeout(timer);
            }
        });
    }
    
    $(".seat").live('click',function(){
        if ($(this).hasClass('selectedSeat')){
            $('#print').html('Bu koltuk zaten ayrılmış');
        }
        
        else if ($(this).hasClass('selectingSeat') && $(this).hasClass('pendingSeat')){
            var allSeatNo = [], selectArry=[], i=0;
            allSeatNo.push($(this).attr('seatNo'));
            clearAllSeateformDB(allSeatNo);
            setSubtractionSessionforSelectin_s(allSeatNo)
            $(this).removeClass('selectingSeat');
            $(this).removeClass('pendingSeat');
            $.each($('#place li.selectingSeat '), function (index, value) {
                selectArry[i++]=i;
            });
            if(selectArry.length==0){
                $('.timeOut').html('');
                clearTimeout(timer);
            }
        }
        
        else if ($(this).hasClass('pendingSeat')){
            if (!($(this).hasClass('selectingSeat')))
                $('#print').html('Bu Koltuk Rezervasyonlu ...');
        }
        
        else if(!($(this).hasClass('selectingSeat'))){
            $(this).toggleClass('pendingSeat');
            $(this).toggleClass('selectingSeat');
            var selectArry_ = [],j=0;
            $.each($('#place li.selectingSeat '), function (index, value) {
                selectArry_[j++]=j;
            });
            if(selectArry_.length==1){
                setSessionforTime();
            }
            insertSeattoTable($(this).attr('seatNo'));
            setIncrementSessionforSelectin_s($(this).attr('seatNo'));
        }
        else{
            $('#print').html('Lütfen Bekleyin ...');
        }
    });
 

    function setIncrementSessionforSelectin_s(seatNo) {
        var price = document.getElementById("seat_book_price").value;
        var tot_price = document.getElementById("total_price_for_selecting_seate").value;
        tot_price = parseInt(tot_price) + parseInt(price);
            
        
        $.ajax({
            type:'POST',
            url:'/ybsotobus/booker/xhrIncrementSessionforSelectin_s',
            data:{
                seatNo:seatNo,
                tot_price:tot_price
            },
            dataType:'json',
            beforeSend:function(o){
            },
            success:function(o){
                document.getElementById("selecting_seate_for_booker").value = o;
                document.getElementById("total_price_for_selecting_seate").value = tot_price;
            },
            error : function(XMLHttpRequest, textStatus, errorThrown){
            }
        });
    }

    
    function setSubtractionSessionforSelectin_s(seatNo) {
        var price = document.getElementById("seat_book_price").value;
        var tot_price = document.getElementById("total_price_for_selecting_seate").value;
        tot_price = parseInt(tot_price) - parseInt(price);
            
        
        $.ajax({
            type:'POST',
            url:'/ybsotobus/booker/xhrSubtractionSessionforSelectin_s',
            data:{
                seatNo:seatNo,
                tot_price:tot_price
            },
            dataType:'json',
            beforeSend:function(o){
            },
            success:function(o){
                document.getElementById("selecting_seate_for_booker").value = o;
                document.getElementById("total_price_for_selecting_seate").value = tot_price;
            },
            error : function(XMLHttpRequest, textStatus, errorThrown){
            }
        });
    }

    function insertSeattoTable(seatNo) {
        var busNo=document.getElementById("seat_book_busNo").value; 
        var bus_book_date= document.getElementById("seat_book_date").value;
        var journeyNo= document.getElementById("seat_book_journeyNo").value;             
        var status = 'P';
        $.ajax({
            type:'POST',
            url:'/ybsotobus/booker/xhrInsertBookingSeat',
            data:{
                seatNo:seatNo,
                busNo:busNo,
                journeyNo:journeyNo,
                bus_book_date:bus_book_date,
                status:status
            },
            dataType:'json',
            beforeSend:function(o){
            },
            success:function(o){
                var seatNo =[];
                $.each($('#place li.selectingSeat '), function (index, value) {
                    items = $(this).attr('seatNo');
                    seatNo.push(items);
                });

            },
            error : function(XMLHttpRequest, textStatus, errorThrown){
            }
        });
    }

    function afterInsertSeat(seatNo) {
        var seatNo = seatNo;
        var busNo=document.getElementById("seat_book_busNo").value; 
        var bus_book_date= document.getElementById("seat_book_date").value;
        var journeyNo= document.getElementById("seat_book_journeyNo").value;
        var noOfSeat= document.getElementById("seat_book_numberOfSeat").value;
        $.ajax({
            type:'POST',
            url:'/ybsotobus/booker/viewBusSeat',
            data:{
                busNo:busNo,
                noOfSeat:noOfSeat,
                journeyNo:journeyNo,
                bus_book_date:bus_book_date,
                seatNo:seatNo
            },
            success:function(o){
                $('#viweSeat').html(o);
            }
        });
    }
    

    
    function setSessionforTime() {
        $.ajax({
            type:'POST',
            url:'/ybsotobus/booker/xhrsetSession',
            beforeSend:function(o){
            },
            success:function(o){
                sessionTimeOut();
            },
            error : function(XMLHttpRequest, textStatus, errorThrown){
            }
        });
    }
      


    function clearAllSeateformDB(allSeatNo) {
        var seatNo = allSeatNo;
        var status = 'P';
        var busNo=document.getElementById("seat_book_busNo").value; 
        var bus_book_date= document.getElementById("seat_book_date").value;
        var journeyNo= document.getElementById("seat_book_journeyNo").value;
        $.ajax({
            type:'POST',
            url:'/ybsotobus/booker/xhrClearAllSeate',
            data:{
                seatNo:seatNo,
                busNo:busNo,
                journeyNo:journeyNo,
                bus_book_date:bus_book_date,
                status:status
            },
            dataType:'json',
            beforeSend:function(o){
            },
            success:function(o){
                if(host+':8080/ybsotobus/booker/booking/' != window.location){
                    window.location.replace(host+":808080/ybsotobus/index");
                }

                
            },
            error : function(XMLHttpRequest, textStatus, errorThrown){
            }
        });
    }
    


    $("#reset").live('click',function(){
        $.ajax({
            type:'POST',
            url:'/ybsotobus/booker/xhrreset',
            data:{
            },
            success:function(o){
                var seatNo =[];
                $.each($('#place li.selectingSeat '), function (index, value) {
                    items = $(this).attr('seatNo');
                    seatNo.push(items);
                });
                clearAllSeateformDB(seatNo);
                $('.timeOut').html('');
                document.getElementById("total_price_for_selecting_seate").value = 0;
                document.getElementById("selecting_seate_for_booker").value = "";
            }
        });
    });
    
    
    
});   