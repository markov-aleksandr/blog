<div class="album py-5 bg-light">
    <div class="container">
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
            <?php foreach ($data as $key): ?>
                <div class="col">
                    <div class="card shadow-sm">
                        <!--                        <svg class="bd-placeholder-img card-img-top" width="100%" height="225" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#55595c"/><text x="50%" y="50%" fill="#eceeef" dy=".3em">Thumbnail</text></svg>-->
                        <div class="card-body">
                            <p class="card-text"><?=$key['title']?></p>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="btn-group">
                                    <a href="/article/view/<?=$key['user_id']?>/<?=$key['id']?>" type="button" class="btn btn-sm btn-outline-secondary">View</a>
                                    <a href="/article/delete/<?=$key['user_id']?>/<?=$key['id']?>" type="button" class="btn btn-sm btn-outline-secondary">Edit</a>
                                </div>
                                <small class="text-muted">9 mins</small>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>
