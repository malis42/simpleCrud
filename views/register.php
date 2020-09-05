<h1>Create an account</h1>

<?php $form = \app\core\form\Form::begin('', "post"); ?>
    <?php echo $form->field($model, 'name') ?>
    <?php echo $form->field($model, 'email') ?>
    <?php echo $form->field($model, 'password')->passwordField() ?>
    <?php echo $form->field($model, 'passwordConfirm')->passwordField() ?>
    <button type="submit" class="btn btn-primary">Submit</button>
<?php \app\core\form\Form::end();?>

<!--<form action="" method="POST">-->
<!--    <div class="form-group">-->
<!--        <label>Name</label>-->
<!--        <input type="text" name="name" class="form-control">-->
<!--    </div>-->
<!--    <div class="form-group">-->
<!--        <label>Email</label>-->
<!--        <input type="text" name="email" class="form-control">-->
<!--    </div>-->
<!--    <div class="form-group">-->
<!--        <label>Password</label>-->
<!--        <input type="password" name="password" class="form-control">-->
<!--    </div>-->
<!--    <div class="form-group">-->
<!--        <label>Confirm password</label>-->
<!--        <input type="password" name="passwordConfirm" class="form-control">-->
<!--    </div>-->
<!--    <button type="submit" class="btn btn-primary">Submit</button>-->
<!--</form>-->