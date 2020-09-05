<h1>Add user</h1>

<?php $form = \app\core\form\Form::begin('/create', "post"); ?>
    <?php echo $form->field($model, 'first_name') ?>
    <?php echo $form->field($model, 'last_name') ?>
    <?php echo $form->field($model, 'phone_number') ?>
    <?php echo $form->field($model, 'address') ?>
    <button type="submit" class="btn btn-primary">Submit</button>
<?php \app\core\form\Form::end();?>
