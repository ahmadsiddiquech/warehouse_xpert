<div class="content-wrapper">
    <h3>Supplier<a href="supplier/create"><button type="button" class="btn btn-lg btn-primary pull-right"><i class="fa fa-plus"></i>&nbsp;&nbsp;&nbsp;<b>Add supplier</b></button></a></h3>
    <div class="container-fluid">
        <!-- START DATATABLE 1 -->
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-body">
                    <table id="datatable1" class="table table-striped table-hover table-body">
                        <thead class="bg-th">
                        <tr class="bg-col">
                        <th class="sr">S.No</th>
                        <th>Supplier Name</th>
                        <th>Company Name</th>
                        <th>Phone</th>
                        <th>Total</th>
                        <th>Paid</th>
                        <th>Balance</th>
                        <th class="" style="width:300px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 0;
                            $remaining = 0;
                            $paid = 0;
                            $total =0;
                            if (isset($news)) {
                                foreach ($news->result() as
                                        $new) {
                                    $i++;
                                    $total = $total + $new->total;
                                    $paid = $paid + $new->paid;
                                    $remaining = $remaining + $new->remaining;
                                    $set_publish_url = ADMIN_BASE_URL . 'supplier/set_publish/' . $new->id;
                                    $set_unpublish_url = ADMIN_BASE_URL . 'supplier/set_unpublish/' . $new->id ;
                                    $edit_url = ADMIN_BASE_URL . 'supplier/create/' . $new->id ;
                                    $delete_url = ADMIN_BASE_URL . 'supplier/delete/' . $new->id;
                                    $supplier_url = ADMIN_BASE_URL . 'supplier/invoice_list/' . $new->id.'/'.$new->name;
                                    $transaction_url = ADMIN_BASE_URL . 'supplier/transaction/' . $new->id.'/'.$new->name;
                                    $transaction_invoice_url = ADMIN_BASE_URL . 'supplier/transaction_list/' . $new->id.'/'.$new->name;
                                    ?>
                                    <tr id="Row_<?=$new->id?>" class="odd gradeX " >
                                    <td width='2%'><?php echo $i;?></td>
                                    <td><?php echo wordwrap($new->name , 50 , "<br>\n")  ?></td>
                                    <td><?php echo $new->company_name   ?></td>
                                    <td><?php echo $new->phone   ?></td>
                                    <td><?php echo $new->total   ?></td>
                                    <td><?php echo $new->paid   ?></td>
                                    <td><?php echo $new->remaining   ?></td>
                                    <td class="table_action">
                                    <a class="btn yellow c-btn view_details" rel="<?=$new->id?>"><i class="fa fa-list"  title="See Detail"></i></a>
                                    <?php

                                    $publish_class = ' table_action_publish';
                                    $publis_title = 'Set Un-Publish';
                                    $icon = '<i class="fa fa-long-arrow-up"></i>';
                                    $iconbgclass = ' btn green c-btn';
                                    if ($new->status  != 1 ) {
                                    $publish_class = ' table_action_unpublish';
                                    $publis_title = 'Set Publish';
                                    $icon = '<i class="fa fa-long-arrow-down"></i>';
                                    $iconbgclass = ' btn default c-btn';
                                    }

                                    echo anchor($supplier_url, '<i class="fa fa-mail-forward"></i>', array('class' => 'action_edit btn blue c-btn','title' => 'View Supplier Invoices'));

                                    echo anchor($transaction_url, '<i class="fa fa-money"></i>', array('class' => 'action_edit btn blue c-btn','title' => 'Make Transaction'));

                                    echo anchor($transaction_invoice_url, '<i class="fa fa-eye"></i>', array('class' => 'action_edit btn blue c-btn','title' => 'View Transaction Invoice'));

                                    // echo anchor("javascript:;",$icon, array('class' => 'action_publish' . $publish_class . $iconbgclass,
                                    // 'title' => $publis_title,'rel' => $new->id,'id' => $new->id, 'status' => $new->status));

                                    echo anchor($edit_url, '<i class="fa fa-edit"></i>', array('class' => 'action_edit btn blue c-btn','title' => 'Edit supplier'));

                                    echo anchor('"javascript:;"', '<i class="fa fa-times"></i>', array('class' => 'delete_record btn red c-btn', 'rel' => $new->id, 'title' => 'Delete supplier'));
                                    ?>
                                    </td>
                                </tr>
                                <?php } ?>    
                            <?php } ?>
                        </tbody>
                    </table>
                    <div class="pull-right" style="padding-right: 60px">
                        <h4 style="color:red;">Grand Total: <?php echo $total ?> PKR</h4>
                        <h4 style="color:red;">Total Paid: <?php echo $paid ?> PKR</h4>
                        <h4 style="color:red;">Total Payable: <?php echo $remaining ?> PKR</h4>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>    

<script type="text/javascript">

$(document).ready(function(){

    $(document).on("click", ".view_details", function(event){
        event.preventDefault();
        var id = $(this).attr('rel');
          $.ajax({
            type: 'POST',
            url: "<?php ADMIN_BASE_URL?>supplier/detail",
            data: {'id': id},
            async: false,
            success: function(test_body) {
                var test_desc = test_body;
                $('#myModal').modal('show')
                $("#myModal .modal-body").html(test_desc);
            }
        });
    });

    /*///////////////////////// end for code detail //////////////////////////////*/

  $(document).off('click', '.delete_record').on('click', '.delete_record', function(e){
        var id = $(this).attr('rel');
        e.preventDefault();
        swal({
            title : "Are you sure to delete the selected supplier?",
            text : "You will not be able to recover this supplier!",
            type : "warning",
            showCancelButton : true,
            confirmButtonColor : "#DD6B55",
            confirmButtonText : "Yes, delete it!",
            closeOnConfirm : false
        },
        function () {
           $.ajax({
                type: 'POST',
                url: "<?php echo ADMIN_BASE_URL?>supplier/delete",
                data: {'id': id},
                async: false,
                success: function() {
                location.reload();
                }
            });
            swal("Deleted!", "supplier has been deleted.", "success");
        });

    });       
    /*///////////////////////////////// START STATUS  ///////////////////////////////////*/
        
    $(document).off("click",".action_publish").on("click",".action_publish", function(event) {
        event.preventDefault();
        var id = $(this).attr('rel');
        var status = $(this).attr('status');
         $.ajax({
            type: 'POST',
            url: "<?= ADMIN_BASE_URL ?>supplier/change_status",
            data: {'id': id, 'status': status},
            async: false,
            success: function(result) {
                if($('#'+id).hasClass('default')==true)
                {
                    $('#'+id).addClass('green');
                    $('#'+id).removeClass('default');
                    $('#'+id).find('i.fa-long-arrow-down').removeClass('fa-long-arrow-down').addClass('fa-long-arrow-up');
                }
                else{
                    $('#'+id).addClass('default');
                    $('#'+id).removeClass('green');
                    $('#'+id).find('i.fa-long-arrow-up').removeClass('fa-long-arrow-up').addClass('fa-long-arrow-down');
                }
                $("#listing").load('<?php ADMIN_BASE_URL?>supplier/manage');
                toastr.success('Status Changed Successfully');
            }
        });
        if (status == 1) {
            $(this).removeClass('table_action_publish');
            $(this).addClass('table_action_unpublish');
            $(this).attr('title', 'Set Publish');
            $(this).attr('status', '0');
        } else {
            $(this).removeClass('table_action_unpublish');
            $(this).addClass('table_action_publish');
            $(this).attr('title', 'Set Un-Publish');
            $(this).attr('status', '1');
        }
    });

});
</script>