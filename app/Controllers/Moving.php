<?php
namespace App\Controllers;

use App\Models\M_employee;
use App\Models\M_medicine;
use App\Models\M_status_lot;
use App\Models\M_moving;
use App\Models\M_lot;
use App\Models\M_type_medicine;
use CodeIgniter\HTTP\RequestInterface;

class Moving extends BaseController {

    // หน้าประวัติการเคลื่อนย้าย
    public function show_moving($page=1) {
        if(!session()->get('emp_id')) {
            $url = base_url() . "/warehouse/show_login";
            header( "refresh: 0; url=$url" );
            exit(0);
        }

        $m_move = new M_moving();

        $arr_total = $m_move->get_all_moving();
        $arr_total = count($arr_total);

        if($arr_total == 0) {
            $data['row_data'] = 10;
            $data['page'] = 1;
            $data['first_page'] = 1;
            $data['last_page'] = 1;
            $data['arr_moving'] = $m_move->get_all_moving();
            $m_stat = new M_status_lot();
            $data['opt_stat'] = $m_stat->get_all_status();
            return view('v_show_moving', $data);
        }

        $row_data = 10;
        $col_page = 10;

        $total_page = ceil($arr_total / $row_data);

        if($page < 1 || $page > $total_page) {
            $url = base_url() . "/warehouse/show_moving/1";
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

        $data['row_data'] = $row_data;
        $data['page'] = $page;
        $data['first_page'] = $first_page;
        $data['last_page'] = $last_page;
        $data['start'] = $start;
        $data['arr_moving'] = $m_move->get_moving_by_limit($start, $num_row);

        $m_stat = new M_status_lot();
        $data['opt_stat'] = $m_stat->get_all_status();

        return view('v_show_moving', $data);
    }

}