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
    <div class="col-md-12">
      <h1 style="text-align: center;">Invoice</h1>
    </div>
  </div>
  <div class="row">
    <div class="col-md-3">
      <img src="<?php echo STATIC_ADMIN_IMAGE.$invoice[0]['image']?>" height="100px;">
    </div>
  </div>
  <div class="row">
    <div class="col-md-6">
      <h2>
        <?php echo $invoice[0]['org_name']; ?>
      </h2>
      <h5>
        <?php echo $invoice[0]['org_address']; ?><br>
        Ph: <?php echo $invoice[0]['org_phone']; ?>
      </h5>
    </div>
    <div class="col-md-6">
      <h5 class="display-5 text-break" style="text-align: right;">
        Invoice #<?php echo $invoice[0]['sale_invoice_id']; ?><br>
        Date <?php echo $invoice[0]['date']; ?><br>
        <b><?php echo $invoice[0]['pay_status']; ?></b>
      </h5>
    </div>
  </div>
  <div class="row">
    <div class="col-md-6">
      <h5 class="text-break" style="text-align: left;">
        <b>Name: </b><?php if (isset($invoice[0]['name'])) {
          echo $invoice[0]['name'];
        } else{
          echo "Walk-In Customer";
        } ?><br>
        <b>Address: </b><?php if (isset($invoice[0]['address'])) {
          echo $invoice[0]['address']; }?>
      </h5>
    </div>
    <div class="col-md-6">
      <h5>
        <b>Phone: </b><?php if (isset($invoice[0]['phone'])) {
          echo $invoice[0]['phone']; } ?>
      </h5>
    </div>
  </div>
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
      <td colspan="1" class="border1"> <?php echo $value['product_name'].' - '.$value['p_c_name'] ?><br><?php echo 'Gross Weight '.$value['gross']. ' - Bardana '.$value['product_bardana']. ' - Allowance '.$value['allowance'];?></td>
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
          <th class="border_bottom" colspan="100%"></th>
        </tr>
        <tr>
    <td colspan="2">&nbsp;</td>
    <td colspan="2" align="left" style="border: 1px solid black"><b>Sub Total: </b></td>
    <td colspan="1" align="right" style="border: 1px solid black">Rs.<?php echo $invoice[0]['total_payable']; ?></td>
  </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
    <td colspan="2" align="left" style="border: 1px solid black"><b>Discount: </b></td>
    <td colspan="1" align="right" style="border: 1px solid black">Rs.<?php echo $invoice[0]['discount']; ?></td>
  </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
    <td colspan="2" align="left" style="border: 1px solid black"><b>Total Amount: </b></td>
    <td colspan="1" align="right" style="border: 1px solid black">Rs.<?php echo $invoice[0]['grand_total']; ?></td>
  </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
    <td colspan="2" align="left" style="border: 1px solid black"><b>Previous Amount: </b></td>
    <td colspan="1" align="right" style="border: 1px solid black">Rs.<?php if (isset($invoice[0]['cust_remaining'])) {
          $cust_remaining = $invoice[0]['cust_remaining'];
          echo $cust_remaining;
        } else{
           $cust_remaining = 0;
          echo $cust_remaining;
        } ?></td>
  </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
    <td colspan="2" align="left" style="border: 1px solid black"><b>Total Paid: </b></td>
    <td colspan="1" align="right" style="border: 1px solid black">Rs.<?php echo $invoice[0]['cash_received']; ?></td>
  </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
    <td colspan="2" align="left" style="border: 1px solid black"><b>Still Outstanding: </b></td>
    <td colspan="1" align="right" style="border: 1px solid black">Rs.<?php echo $invoice[0]['cash_remaining']+$cust_remaining; ?></td>
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