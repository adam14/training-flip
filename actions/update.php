<?php
// App config
require '../config.php';

// App functions
require '../functions/database.php';

if (empty($_GET['disburse_id'])) {
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit;
}

$result = getdataflip($_GET['disburse_id']);
$result = json_decode($result);

$condition = [
    'disburse_id' => $_GET['disburse_id']
];

$data = [];
$data['status'] = $result->status;
$data['time_served'] = $result->time_served;
$data['receipt'] = $result->receipt;
$data['modified'] = date('Y-m-d H:i:s');

$dbupdate = dbupdate('disburse', $condition, $data);

if ($dbupdate) {
    header('Location: ../detail-disburse.php?disburse_id='.$_GET['disburse_id']);
    exit;
} else {
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit;
}