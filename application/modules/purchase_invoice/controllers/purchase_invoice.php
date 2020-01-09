<?php
if ( ! defined('BASEPATH')){
    exit('No direct script access allowed');
}

class purchase_invoice extends MX_Controller
{

    function __construct() {
        parent::__construct();
        Modules::run('site_security/is_login');
    }

    function index() {
        $this->create();
    }

    function manage() {
        $data['news'] = $this->_get('purchase_invoice.id desc');
        $data['view_file'] = 'news';
        $this->load->module('template');
        $this->template->admin($data);
    }

    function create() {
        $update_id = $this->uri->segment(4);
        $user_data = $this->session->userdata('user_data');
        $org_id = $user_data['user_id'];
        if (is_numeric($update_id) && $update_id != 0) {
            $data['news'] = $this->_get_data_from_db($update_id);
        }
        else {
            $data['news'] = $this->_get_data_from_post();
        }
        $supplier = Modules::run('supplier/_get_by_arr_id_supplier',$org_id)->result_array();
        $product = Modules::run('product/_get_by_arr_id_product',$org_id)->result_array();

        $data['supplier'] = $supplier;
        $data['product'] = $product;
        $data['update_id'] = $update_id;
        $data['view_file'] = 'newsform';
        $this->load->module('template');
        $this->template->admin($data);
    }

    function product_list() {
        $invoice_id = $this->uri->segment(4);
        if (is_numeric($invoice_id) && $invoice_id != 0) {
            $data['news'] = $this->_get_product_list($invoice_id);
        }
        $data['view_file'] = 'product_list';
        $this->load->module('template');
        $this->template->admin($data);
    }

    function print_purchase_invoice() {
        $purchase_invoice_id = $this->uri->segment(4);
        $user_data = $this->session->userdata('user_data');
        $org_id = $user_data['user_id'];
        $data['invoice'] = $this->_get_purchase_invoice_data($purchase_invoice_id,$org_id)->result_array();
        $this->load->view('purchase_invoice_print',$data);
    }

 
    function _get_data_from_db($update_id) {
        $query = $this->_get_by_arr_id($update_id);
        foreach ($query->result() as
                $row) {
            $data['id'] = $row->id;
            $data['ref_no'] = $row->ref_no;
            $data['vehicle_no'] = $row->vehicle_no;
            $data['bags'] = $row->bags;
            $data['remarks'] = $row->remarks;
            $data['gate_pass_no'] = $row->gate_pass_no;
            $data['commission'] = $row->commission;
            $data['labour'] = $row->labour;
            $data['brokerage'] = $row->brokerage;
            $data['loading'] = $row->loading;
            $data['market_fees'] = $row->market_fees;
            $data['other_expense'] = $row->other_expense;
            $data['soothly'] = $row->soothly;
            $data['bardana'] = $row->bardana;
            $data['freight'] = $row->freight;
            $data['dami'] = $row->dami;
            $data['soothly_less'] = $row->soothly_less;
            $data['bardana_less'] = $row->bardana_less;
            $data['freight_less'] = $row->freight_less;
            $data['dami_less'] = $row->dami_less;
            $data['commission_less'] = $row->commission_less;
            $data['labour_less'] = $row->labour_less;
            $data['brokerage_less'] = $row->brokerage_less;
            $data['loading_less'] = $row->loading_less;
            $data['market_fees_less'] = $row->market_fees_less;
            $data['other_expense_less'] = $row->other_expense_less;
            $data['change'] = $row->change;
            $data['cash_received'] = $row->cash_received;
            $data['remaining'] = $row->remaining;
            $data['grand_total'] = $row->grand_total;
            $data['total_payable'] = $row->total_payable;
            $data['discount'] = $row->discount;
            $data['date'] = $row->date;
            $data['supplier_name'] = $row->supplier_name;
            $data['supplier_id'] = $row->supplier_id;
            $data['status'] = $row->status;
            $data['org_id'] = $row->org_id;
        }
        if(isset($data))
            return $data;
    }

    function _get_data_from_post() {
        $supplier = $this->input->post('supplier');
        if (isset($supplier) && !empty($supplier)) {
            $supplier2=explode(',', $supplier);
            $data['supplier_id'] = $supplier2[0];
            $data['supplier_name'] = $supplier2[1];
        }
        $data['date'] = $this->input->post('date');
        $data['ref_no'] = $this->input->post('ref_no');
        $data['vehicle_no'] = $this->input->post('vehicle_no');
        $data['remarks'] = $this->input->post('remarks');
        $data['gate_pass_no'] = $this->input->post('gate_pass_no');
        $data['bags'] = $this->input->post('bags');
        $data['commission'] = $this->input->post('commission');
        $data['labour'] = $this->input->post('labour');
        $data['brokerage'] = $this->input->post('brokerage');
        $data['loading'] = $this->input->post('loading');
        $data['market_fees'] = $this->input->post('market_fees');
        $data['other_expense'] = $this->input->post('other_expense');
        $data['soothly'] = $this->input->post('soothly');
        $data['bardana'] = $this->input->post('bardana');
        $data['freight'] = $this->input->post('freight');
        $data['dami'] = $this->input->post('dami');
        $data['soothly_less'] = $this->input->post('soothly_less');
        $data['bardana_less'] = $this->input->post('bardana_less');
        $data['freight_less'] = $this->input->post('freight_less');
        $data['dami_less'] = $this->input->post('dami_less');
        $data['commission_less'] = $this->input->post('commission_less');
        $data['labour_less'] = $this->input->post('labour_less');
        $data['brokerage_less'] = $this->input->post('brokerage_less');
        $data['loading_less'] = $this->input->post('loading_less');
        $data['market_fees_less'] = $this->input->post('market_fees_less');
        $data['other_expense_less'] = $this->input->post('other_expense_less');
        $data['total_payable'] = $this->input->post('total_pay');
        $data['discount'] = $this->input->post('discount');
        $data['grand_total'] = $this->input->post('net_amount');
        $data['cash_received'] = $this->input->post('paid_amount');
        $data['change'] = $this->input->post('change');
        $data['remaining'] = $this->input->post('remaining');
        $data['status'] = $this->input->post('status');


        $user_data = $this->session->userdata('user_data');
        $data['org_id'] = $user_data['user_id'];
        return $data;
    }

    function submit() {
        $update_id = $this->uri->segment(4);
        $data = $this->_get_data_from_post();
        $user_data = $this->session->userdata('user_data');
        $org_id = $user_data['user_id'];
        if ($update_id != 0) {
            $id = $this->_update($update_id,$org_id,$data);
        }
        else {
            $purchase_invoice_id = $this->_insert_purchase_invoice($data);
            $where['id'] = $data['supplier_id'];
            $supplier = Modules::run('supplier/_get_by_arr_id',$where)->result_array();

                $data2['remaining'] = $supplier[0]['remaining'] + $data['remaining'];
                $data2['total'] = $supplier[0]['total'] + $data['grand_total'];
                
                if ($data['change'] == 0) {
                    $data2['paid'] = $supplier[0]['paid'] + $data['cash_received'];
                }
                elseif ($data['change'] > 0) {
                    $data2['paid'] = $supplier[0]['paid'] + $data['grand_total'];
                }


            $this->_update_supplier_amount($data['supplier_id'],$data2,$org_id);
            $this->insert_product($purchase_invoice_id,$org_id);

        }

        if ($data['change'] == 0) {
                $data3['paid'] = $data['cash_received'];
            }
            elseif ($data['change'] > 0) {
                $data3['paid'] = $data['grand_total'];
        }

        $cash_in_hand = Modules::run('account/_get_cash_in_hand')->result_array();
        $cash['opening_balance'] = $cash_in_hand[0]['opening_balance'] - $data3['paid'];
        Modules::run('account/_update_cash_in_hand',$cash);
        $this->session->set_flashdata('message', 'purchase_invoice'.' '.DATA_SAVED);
        $this->session->set_flashdata('status', 'success');
        
        redirect(ADMIN_BASE_URL . 'purchase_invoice/print_purchase_invoice/'.$purchase_invoice_id);
    }

    function insert_product($purchase_invoice_id,$org_id){
        $sale_product = $this->input->post('purchase_product');
        $sale_qty = $this->input->post('purchase_qty');
        $sale_amount = $this->input->post('purchase_amount');
        $counter = 0;
        foreach ($sale_product as $key => $value) {
            $data = array();
            unset($data); 
            $data = array();
            $sale_product2=explode(',', $sale_product[$counter]);
            $sale_product_id = $sale_product2[0];

            $where['id'] = $sale_product_id;
            $arr_product = Modules::run('product/_get_by_arr_id',$where)->result_array();
            if (isset($arr_product) && !empty($arr_product)) {
                foreach ($arr_product as $key => $value1) {
                    $data['purchase_invoice_id'] = $purchase_invoice_id;
                    $data['product_id'] = $value1['id'];
                    $data['product_name'] = $value1['name'];
                    $data['p_c_id'] = $value1['p_c_id'];
                    $data['p_c_name'] = $value1['p_c_name'];
                    $data['s_c_id'] = $value1['s_c_id'];
                    $data['s_c_name'] = $value1['s_c_name'];
                    $data['sale_price'] = $value1['purchase_price'];
                    $data['qty'] = $sale_qty[$counter];
                    $data['amount'] = $sale_amount[$counter];
                    $data['org_id'] = $org_id;


                    $data2['stock'] = $value1['stock'] + $sale_qty[$counter];
                    $rows = $this->_update_product_stock($data2,$org_id,$value1['id']);
                }
            }
            if(!empty($data)){
                $this->_insert_product($data);
            }
            $counter++; 
        }

    }

    //=============AJAX FUNCTIONS==============

    function add_product(){
        $product = $this->input->post('product');
        $qty = $this->input->post('qty');
        $bardana = $this->input->post('bardana');
        $allowance = $this->input->post('allowance');
        $totalIn = $this->input->post('total_pay');
        $qty = $qty - ($bardana+$allowance);
        if(isset($product) && !empty($product)){
            $productData = explode(",",$product);
            $product_id = $productData[0];
        }
        $where['id'] = $product_id;
        $arr_product = Modules::run('product/_get_by_arr_id',$where)->result_array();
        $html='';
        if (isset($arr_product) && !empty($arr_product)) {
            foreach ($arr_product as $key => $value) {
                $purchase_price = ($qty/$value['scale'])*$value['purchase_price'];
                $html.='<tr>';
                $html.='<td><input style="text-align: center;" class="form-control" readonly type="text" name="purchase_product[]" value="'.$value['id'].','.$value['name'].' - '.$value['p_c_name'].'"></td>';
                $html.='<td><input style="text-align: center;" class="form-control" readonly type="text" name="purchase_price[]" value='.$value['purchase_price'].'></td>';
                $html.='<td><input style="text-align: center;" class="form-control" type="number" readonly name="purchase_qty[]" value='.$qty.'></td>';
                $html.='<td><input style="text-align: center;" class="form-control" readonly type="number" name="purchase_amount[]" value='.$purchase_price.'></td>';
                $html.='<td><a class="btn delete" onclick="delete_row(this)" amount='.$purchase_price.'><i class="fa fa-remove"  title="Delete Item"></i></a></td>';
                $html.='</tr>';
            }
            $total = $totalIn + $purchase_price;
        }
        $result_array = [$html,$total];
        echo json_encode($result_array);
    }

    //==============AJAX FUNCTIONS END==================

    function delete() {
        $delete_id = $this->input->post('id');
        $user_data = $this->session->userdata('user_data');
        $org_id = $user_data['user_id'];
        $this->_delete($delete_id, $org_id);
    }

    function detail() {
        $update_id = $this->input->post('id');
        $data['user'] = $this->_get_data_from_db($update_id);
        $this->load->view('detail', $data);
    }

    function _get($order_by) {
        $this->load->model('mdl_purchase_invoice');
        return $this->mdl_purchase_invoice->_get($order_by);
    }

    function _get_by_arr_id($update_id) {
        $this->load->model('mdl_purchase_invoice');
        return $this->mdl_purchase_invoice->_get_by_arr_id($update_id);
    }

    function _get_data_from_db_test($update_id) {
        $this->load->model('mdl_purchase_invoice');
        return $this->mdl_purchase_invoice->_get_data_from_db_test($update_id);
    }

    function _insert_product($data){
        $this->load->model('mdl_purchase_invoice');
        return $this->mdl_purchase_invoice->_insert_product($data);
    }

    function _insert_purchase_invoice($data){
        $this->load->model('mdl_purchase_invoice');
        return $this->mdl_purchase_invoice->_insert_purchase_invoice($data);
    }

    function _update($arr_col, $org_id, $data) {
        $this->load->model('mdl_purchase_invoice');
        $this->mdl_purchase_invoice->_update($arr_col, $org_id, $data);
    }

    function _update_id($id, $data) {
        $this->load->model('mdl_purchase_invoice');
        $this->mdl_purchase_invoice->_update_id($id, $data);
    }

    function _delete($arr_col, $org_id) {       
        $this->load->model('mdl_purchase_invoice');
        $this->mdl_purchase_invoice->_delete($arr_col, $org_id);
    }

    function _get_purchase_invoice_data($purchase_invoice_id,$org_id) {
        $this->load->model('mdl_purchase_invoice');
        return $this->mdl_purchase_invoice->_get_purchase_invoice_data($purchase_invoice_id,$org_id);
    }

    function _update_product_stock($data2,$org_id,$product_id){
        $this->load->model('mdl_purchase_invoice');
        return $this->mdl_purchase_invoice->_update_product_stock($data2,$org_id,$product_id);
    }

    function _update_supplier_amount($supplier_id,$amount,$org_id){
        $this->load->model('mdl_purchase_invoice');
        return $this->mdl_purchase_invoice->_update_supplier_amount($supplier_id,$amount,$org_id);
    }

    function _get_product_list($invoice_id) {
        $this->load->model('mdl_purchase_invoice');
        return $this->mdl_purchase_invoice->_get_product_list($invoice_id);
    }
}