$(function(){
    
    $('input[name="cBus_departureTime"]').timepicker(); 

    $('input[name="cBus_arrivalTime"]').timepicker(); 

    $('input[name="uBus_departureTime"]').timepicker(); 

    

    $('input[name="uBus_arrivalTime"]').timepicker(); 

    
    $('.datepicker_bus_date').datepicker({ 
        dateFormat: 'yy-mm-dd',
        minDate:0
    });
        
    $('.datepicker_repot').datepicker({ 
        dateFormat: 'yy-mm-dd'
    });
    
   
});