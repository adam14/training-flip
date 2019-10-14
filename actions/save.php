<?php
// App config
require '../config.php';

// App functions
require '../functions/database.php';

if (isset($_POST) && !empty($_POST)) {
    $post_flip = [
        'bank_code' => $_POST['bank_code'],
        'account_number' => $_POST['account_number'],
        'amount' => $_POST['amount'],
        'remark' => $_POST['remark']
    ];

    $result = insertflip($post_flip);
    $result = json_decode($result);

    $data = [];
    $data['disburse_id'] = $result->id;
    $data['amount'] = $result->amount;
    $data['status'] = $result->status;
    $data['time_served'] = $result->time_served;
    $data['bank_code'] = $result->bank_code;
    $data['account_number'] = $result->account_number;
    $data['beneficiary_name'] = $result->beneficiary_name;
    $data['remark'] = $result->remark;
    $data['receipt'] = $result->receipt;
    $data['fee'] = $result->fee;
    $data['created'] = date('Y-m-d H:i:s');
    $data['modified'] = date('Y-m-d H:i:s');

    $dbinsert = dbinsert('disburse', $data);

    if ($dbinsert) {
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit;
    }
} else {
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit;
}