<?php
require_once "../db/database.php";

echo "<section id='eventos'>";
echo "<br>";
echo "<h1>Eventos</h1>";

if(empty($eventos)){
    echo "<div class='links'>";
    echo "<p>Nenhum evento encontrado!</p>";
    echo "</div>";
    return;
}
echo "<link rel='stylesheet' href='../style.css'>";
echo "<table border='1' cellpadding='5' cellspacing='0'>";
echo "<thead>
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Descrição</th>
            <th>Data do Evento</th>
            <th>Horário</th>
            <th>Local</th>
            <th>Quantidade de Participantes</th>
            <th>Ações</th>
        </tr>
      </thead>
      <tbody>";

foreach($eventos as $evento){
    $id = $evento['id'];
    echo "<tr>";
    echo "<td>{$id}</td>";
    echo "<td>{$evento['nome']}</td>";
    echo "<td>{$evento['descricao']}</td>";
    echo "<td>{$evento['data_evento']}</td>";
    echo "<td>{$evento['horario']}</td>";
    echo "<td>{$evento['local_evento']}</td>";

    // Contagem de inscritos
    $stmtCount = $pdo->prepare("SELECT COUNT(*) as total_inscritos FROM inscricoes WHERE id_evento = ?");
    $stmtCount->execute([$evento['id']]);
    $totalInscritos = $stmtCount->fetch()['total_inscritos'];

    echo "<td>";
    echo "Inscritos: {$totalInscritos} / {$evento['max_participantes']}";
    echo "</td>";

    // Verifica se o usuário já está inscrito
    $usuario_id = $_SESSION['usuario_id'];
    $stmt = $pdo->prepare("SELECT * FROM inscricoes WHERE id_usuario = ? AND id_evento = ?");
    $stmt->execute([$usuario_id, $evento['id']]);
    $jaInscrito = $stmt->rowCount() > 0;

    // Botão de inscrever-se / cancelar com bloqueio se estiver lotado
    echo "<td>";
    if ($jaInscrito) {
        echo "<a href='../view/desinscrever.php?id={$evento['id']}' class='btn cancelar' 
                 onclick=\"return confirm('Deseja sair deste evento?')\">
                 Cancelar inscrição
              </a>";
    } elseif ($totalInscritos >= $evento['max_participantes']) {
        echo "<span class='evento-lotado'>Evento lotado</span>";
    } else {
        echo "<a href='../view/inscrever.php?id={$evento['id']}' class='btn participar' >
                 Inscrever-se
              </a>";
    }
    echo "</td>";

    echo "</tr>";
}

echo "</tbody></table>";
echo "</section>";

?>