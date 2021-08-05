<?php
if (isset($message_error)): ?>
    <div style="color: red;" class="alert alert-danger"> <?php echo array_shift($message_error)?></div>
<?php endif;?>

<form class="form-horizontal" action='/user/login' method="post">
    <fieldset>
        <div class="control-group">
            <!-- Login -->
            <label class="control-label"  for="login">Login</label>
            <div class="controls">
                <input type="text" id="login" name="login" placeholder="" class="input-xlarge"
                       value="<?php if (isset($login) && isset($message_error)) echo $login?>">
                <p class="help-block">Введите Login</p>
            </div>
        </div>

        <div class="control-group">
            <!-- Password-->
            <label class="control-label" for="password">Пароль</label>
            <div class="controls">
                <input type="password" id="password" name="password" placeholder="" class="input-xlarge"
                       value="<?php if (isset($password) && isset($message_error)) echo $password?>">
                <p class="help-block">Введите пароль</p>
            </div>
        </div>

        <div class="control-group">
            <!-- Button -->
            <div class="controls">
                <button class="btn btn-success">Войти</button>
            </div>
        </div>
    </fieldset>
</form>