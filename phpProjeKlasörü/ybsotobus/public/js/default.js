$(function(){



    $(function(){     
        $('.table-delete-button').live('click',function(){   
            var conf = confirm("Bu kaydı silmek istediğinizden emin misiniz?");
            if(conf == true){
                return true;
            }else{
                return false;
            }
        });
    });


    $(function(){     
        $('.user-search-button').live('click',function(){   
            var userName=document.getElementById("uUserName").value;
            $.post('/ybsotobus/systemUser/xhrSearchSingleUser',{
                'userName':userName
            },function(o){           
                for (var i=0;i<o.length;i++){
                    document.getElementById("uUserName").value = o[0].userName;
                    document.getElementById("uEmpolyeeNo").value = o[0].empolyeeNo;
                    document.getElementById("uEmpolyeeName").value = o[0].empolyeeName;
                    document.getElementById("uEmpolyeeMNo").value = o[0].empolyeeMNo;
                }
               
                                
            },'json');
            return true;
             
        });
    });

    $('#test').live('click',function(){   
        var prtContent = document.getElementById("booking_ticket_area");
        var WinPrint = window.open('', '', 'letf=0,top=0,width=500,height=500,toolbar=0,scrollbars=0,status=0');
        WinPrint.document.write(prtContent.innerHTML);
        WinPrint.document.close();
        WinPrint.focus();
        WinPrint.print();
        WinPrint.close();
    });
    
    $('#printbusTicketsbtn').live('click',function(){   
        var prtContent = document.getElementById("bus_ticket_sub_area");
        var WinPrint = window.open('', '', 'letf=0,top=0,width=500,height=500,toolbar=0,scrollbars=0,status=0');
        WinPrint.document.write(prtContent.innerHTML);
        WinPrint.document.close();
        WinPrint.focus();
        WinPrint.print();
        WinPrint.close();
    });


    $(function(){     
        $('#journeyNoRedioBtn').live('click',function(){ 
            var jNo = $('input[name=journeyNo]:checked').val();
            //alert(jNo);
            $.ajax({
                type:'POST',
                url:'/ybsotobus/journey/xhrSearchSingleJourney',
                data:{
                    jNo:jNo
                },
                dataType:'json',
                beforeSend:function(o){
                },
                success:function(o){
                    alert(' [ Güzergah => '+o[0].routeNo + ']\n [ Nereden => '+o[0].journeyFrom + ' ]\n [ Nereye => '+o[0].journeyTo + ' ]\n [ Hareket Saati => '+o[0].departureTime+' ]');

                },
                error : function(XMLHttpRequest, textStatus, errorThrown){
                }
            });
            
        });
    });
    


    $('#UploadeBusNo').live('click',function(){   
               
        Parse.initialize('w6sOkx6IXZPloTIkWcdbfX3RxKrrPJZmWPIGHeYk','A2yVM8pivVRG45md3dmHP0g0rDGloutMDK2ETgdv');
        var Journey = Parse.Object.extend("journey");
        
        $.ajax({
            type:'POST',
            url:'/ybsotobus/bus/xhrSearchAllBusandJourney',
            data:{
            },
            dataType:'json',
            beforeSend:function(o){
                $(".loadingDefault").fadeIn();
            },
            success:function(o){
                var query = new Parse.Query(Journey);
                query.find({
                    success: function(obj) {
                        Parse.Object.destroyAll(obj).then(function() {

                            for (var j=0; j<o.length; j++){
                    
                                var journey = new Journey();
                    
                                journey.set("busNo",o[j].busNo);
                                journey.set("journeyNo",o[j].journeyNo);
                                journey.set("no_of_seat",parseInt(o[j].numberOfSeat));
                                
                                journey.save();
                            }
                
                            journey.save(null, {
                                success: function(journey) { 
                                    $(".loading").fadeOut();
                                    alert('Save : ' + journey.id);
                                },
                                error: function(journey, error) {
                                    $(".loading").fadeOut();
                                    alert('yeni nesne oluşturulamadı. Hata Kodu: ' + error.message);
                                }
                            });

                            $(".loadingDefault").fadeOut();
                        });
                    },
                    error: function(error) {
                        alert('' + error.message);
                        $(".loadingDefault").fadeOut();
                    }
                });
            },
            error : function(XMLHttpRequest, textStatus, errorThrown){
                $(".loadingDefault").fadeOut();
            }
        });        
    });

});