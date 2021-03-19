<?php

if(isset($_POST['ajoutU']))
    {
        extract ($_POST);
        require_once '../model/crud/user/createUser.php';
    }