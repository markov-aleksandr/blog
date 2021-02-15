<div class="container">
    <?php foreach ($data as $item): ?>
        <h1 style="text-align: center"><?= $item['title'] ?></h1>
        <p><?= $item['text'] ?></p>

    <?php endforeach; ?>


    <!-- --------------------------------------------Comment`s------------------------------------------------------------------>

    <div class="comments">
        <h3 class="title-comments">Комментарии (6)</h3>


    </div>

    <?php foreach ($additionalData as $value): ?>
        <p><?= $value['comment_text']?></p>

<!--        <form method="post" action="/posts/--><?//= $data[0]['id']?><!--/comment/--><?//= $value['id'] ?><!--" id="ansComment" >-->
<!--            <textarea name="comment" class="form-control" id="ansComment__text"></textarea>-->
<!--            <button onclick="visibleTextArea()" class="btn btn-secondary" id="ansComment__button">Ответить</button>-->
<!--            <button type="submit" class="btn btn-secondary" >Отправить</button>-->
<!--            <hr>-->
<!--        </form>-->
<!-- <a href="/posts/--><?//= $data[0]['id']?><!--/comment/--><?//= $value['id'] ?><!--">Ответить</a> -->
    <?php endforeach; ?>

    <?php if (isset($_SESSION['id'])): ?>
    <form action="/posts/<?= $data[0]['id'] ?>/comment" method="post" id="comment">
        <textarea class="form-control" name="comment"></textarea>
        <button type="submit" class="btn btn-primary ">Отправить комментарий</button>

        <?php else: ?>
            <p>Авторизуйтесь</p>
        <?php endif; ?>
    </form>
</div>
