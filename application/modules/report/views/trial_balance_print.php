<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
<link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
<style type="text/css">
  @media print {
    html, body {
        font-family: 'Roboto', sans-serif;
    }
  }
  body {
    font-family: 'Roboto', sans-serif;
  }
  .border_bottom {
    border-bottom: 2px solid black;
  }
  .border1 {
    border-left:1px solid black;
    border-top:1px solid black;
    padding: 10px;
  }
</style>
<body class="container pt-5">
    <div class="row">
    <div class="col-md-3">
      <img src="<?php echo STATIC_ADMIN_IMAGE.'logo.png'?>" height="100px;">
    </div>
    <div class="col-md-9">
      <h1 style="text-align: center;">
      <?php echo $org[0]['org_name'];?>
      </h1>
      <h5 class="display-5 text-break" style="text-align: center;">
        <?php echo $org[0]['org_address']; ?>
        &nbsp;Ph: <?php echo $org[0]['org_phone']; ?><br>
        Trial Balance for the period
      </h5>
    </div>
  </div>
  <div class="row">&nbsp;</div>
  <div class="row">&nbsp;</div>
  <div class="row">
    <div class="col-md-9">
      <h4>
      </h4>
    </div>
    <div class="col-md-3">
      <h5>
        From Date : <?=$from_date?><br>
        Upto Date : <?=$to_date?>
      </h5>
    </div>
  </div>
  <div class="row">&nbsp;</div>
  <p class="border_bottom"></p>
  <div class="row">
    <div class="col-md-6"><b>Account Title</b></div>
    <div class="col-md-3"><b>Debit</b></div>
    <div class="col-md-3"><b>Credit</b></div>
  </div>
  <p class="border_bottom"></p>
  <?php if (isset($cid) && !empty($cid)) { 
    $cidtotal = $cid[0]['opening_balance'];
    ?>
    <div class="row">
      <div class="col-md-6">Cash</div>
      <div class="col-md-3"><?=$cidtotal.' -PKR'?></div>
      <div class="col-md-3">0</div>
    </div>
    <p class="border_bottom"></p>
  <?php } ?>
  <?php if (isset($customer) && !empty($customer)) {
    $custotal = 0;
    foreach ($customer as $key => $value) {
      $custotal = $custotal + $value['remaining'];
    }
    ?>
    <div class="row">
      <div class="col-md-6">Account Receivable</div>
      <div class="col-md-3"><?=$custotal.' -PKR'?></div>
      <div class="col-md-3">0</div>
    </div>
    <p class="border_bottom"></p>
  <?php } ?>
  <?php if (isset($supplier) && !empty($supplier)) {
    $suptotal = 0;
    foreach ($supplier as $key => $value) {
      $suptotal = $suptotal + $value['remaining'];
    }
    ?>
    <div class="row">
      <div class="col-md-6">Account Payable</div>
      <div class="col-md-3">0</div>
      <div class="col-md-3"><?=$suptotal.' -PKR'?></div>
    </div>
    <p class="border_bottom"></p>
  <?php } ?>
  <?php if (isset($expense) && !empty($expense)) {
    $exptotal = 0;
    foreach ($expense as $key => $value) {
      $exptotal = $exptotal + $value['amount'];
    }
    ?>
    <div class="row">
      <div class="col-md-6">Extra Expense</div>
      <div class="col-md-3"><?=$exptotal.' -PKR'?></div>
      <div class="col-md-3">0</div>
    </div>
    <p class="border_bottom"></p>
  <?php } ?>
  <?php if (isset($account_expense) && !empty($account_expense)) {
    $accexptotal = 0;
    foreach ($account_expense as $key => $value) {
      $accexptotal = $accexptotal + $value['remaining'];
    }
    ?>
    <div class="row">
      <div class="col-md-6">Expense</div>
      <div class="col-md-3"><?=$accexptotal.' -PKR'?></div>
      <div class="col-md-3">0</div>
    </div>
    <p class="border_bottom"></p>
  <?php } ?>
  <?php if (isset($salary) && !empty($salary)) {
    $saltotal = 0;
    foreach ($salary as $key => $value) {
      $saltotal = $saltotal + $value['remaining'];
    }
    ?>
    <div class="row">
      <div class="col-md-6">Salary Expense</div>
      <div class="col-md-3"><?=$saltotal.' -PKR'?></div>
      <div class="col-md-3">0</div>
    </div>
    <p class="border_bottom"></p>
  <?php } ?>

  <?php if (isset($loan) && !empty($loan)) {
    $loantotal = 0;
    foreach ($loan as $key => $value) {
      $loantotal = $loantotal + $value['opening_balance'];
    }
    ?>
    <div class="row">
      <div class="col-md-6">Loan Bank</div>
      <div class="col-md-3">0</div>
      <div class="col-md-3"><?=$loantotal.' -PKR'?></div>
    </div>
    <p class="border_bottom"></p>
  <?php } ?>











  <div class="row">
      <div class="col-md-6"><p style="float: right;"><b>Total</b></p></div>
      <div class="col-md-3"><p><b><? echo $custotal+$exptotal+$cidtotal+$accexptotal+$saltotal.' -PKR'?></b></p></div>
      <div class="col-md-3"><p><b><? echo $suptotal+$loantotal.' -PKR'?></b></p></div>
    </div>
    <p class="border_bottom"></p>

  <div class="row mt-5 pt-5">
    <div class="col-md-9"></div>
    <div class="col-md-3">
      <h5 style="text-align: center; border-top:1px dashed black">Signature</h5>
    </div>
  </div>
<div>
<b> Powered by XpertSpot +92-300-2660908</b>
<p style="page-break-after: always"> </p>
</div>
</body>
<script type="text/javascript">
window.print();
</script>