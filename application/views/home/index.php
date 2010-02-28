<table>
<?php foreach ($tags as $tag): ?>
    <tr><td><a href="<?php echo url::site('tag/show/'.$tag->id) ?>"><?php echo $tag->name ?></a></td><td><?php echo $tag->tasks->count_all() ?></td></tr>
<?php endforeach ?>
</table>
