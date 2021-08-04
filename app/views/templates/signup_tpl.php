<?php
if (isset($message_error)): ?>
    <div style="color: red;" class="alert alert-danger"> <?php echo array_shift($message_error)?></div>
<?php endif;?>
<?php
if (isset($message_success)): ?>
    <div class="alert alert-success"> <?php echo array_shift($message_success)?></div>
<?php endif;?>
<form class="form-horizontal" action='/user/signup' method="post">
    <fieldset>
        <div class="control-group">
            <!-- Username -->
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
                <p class="help-block">Введите пароль (минимум 6 символов)</p>
            </div>
        </div>

        <div class="control-group">
            <!-- E-mail -->
            <label class="control-label" for="email">E-mail</label>
            <div class="controls">
                <input type="text" id="email" name="email" placeholder="" class="input-xlarge"
                       value="<?php if (isset($email) && isset($message_error)) echo $email?>">
                <p class="help-block">Введите свой E-mail</p>
            </div>
        </div>

        <!-- Username -->
        <label class="control-label"  for="username">Имя</label>
        <div class="controls">
            <input type="text" id="username" name="username" placeholder="" class="input-xlarge"
                   value="<?php if (isset($name) && isset($message_error)) echo $name?>">
            <p class="help-block">Введите имя пользователя</p>
        </div>

        <div class="control-group">
            <!-- Button -->
            <div class="controls">
                <button class="btn btn-success">Зарегистрироваться</button>
            </div>
        </div>
    </fieldset>
</form>