$(document).ready(function(){
    $('#myModal').on('shown.bs.modal', function () {
        $('#myInput').trigger('focus')
    })

    // Cadastrar modalidade
    $(document).on('submit', '#cadastrar_modalidade', function(e){
        e.preventDefault();
        $.ajax({
            url: 'http://localhost/repositorio/Desafio_InterCurso_Unifae/cadastrar_modalidades.php',
            method: 'POST',
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
        }).done(function(data){
            if(data.erro == true){
                Swal.fire({
                    title: "Erro",
                    text: data.menssagem,
                    icon: "error"
                });
            } else {
                Swal.fire({
                    title: data.menssagem,
                    icon: "success",
                    draggable: true
                });
            }
        })
    });

    // Exibir as informações
    // function exibirModalidades(){
    //     $.ajax({
    //         url: 'http://localhost/repositorio/Desafio_InterCurso_Unifae/editar_modalidades.php',
    //         method: 'GET',
    //         dataType: 'json'
    //     }).done(function(data){
    //         console.log(data)
    //         // $("#exibir_modalidades").html(data);
    //         // for(var i = 0; i < data.length; i++){
    //         //     $('#exibir_modalidades').prepend('<p>' + data[i].nome + '</p>');
    //         // }
            
    //     })
    // }
    // exibirModalidades();

    function getComments() {
    $.ajax({
        url: 'http://localhost/repositorio/Desafio_InterCurso_Unifae/editar_modalidades.php',
        method: 'GET',
        dataType: 'json'
    }).done(function(result){
        console.log(result);
        for(var i = 0; i < result.length; i++){
            // $("#exibir_modalidades").html(data);
            $('#exibir_modalidades').prepend('<tr><td>' + result[i].nome + '</td><td>' + result[i].regras + '</td><td>' + result[i].numero_atletas + '</td></tr>');
        }
    });
}

getComments();

    // script de editar os gestores/usuarios
    $(document).on('click', '.definir', function(e){
        e.preventDefault();
        var id = $(this).attr("id");
        $.ajax({
            url: 'http://localhost/repositorio/Desafio_InterCurso_Unifae/definir_gestores.php',
            method: 'POST',
            data:{
                id: id
            }

        }).done(function(data){
            if(data.erro == true){
                Swal.fire({
                    title: "Erro",
                    text: data.menssagem,
                    icon: "error"
                });
            } else {
                Swal.fire({
                    title: data.menssagem,
                    icon: "success",
                    draggable: true
                });
            }
        })
    });

    // script para deletar um gestor
    $(document).on('click', '.deletarGestor', function(e){
        e.preventDefault();
        var del = $(this).attr("id");
        $.ajax({
            url: 'http://localhost/repositorio/Desafio_InterCurso_Unifae/definir_gestores.php',
            method: 'POST',
            data:{
                del: del
            }

        }).done(function(data){
            if(data.erro == true){
                Swal.fire({
                    title: "Erro",
                    text: data.menssagem,
                    icon: "error"
                });
            } else {
                Swal.fire({
                    title: data.menssagem,
                    icon: "success",
                    draggable: true
                });
            }
        })
    });

    // Cadastrar sortear os jogos
    $(document).on('submit', '#sortear_jogos', function(e){
        e.preventDefault();
        $.ajax({
            url: 'http://localhost/repositorio/Desafio_InterCurso_Unifae/cadastrar_jogos.php',
            method: 'POST',
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
        }).done(function(data){
            if(data.erro == true){
                Swal.fire({
                    title: "Erro",
                    text: data.menssagem,
                    icon: "error"
                });
            } else {
                Swal.fire({
                    title: data.menssagem,
                    icon: "success",
                    draggable: true
                });
            }
        })
    });

    // script de editar os jogos
    $(document).on('click', '.editar_jogos', function(e){
        e.preventDefault();
        var id = $(this).attr("id");
        $.ajax({
            url: 'http://localhost/repositorio/Desafio_InterCurso_Unifae/editar_jogos.php',
            method: 'POST',
            data:{
                id: id
            }

        }).done(function(data){
            if(data.erro == true){
                Swal.fire({
                    title: "Erro",
                    text: data.menssagem,
                    icon: "error"
                });
            } else {
                Swal.fire({
                    title: data.menssagem,
                    icon: "success",
                    draggable: true
                });
            }
        })
    })

    // script para definir um atleta
    $(document).on('click', '.definir_atleta', function(e){
        e.preventDefault();
        var edit = $(this).attr("id");
        $.ajax({
            url: 'http://localhost/repositorio/Desafio_InterCurso_Unifae/definir_atletas.php',
            method: 'POST',
            data:{
                edit: edit
            }
        }).done(function(data){
            if(data.erro == true){
                Swal.fire({
                    title: "Erro",
                    text: data.menssagem,
                    icon: "error"
                });
            } else {
                Swal.fire({
                    title: data.menssagem,
                    icon: "success",
                    draggable: true
                });
            }
        })
    });

    // script para remover um atleta
    $(document).on('click', '.remover_atleta', function(e){
        e.preventDefault();
        var del = $(this).attr("id");
        $.ajax({
            url: 'http://localhost/repositorio/Desafio_InterCurso_Unifae/remover_atletas.php',
            method: 'POST',
            data:{
                del: del
            }
        }).done(function(data){
            if(data.erro == true){
                Swal.fire({
                    title: "Erro",
                    text: data.menssagem,
                    icon: "error"
                });
            } else {
                Swal.fire({
                    title: data.menssagem,
                    icon: "success",
                    draggable: true
                });
            }
        })
    });

    // Cadastrar Times
    $(document).on('submit', '#cadastrar_time', function(e){
        e.preventDefault();
        $.ajax({
            url: 'http://localhost/repositorio/Desafio_InterCurso_Unifae/cadastrar_times.php',
            method: 'POST',
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
        }).done(function(data){
            if(data.erro == true){
                Swal.fire({
                    title: "Erro",
                    text: data.menssagem,
                    icon: "error"
                });
            } else {
                Swal.fire({
                    title: data.menssagem,
                    icon: "success",
                    draggable: true
                });
            }
        })
    });

    // Editar notificações
    $(document).on('click', '.editar_notificacao', function(e){
        e.preventDefault();
        var edit = $(this).attr("id");
        $.ajax({
            url: 'http://localhost/repositorio/Desafio_InterCurso_Unifae/editar_notificacoes.php',
            method: 'POST',
            data:{
                edit: edit
            }
        }).done(function(data){
            if(data.erro == true){
                Swal.fire({
                    title: "Erro",
                    text: data.menssagem,
                    icon: "error"
                });
            } else {
                Swal.fire({
                    title: data.menssagem,
                    icon: "success",
                    draggable: true
                });
            }
        })
    });

    // remover notificações
    $(document).on('click', '.remover_notificacao', function(e){
        e.preventDefault();
        var del = $(this).attr("id");
        $.ajax({
            url: 'http://localhost/repositorio/Desafio_InterCurso_Unifae/editar_notificacoes.php',
            method: 'POST',
            data:{
                del: del
            }
        }).done(function(data){
            if(data.erro == true){
                Swal.fire({
                    title: "Erro",
                    text: data.menssagem,
                    icon: "error"
                });
            } else {
                Swal.fire({
                    title: data.menssagem,
                    icon: "success",
                    draggable: true
                });
            }
        })
    });
});