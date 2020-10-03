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
                <label>Enable Debugging
                    <input type="checkbox" name="debugging" id="debugging" value="true" />
                </label>
            </form>
            <?php
                //If To-Do Form is Submitted and $_POST["todo"] is not Empty
                if (isset($_POST) && !empty($_POST["todo"])):
                    $add_todo = new ToDo($_POST["todo"]); //Initiate new ToDo Class
                    $add_todo->RenderResponse(); //Render Response
                endif;
            ?>
            <h2>Clear To-Do</h2>
            <form method="POST" action="">
                <input type="submit" name="clear" value="Clear All To-Do">
                <label>Enable Debugging
                    <input type="checkbox" name="debugging" id="debugging" value="true" />
                </label>
            </form>
            <?php
                //If Clear Form is Submitted and $_POST["clear"] is not Empty
                if (isset($_POST) && !empty($_POST["clear"])):
                    $clear_todo = new Session(); //Initiate new Session Class
                    $clear_todo->ClearTodos(); //Run the ClearTodos() Method
                endif;
            ?>
        </section>
        <section>
            <h2>Active To-Do(s)</h2>
            <form>
                <ul>
                    <?php $all_active_todos = new ToDo(); //Initiate new Session Class ?>
                    <?php $all_active_todos->RenderActiveTodos(); ?>
                </ul>
            </form>
        </section>
        <section>
            <h2>Completed To-Do(s)</h2>
            <ul>
            </ul>
        </section>
        <?php if (isset($_POST["debugging"])) : //If $_POST["debugging"] is not Empty ?>
            <section>
                <h2>Debugging To-Do(s)</h2>
                <b>To-Do</b>
                <pre>
                    <?php var_dump($_POST["todo"]); ?>
                </pre>
                <b>SESSION</b>
                <pre>
                    <?php var_dump($_SESSION["todos_array"]); ?>
                </pre>
            </section>
        <?php endif; ?>
    </main>
<?php
    //Include END
    include_once dirname(__FILE__) . '/templates/footer.php';
?>