<div class="container">
    <?php foreach ($data as $item): ?>
        <h1 style="text-align: center"><?= $item['title'] ?></h1>
        <p><?= $item['text'] ?></p>
        <input type="hidden" name="article_id" class="post_id" id="<?=$item['id']?>">
    <?php endforeach; ?>

    <form method="post" class="form-control" id="comment_form">
        <div class="form-group">
            <label for="comment_content">Введите ваш комментарий: </label>
            <textarea name="comment_content" class="form-control" id="comment_content"> </textarea>
        </div>
        <div class="form-group">
            <input type="submit" name="submit" class="btn btn-info" id="submit" value="Submit">
        </div>
    </form>
    <span id="comment_message"></span>
    <br>
    <h3>Комментарии</h3>
    <?php foreach ($additionalData as $value): ?>
        <div id="display_comment"><?= $value['comment_text'] ?></div>
    <?php endforeach; ?>
