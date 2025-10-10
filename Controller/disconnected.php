<?php
require_once 'cookie_param.php';
session_start();
session_destroy();
header("Location: ../index.php");