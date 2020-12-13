
<div class="container col-6">
    <main class="form-signin">
            <div class="py-5 text-center">
                <h2>Зарегестрироваться</h2>
            </div>
            <div class="col-lg-8">
                <h4 class="mb-4">Чтобы комфортнее пользоваться ресурсом, вы можете зарегистрироваться</h4>
                <form class="needs-validation" action="sign/up" method="post" >
                    <div class="row g-3">
                        <div class="col-12">
                            <label for="login" class="form-label">Введите логин</label>
                            <input name="login" type="text" class="form-control" id="login" required>
                            <div class="invalid-feedback">
                                Введите Ваш логин.
                            </div>
                            <div class="col-12">
                                <label for="email" class="form-label">Введите Ваш email</label>
                                <input name="email" type="text" class="form-control" id="email" required>
                                <div class="invalid-feedback">
                                    Введите Ваш email.
                                </div>
                                <div class="col-sm-12">
                                    <label for="password" class="form-label">Введите пароль</label>
                                    <input name="password" type="text" class="form-control" id="password" required>
                                    <div class="invalid-feedback">
                                        Введите Ваш пароль.
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr class="my-4">
                        <button class="w-100 btn btn-primary btn-lg" type="submit">Зарегестрироваться</button>
                </form>
            </div>
</div>
</main>