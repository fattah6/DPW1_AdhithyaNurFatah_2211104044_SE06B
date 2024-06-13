<?php
// logout.php

session_start(); // Start the session
session_unset(); // Unset all of the session variables
session_destroy(); // Destroy the session

// Redirect to the index page
header('Location: index.php');
exit();
