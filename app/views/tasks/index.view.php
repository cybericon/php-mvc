<?php include_once APP_DIR . "views/partials/header.php";?>


<h1>Welcome HomePage</h1>
<div class="row">
    <div class="col l10 offset-l1">
        <ul class="collection with-header">
            <li class="collection-header">
                <h4>
                <?php if (empty($tasks)): ?>
                    Add some tasks first
                <?php else: ?>
                    All Tasks
                <?php endif;?>
                </h4>
            </li>
            <?php foreach ($tasks as $task): ?>
            <li class="collection-item">
                <a href="task/<?=$task->id?>">
                <?php if ($task->completed): ?>
                    <i class="material-icons">done</i>
                    <del><?=$task->description?></del>
                <?php else: ?>
                    <?=$task->description?>
                <?php endif?>
                </a>

                <form action="/delete-task" method="POST" class="secondary-content">
                    <input type="hidden" name="id" value=<?=$task->id?> >
                    <button class='red btn btn-small' type='submit'><i class="material-icons">delete</i></button>
                </form>

                <form action="/update-task" method="POST" class="secondary-content">
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
                <p> <?=$task->details?></p>
            </li>
            <?php endforeach?>

        </ul>

        <form action="add-task" method="post">
            <div class="row">
                <div class="input-field col s8">
                    <i class="material-icons prefix">list</i>
                    <input id="description" type="text" name="description" class="validate">
                    <label for="description">Task Title</label>
                </div>

                <div class="input-field col s8">
                    <i class="material-icons prefix">list</i>
                    <textarea name="details" id="details" cols="30" rows="10" class="validate"></textarea>
                    <label for="description">Details</label>
                </div>

                <button class="btn waves-effect waves-light col s2 offset-s2" type="submit">Add Task
                    <i class="material-icons right">send</i>
                </button>
            </div>
        </form>
    </div>
</div>
<?php include_once APP_DIR . "views/partials/footer.php";
