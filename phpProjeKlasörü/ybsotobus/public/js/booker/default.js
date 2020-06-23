$(function(){ 
    $("#exampleBooker tr").live('click',function(){
        document.getElementById("book_busNo").value=$(this).find("td").eq(0).html();
        document.getElementById("book_numberOfSeat").value=$(this).find("td").eq(1).html();
        document.getElementById("book_price").value=$(this).find("td").eq(6).html();
    });

});