<?php // vim: set sw=4 ts=4 expandtab nu: 
/**
 * Query File
 *
 * PHP version 8.0
 *
 * @category IndexFile
 * @package  Query
 * @author   Adrian P. Ireland <procras2@gmail.com>
 * @license  http://gnu.org/licences/gpl-3.0 GPLv3
 * @link     http://localhost/~adrian/query
 */

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (isset($_POST['day'])) {
    // Connect to the data base and do the query
    // We will use mysqli
    $mysqli = new mysqli("localhost", "root", "Mysql", "clinical");

    // Check connct
    if ($mysqli->connect_errno) {
        echo "Failed to connect to MySQL: " . $mysqli->connect_error;
        exit();
    }

    $query = "
SELECT
    CONCAT(t2.`f_name`, ' ', t2.`l_name`) AS \"name\",
    t1.`number`,
    t1.`amount`
FROM
    `room_invoice` t1
LEFT JOIN
    `patient` t2 ON t1.`patient` = t2.`id`
WHERE
    t1.`billeddate` = \"{$_POST['day']}\"
";

    $headers = array();
    $headers [] = 'number';
    $headers [] = 'name';
    $headers [] = 'amount';

    $entries = array();
    if ($result = $mysqli->query($query)) {
        while ($row = mysqli_fetch_assoc($result)) {
            $entries[] = array(
                $row['number'],
                $row['name'],
                (double) $row['amount']
            );
        } 
        $response = array();
        $response['headers'] = $headers;
        $response['rows'] = $entries;
        echo json_encode($response);
    } else {
        echo 'mysqli->query is false, please try again<br>' . PHP_EOL;
    }

    // Free up the result resource
    $result->free_result();

    $mysqli->close();
} else {
    echo 'Only POST accepted';
}

