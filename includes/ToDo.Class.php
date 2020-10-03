<?php
    //Creating ToDo Class
    Class ToDo {
        //Declare Constructor
        public function __construct($todo = "") {
            //Assign Todo
            $this->todo = $todo;

            //Store Todo
            $this->StoreToDo();
        }

        //Add Todo to $_SESSION
        public function StoreToDo() {
            //Initiate Session with New Todo
            $this->store_todo = new Session($this->todo);
        }

        public function Status() {
            //Check If Todo is Saved in $_SESSION via Session Class
            return (in_array($this->todo, $this->store_todo->AllActiveTodos()));
        }

        public function Response() {
            //Check If Todo is Saved in $_SESSION via Session Class
            if ($this->Status()) {
                $response_msg = "To-Do Added.";
            }
            else {
                $response_msg = "Error Adding To-Do.";
            }
            $this->response_msg = $response_msg;

            //Return Status Response Message
            return ($this->response_msg);
        }

        public function RenderResponse() {
            ?>
                <h3 class="response">
                    <?php echo $this->Response(); //Echo Status Response Message ?>
                </h3>
            <?php
        }

        public function RenderActiveTodos() {
            $active_todos = $this->store_todo->AllActiveTodos(); //Get All Active Todos
            $active_todos_reversed = array_reverse($active_todos); //Reverse Array for Ease of Reading
            foreach ($active_todos_reversed as $active_todo) {
                ?>
                    <li>
                        <?php echo $active_todo; //Print Out Todo in Li List ?>
                        <form method="POST" action="">
                            <input type="hidden" name="todo_id" value="<?php echo array_search($active_todo, $active_todos); //Position of Todo in Array ?>" />
                            <input type="hidden" name="type" value="active" />
                            <input type="submit" name="delete" value="Delete" />
                        </form>
                        <form method="POST" action="">
                            <input type="hidden" name="todo_id" value="<?php echo array_search($active_todo, $active_todos); //Position of Todo in Array ?>" />
                            <input type="hidden" name="type" value="complete" />
                            <input type="submit" name="complete" value="Complete" />
                        </form>
                    </li>
                <?php
            }
        }
    }
?>