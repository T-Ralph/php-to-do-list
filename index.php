<?php
    //Set Up Class AutoLoading
    spl_autoload_register(function ($class) {
        include_once dirname(__FILE__) . '/includes/' . $class . '.Class.php';
    });

    //Include HTML HEAD
    include_once dirname(__FILE__) . '/templates/head.php';
?>
    <main>
        <h1>To-Do App</h1>
        <section>
            <h2>Add To-Do</h2>
            <form method="POST" action="">
                <label for="todo">New To-Do</label>
                <input type="text" name="todo" id="todo" placeholder="New To-Do" required>
                <input type="submit" name="add" value="Add To-Do">
            </form>
            <?php
                //If To-Do Form is Submitted and $_POST["todo"] is not Empty
                if (isset($_POST) && !empty($_POST["todo"])) :
                    $add_todo = new ToDo($_POST["todo"]); //Initiate new ToDo Class
                    $add_todo->RenderResponse(); //Render Response
                endif;
            ?>
            <br /><br /><br />
            <h2>Clear To-Do</h2>
            <?php
                //If Clear Form is Submitted and $_POST["clear"] is not Empty
                if (isset($_POST) && !empty($_POST["clear"])) :
                    $clear_todo = new Session(); //Initiate new Session Class
                    $clear_todo->ClearTodos(); //Run the ClearTodos() Method
                endif;
            ?>
            <form method="POST" action="">
                <input type="submit" name="clear" value="Clear All To-Do">
            </form>
            <br /><br /><br />
            <h2>Debugging To-Do</h2>
            <button>
                <a href="?debugging=<?php echo (isset($_GET["debugging"]) && ($_GET["debugging"] == "true")) ? "false" : "true"; ?>">
                    <?php echo (isset($_GET["debugging"]) && ($_GET["debugging"] == "true")) ? "Disable" : "Enable" ?> Debugging
                </a>
            </button>
        </section>
        <section>
            <h2>Active To-Do(s)</h2>
            <?php
                //If To-Do Form is Submitted and $_POST["delete"] is not Empty
                if (isset($_POST) && !empty($_POST["delete"]) && $_POST["type"] == "active") :
                    $delete_active_todo = new Session(); //Initiate new Session Class
                    $delete_active_todo->DeleteActiveTodo($_POST["todo_id"]); //Delete Active Todo by todo_id
                endif;
            ?>
            <?php
                //If To-Do Form is Submitted and $_POST["delete"] is not Empty
                if (isset($_POST) && !empty($_POST["complete"]) && $_POST["type"] == "complete") :
                    $complete_todo = new Session(); //Initiate new Session Class
                    $complete_todo->CompleteTodo($_POST["todo_id"]); //Complete Active Todo by todo_id
                endif;
            ?>
            <ul>
                <?php $all_active_todos = new ToDo(); //Initiate new Session Class ?>
                <?php $all_active_todos->RenderActiveTodos(); ?>
            </ul>
        </section>
        <section>
            <h2>Completed To-Do(s)</h2>
            <?php
                //If To-Do Form is Submitted and $_POST["delete"] is not Empty
                if (isset($_POST) && !empty($_POST["delete"]) && $_POST["type"] == "completed") :
                    $delete_active_todo = new Session(); //Initiate new Session Class
                    $delete_active_todo->DeleteCompletedTodo($_POST["todo_id"]); //Delete Active Todo by todo_id
                endif;
            ?>
            <ul>
                <?php $all_completed_todos = new ToDo(); //Initiate new Session Class ?>
                <?php $all_completed_todos->RenderCompletedTodos(); ?>
            </ul>
        </section>
        <?php if (isset($_GET["debugging"]) && $_GET["debugging"] == "true") : //If $_GET["debugging"] is True ?>
            <section>
                <h2>Debugging To-Do(s)</h2>
                <b>To-Do</b>
                <pre>
                    <?php var_dump(isset($_POST["todo"]) ? $_POST["todo"] : NULL); ?>
                </pre>
                <b>SESSION</b>
                <pre>
                    <?php var_dump(isset($_SESSION["todos_array"]) ? $_SESSION["todos_array"] : NULL); ?>
                </pre>
            </section>
        <?php endif; ?>
    </main>
<?php
    //Include END
    include_once dirname(__FILE__) . '/templates/footer.php';
?>