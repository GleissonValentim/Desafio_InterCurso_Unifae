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
    function exibirModalidades(){
        $.ajax({
            url: 'http://localhost/repositorio/Desafio_InterCurso_Unifae/modalidades.php',
            method: 'GET',
        }).done(function(data){
            $(".exibir_modalidades").html(data);
        })
    }
    setInterval(exibirModalidades, 1000);

    // script de editar os gestores/usuarios
    $(document).on('click', '#definir', function(e){
        e.preventDefault();
        var id = $("#definir").val();
        $.ajax({
            url: 'http://localhost/repositorio/Desafio_InterCurso_Unifae/gestores.php',
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
    $(document).on('click', '#deletarGestor', function(e){
        e.preventDefault();
        var del = $("#deletarGestor").val();
        console.log(del);
        $.ajax({
            url: 'http://localhost/repositorio/Desafio_InterCurso_Unifae/gestores.php',
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