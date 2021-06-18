<?php
session_start();
echo "Logging out !! Please wait....";

session_unset();
header("location: /forums/index.php?logout=success");

?>