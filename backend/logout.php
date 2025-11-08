<?php
header("Content-Type: application/json");

require 'session.php';

destroySession();
echo json_encode(["status" => "success"]);
