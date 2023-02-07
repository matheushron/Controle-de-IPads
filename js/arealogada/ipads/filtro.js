$(function(){
    $("#NovosAtivos input").keyup(function(){        
        var index = $(this).parent().index();
        var nth = "#NovosAtivos td:nth-child("+(index+1).toString()+")";
        var valor = $(this).val().toUpperCase();
        $("#NovosAtivos tbody tr").show();
        $(nth).each(function(){
            if($(this).text().toUpperCase().indexOf(valor) < 0){
                $(this).parent().hide();
            }
        });
    });
 
    $("#NovosAtivos input").blur(function(){
        $(this).val("");
    });
});

$(function(){
    $("#NovosAtivos select").change(function(){        
        var index = $(this).parent().index();
        var nth = "#NovosAtivos td:nth-child("+(index+1).toString()+")";
        var valor = $(this).val().toUpperCase();
        $("#NovosAtivos tbody tr").show();
        $(nth).each(function(){
            if($(this).text().toUpperCase().indexOf(valor) < 0){
                $(this).parent().hide();
            }
        });
    });
 
    $("#NovosAtivos select").blur(function(){
        $(this).val("");
    }); 
});