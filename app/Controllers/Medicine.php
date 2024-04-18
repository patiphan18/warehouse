<?php
namespace App\Controllers;

use App\Models\M_employee;
use App\Models\M_medicine;
use App\Models\M_status_lot;
use App\Models\M_moving;
use App\Models\M_lot;
use App\Models\M_type_medicine;
use CodeIgniter\HTTP\RequestInterface;

class Medicine extends BaseController {

    // หน้าข้อมูลยา
    public function show_medicine($page=1) {
        
        $m_med_type = new M_type_medicine();
        $data['opt_med_type'] = $m_med_type->get_all_type();


        if(!session()->get('emp_id')) {
            $login_url = base_url() . "/user/show_login";
            header( "refresh: 0; url=$login_url" );
            exit(0);
        }

        $m_med= new M_medicine();
        $arr_total = $m_med->get_all_medicine();
        $arr_total = count($arr_total);

        if($arr_total == 0) {
            $data['row_data'] = 10;
            $data['page'] = 1;
            $data['first_page'] = 1;
            $data['last_page'] = 1;
            $data['arr_med'] = $m_med->get_all_medicine();

            return view('v_show_medicine', $data);
        }

        $row_data = 10;
        $col_page = 10;
        
        $total_page = ceil($arr_total / $row_data);

        if($page < 1 || $page > $total_page) {
            $url = base_url() . "/medicine/show_medicine/1";
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
        $data['arr_med'] = $m_med->get_all_medicine_by_limit($start, $num_row);

        return view('v_show_medicine', $data);
    }

    public function insert_medicine() {
        $med_code = $this->request->getPost('med_code');
        $med_name = $this->request->getPost('med_name');
        $med_price = $this->request->getPost('med_price');
        $med_type = $this->request->getPost('med_type');
        $med_img = $this->request->getFile('med_img');
        
        $url = base_url() . "/medicine/show_medicine";
        $m_med = new M_medicine();
        if($m_med->check_value($med_code, $med_name, $med_img, $med_price, $med_type) == false) {   
            header( "refresh: 0; url=$url" );
            exit(0);
        }
        if($med_img->isValid()) {
            $image_name = $med_img->getRandomName();
            $med_img->move('./picture',$image_name);
            $med_img = $image_name;
        } else {
            header( "refresh: 0; url=$url" );
            exit(0);
        }
        $m_med->insert_medicine($med_code, $med_name, $med_img, $med_price, $med_type);

        header( "refresh: 0; url=$url" );
        exit(0);
    }

    public function edit_medicine() {

        $med_id = $this->request->getPost('med_id');
        $med_code = $this->request->getPost('med_code');
        $med_name = $this->request->getPost('med_name');
        $med_price = $this->request->getPost('med_price');
        $med_type = $this->request->getPost('med_type');
        $med_img = $this->request->getFile('med_img');

        $index_url = base_url();
        if(!isset($med_id) || !isset($med_code) || !isset($med_name) || !isset($med_price) || !isset($med_type) || !isset($med_img)) {        
            header( "refresh: 0; url=$index_url" );
            exit(0);
        } else if($med_code == NULL && $med_name == NULL && $med_price == NULL && $med_type == NULL && $med_img == NULL) {        
            header( "refresh: 0; url=$index_url" );
            exit(0);
        } else if($med_id == NULL) {
            header( "refresh: 0; url=$index_url" );
            exit(0);
        }
        
        $m_med = new M_medicine();

        if($med_img->isValid()) {
            $obj_med = $m_med->get_image_by_id($med_id);
            $img = $obj_med->med_img;
            $path = "picture/" . $img;
            $img_del = unlink($path);

            if($img_del) {
                $image_name = $med_img->getRandomName();
                $med_img->move('./picture',$image_name);
                $med_img = $image_name;

            } else {
                header( "refresh: 0; url=$index_url" );
                exit(0);
            }
        } else {
            $med_img = NULL;
        }

        $m_med->update_medicine($med_id, $med_code, $med_name, $med_img, $med_price, $med_type);

        $url = base_url() . "/medicine/show_medicine";
        header( "refresh: 0; url=$url" );
        exit(0);
        //return redirect()->to('/warehouse/show_medicine');
    }

}