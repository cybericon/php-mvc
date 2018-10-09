<?php include_once APP_DIR . "views/partials/header.php";?>

<h1>Welcome HomePage</h1>

<ul class="collection with-header">
    <li class="collection-header">
        <h4>
        <?php if (empty($task)): ?>
            no task found
        <?php else: ?>
           <?=$task->description?>
        <?php endif;?>
        </h4>
    </li>
    <li class="collection-item">
        <p>
        <?=$task->details?>
        </p>
    </li>
</ul>

<div class="row">
    <form action="/update-task" method="POST" class="col s4">
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
            <button class='blue btn btn-small' type='submit'><i class="material-icons">edit</i></button>
        </label>
    </form>
    <form action="/delete-task" method="POST" class="col s1">
        <input type="hidden" name="id" value=<?=$task->id?> >
        <button class='red btn btn-small' type='submit'><i class="material-icons">delete</i></button>
    </form>
</div>
<p class="secondary-content"><a href="/tasks"> Show all tasks</a></p>



<?php include_once APP_DIR . "views/partials/footer.php";?>