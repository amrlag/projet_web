<h1>Mini-chat</h1>

<form method="post" action="?page=chat_store">
    <textarea
        name="message"
        maxlength="255"
        rows="4"
        cols="60"
        required></textarea>

    <br><br>

    <button type="submit">Envoyer</button>
</form>

<hr>

<h2>10 derniers messages</h2>

<?php if (!empty($messages)): ?>

    <?php foreach ($messages as $msg): ?>

        <p>
            <strong><?= htmlspecialchars($msg['username']) ?></strong> :
            <?= htmlspecialchars($msg['message']) ?>
            <br>
            <small><?= htmlspecialchars($msg['created_at']) ?></small>
        </p>

        <hr>

    <?php endforeach; ?>

<?php else: ?>

    <p>Aucun message pour le moment.</p>

<?php endif; ?>
