<?php
// App config
require __DIR__ .'/config.php';

// App functions
require __DIR__ .'/functions/database.php';
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
                            Input Disburse
                        </div>
                        <form method="POST" action="./actions/save.php">
                            <div class="panel-body">
                                <div class="form-group">
                                    <label for="bank_code">Bank Code</label>
                                    <input type="text" class="form-control" id="bank_code" name="bank_code" placeholder="Bank Code">
                                </div>
                                <div class="form-group">
                                    <label for="account_number">Account Number</label>
                                    <input type="text" class="form-control" id="account_number" name="account_number" placeholder="Account Number">
                                </div>
                                <div class="form-group">
                                    <label for="amount">Amount</label>
                                    <input type="text" class="form-control" id="amount" name="amount" placeholder="Amount">
                                </div>
                                <div class="form-group">
                                    <label for="remark">Remark</label>
                                    <textarea class="form-control" id="remark" name="remark" placeholder="Remark"></textarea>
                                </div>
                            </div>
                            <div class="panel-footer">
                                <button class="btn btn-sm btn-success" type="submit">Process</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-md-3">&nbsp;</div>
            </div>
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Disburse ID</th>
                                <th>Bank Code</th>
                                <th>Account Number</th>
                                <th>Time Served</th>
                                <th>Receipt</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $disburse = dbget('disburse', [], []); ?>
                            <?php if ($disburse): ?>
                                <?php foreach ($disburse as $value): ?>
                                    <tr>
                                        <td><a href="./actions/update.php?disburse_id=<?php echo $value['disburse_id']; ?>" title="Click to Detail"><?php echo $value['disburse_id']; ?></a></td>
                                        <td><?php echo $value['bank_code']; ?></td>
                                        <td><?php echo $value['account_number']; ?></td>
                                        <td><?php echo $value['time_served']; ?></td>
                                        <td>  
                                            <?php if (!empty($value['receipt'])): ?>
                                                <img src="<?php echo $value['receipt']; ?>" width="100px" height="100px">
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <?php if ($value['status'] == 'PENDING'): ?>
                                                <span class="label label-warning"><?php echo $value['status']; ?></span>
                                            <?php elseif ($value['status'] == 'SUCCESS'): ?>
                                                <span class="label label-success"><?php echo $value['status']; ?></span>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="7" class="text-center">Data not found.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript" src="./assets/bootstrap/js/bootstrap.min.js"></script>
</body>
</html>