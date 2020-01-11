<?php
if ( ! defined('BASEPATH')){
    exit('No direct script access allowed');
}

class sale_invoice extends MX_Controller
{

    function __construct() {
        parent::__construct();
        Modules::run('site_security/is_login');
    }

    function index() {
        $this->create();
    }

    function manage() {
        $data['news'] = $this->_get('sale_invoice.id desc');
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
        $customer = Modules::run('customer/_get_by_arr_id_customer',$org_id)->result_array();
        $product = Modules::run('product/_get_by_arr_id_product',$org_id)->result_array();

        $data['customer'] = $customer;
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

    function print_sale_invoice() {
        $sale_invoice_id = $this->uri->segment(4);
        $user_data = $this->session->userdata('user_data');
        $org_id = $user_data['user_id'];
        $customer = $this->_get_by_arr_id($sale_invoice_id)->result_array();
        if (isset($customer) && !empty($customer)) {
            $data['invoice'] = $this->_get_sale_invoice_data($sale_invoice_id,$customer[0]['customer_id'],$org_id)->result_array();
        }
        if ($org_id == 24) {
            $this->load->view('DONT_DELETE_INVOICE',$data);
        }
        else{
            $this->load->view('sale_invoice_print',$data);
        }
        
    }
 
    function _get_data_from_db($update_id) {
        $query = $this->_get_by_arr_id($update_id);
        foreach ($query->result() as
                $row) {
            $data['id'] = $row->id;
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
            $data['commission_less'] = $row->commission_less;
            $data['labour_less'] = $row->labour_less;
            $data['brokerage_less'] = $row->brokerage_less;
            $data['loading_less'] = $row->loading_less;
            $data['market_fees_less'] = $row->market_fees_less;
            $data['other_expense_less'] = $row->other_expense_less;
            $data['soothly_less'] = $row->soothly_less;
            $data['bardana_less'] = $row->bardana_less;
            $data['freight_less'] = $row->freight_less;
            $data['dami_less'] = $row->dami_less;
            $data['change'] = $row->change;
            $data['cash_received'] = $row->cash_received;
            $data['grand_total'] = $row->grand_total;
            $data['discount'] = $row->discount;
            $data['remaining'] = $row->remaining;
            $data['total_payable'] = $row->total_payable;
            $data['date'] = $row->date;
            $data['customer_name'] = $row->customer_name;
            $data['customer_id'] = $row->customer_id;
            $data['status'] = $row->status;
            $data['org_id'] = $row->org_id;
        }
        if(isset($data))
            return $data;
    }

    function _get_data_from_post() {
        $customer = $this->input->post('customer');
        if (isset($customer) && !empty($customer)) {
            $customer2=explode(',', $customer);
            $data['customer_id'] = $customer2[0];
            $data['customer_name'] = $customer2[1];
        }
        else{
            $data['customer_id'] = 0;
            $data['customer_name'] = 'walk-in';
        }
        $data['date'] = $this->input->post('date');
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
            $sale_invoice_id = $this->_insert_sale_invoice($data);
            
            if ($data['customer_id'] != 0) {
                $where['id'] = $data['customer_id'];
                $customer = Modules::run('customer/_get_by_arr_id',$where)->result_array();
                $data2['remaining'] = $customer[0]['remaining'] + $data['remaining'];
                $data2['total'] = $customer[0]['total'] + $data['grand_total'];
                
                if ($data['change'] == 0) {
                    $data2['paid'] = $customer[0]['paid'] + $data['cash_received'];
                }
                elseif ($data['change'] > 0) {
                    $data2['paid'] = $customer[0]['paid'] + $data['grand_total'];
                }

                $this->_update_customer_amount($data['customer_id'],$data2,$org_id);
            }

            if ($data['change'] == 0) {
                    $data3['paid'] = $data['cash_received'];
                }
                elseif ($data['change'] > 0) {
                    $data3['paid'] = $data['grand_total'];
            }

            $cash_in_hand = Modules::run('account/_get_cash_in_hand')->result_array();
            $cash['opening_balance'] = $cash_in_hand[0]['opening_balance'] + $data3['paid'];
            Modules::run('account/_update_cash_in_hand',$cash);
            $this->insert_product($sale_invoice_id,$org_id);
        }
        $this->session->set_flashdata('message', 'sale_invoice'.' '.DATA_SAVED);
        $this->session->set_flashdata('status', 'success');
        
        redirect(ADMIN_BASE_URL . 'sale_invoice/print_sale_invoice/'.$sale_invoice_id);
    }

    function insert_product($sale_invoice_id,$org_id){
        $sale_product = $this->input->post('sale_product');
        $sale_qty = $this->input->post('sale_qty');
        $sale_amount = $this->input->post('sale_amount');
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
                    $data['sale_invoice_id'] = $sale_invoice_id;
                    $data['product_id'] = $value1['id'];
                    $data['product_name'] = $value1['name'];
                    $data['p_c_id'] = $value1['p_c_id'];
                    $data['p_c_name'] = $value1['p_c_name'];
                    $data['s_c_id'] = $value1['s_c_id'];
                    $data['s_c_name'] = $value1['s_c_name'];
                    $data['sale_price'] = $value1['sale_price'];
                    $data['qty'] = $sale_qty[$counter];
                    $data['amount'] = $sale_amount[$counter];
                    $data['org_id'] = $org_id;
                    $data2['stock'] = $value1['stock'] - $sale_qty[$counter];
                    $rows = $this->_update_product_stock($data2,$org_id,$value1['id']);
                }
            }
            if(!empty($data)){
                $invoice_product_id = $this->_insert_product($data);
            }
            $counter++; 
        }

    }

    //=============AJAX FUNCTIONS==============

    function get_product(){
        $product = $this->input->post('product');
        if(isset($product) && !empty($product)){
            $productData = explode(",",$product);
            $product_id = $productData[0];
            $sale_price = $productData[2];
        }
        print_r($sale_price);

    }

    function add_product(){
        $product = $this->input->post('product');
        $qty = $this->input->post('qty');
        $bardana = $this->input->post('bardana');
        $allowance = $this->input->post('allowance');
        $price = $this->input->post('price');
        $totalIn = $this->input->post('total_pay');
        $qty = $qty - ($bardana+$allowance);
        $totalIn = $this->input->post('total_pay');
        if(isset($product) && !empty($product)){
            $productData = explode(",",$product);
            $product_id = $productData[0];
        }
        $where['id'] = $product_id;
        $arr_product = Modules::run('product/_get_by_arr_id',$where)->result_array();
        $html='';
        $i = 0;
        if (isset($arr_product) && !empty($arr_product)) {
            foreach ($arr_product as $key => $value) {
                $sale_price = ($qty/$value['scale'])*$price;
                $html.='<tr>';
                $html.='<td><input style="text-align: center;" class="form-control" readonly type="text" name="sale_product[]" value="'.$value['id'].','.$value['name'].' - '.$value['p_c_name'].'"></td>';
                $html.='<td><input style="text-align: center;" class="form-control" readonly type="text" name="sale_price[]" value='.$price.'></td>';
                $html.='<td><input style="text-align: center;" class="form-control" type="number"  name="sale_qty[]" value='.$qty.'></td>';
                $html.='<td><input style="text-align: center;" class="form-control" readonly type="number" name="sale_amount[]" value='.$sale_price.'></td>';
                $html.='<td><a class="btn delete" onclick="delete_row(this)" amount='.$sale_price.'><i class="fa fa-remove"  title="Delete Item" style="color:red;"></i></a></td>';
                $html.='</tr>';
            }
            $total = $totalIn + $sale_price;
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
        $this->load->model('mdl_sale_invoice');
        return $this->mdl_sale_invoice->_get($order_by);
    }

    function _get_by_arr_id($update_id) {
        $this->load->model('mdl_sale_invoice');
        return $this->mdl_sale_invoice->_get_by_arr_id($update_id);
    }

    function _get_data_from_db_test($update_id) {
        $this->load->model('mdl_sale_invoice');
        return $this->mdl_sale_invoice->_get_data_from_db_test($update_id);
    }

    function _insert_product($data){
        $this->load->model('mdl_sale_invoice');
        return $this->mdl_sale_invoice->_insert_product($data);
    }

    function _insert_sale_invoice($data){
        $this->load->model('mdl_sale_invoice');
        return $this->mdl_sale_invoice->_insert_sale_invoice($data);
    }

    function _update($arr_col, $org_id, $data) {
        $this->load->model('mdl_sale_invoice');
        $this->mdl_sale_invoice->_update($arr_col, $org_id, $data);
    }

    function _update_id($id, $data) {
        $this->load->model('mdl_sale_invoice');
        $this->mdl_sale_invoice->_update_id($id, $data);
    }

    function _delete($arr_col, $org_id) {       
        $this->load->model('mdl_sale_invoice');
        $this->mdl_sale_invoice->_delete($arr_col, $org_id);
    }

    function _get_sale_invoice_data($sale_invoice_id,$customer_id,$org_id) {
        $this->load->model('mdl_sale_invoice');
        return $this->mdl_sale_invoice->_get_sale_invoice_data($sale_invoice_id,$customer_id,$org_id);
    }

    function _update_product_stock($data2,$org_id,$product_id){
        $this->load->model('mdl_sale_invoice');
        return $this->mdl_sale_invoice->_update_product_stock($data2,$org_id,$product_id);
    }

    function _update_customer_amount($customer_id,$data,$org_id){
        $this->load->model('mdl_sale_invoice');
        return $this->mdl_sale_invoice->_update_customer_amount($customer_id,$data,$org_id);
    }

    function _get_product_list($invoice_id) {
        $this->load->model('mdl_sale_invoice');
        return $this->mdl_sale_invoice->_get_product_list($invoice_id);
    }
}