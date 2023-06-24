<?php
session_destroy();
header("Location:".web::$domain);
?>