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

    // script de editar as modalidadaes
    $(document).on('click', '.editar_modalidadade', function(e){
        e.preventDefault();
        var edit = $(this).attr("id");
        $.ajax({
            url: 'http://localhost/repositorio/Desafio_InterCurso_Unifae/editar_modalidades.php',
            method: 'POST',
            data:{
                edit: edit
            }

        }).done(function(data){
           $('#editarModalidade').html(data);
        })
    });

    // script para atualizar os dados das modalidades
    $(document).on('submit', '#atualizar_modalidade', function(e){
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

    // script de remover as modalidades
    $(document).on('click', '.remover_modalidadade', function(e){
        e.preventDefault();
        var del = $(this).attr("id");
        Swal.fire({
            title: "Tem certeza?",
            text: "Você não poderá reverter isso!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#39bd9c",
            cancelButtonColor: "#d33",
            confirmButtonText: "Sim, apague!",
            cancelButtonText: "Cancelar",
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                    url: 'http://localhost/repositorio/Desafio_InterCurso_Unifae/editar_modalidades.php',
                    method: 'POST',
                    data:{
                        del: del
                }}).done(function(data){
                    if(data.erro == true){
                        Swal.fire({
                            title: "Erro",
                            text: data.menssagem,
                            icon: "error"
                        });
                    } else {
                    if (result.isConfirmed) {
                            Swal.fire({
                            title: "Deletado!",
                            text: data.menssagem,
                            icon: "success"
                            });
                        }
                    }
                })
            }
        });
    });

    // Listar as modalidades
    function getModalidades() {
        $.ajax({
            url: 'http://localhost/repositorio/Desafio_InterCurso_Unifae/imprimir_modalidades.php',
            method: 'GET',
            dataType: 'json'
        }).done(function(result){
            $('#exibir_modalidades').html(result);
        });
    }

    setInterval(getModalidades, 1000);
    
    // script de editar os gestores/usuarios
    $(document).on('click', '.definir', function(e){
        e.preventDefault();
        var edit = $(this).attr("id");
        $.ajax({
            url: 'http://localhost/repositorio/Desafio_InterCurso_Unifae/definir_gestores.php',
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

    // script para deletar um gestor
    $(document).on('click', '.deletarGestor', function(e){
        e.preventDefault();
        var del = $(this).attr("id");
        Swal.fire({
            title: "Tem certeza?",
            text: "Você não poderá reverter isso!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#39bd9c",
            cancelButtonColor: "#d33",
            confirmButtonText: "Sim, apague!",
            cancelButtonText: "Cancelar",
            }).then((result) => {
                if (result.isConfirmed) {
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
                    if (result.isConfirmed) {
                            Swal.fire({
                            title: "Deletado!",
                            text: data.menssagem,
                            icon: "success"
                            });
                        }
                    }
                })
            }
        });
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

    // Listar os jogos
    function getjogos() {
        $.ajax({
            url: 'http://localhost/repositorio/Desafio_InterCurso_Unifae/imprimir_jogos.php',
            method: 'GET',
            dataType: 'json'
        }).done(function(result){
            console.log("eu")
            $('.listar_jogos').html(result);
        });
    }

    setInterval(getjogos, 1000);

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
        Swal.fire({
            title: "Tem certeza?",
            text: "Você não poderá reverter isso!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#39bd9c",
            cancelButtonColor: "#d33",
            confirmButtonText: "Sim, apague!",
            cancelButtonText: "Cancelar",
            }).then((result) => {
                if (result.isConfirmed) {
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
                    if (result.isConfirmed) {
                            Swal.fire({
                            title: "Deletado!",
                            text: data.menssagem,
                            icon: "success"
                            });
                        }
                    }
                })
            }
        });
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
        Swal.fire({
            title: "Tem certeza?",
            text: "Você não poderá reverter isso!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#39bd9c",
            cancelButtonColor: "#d33",
            confirmButtonText: "Sim, recusar!",
            cancelButtonText: "Cancelar",
            }).then((result) => {
                if (result.isConfirmed) {
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
                    if (result.isConfirmed) {
                            Swal.fire({
                            title: "Deletado!",
                            text: data.menssagem,
                            icon: "success"
                            });
                        }
                    }
                })
            }
        });
    });
});