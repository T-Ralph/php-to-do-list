<?php
    //Creating ToDo Class
    Class Session {
        //Declare Constructor
        public function __construct($todo = "") {
            //Assign todo
            $this->todo = $todo;

            //Setup $_SESSION for Storage
            $this->SetUp();

            //Check if $this->todo is not EMpty
            if (!empty($this->todo)) {
                $this->AddActiveTodo(); //Add Todo to Storage
            }
        }

        //Declare SetUp Function
        public function SetUp() {
            //Check If $_SESSION["todos_array"] is Empty, then, Set All The Needed Arrays
            if (empty($_SESSION["todos_array"])) {
                $_SESSION["todos_array"] = array();
                $_SESSION["todos_array"]["active"] = array();
                $_SESSION["todos_array"]["completed"] = array();
                $this->todos_array = array();
                $this->todos_array["active"] = array();
                $this->todos_array["completed"] = array();
            }

            //Initialize $this->todos_array
            $this->todos_array = $_SESSION["todos_array"];
        }

        public function AddActiveTodo() {
            //Add ToDo to $this->todos_array["active"]
            array_push($this->todos_array["active"], $this->todo);

            //Save Array to $_SESSION
            $this->SaveActiveTodo();
        }

        public function SaveActiveTodo() {
            //Add $this->todos_array to $_SESSION
            $_SESSION["todos_array"]["active"] = $this->todos_array["active"];
        }

        public function AllActiveTodos() {
            //Return All Todo Array in $this->todos_array
            return $this->todos_array["active"];
        }

        public function ClearTodos() {
            //Clear $this->todos_array and $_SESSION
            unset($this->todos_array["active"]);
            unset($_SESSION["todos_array"]["active"]);
            unset($this->todos_array["completed"]);
            unset($_SESSION["todos_array"]["completed"]);
            session_destroy();
        }

        public function DeleteActiveTodo($todo_id) {
            //Remove Todo from Array
            array_splice($this->todos_array["active"], $todo_id, 1);

            //Save Array to $_SESSION
            $this->SaveActiveTodo();
        }

        public function CompleteTodo($todo_id) {
            //Add Todo to Completed Todo
            $this->AddCompletedTodo($this->todos_array["active"][$todo_id]);

            //Remove Todo from Array
            $this->DeleteActiveTodo($todo_id);
        }

        public function AddCompletedTodo($todo) {
            //Add ToDo to $this->todos_array["completed"]
            array_push($this->todos_array["completed"], $todo);

            //Save Array to $_SESSION
            $this->SaveCompletedTodo();
        }

        public function SaveCompletedTodo() {
            //Add $this->todos_array to $_SESSION
            $_SESSION["todos_array"]["completed"] = $this->todos_array["completed"];
        }

        public function AllCompletedTodos() {
            //Return All Todo Array in $this->todos_array
            return $this->todos_array["completed"];
        }

        public function DeleteCompletedTodo($todo_id) {
            //Remove Todo from Array
            array_splice($this->todos_array["completed"], $todo_id, 1);

            //Save Array to $_SESSION
            $this->SaveCompletedTodo();
        }
    }
?>