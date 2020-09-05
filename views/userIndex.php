<h1> Welcome</h1>

<a href="/create" class="btn btn-success mb-2">Create new user</a>


<table class="table">
    <thead class="thead-dark">
    <tr>
        <th scope="col">Id</th>
        <th scope="col">Name</th>
        <th scope="col">Adress</th>
        <th scope="col">Phone number</th>
        <th scope="col">Actions</th>
    </tr>
    </thead>
    <tbody>
    <?php
    foreach($data as $record){
        $userId = $record['id'];
        $fullName = $record['first_name'] . ' ' . $record['last_name'];

        echo '<tr><th scope="row">' . $userId . '</th>';
        echo '<td>' . $fullName . '</td>';
        echo '<td>' . $record['address'] . '</td>';
        echo '<td>' . $record['phone_number'] . '</td>';

        echo '<td><a href="userEdit/' . $userId . '" class="btn btn-primary">Edit</a>';
        echo '<form action="userDelete/' . $userId . '" method="POST" style="display: inline-block;"><button type="submit" class="btn btn-danger">Delete</button></form>';
    }
    ?>
    </tbody>
</table>
