<?php         $userId = $record['id']; ?>
<h3>Editing user #<?php echo $userId; ?></h3>

<table class="table">
    <thead class="thead-dark">
    <tr>
        <th scope="col">Id</th>
        <th scope="col">Name</th>
        <th scope="col">Adress</th>
        <th scope="col">Phone number</th>
    </tr>
    </thead>
    <tbody>
    <?php
        $fullName = $record['first_name'] . ' ' . $record['last_name'];

        echo '<tr><th scope="row">' . $userId . '</th>';
        echo '<td>' . $fullName . '</td>';
        echo '<td>' . $record['address'] . '</td>';
        echo '<td>' . $record['phone_number'] . '</td>';
    ?>
    </tbody>
</table>


<?php $form = \app\core\form\Form::begin('/userEdit/' . $userId , "post"); ?>
    <?php echo $form->field($model, 'first_name') ?>
    <?php echo $form->field($model, 'last_name') ?>
    <?php echo $form->field($model, 'phone_number') ?>
    <?php echo $form->field($model, 'address') ?>
<button type="submit" class="btn btn-primary">Submit</button>
<?php \app\core\form\Form::end();?>