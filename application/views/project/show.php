<table>
<?php foreach ($project->tasks->find_all() as $task): ?>
    <tr><td><?php echo $task->content ?></td></tr>
<?php endforeach; ?>
</table>
