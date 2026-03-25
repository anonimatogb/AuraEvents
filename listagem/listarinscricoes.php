<?php if (empty($inscricoes)): ?>
<div>
    <h3>Inscrições</h3>
    <p>Nenhuma inscrição encontrada.</p>
</div>
<?php else: ?>
<div>
    <h1>Inscrições (<?php echo count($inscricoes); ?> total)</h1>
    <table>
        <thead>
            <tr>
                <th>ID Inscrição</th>
                <th>Usuário</th>
                <th>Evento</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($inscricoes as $inscricao): ?>
            <tr>
                <td>#<?php echo $inscricao['id']; ?></td>
                <td><?php echo $inscricao['usuario_nome']; ?></td>
                <td><?php echo $inscricao['evento_nome']; ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<?php endif; ?>
