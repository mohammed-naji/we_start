<h1>{{ $abc }}</h1>
<h3>{{ $my_age }}</h3>

<table border="1">
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Email</th>
    </tr>
    <?php
    $i = 1;
    foreach($users as $user): ?>
    <tr <?php if($i%2==1){ ?> style="background: red" <?php } ?>>
        <td><?= $i ?></td>
        <td>ffff</td>
        <td>eeee</td>
    </tr>
    <?php
    $i++;
endforeach; ?>
</table>
