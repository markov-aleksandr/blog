<div class="container">
    <main>
        <div class="create">
            <div class="py-5 text-center">
                <h2>Добавить статью</h2>
            </div>
            <div class="row g-3">
                <div class="col-md-5 col-lg-4 order-md-last">
                    <h4 class="d-flex justify-content-between align-items-center mb-3">
                        <span class="text-muted">Ваши статьи</span>
                        <span class="badge bg-secondary rounded-pill count"><?= $data[0]["COUNT(*)"] ?></span>
                    </h4>
<!--       блок статей             -->
                </div>
                <div class="col-md-7 col-lg-8">
                    <h4 class="mb-3">Заполните поля ниже чтобы добавить статью</h4>
                    <form class="needs-validation" novalidate>
                        <div class="row g-3">
                            <div class="col-sm-12">
                                <label for="title" class="form-label">Название статьи</label>
                                <input name="title" type="text" class="form-control title" required>
                                <div class="col-12">
                                    <label for="article" class="form-label">Текст статьи</label>
                                    <textarea name="text" class="form-control text" placeholder="Текст статьи..."
                                              required></textarea>
                                </div>
                            </div>
                        </div>
                        <hr class="my-4">
                        <button class="w-100 btn btn-primary btn-lg submit" type="submit">Добавить статью</button>
                    </form>
                </div>
            </div>
    </main>
