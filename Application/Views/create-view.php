<div class="container">
    <main>
        <form action="/article/create" method="post" class="needs-validation" novalidate>
            <div class="py-5 text-center">
                <h2>Добавить статью</h2>
            </div>
            <div class="row g-3">
                <div class="col-md-5 col-lg-4 order-md-last">
                    <h4 class="d-flex justify-content-between align-items-center mb-3">
                        <span class="text-muted">Ваши статьи</span>
                        <span class="badge bg-secondary rounded-pill"><?=$_SESSION['userId']?></span>
                    </h4>
                    <div class="article"></div>
                    <div class="article"></div>
                    <div class="article"></div>
                    <div class="article"></div>
                    <div class="article"></div>
                    <div class="article"></div>

                </div>
                <div class="col-md-7 col-lg-8">
                    <h4 class="mb-3">Заполните поля ниже чтобы добавить статью</h4>
                    <form class="needs-validation" novalidate>
                        <div class="row g-3">
                            <div class="col-sm-12">
                                <label for="title" class="form-label">Название статьи</label>
                                <input name="title" type="text" class="form-control" id="title" required>
                                <div class="invalid-feedback">
                                    Введите текст заголовка
                                </div>
                                <div class="col-12">
                                    <label for="article" class="form-label">Текст статьи</label>
                                    <textarea  name="article" class="form-control" placeholder="Текст статьи..." id="article"
                                              required></textarea>
                                    <div class="invalid-feedback">
                                        Введите текст статьи
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr class="my-4">
                        <button class="w-100 btn btn-primary btn-lg" type="submit">Добавить статью</button>
                    </form>
                </div>
            </div>
    </main>`