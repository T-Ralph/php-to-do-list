<?php
    //Include HTML HEAD
    include_once dirname(__FILE__) . '/templates/head.php';
?>
    <main>
        <h1>To-Do App</h1>
        <section>
            <h2>Add To-Do</h2>
            <form>
                <label for="todo">New To-Do</label>
                <input type="text" name="todo" id="todo" placeholder="New To-Do" required>
                <input type="submit" value="Add To-Do">
            </form>
        </section>
        <section>
            <h2>Active To-Do(s)</h2>
            <form>
                <ul>
                </ul>
            </form>
        </section>
        <section>
            <h2>Completed To-Do(s)</h2>
            <ul>
            </ul>
        </section>
        <section>
            <h2>Debugging To-Do(s)</h2>
            <ul>
            </ul>
        </section>
    </main>
<?php
    //Include END
    include_once dirname(__FILE__) . '/templates/footer.php';
?>