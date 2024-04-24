<?php

session_start(); 
session_unset(); 
session_destroy();

header ("Location: ../Website/Log_In.php"); 
die();