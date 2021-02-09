<a href="/">Back to main</a>
<div class="container">
    <?php foreach ($data as $item): ?>

        <h1 style="text-align: center"><?= $item['title'] ?></h1>
        <p><?= $item['text'] ?></p>

    <?php endforeach; ?>
    <h3>Коментарии: </h3>
    <div class="create_comments">
        <textarea name="article" class="form-control"></textarea>
    </div>

    <div class="comments">
        <p>коментарии</p>
        <p>коментарии</p>
        <p>коментарии</p>
        <p>коментарии</p>
    </div>
</div>

