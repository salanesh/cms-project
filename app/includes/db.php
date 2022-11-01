<?php
// $db["db_host"] = "db";
// $db["db_user"] = "salanesh";
// $db["db_pass"] = "wakwak123";
// $db["db_name"] = "cms";
define("DB_HOST", "db");
define("DB_USER", "salanesh");
define("DB_PASS", "wakwak123");
define("DB_NAME", "cms");
// foreach ($db as $key => $value) {
//     define(strtoupper($key), $value);
// }
$connection = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
// if ($connection) {
//     echo "We are connected";
// }
