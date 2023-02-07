$(function(){
    $("#chips input").keyup(function(){        
        var index = $(this).parent().index();
        var nth = "#chips td:nth-child("+(index+1).toString()+")";
        var valor = $(this).val().toUpperCase();
        $("#chips tbody tr").show();
        $(nth).each(function(){
            if($(this).text().toUpperCase().indexOf(valor) < 0){
                $(this).parent().hide();
            }
        });
    });
 
    $("#chips").blur(function(){
        $(this).val("");
    });
});


$(function(){
    $("#chips select").change(function(){        
        var index = $(this).parent().index();
        var nth = "#chips td:nth-child("+(index+1).toString()+")";
        var valor = $(this).val().toUpperCase();
        $("#chips tbody tr").show();
        $(nth).each(function(){
            if($(this).text().toUpperCase().indexOf(valor) < 0){
                $(this).parent().hide();
            }
        });
    });
 
    $("#chips select").blur(function(){
        $(this).val("");
    }); 
});
