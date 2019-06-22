<?php

    require_once 'config.php';

    /* carrega um usuário */
    /* $root = new Usuario();
      $root->loadById(3);
      echo $root;
     */

    /* carrega uma lista de usuários */
    /* $lista = Usuario::getList();
      echo json_encode($lista);
     */

    /* carrega uma lista de usuarios buscando pelo login */
    /* $busca = Usuario::search('jo');
      echo json_encode($busca); */

    /* carrega um usuário usando login e senha */
    /* $usuario = new Usuario();
    $usuario->login("root", "!@#$");
    echo $usuario;
    */
    
    $aluno = new Usuario("aluno","@lun0");
    $aluno->insert();
    
    echo $aluno;
?>