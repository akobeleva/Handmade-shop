<?php
if (isset($message_error)): ?>
    <div style="color: red;" class="alert alert-danger"> <?php echo array_shift($message_error)?></div>
<?php endif;?>
<?php
if (isset($message_success)): ?>
    <div class="alert alert-success"> <?php echo array_shift($message_success)?></div>
<?php endif;?>
<form class="form-horizontal" action='/user/profile-settings' method="post">
    <fieldset>

        <!-- Username -->
        <label class="control-label"  for="username">Имя пользователя</label>
        <div class="controls">
            <input type="text" id="username" name="username" placeholder="" class="input-xlarge"
                   value="<?php if (isset($name)) echo $name?>">
            <p class="help-block">Введите имя пользователя</p>
        </div>

        <div class="control-group">
            <!-- Login -->
            <label class="control-label"  for="login">Login</label>
            <div class="controls">
                <input type="text" id="login" name="login" placeholder="" class="input-xlarge"
                       value="<?php if (isset($login)) echo $login?>">
                <p class="help-block">Введите Login</p>
            </div>
        </div>

        <div class="control-group">
            <!-- E-mail -->
            <label class="control-label" for="email">E-mail</label>
            <div class="controls">
                <input type="text" id="email" name="email" placeholder="" class="input-xlarge"
                       value="<?php if (isset($email)) echo $email?>">
                <p class="help-block">Введите свой E-mail</p>
            </div>
        </div>

        <div class="control-group">
            <!-- Button -->
            <div class="controls">
                <button class="btn btn-success">Сохранить изменения</button>
            </div>
        </div>
    </fieldset>
</form>