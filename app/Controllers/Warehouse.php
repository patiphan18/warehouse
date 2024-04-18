<?php
namespace App\Controllers;

use App\Models\M_employee;
use App\Models\M_medicine;
use App\Models\M_status_lot;
use App\Models\M_moving;
use App\Models\M_lot;
use App\Models\M_type_medicine;
use CodeIgniter\HTTP\RequestInterface;

class Warehouse extends BaseController {

    // หน้าล็อตยา
    public function show_lot($page=1) {
    
        if(!session()->get('emp_id')) {
            $url = base_url() . "/warehouse/show_login";
            header( "refresh: 0; url=$url" );
            exit(0);
        }

        $m_stat = new M_status_lot();
        $data['opt_stat'] = $m_stat->get_all_status();

        $m_lot = new M_lot();
        $arr_total = $m_lot->get_lot_in_warehouse();
        $arr_total = count($arr_total);

        if($arr_total == 0) {
            $data['row_data'] = 10;
            $data['page'] = 1;
            $data['first_page'] = 1;
            $data['last_page'] = 1;
            $data['emp'] = session()->get('emp_id');
            $data['arr_lot'] = $m_lot->get_lot_in_warehouse();

            return view('v_show_lot', $data);
        }

        $row_data = 10;
        $col_page = 10;
        
        $total_page = ceil($arr_total / $row_data);

        if($page < 1 || $page > $total_page) {
            $url = base_url() . "/warehouse/show_lot/1";
            header( "refresh: 0; url=$url" );
            exit(0);
        }
        
        $first_page = $page - ($page % $col_page);
        $last_page = $first_page + $col_page;
        if($first_page == 0) {
            $first_page = 1;
        }
        if($last_page > $total_page) {
            $last_page = $total_page;       
        } 
        
        $start = $arr_total - $page * $row_data;
        $num_row = 10;
        if($start < 0) {
            $start = 0;
            $num_row = $arr_total % 10;
        }


        $data['emp'] = session()->get('emp_id');
        $data['row_data'] = $row_data;
        $data['page'] = $page;
        $data['first_page'] = $first_page;
        $data['last_page'] = $last_page;
        $data['arr_lot'] = $m_lot->get_lot_in_warehouse_by_limit($start, $num_row);

        

        return view('v_show_lot', $data);
    }

    public function insert_lot() {
        $med_code = $this->request->getPost('med_code');
        $lot_qty = $this->request->getPost('lot_qty');
        $mfg_date = $this->request->getPost('mfg_date');
        $exp_date = $this->request->getPost('exp_date');
        $emp_id = $this->request->getPost('emp_id');

        $index_url = base_url();
        if(!isset($med_code) || !isset($lot_qty) || !isset($emp_id)) {        
            header( "refresh: 0; url=$index_url" );
            exit(0);
        } else if(!isset($mfg_date) || !isset($exp_date)) {
            header( "refresh: 0; url=$index_url" );
            exit(0);
        }
        
        $m_lot = new M_lot();
        $m_move = new M_moving();
        $m_med = new M_medicine();

        $obj_med = $m_med->get_price_by_code($med_code);
        $price = $obj_med->med_price;
        $total_price = $price * $lot_qty;

        $m_lot->insert_lot($med_code, $lot_qty, $mfg_date, $exp_date, $total_price);

        $obj_lot = $m_lot->get_last_id();
        $m_move->insert_im_history($obj_lot->lot_id, $emp_id);

        unset($_POST);
        $url = base_url() . "/warehouse/show_lot";
        header( "refresh: 0; url=$url" );
        exit(0);
    }    

    public function export_lot() {
    
        $lot_id = $this->request->getPost('lot_id');
        $stat_id = $this->request->getPost('stat_id');
        $emp_id = $this->request->getPost('emp_id');

        $index_url = base_url();
        if(!isset($lot_id) || !isset($stat_id) || !isset($emp_id)) {        
            header( "refresh: 0; url=$index_url" );
            exit(0);
        } 

        $m_move = new M_moving();
        $m_move->insert_ex_history($lot_id, $emp_id, $stat_id);

        $m_lot = new M_lot();
        $m_lot->update_lot_status($lot_id, $stat_id);

        return redirect()->to('/warehouse/show_lot');
    } 

    public function update_lot_status() {
        $lot_id = $this->request->getPost('lot_id');
        $stat_id = $this->request->getPost('stat_id');

        $index_url = base_url();
        if(!isset($lot_id) || !isset($stat_id)) {        
            header( "refresh: 0; url=$index_url" );
            exit(0);
        } 

        $m_lot= new M_lot();
        $m_lot->update_lot_status($lot_id, $stat_id);

        $data['arr_lot'] = $m_lot->get_lot_in_warehouse();

        return view('v_show_lot', $data);
    }

}