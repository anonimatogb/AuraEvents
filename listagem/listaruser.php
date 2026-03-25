<?php
echo "<section id='usuarios'>";

echo "<h1>Gerenciamento de Usuários</h1>";

if(empty($usuarios)){
    echo "<div class='links'>";
    echo "<p>Nenhum usuário encontrado!</p>";
    echo "<br>
<a href='../view/cadastro.php' class='cadastro'>Cadastrar novo usuário</a>";
echo "</div>";
    return;
}

echo "<table border='1' cellpadding='5' cellspacing='0'>";
echo "<thead>
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Email</th>
            <th>Senha</th>
            <th>Cargo</th>
            <th>Telefone</th>
            <th>Ações</th>
        </tr>
      </thead>
      <tbody>";

foreach($usuarios as $usuario){
    $id = $usuario['id'];
    echo "<tr>";
    echo "<td>#{$id}</td>";
    echo "<td>{$usuario['nome']}</td>";
    echo "<td>{$usuario['email']}</td>";
    echo "<td>{$usuario['senha']}</td>";
    echo "<td>{$usuario['cargo']}</td>";
    echo "<td>{$usuario['telefone']}</td>";
    echo "<td>
            <a href='../editar/editaruser.php?id={$id}' class='btn-editar'>Editar</a> |
            <a href='../delete/deletarusuario.php?id={$id}' class='btn-deletar' 
               onclick=\"return confirm('Tem certeza que deseja excluir este usuário?')\">Deletar</a> |
            <a href='../cadastro/cadastrousuario.php' class='btn-cadastrar'>Cadastrar</a>
          </td>";
    echo "</tr>";
}

echo "</tbody></table>";
echo "</section>";
?>