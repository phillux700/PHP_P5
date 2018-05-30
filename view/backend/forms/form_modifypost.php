<div class="form-container">
    <div class="response alert"></div>
        <?php if(isset($_SESSION['flash'])) : ?>
            <?php foreach($_SESSION['flash'] as $type => $message): ?>
                <div class="text-center alert alert-<?= $type; ?>">
                    <?= $message; ?>
                </div>
            <?php endforeach; ?>
            <?php unset($_SESSION['flash']); ?>
        <?php endif; ?>
<form action="index.php?action=modifyPost&amp;id=<?= $post->getId() ?>" method="post">
    <div>
        <label for="title">Titre</label><br />
        <input type="text" id="title" name="title" value="<?= htmlspecialchars($post->getTitle()) ?>" />
    </div>
    <div class="divide20"></div>
    <div>
        <label for="chapo">Chapô</label><br />
        <input type="text" id="chapo" name="chapo" value="<?= htmlspecialchars($post->getChapo()) ?>" />
    </div>
    <div class="divide20"></div>
    <div>
        <label for="content">Article</label><br />

        <textarea id="content" name="content"><?= htmlspecialchars($post->getContent()) ?></textarea>
    </div>
    <div class="divide40"></div>
    <div>
        <input class="btn btn-default" type="submit" style="width: 100px;display: block; margin: 0 auto;"/>
    </div>
</form>
</div>
