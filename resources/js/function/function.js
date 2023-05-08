$(document).on('show.bs.modal', '.modal', function () {
    var zIndex = 1040 + (10 * $('.modal:visible').length);
    $(this).css('z-index', zIndex);
    setTimeout(function() {
        $('.modal-backdrop').not('.modal-stack').css('z-index', zIndex - 1).addClass('modal-stack');
    }, 0);
});
//Ajax Scripts para formulários
$(function () {
    $('#cadastro-metas').on("submit",function(e){
        e.preventDefault();
        e.stopImmediatePropagation();
        var data = {
           1: $('#cadastro-metas-loja').val(),
           2: $('#cadastro-metas-regional').val(),
           3: $('#cadastro-metas-mes').val(), 
           4: $('#cadastro-metas-ano').val(),
           5: $('#cadastro-metas-servicos').val(),
           6: $('#cadastro-metas-terminais').val(), 
           7: $('#cadastro-metas-acessorios').val()
        };
        $.ajax({
            url: '/cadastro-metas',
            method: 'post',
            data: {dados: data},
            contentType: "application/x-www-form-urlencoded",
            success: function(response){
                
                if(response.from[0] == "" || response.from[1] == "" || response.from[2] == "" || response.from[3] == ""  || response.from[4] == "" || response.from[5] == "" || response.from[6] == ""){
                   
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Preencha os campos marcados!',

                    });
                    if(response.from[0] == ""){
                        $('#cadastro-metas-loja').css({"border-color": "red"})
                    }else{
                        $('#cadastro-metas-loja').css({"border-color": "grey"})
                    }
                    if(response.from[1] == ""){
                        $('#cadastro-metas-regional').css({"border-color": "red"})
                    }else{
                      $('#cadastro-metas-regional').css({"border-color": "grey"})
                    }
                    if(response.from[2] == ""){
                        $('#cadastro-metas-mes').css({"border-color": "red"})
                    }else{
                        $('#cadastro-metas-mes').css({"border-color": "grey"})
                    }
                    if(response.from[3] == ""){
                        $('#cadastro-metas-ano').css({"border-color": "red"})
                    }else{
                        $('#cadastro-metas-ano').css({"border-color": "grey"})
                    }
                    if(response.from[4] == ""){
                        $('#cadastro-metas-servicos').css({"border-color": "red"})
                    }else{
                        $('#cadastro-metas-servicos').css({"border-color": "grey"})
                    }
                    if(response.from[5] == ""){
                        $('#cadastro-metas-terminais').css({"border-color": "red"})
                    }else{
                        $('#cadastro-metas-terminais').css({"border-color": "grey"})
                    }
                    if(response.from[6] == ""){
                        $('#cadastro-metas-acessorios').css({"border-color": "red"})
                    }else{
                        $('#cadastro-metas-acessorios').css({"border-color": "grey"})
                    }
                }else{
                    Swal.fire({
                        icon: 'success',
                        title: 'Tudo Ok!',
                        text: 'Formulário enviado com sucesso!',
                    }).then(
                      function() {
                        window.location.href = "/cadastro-metas";
                    })
                }              
            }
        });
    });
});

$(function(){
    $('.select-2-cadastro-metas').select2();
})
