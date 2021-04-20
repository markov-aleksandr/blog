<div class="container">
    <?php foreach ($data as $item): ?>
        <h1 style="text-align: center"><?= $item['title'] ?></h1>
        <p><?= $item['text'] ?></p>
        <input type="hidden" name="article_id" class="post_id" id="<?= $item['id'] ?>">
    <?php endforeach; ?>

    <style>
        .user {
            font-weight: bold;
            color: black;
        }

        .time {
            color: gray;
        }

        .userComment {
            color: #000;
        }

        .comment {
            margin-top: 10px;
        }

        .replies {
            margin-left: 20px;
        }

    </style>
<!--    --><?php //var_dump($additionalData);

    ?>


    <div class="row">
        <div class="col-md-12">
            <h2>Комментарии (<b id="countComment"><?= $additionalData['count'] ?></b>)</h2>
            <textarea class="form-control" name="comment" id="commentField" cols="30" rows="2"
                      placeholder="Ваш коментарий..."></textarea>
            <button class="btn btn-primary" style="float: right;" id="addComment">Отправить</button>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="userComments">
                <?php foreach ($additionalData['posts'] as $value): ?>


                <div class="comment">
                    <div class="user"><b><?=$value['login']?></b> <span class="time"><?=$value['time']?></span></div>
                    <div class="userComment"><?=$value['comment_text']?></div>
                    <?php endforeach; ?>
                    <div class="replies">
                        <div class="comment">
                            <div class="user"><b>Derzhavo</b> <span class="time">2019-07-15</span></div>
                            <div class="userComment">привет, это саша державо</div>
                        </div>
                        <div class="comment">
                            <div class="user"><b>Derzhavo</b> <span class="time">2019-07-15</span></div>
                            <div class="userComment">а ты кто?</div>
                        </div>
                    </div>
                </div>
            </div>


            <!--                <form method="post" class="form-control" id="comment_form">-->
            <!--                    <div class="form-group">-->
            <!--                        <label for="comment_content">Введите ваш комментарий: </label>-->
            <!--                        <textarea name="comment_content" class="form-control" id="comment_content"> </textarea>-->
            <!--                    </div>-->
            <!--                    <div class="form-group">-->
            <!--                        <input type="submit" name="submit" class="btn btn-info" id="submit" value="Submit">-->
            <!--                    </div>-->
            <!--                </form>-->
            <!--                <span id="comment_message"></span>-->
            <!--                <br>-->
            <!--                <h3>Комментарии</h3>-->

