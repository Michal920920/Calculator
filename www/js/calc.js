$(document).ready(function () {
$(document).ajaxComplete(fontSize);

//ošetření vstupů tlačítek kalkulačky
    $("button").click(function(){
        
        var operators = ["+", "-", "*", "/", "."];
        var operatorsPlusMinus = ["+", "-"];
        var display = $('#display').val();

       //na vstupu číslo, odešleme k výpočtu
       if($.isNumeric($(this).val())){
            if($('#display').val().length <= 24){
                $('#display').val(display + $(this).val());
            }
       sendContinuosResult();
       
       //na vstupu operátor
       }else if($(this).hasClass('operator')){
            //poslední znak na displeji
            var lastChar = display.slice(-1);
            //na vstupu +/- a je prvním znakem
            if($.inArray($(this).val(), operatorsPlusMinus) !== -1 && display.length <= 1){ 
                //před ním je číslo
                if($.isNumeric(lastChar)){
                   $('#display').val(display + $(this).val());
                //před ním je operátor
                }else{
                     $('#display').val(display.substring(0,display.length - 1));
                     $('#display').val($(this).val());
                }
            //předešlý znak je operátor    
            }else if($.inArray(lastChar, operators) !== -1 && display.length > 1){ 
                $('#display').val(display.substring(0,display.length - 1));
                $('#display').val($('#display').val() + $(this).val());//vymazat a nahradit vstupem
            //ostatní za první pozicí, pokud to není +/-
            }else if(display.length > 0 && $.inArray(lastChar, operatorsPlusMinus) === -1){
                $('#display').val(display + $(this).val());
            }
       //na vstupu tlačítko <-     
       }else if($(this).attr("id") === 'back'){ 
           $('#display').val(display.substring(0,display.length - 1));
       //na vstupu tlačítko C    
       }else if($(this).attr("id") === 'clear'){ 
           $('#display').val(null);
           $('#continuosResult').text(null);
       //na vstupu tlačítko AC    
       }else if($(this).attr("id") === 'allClear'){ 
          sendAllClear();
       //na vstupu tlačítko =    
       }else if($(this).attr("id") === 'equals'){ 
            sendExample();
       }
    });
    
    //stisknutí enter
    $(function(){
      $(document).keyup(function(e) {
        if (e.which === 13) {
          sendExample();
        }
      });
    });

    //vstup do inputu z klávesnice
    $('#wholedisplay').on('input','#display',function(e){
            e.preventDefault();
            sendContinuosResult();
    });
    
    //odeslání příkladu, při úspěchu uložení
    function sendExample(){
           $.nette.ajax({
            type: "POST",
            url :  $('#equals').attr("data-link"),
            data:{
                "calculator-result":  $('#continuosResult').text()
            },success:function(){
                 saveResult();
            }
	});
    }
    
    //průběžný výpočet příkladu
    function sendContinuosResult(){
           $.nette.ajax({
            type: "POST",
            url :  $('#continuosResult').attr("data-link"),
            data:{
                "calculator-continuosExample":  $('#display').val()
            }
	});      
    }
    
    //restart
    function sendAllClear(){
           $.nette.ajax({
            url :  $('#allClear').attr("data-link")
	});      
    }
    
    //odeslání aktuálního výrazu a doposud uložených hodnot
    function saveResult(){
        var count = $("#resultsHistory p").length;
        let saved = [];
        for(var i = 0; i < count; i++){
             saved[i] =  $('#result'+i).text();
        }
        var expression = $('#display').val() + '=' + $('#continuosResult').text();
        $.nette.ajax({
            type: "POST",
            url :  $('#resultsHistory').attr("data-link"),
            data:{
                "calculator-expression": expression,
                "calculator-saved": saved
            },success:function(){
                cursorToEnd();
            }
	});  
    }
   
    function fontSize(){
        var display = $('#display');
        var continuosResult = $('#continuosResult');
        var textLength = display.val().length;
                if (textLength > 15) {
                    display.css('font-size', '0.9em');
                    continuosResult.css('font-size', '0.8em');
                }else{
                     display.css('font-size', '1.3em');
                     continuosResult.css('font-size', '1.1em');
                }
    }
    
    function cursorToEnd(){
            var fieldInput = $('#display');
            var fldLength= fieldInput.val().length;
            fieldInput.focus();
            fieldInput[0].setSelectionRange(fldLength, fldLength);
    }
    
    $(document).on('mouseenter','.singleResult',function(){
        if($(this).text().length > 22){
            $(this).addClass('singleResultAll').removeClass('singleResult');
        }
    });
    
    $(document).on('mouseleave','.singleResultAll',function(){
        $(this).addClass('singleResult').removeClass('singleResultAll');
    });
});