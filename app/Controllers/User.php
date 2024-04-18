<?php
namespace App\Controllers;

use App\Models\M_employee;
use App\Models\M_medicine;
use App\Models\M_status_lot;
use App\Models\M_moving;
use App\Models\M_lot;
use App\Models\M_type_medicine;
use CodeIgniter\HTTP\RequestInterface;

class User extends BaseController {

    public function index() {
         return view('index');
    }

    public function show_profile() { 
        $m_emp = new M_employee();
        $session = session();
        $emp['id'] = $session->get('emp_id');
        $data['arr_emp'] = $m_emp->get_employee_by_id($emp['id']->emp_id);
        return view('v_show_profile', $data);
    }

    // หน้าเปลี่ยนรหัสผ่าน
    public function show_change_password() { 
        $m_emp = new M_employee();
        $session = session();
        $emp['id'] = $session->get('emp_id');
        $data['arr_emp'] = $m_emp->get_employee_by_id($emp['id']->emp_id);
        return view('v_show_change_password', $data);
    }

    public function change_password() { 
        $old_pass = $this->request->getPost('old_pass');
        $new_pass = $this->request->getPost('new_pass');
        $confirm_pass = $this->request->getPost('confirm_pass');

        $session = session();

        if(!isset($old_pass) || !isset($new_pass) || !isset($confirm_pass)) {
            $session->setFlashdata('error', 'เกิดข้อผิดพลาด');
            $url = base_url() . "/warehouse/show_change_password";
            header( "refresh: 0; url=$url" );
            exit(0);
        }

        if($new_pass != $confirm_pass) {
            $session->setFlashdata('error', 'รหัสผ่านใหม่ไม่ตรงกัน');
            $url = base_url() . "/warehouse/show_change_password";
            header( "refresh: 0; url=$url" );
            exit(0);
        }

        $hash_old_pass = hash('sha256', $old_pass);
        $hash_new_pass = hash('sha256', $new_pass);

        $m_emp = new M_employee();
        $emp['id'] = $session->get('emp_id');

        if($m_emp->change_password($emp['id']->emp_id, $hash_old_pass, $hash_new_pass) == true) {
            $session->setFlashdata('success', 'เปลี่ยนรหัสผ่านสำเร็จ');
            $url = base_url() . "/warehouse/show_change_password";
            header( "refresh: 0; url=$url" );
            exit(0);
        }

        $session->setFlashdata('error', 'เปลี่ยนรหัสผ่านไม่สำเร็จ');
        $url = base_url() . "/warehouse/show_change_password";
        header( "refresh: 0; url=$url" );
        exit(0);
    }

    // หน้าเข้าสู่ระบบ
    public function show_login() {
        $session = session();
        if($session->get('emp_id')) {
            $url = base_url();
            header( "refresh: 0; url=$url" );
            exit(0);
        } 
        $rand_token = openssl_random_pseudo_bytes(16);
        $rand_token = bin2hex($rand_token);
 
        $session->setFlashdata('token', $rand_token);

        return view('v_show_login');
    }

    public function check_login() {
        
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');
        $token = $this->request->getPost('token');

        $session = session();
        $login_url = base_url() . "/user/show_login";

        if(!isset($username) || !isset($password) || !isset($token)) { 
            $session->setFlashdata('msg', 'เกิดข้อผิดพลาดในการเข้าสู่ระบบ');     
            
            header( "refresh: 0; url=$login_url" );
            exit(0);
        } else if(strlen($username) < 1 || strlen($password) < 1) {
            $session->setFlashdata('msg', 'ชื่อผู้ใช้งานหรือรหัสผ่านไม่ถูกต้อง');

            header( "refresh: 0; url=$login_url" );
            exit(0);
        }
        
        if($token != $session->getFlashdata('token')) {
            $session->setFlashdata('msg', 'เกิดข้อผิดพลาดในการเข้าสู่ระบบ');

            header( "refresh: 0; url=$login_url" );
            exit(0);
        }

        $hash_pass = hash('sha256', $password);

        $m_emp = new M_employee();
        

        if($m_emp->check_login($username, $hash_pass) == true) {
            $employee_id = $m_emp->get_employee_id($username);
            $ses_data = [
                'emp_id' => $employee_id,
                'logged_in' => TRUE
            ];
            $session->set($ses_data);
            $base_url = base_url();
            header( "refresh: 0; url=$base_url" );
            exit(0);
            //return redirect()->to('/index');
        } else {
            $session->setFlashdata('msg', 'ชื่อผู้ใช้งานหรือรหัสผ่านไม่ถูกต้อง');
            //return redirect()->to('warehouse/show_login');

            header( "refresh: 0; url=$login_url" );
            exit(0);
        }


        return view('index');
    }

    // ออกจากระบบ
    public function logout() {
        $session = session();
        $session->destroy();
        $login_url = base_url() . "/user/show_login";
        header( "refresh: 0; url=$login_url" );
        exit(0);
       //return redirect()->to('warehouse/show_login');
    }

}