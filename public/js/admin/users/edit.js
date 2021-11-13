$(function(){
    $('#select-project').on('change',onSelectProjectChange);
});

function onSelectProjectChange (){    
    var project_id = $(this).val();
    if(! project_id){
        $('#select-level').html('<option value="">Seleccionar Proyecto</option>');
        return;
    }
        

    fetch('/api/proyecto/'+project_id+'/niveles')
    .then(res=> res.json())
    .then(data=>{
        var html_select = '<option value="">Seleccionar Proyecto</option>';
        for (i=0; i<data.length; i++)
            html_select += '<option value="'+data[i].id+'">'+data[i].name+'</option>';
            $('#select-level').html(html_select);
    });
        
    // $.get('/api/proyecto/1/niveles', function(data){
    //     var html_select = '<option value="">Seleccionar Proyecto</option>';
    //     for (var i = 0; i < data.length; i++)
    //         html_select += '<option value="'+data[i].id+'">'+data[i].name+'</option>';                       
    //         $('#select-level').html(html_select);
    // });
}