$(document).ready(function(){
    $('#myModal').on('shown.bs.modal', function () {
        $('#myInput').trigger('focus')
    })

    // Listar os filtros
    // function getFiltros() {
    //     $.ajax({
    //         url: 'http://localhost/repositorio/Desafio_InterCurso_Unifae/filtros.php',
    //         method: 'GET',
    //         dataType: 'json'
    //     }).done(function(result){
    //         $('.teste').html(result);
    //     });
    // }
    // setInterval(getFiltros, 1000);

    // Filtrar
    $(document).on('click', '.filtrar_jogos', function(e){
        e.preventDefault();
        // var id = $(this).attr("id");
        var id = $('#filtro_modalidades').val();
        $.ajax({
            url: 'http://localhost/repositorio/Desafio_InterCurso_Unifae/imprimir_jogos.php',
            method: 'POST',
            data:{
                id: id
            }
        }).done(function(data){
           $('.listar_jogos').html(data);
        })
    });

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
            if(result.erro == true){
                $('#exibir_modalidades').show();
                $('#exibir_modalidades').hide();
                $('.modalidades_vazia').html(result.menssagem);
            } else {
                $('.modalidades_vazia').hide();
                $('#exibir_modalidades').show();
                $('#exibir_modalidades').html(result);
            }
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
                }).then(() => {
                    location.reload();
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
                            }).then(() => {
                                location.reload();
                            });
                        }
                    }
                })
            }
        });
    });

    // Sortear os jogos
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
        var edit = $(this).attr("id");
        $.ajax({
            url: 'http://localhost/repositorio/Desafio_InterCurso_Unifae/atualizar_jogos.php',
            method: 'POST',
            data:{
                edit: edit
            }

        }).done(function(data){
           $('#editar_jogos').html(data);
        })
    });

    // script de atualizar os dados dos jogos
    $(document).on('submit', '#atualizar_jogos', function(e){
        e.preventDefault();
        $.ajax({
            url: 'http://localhost/repositorio/Desafio_InterCurso_Unifae/editar_jogos.php',
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
    })

    // Guarda o id da modalidade dos jogos
    $(document).on('submit', '.teste', function(e){
        e.preventDefault();

        var id = $('#filtro_modalidades').val();
        $('.listar_jogos').data('modalidade-id', id);
    });

    // Listar os jogos
    function getjogos() {
        var id = $('.listar_jogos').data('modalidade-id');
        $.ajax({
            url: 'http://localhost/repositorio/Desafio_InterCurso_Unifae/imprimir_jogos.php',
            method: 'GET',
            dataType: 'json',
            data:{
                id: id
            }
        }).done(function(result){
            if(result.erro == true){
                $('.jogos_vazio').show();
                $('.listar_jogos').hide();
                $('.jogos_vazio').html(result.menssagem);
            } else {
                $('.jogos_vazio').hide();
                $('.listar_jogos').show();
                $('.listar_jogos').html(result);
            }
        });
    }

    setInterval(getjogos, 1000);

    // Guarda o id do atleta
    $(document).on('click', '.definir_atleta_1', function(e){
        e.preventDefault();

        var id = $(this).val(); 
        $('#exampleModal').data('usuario-id', id);
    });

    // script para definir um atleta
    $(document).on('submit', '#definir_atleta_2', function(e){
        e.preventDefault();
        var edit = $('select[name="modalidade"]').val();
        var id = $('#exampleModal').data('usuario-id');
        $.ajax({
            url: 'http://localhost/repositorio/Desafio_InterCurso_Unifae/definir_atletas.php',
            method: 'POST',
            data:{
                edit: edit,
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
                }).then(() => {
                    location.reload();
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
                            }).then(() => {
                                location.reload();
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
                }).then(() => {
                    location.reload();
                });
            }
        })
    });

    // Ecluir Times
    $(document).on('click', '.remover_time', function(e){
        e.preventDefault();
        var del = $(this).attr("id");
        console.log(del)
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
                    url: 'http://localhost/repositorio/Desafio_InterCurso_Unifae/editar_time.php',
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
                            }).then(() => {
                                location.reload();
                            });
                        }
                    }
                })
            }
        });
    });

    // Sair de um time
    $(document).on('click', '.sair_time', function(e){
        e.preventDefault();
        var sair = $(this).attr("id");
        Swal.fire({
            title: "Tem certeza?",
            text: "Você não poderá reverter isso!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#39bd9c",
            cancelButtonColor: "#d33",
            confirmButtonText: "Sim, sair do time!",
            cancelButtonText: "Cancelar",
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                    url: 'http://localhost/repositorio/Desafio_InterCurso_Unifae/editar_time.php',
                    method: 'POST',
                    data:{
                        sair: sair
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
                            }).then(() => {
                                location.reload();
                            });
                        }
                    }
                })
            }
        });
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
                }).then(() => {
                    location.reload();
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
                            }).then(() => {
                                location.reload();
                            });
                        }
                    }
                })
            }
        });
    });
})