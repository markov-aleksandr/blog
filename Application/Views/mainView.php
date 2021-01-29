<div class="container marketing">
    <hr class="featurette-divider">
    <?php foreach ($data as $key): ?>
    <div class="row featurette">
        <div class="col-md-12"> <!-- col-md-7 if add photo-->
            <a class="featurette-heading" href="/article/view/<?=$key['id']?>"><?= $key['title'] ?></a>
            <p class="lead"><?= $key['text'] ?></p>
        </div>
        і
<!--  ADD PHOTO   -->
<!--                <div class="col-md-5">-->
<!--                    <svg class="bd-placeholder-img bd-placeholder-img-lg featurette-image img-fluid mx-auto" width="500"-->
<!--                         height="500" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: 500x500"-->
<!--                         preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title>-->
<!--                        <rect width="100%" height="100%" fill="#eee"/>-->
<!--                        <text x="50%" y="50%" fill="#aaa" dy=".3em">500x500</text>-->
<!--                    </svg>-->
<!--                </div>-->
        <hr class="featurette-divider">
        <?php endforeach; ?>