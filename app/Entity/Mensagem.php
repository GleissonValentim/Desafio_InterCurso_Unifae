<?php

    namespace app\Entity;

    class Mensagem {
        
        public function getMensagem($location, $status, $menssagem){
            $_SESSION['menssagem'] = $menssagem;
            header('location: '.$location.'?status='.$status.'');
        }
    }