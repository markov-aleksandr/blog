<div class="container">
    <input type="hidden" class="articleId" name="articleId" id="<?= $data['id'] ?>">
    <h1 style="text-align: center"><?= $data['title'] ?></h1>
    <p><?= $data['text'] ?></p>
    <input type="hidden" name="article_id" class="post_id" id="<?= $data['id'] ?>">


    <div class="row">
        <div class="col-md-12">
            <h2>Комментарии
                            <textarea class="form-control" name="comment" id="commentField" cols="30" rows="2"
                                      placeholder="Ваш коментарий..."></textarea>
                    <button class="btn btn-primary" style="float: right;" onclick="isReply = false" id="addComment">
                        Отправить
                    </button>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
<!--            <ul>-->
            <div class="userComments">

                <div class="comment">
                    <div class="user"><b></b> <span class="time"></span>
                    </div>
                    <div class="userComment"></div>
                    <div class="reply" id=""><a href="javascript:void(0)">ответить</a></div>
                    <div class="replies">
                        <div class="comment">
                            <div class="user"><b></b> <span class="time"></span></div>
                            <div class="userComment"></div>
                        </div>
                    </div>

                    <div class="row rowReply" style="display: none">
                        <div class="col-md-12">
                                        <textarea class="form-control" name="replyComment" id="replyComment" cols="30"
                                                  rows="2"></textarea>
                            <button class="btn btn-primary" id="addReply"
                                    onclick="isReply = true;">Ответить
                            </button>
                            <button class="btn btn-danger" onclick="$('.rowReply').hide()">Закрыть</button>
                        </div>
                    </div>
                    <div class="replies">
                        <div class="comment">
                            <div class="user"><b></b> <span class="time"></span></div>
                            <div class="userComment"></div>
                        </div>
                        <div class="comment">
                            <div class="user"><b>admin</b> <span class="time">2019-07-15</span></div>
                            <div class="userComment"></div>
                        </div>
                    </div>
                </div>
<!--            </ul>-->
            </div>
        </div>
    </div>
</div>