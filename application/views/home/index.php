<table>
<?php foreach ($projects as $project): ?>
    <tr><td><a href="<?php echo url::site('project/show/'.$project->id) ?>"><?php echo $project->name ?></a></td><td><?php echo $project->tasks->count_all() ?></td></tr>
<?php endforeach ?>
</table>
