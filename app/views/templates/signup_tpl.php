<form class="form-horizontal" action='/user/signup' method="post">
    <fieldset>
        <div class="control-group">
            <!-- Username -->
            <label class="control-label"  for="login">Login</label>
            <div class="controls">
                <input type="text" id="login" name="login" placeholder="" class="input-xlarge">
                <p class="help-block">Введите Login</p>
            </div>
        </div>

        <div class="control-group">
            <!-- Password-->
            <label class="control-label" for="password">Пароль</label>
            <div class="controls">
                <input type="password" id="password" name="password" placeholder="" class="input-xlarge">
                <p class="help-block">Введите пароль (минимум 6 символов)</p>
            </div>
        </div>

        <div class="control-group">
            <!-- E-mail -->
            <label class="control-label" for="email">E-mail</label>
            <div class="controls">
                <input type="text" id="email" name="email" placeholder="" class="input-xlarge">
                <p class="help-block">Введите свой E-mail</p>
            </div>
        </div>

        <!-- Username -->
        <label class="control-label"  for="username">Имя</label>
        <div class="controls">
            <input type="text" id="username" name="username" placeholder="" class="input-xlarge">
            <p class="help-block">Введите имя пользователя</p>
        </div>
        </div>

        <div class="control-group">
            <!-- Button -->
            <div class="controls">
                <button class="btn btn-success">Зарегистрироваться</button>
            </div>
        </div>
    </fieldset>
</form>