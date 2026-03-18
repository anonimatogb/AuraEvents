<?php
echo "<section id='eventos'>";

echo "<h1>Gerenciamento de Eventos</h1>";

if(empty($eventos)){
    echo "<div class='links'>";
    echo "<p>Nenhum evento encontrado!</p>";
    echo "<br>
<a href='../cadastro/cadastroevento.php' class='cadastro'>Cadastrar novo evento</a>";
echo "</div>";
    return;
}

echo "<table border='1' cellpadding='5' cellspacing='0'>";
echo "<thead>
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Descrição</th>
            <th>Data do Evento</th>
            <th>Horário</th>
            <th>Local</th>
            <th>Máximo de Participantes</th>
            <th>Ações</th>
        </tr>
      </thead>
      <tbody>";

foreach($eventos as $evento){
    $id = $evento['id_evento'];
    echo "<tr>";
    echo "<td>{$id}</td>";
    echo "<td>{$evento['nome']}</td>";
    echo "<td>{$evento['descricao']}</td>";
    echo "<td>{$evento['data_evento']}</td>";
    echo "<td>{$evento['horario']}</td>";
    echo "<td>{$evento['local_evento']}</td>";
    echo "<td>{$evento['max_participantes']}</td>";
    echo "<td>
            <a href='../editar/editarevent.php?id={$id}' class='btn-editar'>Editar</a> |
            <a href='../delete/deletarevento.php?id={$id}' class='btn-deletar' 
               onclick=\"return confirm('Tem certeza que deseja excluir este evento?')\">Deletar</a> |
            <a href='../cadastro/cadastroevento.php' class='btn-cadastrar'>Cadastrar</a>
          </td>";
    echo "</tr>";
}

echo "</tbody></table>";
echo "</section>";
?>