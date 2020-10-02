<?php
    //Creating ToDo Class
    Class Session {
        //Declare Constructor
        public function __construct($todo) {
            //Assign todo
            $this->todo = $todo;

            //Setup $_SESSION for Storage
            $this->SetUp();

            //Add Todo to Storage
            $this->AddTodo();
            $this->SaveTodo();
        }

        //Declare SetUp Function
        public function SetUp() {
            //Check If $_SESSION["todos_array"] is Empty to Set it as Array
            if (empty($_SESSION["todos_array"])) {
                $_SESSION["todos_array"] = array(); //Set $_SESSION["todos_array"]
            }

            //Initialize $this->todos_array
            $this->todos_array = $_SESSION["todos_array"];
        }

        public function AddTodo() {
            //Add ToDo to $this->todos_array
            array_push($this->todos_array, $this->todo);
        }

        public function SaveTodo() {
            //Add $this->todos_array to $_SESSION
            $_SESSION["todos_array"] = $this->todos_array;
        }

        public function AllTodos() {
            return $this->todos_array;
        }
    }
?>