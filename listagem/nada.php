<?php
require_once "../db/database.php";

echo "<div class='container'>";
echo "<section id='eventos'>";
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
    $id = $evento['id_evento'];
    echo "<tr>";
    echo "<td>{$id}</td>";
    echo "<td>{$evento['nome']}</td>";
    echo "<td>{$evento['descricao']}</td>";
    echo "<td>{$evento['data_evento']}</td>";
    echo "<td>{$evento['horario']}</td>";
    echo "<td>{$evento['local_evento']}</td>";

    // Contagem de inscritos
    $stmtCount = $pdo->prepare("SELECT COUNT(*) as total_inscritos FROM inscricoes WHERE id_evento = ?");
    $stmtCount->execute([$evento['id_evento']]);
    $totalInscritos = $stmtCount->fetch()['total_inscritos'];

    echo "<td>";
    echo "Inscritos: {$totalInscritos} / {$evento['max_participantes']}";
    echo "</td>";

    // Verifica se o usuário já está inscrito
    $usuario_id = $_SESSION['usuario_id'];
    $stmt = $pdo->prepare("SELECT * FROM inscricoes WHERE id_usuario = ? AND id_evento = ?");
    $stmt->execute([$usuario_id, $evento['id_evento']]);
    $jaInscrito = $stmt->rowCount() > 0;

    // Botão de participar / cancelar com bloqueio se estiver lotado
    echo "<td>";
    if ($jaInscrito) {
        echo "<a href='../view/desinscrever.php?id={$evento['id_evento']}' class='btn cancelar' 
                 onclick=\"return confirm('Deseja sair deste evento?')\">
                 Cancelar inscrição
              </a>";
    } elseif ($totalInscritos >= $evento['max_participantes']) {
        echo "<span class='evento-lotado'>Evento lotado</span>";
    } else {
        echo "<a href='../view/inscrever.php?id={$evento['id_evento']}' class='btn participar' >
                 Participar
              </a>";
    }
    echo "</td>";

    echo "</tr>";
}

echo "</tbody></table>";
echo "</section>";
echo "</div>";
?>