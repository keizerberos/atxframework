<?php

class Tableset extends ACCESS
{

    function __construct()
    {
        parent::ACCESS($_SESSION['db_default']);
    }
}
?>