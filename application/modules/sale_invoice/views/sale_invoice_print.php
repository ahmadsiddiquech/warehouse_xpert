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
  }
</style>
<body class="container pt-5">
    <div class="row">
    <div class="col-md-3">
      <img src="<?php echo STATIC_ADMIN_IMAGE.$invoice[0]['image']?>" height="100px;">
    </div>
    <div class="col-md-6 ">
      <h1 style="text-align: center;">
      <?php echo $invoice[0]['org_name']; ?>
      </h1>
      <h5 class="display-5 text-break" style="text-align: center;">
        <?php echo $invoice[0]['org_address']; ?><br>
        Ph: <?php echo $invoice[0]['org_phone']; ?>
      </h5>
    </div>
    <div class="col-md-3">
      <h2 style="text-align: right;">
      Invoice
      </h2>
      <h5 class="display-5 text-break" style="text-align: right;">
        Invoice #<?php echo $invoice[0]['sale_invoice_id']; ?><br>
        Date <?php echo $invoice[0]['date']; ?><br>
        <b><?php echo $invoice[0]['pay_status']; ?></b>
      </h5>
    </div>
  </div>
  <div class="row">&nbsp;</div>
  <div class="row">&nbsp;</div>
  <p class="border_bottom"></p>
  <div class="row pl-3 pr-3">
    <div class="col-md-5" style="border: 1px solid black;">
      <h2 style="text-align: left;">
      Invoice From
      </h2>
      <h5 class="display-5 text-break" style="text-align: left;">
        <?php echo $invoice[0]['org_name']; ?><br>
        <?php echo $invoice[0]['org_address']; ?><br>
        <?php echo $invoice[0]['org_phone']; ?><br>
      </h5>
    </div>
    <div class="col-md-2"></div>
    <div class="col-md-5" style="border: 1px solid black;">
      <h2 style="text-align: left;">
      Invoice To
      </h2>
      <h5 class="display-5 text-break" style="text-align: left;">
        <?php if (isset($invoice[0]['name'])) {
          echo $invoice[0]['name'];
        } else{
          echo "Walk-In Customer";
        } ?><br>
        <?php if (isset($invoice[0]['address'])) {
          echo $invoice[0]['address'];
        } ?><br>
        <?php if (isset($invoice[0]['phone'])) {
          echo $invoice[0]['phone'];
        } ?><br>
      </h5>
    </div>
  </div>
  <div class="row">&nbsp;</div>
  <div class="row">&nbsp;</div>
  <div class="row">&nbsp;</div>
  <div class="row">
    <div class="col-md-4">
      <b>Vehicle No: <?=$invoice[0]['vehicle_no']?></b>
    </div>
    <div class="col-md-4">
      <b>Gate Pass No: <?=$invoice[0]['gate_pass_no']?></b> 
    </div>
    <div class="col-md-4">
      <b>Total Bags: <?=$invoice[0]['bags']?></b>
    </div>
  </div>
  <hr>
<table width="100%">
  <thead align="center">
    <th colspan="1" class="border1">Item Code</th>
    <th colspan="1" class="border1">Description</th>
    <th colspan="1" class="border1">Unit Price</th>
    <th colspan="1" class="border1">Net Weight</th>
    <th colspan="1" class="border1" style="border-right: 1px solid black">Amount</th>
  </thead>
  <tbody>
  <?php foreach ($invoice as $key => $value) { ?>
    <tr style="text-align: center;">
      <td colspan="1" class="border1"> <?php echo 'PR -'.$value['product_id'];?></td>
      <td colspan="1" class="border1"> <?php echo $value['product_name'].' - '.$value['p_c_name'] ?><br><?php echo 'Gross Weight '.$value['gross']. ' - Bardana '.$value['bardana']. ' - Allowance '.$value['allowance'];?></td>
      <td colspan="1" class="border1"> <?php echo $value['sale_price'];?></td>
      <td colspan="1" class="border1"> <?php echo $value['qty'];?></td>
      <td colspan="1" class="border1" style="border-right: 1px solid black"> <?php echo $value['amount'];?></td>
    </tr>
  <?php  }  ?>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2" style="border-left: 1px solid black;border-top: 1px solid black;border-right: 1px solid black"><b>Add Expense</b></td>
    <td>&nbsp;</td>
    <td colspan="2" style="border-left: 1px solid black;border-top: 1px solid black;border-right: 1px solid black"><b>Less Expense</b></td>
  </tr>
        <tr>
          <?php  if(isset($invoice[0]['commission']) && !empty($invoice[0]['commission'])){?>
          <td colspan="1" align="center" style="border-left: 1px solid black;">Commission: Rs.<?php echo $invoice[0]['commission']; ?></td>
          <?php }?>
          <?php  if(isset($invoice[0]['soothly']) && !empty($invoice[0]['soothly'])){?>
          <td colspan="1" align="center" style="border-right: 1px solid black;">Soothly: Rs.<?php echo $invoice[0]['soothly']; ?></td>
          <?php }?>
          <?php  if(isset($invoice[0]['commission_less']) && !empty($invoice[0]['commission_less'])){?>
            <td>&nbsp;</td>
          <td colspan="1" align="center" style="border-left: 1px solid black;">Commission: Rs.<?php echo $invoice[0]['commission_less'];?></td>
          <?php }?>
          <?php  if(isset($invoice[0]['soothly_less']) && !empty($invoice[0]['soothly_less'])){?>
          <td colspan="1" align="center" style="border-right: 1px solid black;">Soothly: Rs.<?php echo $invoice[0]['soothly_less']; ?></td>
          <?php }?>
        </tr>
        <tr>
          <?php  if(isset($invoice[0]['labour']) && !empty($invoice[0]['labour'])){?>
          <td colspan="1" align="center" style="border-left: 1px solid black;">Labour: Rs.<?php echo $invoice[0]['labour']; ?></td>
          <?php }?>
          <?php  if(isset($invoice[0]['bardana']) && !empty($invoice[0]['bardana'])){?>
          <td colspan="1" align="center" style="border-right: 1px solid black;">Bardana: Rs.<?php echo $invoice[0]['bardana']; ?></td>
          <?php }?>
          <?php  if(isset($invoice[0]['labour_less']) && !empty($invoice[0]['labour_less'])){?>
          <td>&nbsp;</td>
          <td colspan="1" align="center" style="border-left: 1px solid black;">Labour: Rs.<?php echo $invoice[0]['labour_less']; ?></td>
          <?php }?>
          <?php  if(isset($invoice[0]['bardana_less']) && !empty($invoice[0]['bardana_less'])){?>
          <td colspan="1" align="center" style="border-right: 1px solid black;">Bardana: Rs.<?php echo $invoice[0]['bardana_less']; ?></td>
          <?php }?>
        </tr>
        <tr>
          <?php  if(isset($invoice[0]['brokerage']) && !empty($invoice[0]['brokerage'])){?>
          <td colspan="1" align="center" style="border-left: 1px solid black;">Brokerage: Rs.<?php echo $invoice[0]['brokerage']; ?></td>
          <?php }?>
          <?php  if(isset($invoice[0]['freight']) && !empty($invoice[0]['freight'])){?>
          <td colspan="1" align="center" style="border-right: 1px solid black;">Freight: Rs.<?php echo $invoice[0]['freight']; ?></td>
          <?php }?>
          <?php  if(isset($invoice[0]['brokerage_less']) && !empty($invoice[0]['brokerage_less'])){?>
          <td>&nbsp;</td>
          <td colspan="1" align="center" style="border-left: 1px solid black;">Brokerage: Rs.<?php echo $invoice[0]['brokerage_less']; ?></td>
          <?php }?>
          <?php  if(isset($invoice[0]['freight_less']) && !empty($invoice[0]['freight_less'])){?>
          <td colspan="1" align="center" style="border-right: 1px solid black;">Freight: Rs.<?php echo $invoice[0]['freight_less']; ?></td>
          <?php }?>
        </tr>
        <tr>
          <?php  if(isset($invoice[0]['loading']) && !empty($invoice[0]['loading'])){?>
          <td colspan="1" align="center" style="border-left: 1px solid black;">Loading: Rs.<?php echo $invoice[0]['loading']; ?></td>
          <?php }?>
          <?php  if(isset($invoice[0]['dami']) && !empty($invoice[0]['dami'])){?>
          <td colspan="1" align="center" style="border-right: 1px solid black;">Dami: Rs.<?php echo $invoice[0]['dami']; ?></td>
          <?php }?>
          <?php  if(isset($invoice[0]['loading_less']) && !empty($invoice[0]['loading_less'])){?>
          <td>&nbsp;</td>
          <td colspan="1" align="center" style="border-left: 1px solid black;">Loading: Rs.<?php echo $invoice[0]['loading_less']; ?></td>
          <?php }?>
          <?php  if(isset($invoice[0]['dami_less']) && !empty($invoice[0]['dami_less'])){?>
          <td colspan="1" align="center" style="border-right: 1px solid black;">Dami: Rs.<?php echo $invoice[0]['dami_less']; ?></td>
          <?php }?>
        </tr>
        <tr>
          <?php  if(isset($invoice[0]['market_fees']) && !empty($invoice[0]['market_fees'])){?>
          <td colspan="1" align="center" style="border-left: 1px solid black;border-bottom: 1px solid black">Market Fees: Rs.<?php echo $invoice[0]['market_fees']; ?></td>
          <?php }?>
          <?php  if(isset($invoice[0]['other_expense']) && !empty($invoice[0]['other_expense'])){?>
          <td colspan="1" align="center" style="border-right: 1px solid black;border-bottom: 1px solid black">Other Expense: Rs.<?php echo $invoice[0]['other_expense']; ?></td>
          <?php }?>
          <?php  if(isset($invoice[0]['market_fees_less']) && !empty($invoice[0]['market_fees_less'])){?>
          <td>&nbsp;</td>
          <td colspan="1" align="center" style="border-left: 1px solid black;border-bottom: 1px solid black">Market Fees: Rs.<?php echo $invoice[0]['market_fees_less']; ?></td>
          <?php }?>
          <?php  if(isset($invoice[0]['other_expense_less']) && !empty($invoice[0]['other_expense_less'])){?>
          <td colspan="1" align="center" style="border-right: 1px solid black;border-bottom: 1px solid black">Other Expense: Rs.<?php echo $invoice[0]['other_expense_less']; ?></td>
          <?php }?>
        </tr>
        <tr>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <th class="border_bottom" colspan="100%"></th>
        </tr>
        <tr>
          <td colspan="4" align="right"><b>Total Amount: </b></td>
          <td colspan="1" align="right"><b>Rs.<?php echo $invoice[0]['total_payable']; ?></b></td>
        </tr>
        <tr>
          <td colspan="4" align="right"><b>Discount: </b></td>
          <td colspan="1" align="right"><b>Rs.<?php echo $invoice[0]['discount']; ?></b></td>
        </tr>
        <tr>
          <td colspan="4" align="right"><b><h3>Grand Total: </h3></b></td>
          <td colspan="1" align="right"><b><h3>Rs.<?php echo $invoice[0]['grand_total']; ?></h3></b></td>
        </tr>
        <tr>
          <td colspan="4" align="right"><b>Cash Recieved: </b></td>
          <td colspan="1" align="right"><b>Rs.<?php echo $invoice[0]['cash_received']; ?></b></td>
        </tr>
        <tr>
          <td colspan="4" align="right"><b>Change: </b></td>
          <td colspan="1" align="right"><b>Rs.<?php echo $invoice[0]['change']; ?></b></td>
        </tr>
        <tr>
          <td colspan="4" align="right"><b><h3>Remaining: </h3></b></td>
          <td colspan="1" align="right"><b><h3>Rs.<?php echo $invoice[0]['cash_remaining']; ?></h3></b></td>
        </tr>
        <tr>
          <th class="border_bottom" colspan="100%"></th>
        </tr>
        <tr>
          <td colspan="4" align="right"><b><h3>Total Due Balance: </h3></b></td>
          <td colspan="1" align="right"><b><h3>Rs.<?php echo $invoice[0]['remaining']; ?></h3></b></td>
        </tr>
  </tbody>
</table>
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