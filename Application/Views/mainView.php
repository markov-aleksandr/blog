<div class="container marketing">
    <hr class="featurette-divider">
    <?php foreach ($data

    as $key): ?>
    <div class="row featurette">
        <div class="col-md-12"> <!-- col-md-7 if add photo-->
            <a class="featurette-heading" href="/posts/<?= $key['id'] ?>/show"><?= $key['title'] ?></a>

            <p class="lead"><?= $key['text'] ?></p>
        </div>
        <hr class="featurette-divider">
        <?php endforeach; ?>




