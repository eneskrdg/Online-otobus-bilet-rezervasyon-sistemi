$(function(){

   
    var busNo=document.getElementById("seat_book_busNo").value; 
    var noOfSeat = document.getElementById("seat_book_numberOfSeat").value;
    var bus_book_date= document.getElementById("seat_book_date").value;
    var journeyNo= document.getElementById("seat_book_journeyNo").value;
    var bookSeat=[];
    var bookStatus=[];
    

    searchAvailableSeat();
     

    function searchAvailableSeat() {
        
        $.post('/ybsotobus/booker/xhrSearchAvailableSeat',{
            'busNo':busNo,
            'bus_book_date':bus_book_date,
            'journeyNo':journeyNo
        },function(o){  
            for (var u=0;u<o.length;u++){
                bookSeat[u]=o[u].seatNo;
                bookStatus[u]=o[u].status;
            }

            displayBusSeat();
        },'json');
        return true;
    }
    

    function displayBusSeat() {
        var rows = 5;
        var cols = 13;
        var rowCssPrefix = 'row-';
        var colCssPrefix = 'col-';
        var seatWidth = 40;
        var seatHeight = 40;
        var seatCss = 'seat';
        var hidingSeatCss = 'hidingSeats';
        var selectedSeatCss = 'selectedSeat';
        var selectingSeatCss = 'selectingSeat';
        var pendingSeatCss = 'pendingSeat';
        var str = [], seatNo, className, p, x=0;
                              
        
        if(noOfSeat == 49){
            for (var i=0; i < cols; i++) {
                for (var j = 0; j < rows; j++) {
                    p = (i* rows + j + 1);
                    if(p==3 || p==8 || p==13 || p==18 || p==23 || p==28 || p==33|| p==38|| p==43|| p==48|| p==53|| p==58|| p==4 || p==5 || p==39 || p==40){
                        seatNo = null;
                        className = seatCss + ' ' + hidingSeatCss + ' ' + rowCssPrefix + i.toString() + ' ' + colCssPrefix + j.toString();
                    }else{
                        seatNo = (++x);
                        for (var v = 0; v < bookSeat.length; v++){
                            if(x == bookSeat[v]){
                                if(bookStatus[v]=='B')
                                    className = seatCss  + ' ' + rowCssPrefix + i.toString() + ' ' + colCssPrefix + j.toString() + ' ' + selectedSeatCss;
                                if(bookStatus[v]=='P')
                                    className = seatCss  + ' ' + rowCssPrefix + i.toString() + ' ' + colCssPrefix + j.toString() + ' ' + pendingSeatCss;
                                break;
                            }else{
                                className = seatCss + ' ' + rowCssPrefix + i.toString() + ' ' + colCssPrefix + j.toString();
                            }
                        }
                    }
                    str.push('<li class="' + className + '"' + 'seatno="' + seatNo + '"' +'style="top:' + (j * seatHeight).toString() + 'px;left:' + (i * seatWidth).toString() + 'px">' +'<a title="' + seatNo + '">' + seatNo + '</a>' +'</li>');
                }
            }
        }

        $('#place').html(str.join(''));
    }


    function searchAvailableSeatAfterUpdate(handleData) {
        
        var bookSeatAfter=[];
        var bookStatusAfter=[];
        var alData=[];
        $.ajax({
            type:'POST',
            url:'/ybsotobus/booker/xhrSearchAvailableSeat',
            data:{
                busNo:busNo,
                bus_book_date:bus_book_date,
                journeyNo:journeyNo
            },
            dataType:'json',
            beforeSend:function(o){
            },
            success:function(o){ 
                for (var u=0;u<o.length;u++){
                    bookSeatAfter[u]=o[u].seatNo;
                    bookStatusAfter[u]=o[u].status;
                }
                alData[0]=bookSeatAfter;
                alData[1]=bookStatusAfter;
                handleData(alData);
            },
            error : function(XMLHttpRequest, textStatus, errorThrown){
            }
        });
    }
    
    function startRefresh() {
        
        searchAvailableSeatAfterUpdate(function(seat){
            for (var i = 1; i < noOfSeat; i++){
                $('li[seatno="'+i+'"]').removeClass('pendingSeat');
                for (var j = 0; j < seat[0].length; j++){
                    if(i==seat[0][j]){
                        if(seat[1][j]=='B'){
                            $('li[seatno="'+i+'"]').addClass("selectedSeat");        
                        }
                        if(seat[1][j]=='P'){
                            $('li[seatno="'+i+'"]').addClass("pendingSeat");
                        }
                        break;
                    }
                }
            }

        });
        setTimeout(startRefresh,1000);
    }

  
});

$("#btnShowNew").live('click',function(){



    });