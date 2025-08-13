<?php 
    session_start();
    
    include __DIR__.'/vendor/autoload.php';

    use \App\Entity\Usuario;
    use \App\Entity\Mensagem;
    $obMensagem = new Mensagem;
    $obUsuario = new Usuario;

    if (!isset($_SESSION['usuario'])) {
        $obMensagem->getMensagem("index.php", "error", "Voçe não tem acesso a essa página");
    } 

    $idUsuario = $_SESSION['usuario'];
    $usuario = Usuario::getUsuarioId($idUsuario);

    if(isset($_POST['nome'], $_POST['senha'], $_POST['confirmar_senha'])){

        $id = $obUsuario->id = $idUsuario;
        $nome = $obUsuario->nome = $_POST["nome"];

        if ($nome != ''){
            $obUsuario->editarUsuarioNome();

            if($obUsuario){
                $obMensagem->getMensagem("index.php", "success", "Usuário editado com sucesso!"); 
            } else {
                $obMensagem->getMensagem("editar_perfil.php", "error", "Erro ao editar o usuário. Por favor, tente novamente."); 
            }
        } else {
            $obMensagem->getMensagem("editar_perfil.php", "error", "Por favor, preencha todos os campos!");
        }

        if($_POST['senha'] != null && $_POST['confirmar_senha']){
            if ($_POST['senha'] == $_POST['confirmar_senha']){
                $novaSenha = password_hash($_POST['senha'], PASSWORD_DEFAULT);
                $senha = $obUsuario->senha = $novaSenha;

                $obUsuario->editarUsuarioSenha();

                if($obUsuario){
                    $obMensagem->getMensagem("index.php", "success", "Usuário editado com sucesso!"); 
                } else {
                    $obMensagem->getMensagem("editar_perfil.php", "error", "Erro ao editar o usuário. Por favor, tente novamente."); 
                }
            } else {
                $obMensagem->getMensagem("editar_perfil.php", "error", "As senhas não batem. Por favor, tente novamente.");  
            }
        } 
    }

    include __DIR__.'/includes/header.php';
    include __DIR__.'/includes/profile.php';
    include __DIR__.'/includes/footer.php';
?>