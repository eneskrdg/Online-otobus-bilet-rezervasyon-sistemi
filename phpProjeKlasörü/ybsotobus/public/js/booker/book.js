$(function(){
    
    var busNo=document.getElementById("seat_book_busNo").value; 
    var bus_book_date= document.getElementById("seat_book_date").value;
    var journeyNo= document.getElementById("seat_book_journeyNo").value;
    
    cliarPrint();
    $(".seat").live('click',function(){
        if ($(this).hasClass('selectedSeat')){
            $('#print').html('Bu koltuk zaten ayrılmış ...');
        }
        else if ($(this).hasClass('selectingSeat') && $(this).hasClass('pendingSeat')){
            var allSeatNo = [], selectArry=[], i=0;
            allSeatNo.push($(this).attr('seatNo'));
            clearAllSeate(allSeatNo);
            $(this).removeClass('selectingSeat');
            $(this).removeClass('pendingSeat');
            $.each($('#place li.selectingSeat '), function (index, value) {
                selectArry[i++]=i;
            });
            if(selectArry.length==0){
                $('#timeOut').html('');
                clearTimeout(timer);
            }
        }
        
        else if ($(this).hasClass('pendingSeat')){
            if (!($(this).hasClass('selectingSeat')))
                $('#print').html('Bu Koltuk Rezervasyonlu ...');
        }
        else if(!($(this).hasClass('selectingSeat'))){
            $(this).removeClass('cancelSeat');
            $(this).toggleClass('selectingSeat');
            insertSeattoTable($(this).attr('seatNo'));
        }
        else{
            $('#print').html('Lütfen Bekleyin ...');
        }
    });
    
    function cliarPrint() {
        setTimeout(cliarPrint,2500);
        $('#print').html('');
    }
    
    function setSession() {
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
    
    function sessionTimeOut() {
        var allSeatNo = []
        timer = setTimeout(sessionTimeOut,1000);
        $.ajax({
            type:'POST',
            url:'/ybsotobus/booker/xhrSessionTimeOut',
            dataType:'json',
            beforeSend:function(o){
            },
            success:function(o){
                $('#timeOut').html('Rezervasyon Ve Bilet Alımı İçin Kalan Süre ['+o+'] S');
            },
            error : function(XMLHttpRequest, textStatus, errorThrown){
                $('#timeOut').html('');
                $.each($('#place li.selectingSeat '), function (index, value) {
                    items = $(this).attr('seatNo');
                    $(this).toggleClass('selectingSeat');
                    allSeatNo.push(items);
                });
                clearAllSeate(allSeatNo);
                clearTimeout(timer);
            }
        });
    }
    
    function insertSeattoTable(seatNo) {
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
                var selectArry = [],i=0;
                $.each($('#place li.selectingSeat '), function (index, value) {
                    selectArry[i++]=i;
                });
                if(selectArry.length==1){
                    setSession();
                }
            },
            error : function(XMLHttpRequest, textStatus, errorThrown){
            }
        });
    }
    
    function clearAllSeate(allSeatNo) {
        var seatNo = allSeatNo;
        var status = 'P';
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
                for(var i = 0; i<seatNo.length; i++){
                    $('li[seatno="'+seatNo[i]+'"]').removeClass("pendingSeat");
                }
            },
            error : function(XMLHttpRequest, textStatus, errorThrown){
            }
        });
    }
    
    
});   