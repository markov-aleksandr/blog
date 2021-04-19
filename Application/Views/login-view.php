<div class="col-lg-4 container ">
    <div class="py-5 text-center">
        <h2>Войти</h2>
    </div>
    <h4 class="mb-4 text-center">Добро пожаловать:)</h4>
    <form class="needs-validation" action="/user/authorize" method="post">
        <div class="col-12">
            <label for="login" class="form-label">Введите email</label>
            <input name="email" type="text" class="form-control" id="email" required>
            <div class="invalid-feedback">
                Введите Ваш логин.
            </div>
            <div class="col-12">
                <div class="col-sm-12">
                    <label for="password" class="form-label">Введите пароль</label>
                    <input name="password" type="password" class="form-control" id="password" required>
                    <div class="invalid-feedback">
                        Введите Ваш пароль.
                    </div>
                </div>
            </div>
        </div>
        <hr class="my-4">
        <button class="w-100 btn btn-primary btn-lg" type="submit">Войти</button>
    </form>
</div>