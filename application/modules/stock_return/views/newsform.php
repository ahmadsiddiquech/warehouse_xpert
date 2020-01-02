<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.jquery.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.min.css">
<style type="text/css">
  th, td, tr {
    border-collapse: collapse;
    border: 1px solid black;
    text-align: center;
  }
select:invalid {
  height: 0px !important;
  opacity: 0 !important;
  position: absolute !important;
  display: flex !important;
}
  
</style>

<div class="page-content-wrapper">
  <div class="page-content"> 
    <div class="content-wrapper">
        <!-- BEGIN PAGE TITLE & BREADCRUMB-->
      <h3>
        <?php 
        if (empty($update_id)) 
                    $strTitle = 'Add Stock Return invoice';
                else 
                    $strTitle = 'Edit Stock Return invoice';
                    echo $strTitle;
                    ?>
                    <a href="<?php echo ADMIN_BASE_URL . 'stock_return/manage'; ?>"><button type="button" class="btn btn-lg btn-primary pull-right"><i class="fa fa-chevron-left"></i>&nbsp;&nbsp;&nbsp;<b>View Stock Return Invoice</b></button></a>
       </h3>             
            
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="tabbable tabbable-custom boxless">
          <div class="tab-content">
          <div class="panel panel-default" style="margin-top:-30px;">
         
            <div class="tab-pane  active" >
              <div class="portlet box green ">
                
                <div class="portlet-body form " style="padding-top:15px;"> 
                  
                  <!-- BEGIN FORM-->
                        <?php
                        $attributes = array('autocomplete' => 'off', 'id' => 'form_sample_1', 'class' => 'form-horizontal');
                        if (empty($update_id)) {
                            $update_id = 0;
                        } else {
                            
                        }
                        if (isset($hidden) && !empty($hidden))
                            echo form_open_multipart(ADMIN_BASE_URL . 'stock_return/submit/' . $update_id, $attributes, $hidden);
                        else
                            echo form_open_multipart(ADMIN_BASE_URL . 'stock_return/submit/' . $update_id, $attributes);
                        ?>
                  <div class="form-body">

                    <div class="row" style="margin-top:15px;">
                      <div class="col-sm-5">
                        <div class="form-group">
                          <?php
                              $data = array(
                              'name' => 'date',
                              'id' => 'date',
                              'class' => 'form-control',
                              'type' => 'date',
                              'tabindex' => '1',
                              'value' => date('Y-m-d'),
                              'data-parsley-maxlength'=>TEXT_BOX_RANGE
                              );
                              $attribute = array('class' => 'control-label col-md-4');
                              ?>
                          <?php echo form_label('Date', 'date', $attribute); ?>
                          <div class="col-md-8"> <?php echo form_input($data); ?></div>
                        </div>
                      </div>
                      <div class="col-sm-5">
                        <div class="form-group">
                          <?php
                              $data = array(
                              'name' => 'ref_no',
                              'id' => 'ref_no',
                              'class' => 'form-control',
                              'type' => 'ref_no',
                              'tabindex' => '2',
                              'data-parsley-maxlength'=>TEXT_BOX_RANGE
                              );
                              $attribute = array('class' => 'control-label col-md-4');
                              ?>
                          <?php echo form_label('Reference No', 'ref_no', $attribute); ?>
                          <div class="col-md-8"> <?php echo form_input($data); ?></div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-sm-5">
                        <div class="form-group">
                          <?php
                                        $data = array(
                                        'name' => 'return_type',
                                        'id' => 'return_type',
                                        'class' => 'form-control',
                                        'type' => 'text',
                                        'tabindex' => '3',
                                        'value' => $news['return_type'],
                                        );
                                        $attribute = array('class' => 'control-label col-md-4');
                                        ?>
                          <?php echo form_label('Returnee <span style="color:red">*</span>', 'return_type', $attribute); ?>
                          <div class="col-md-8"> 
                            <select name="return_type" id="return_type" required="required" class="form-control" tabindex="5">
                              <option>Select</option>
                              <option value="Customer" <?php if($news['return_type']=='Customer') echo "selected"; ?>>Customer</option>
                              <option value="Supplier" <?php if($news['return_type']=='Supplier') echo "selected"; ?>>Supplier</option>
                            </select>
                      </div>
                        </div>
                      </div>
                      <div class="col-sm-5">
                          <div class="form-group">
                            <div class="control-label col-md-4">
                              <label>Name</label>
                            </div>
                            <div class="col-md-8">
                              <select name="returnee" id="returnee" class="form-control" required="required" tabindex="2" required="required">
                              <option>Select</option>
                            </select>
                            </div>
                          </div>
                      </div>
                    </div>
                    <hr>

                    <div class="row">
                      <div class="col-md-1"></div>
                      <div class="col-md-4"><h4 style="color: #23b7e5">Product</h4></div>
                    </div>
                    
               <div class="row" style="padding-top: 15px;">
                      <div class="col-sm-10">
                          <div class="form-group">
                            <div class="control-label col-md-1">
                              <label>Product</label>
                            </div>
                            <div class="col-md-8">
                              <select name="product" id="product" class="chosen form-control product" tabindex="6">
                                <option value=""></option>
                              <?php if(isset($product) && !empty($product))
                              foreach ($product as $key => $value):?>
                                <option <?php if(isset($news['product_id']) && $news['product_id'] == $value['id']) echo "selected"; ?> value="<?php echo $value['id'].','.$value['name'].','.$value['purchase_price'] ?>"><?=$value['name'].'-'.$value['p_c_name'];?></option>
                              <?php endforeach; ?>
                            </select>
                            </div>
                          
                          <div class="control-label col-md-1">
                          <label>Qty</label>
                        </div>
                        <div class="col-md-2">
                          <input type="text" name="qty" class="form-control" value="1" style="text-align: center;">
                        </div>
                        </div>
                      </div>
                    <button class="btn btn-primary add_product btn-lg" tabindex="7" style="border-radius: 7px !important;padding-left: 30px;padding-right: 30px;font-size: 20px;">Add</button>
                    </div>
                    <div class="row" style="padding-top: 20px;">
                      <div class="col-md-1">
                      </div>
                      <div class="col-md-10">
                      <table style="width: 100%;">
                      <thead>
                       <tr>
                        <th>Description</th>
                        <th>Price per Unit</th>
                        <th>Quantity</th>
                        <th>Amount</th>
                        <th>Actions</th>
                       </tr>
                      </thead>
                      <tbody id="table_data">
                      </tbody>
                     </table>
                      </div>
                    </div>
                    <div class="row" style="padding-top: 15px;">
                      <div class="col-md-4"></div>
                      <div class="col-md-7">
                        <div class="row">
                          <div class="col-md-6">
                            <h4 style="text-align: right;">Total Payment</h4>
                          </div>
                          <div class="col-md-6">
                            <input type="number" readonly name="total_pay" value="0" class="form-control" style="text-align: center;">
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-6">
                            <h4 style="text-align: right;">Discount</h4>
                          </div>
                          <div class="col-md-6">
                            <input type="number" name="discount" id="discount" class="form-control" value="0" style="text-align: center;" tabindex="8">
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-6">
                            <h4 style="text-align: right;">Grand Total</h4>
                          </div>
                          <div class="col-md-6">
                            <input type="number" readonly name="net_amount" value="0" class="form-control" style="text-align: center;">
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-6">
                            <h4 style="text-align: right;">Cash Paid<span style="color: red">*</span></h4>
                          </div>
                          <div class="col-md-6">
                            <input type="number" name="paid_amount" id="paid_amount" class="form-control" value="" style="text-align: center;" tabindex="9" required="required">
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-6">
                            <h4 style="text-align: right;">Remaining</h4>
                          </div>
                          <div class="col-md-6">
                            <input type="number" readonly name="remaining" id="remaining" class="form-control" value="0" style="text-align: center;">
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-6">
                            <h4 style="text-align: right;">Change</h4>
                          </div>
                          <div class="col-md-6">
                            <input type="number" readonly name="change" value="0" class="form-control" style="text-align: center;">
                          </div>
                        </div>
                      </div>
                      </div>
                </div>
                </div>



                <div class="form-actions fluid no-mrg">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="col-md-offset-2 col-md-9" style="padding-bottom:15px;padding-top:15px;">
                       <span style="margin-left:40px"></span>
                       <button type="submit" id="button1" class="btn btn-success btn-lg" tabindex="10" style="margin-left:20px; border-radius: 7px !important; padding: 20px;font-size: 20px;"><i class="fa fa-print"></i>&nbsp;Save & Print</button>
                       <a href="<?php echo ADMIN_BASE_URL . 'stock_return/create'; ?>">
                        <button type="button" class="btn btn-info btn-lg" style="margin-left:20px; border-radius: 7px !important; padding: 20px;font-size: 20px;" tabindex="11"><i class="fa fa-file"></i>&nbsp;New</button>
                        </a>
                        <a href="<?php echo ADMIN_BASE_URL . 'stock_return'; ?>">
                        <button type="button" class="btn btn-danger btn-lg" style="margin-left:20px;border-radius: 7px !important;padding: 20px;font-size: 20px;" tabindex="12"><i class="fa fa-undo"></i>&nbsp;Cancel</button>
                        </a>
                      </div>
                    </div>
                  </div>
                </div>
                
                <?php echo form_close(); ?> 
                <!-- END FORM--> 
                
               </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
</div>


<script>

    function delete_row(x){
      var row_id = x.parentNode.parentNode.rowIndex;
      document.getElementById("table_data").deleteRow(row_id-1);
    };

$(document).ready(function(){

$("#return_type").change(function () {
    var return_type = this.value;
   $.ajax({
        type: 'POST',
        url: "<?php echo ADMIN_BASE_URL?>stock_return/get_returnee",
        data: {'return_type': return_type },
        async: false,
        success: function(result) {
        $("#returnee").html(result);
      }
    });
});

$(document).on("click", ".add_product", function(event){
event.preventDefault();
var product = $(this).parent().find('select[name=product]').val();
var qty = $('input[name=qty]').val();
var total_pay = $('input[name=total_pay]').val();
    $.ajax({
                type: 'POST',
                url: "<?php echo ADMIN_BASE_URL?>stock_return/add_product",
                data: {'product': product ,'total_pay' :total_pay , 'qty':qty},
                dataType: 'json',
                async: false,
                success: function(result) {
                $("#table_data").append(result[0]);
                $('input[name=total_pay]').val(result[1]);
                $('input[name=net_amount]').val(result[1]);
                $('input[name=remaining]').val(result[1]);
              }
});
});

$(document).on("click", ".delete", function(event){
event.preventDefault();
  var amount = $(this).attr('amount');
  var total_pay = $('input[name=total_pay]').val();
  $('input[name=total_pay]').val(total_pay-amount);
  var net_amount = $('input[name=net_amount]').val();
  $('input[name=net_amount]').val(net_amount-amount);
  var remaining = $('input[name=remaining]').val();
  $('input[name=remaining]').val(remaining-amount);

});

$('input[name=discount]').keyup(function() {
    var total_pay = parseInt($('input[name=total_pay]').val());
    var discount = $(this).val();
    var net_amount = total_pay - discount;
    $('input[name=net_amount]').val(net_amount);
    $('input[name=remaining]').val(net_amount);
});

$('input[name=paid_amount]').keyup(function() {
    var net_amount = parseInt($('input[name=net_amount]').val());
    var paid_amount = $(this).val();
    var change = paid_amount - net_amount;
    var remaining = net_amount - paid_amount;
    if (change > 0) {
      $('input[name=change]').val(change);
    }
    else{
      $('input[name=change]').val(0);
    }
     if (remaining > 0) {
      $('input[name=remaining]').val(remaining);
     }
     else{
      $('input[name=remaining]').val(0);
     }
    
});

$(".chosen").chosen();
});

             
</script>