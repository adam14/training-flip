<?php
// App config
require __DIR__ .'/config.php';

// App functions
require __DIR__ .'/functions/database.php';

if (empty($_GET['disburse_id'])) {
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit;
}

$condition = [
    'disburse_id = '.$_GET['disburse_id'],
];
$detail_data = dbdetail('disburse', $condition);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Soal-Flip.id</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel="stylesheet" href="./assets/bootstrap/css/bootstrap.css">
</head>
<body>
    <div class="container-fluid">
        <div class="row bg-warning">
            <div class="col-lg-12">
                <p class="text-center" style="font-size: 25px;">Disburse - Flip.id</p>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="col-md-3">&nbsp;</div>
                <div class="col-md-6">
                    <div class="panel panel-info" style="margin-top: 30px;">
                        <div class="panel-heading">
                            Data Disburse
                        </div>
                        <div class="panel-body">
                            <table class="table table-striped">
                                <tr>
                                    <td>Disburse ID</td>
                                    <td><?php echo $detail_data['disburse_id']; ?></td>
                                </tr>
                                <tr>
                                    <td>Bank Code</td>
                                    <td><?php echo $detail_data['bank_code']; ?></td>
                                </tr>
                                <tr>
                                    <td>Account Number</td>
                                    <td><?php echo $detail_data['account_number']; ?></td>
                                </tr>
                                <tr>
                                    <td>Beneficiary Name</td>
                                    <td><?php echo $detail_data['beneficiary_name']; ?></td>
                                </tr>
                                <tr>
                                    <td>Remark</td>
                                    <td><?php echo $detail_data['remark']; ?></td>
                                </tr>
                                <tr>
                                    <td>Fee</td>
                                    <td>Rp. <?php echo $detail_data['fee']; ?></td>
                                </tr>
                                <tr>
                                    <td>Status</td>
                                    <td><?php echo $detail_data['status']; ?></td>
                                </tr>
                                <tr>
                                    <td>Time Served</td>
                                    <td><?php echo $detail_data['time_served']; ?></td>
                                </tr>
                                <tr>
                                    <td>Receipt</td>
                                    <td>
                                        <?php if (!empty($detail_data['receipt'])): ?>
                                            <img src="<?php echo $detail_data['receipt']; ?>" width="100px" height="100px">
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="panel-footer">
                            <a href="./" class="btn btn-sm btn-default">Back</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">&nbsp;</div>
            </div>
        </div>
    </div>
</body>
</html>