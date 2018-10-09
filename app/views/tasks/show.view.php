<?php include_once APP_DIR . "views/partials/header.php";?>

<h1>Welcome HomePage</h1>

<ul class="collection with-header">
<form action="/update-task" method="POST">
    <li class="collection-header">
        <h4>
        <?php if (empty($task)): ?>
            no task found
        <?php else: ?>
        <input type="text" name="description" value = "<?=$task->description?>" >
        <?php endif;?>
        </h4>
    </li>
    <li class="collection-item">
        <p>
        <textarea name="details" cols="30" rows="10"><?=$task->details?></textarea>
        </p>
    </li>
</ul>

        <input type="hidden" name="id" value ="<?=$task->id?>" >
        <label>
            <input class="with-gap" name="completed" type="radio" value="0" <?php echo $task->completed == 0 ? 'checked' : ''; ?> >
            <span>Incomplete</span>
        </label>
        <label>
            <input class="with-gap" name="completed" type="radio" value="1" <?php echo $task->completed == 0 ? '' : 'checked'; ?> >
            <span>completed</span>
        </label>
        <label>
            <button class='blue btn btn-medium with-gap' type='submit'><i class="material-icons left">edit</i>Update Task</button>
        </label>
    </form>
    <p>
    <form action="/delete-task" method="POST" class="col s1">
        <input type="hidden" name="id" value=<?=$task->id?> >
        <button class='red btn btn-medium with-gap' type='submit'><i class="material-icons left">delete</i>Remove Task</button>
    </form>
    </p>
<p class="secondary-content"><a href="/tasks"> Show all tasks</a></p>



<?php include_once APP_DIR . "views/partials/footer.php";?>