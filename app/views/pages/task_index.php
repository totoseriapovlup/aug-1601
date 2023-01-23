<h2>All tasks</h2>
<a href="<?= url('task', 'create')?>">Create new task</a>
<table>
    <thead>
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php if(count($tasks)>0):?>
            <?php foreach ($tasks as $task):?>
            <tr>
                <td><?= $task['id']?></td>
                <td><?= $task['name']?></td>
                <td></td>
            </tr>
            <?php endforeach;?>
        <?php endif;?>
    </tbody>
</table>