<?php
namespace App\Models;
use CodeIgniter\Model;

class M_employee extends Model {
    protected $table_emp = "wh_employee";
    protected $table_lot = "wh_lot";
    protected $table_med = "wh_medicine";
    protected $table_moving = "wh_moving";
    protected $table_stat = "wh_status_lot";
    protected $table_type = "wh_type_medicine";
    //protected $primaryKey = "emp_id";

    public function get_all_employee() {
        $sql = "SELECT * FROM $this->table_emp";
        return $this->db->query($sql)->getResult();
    }

    public function get_employee_id($username) {
        $sql = "SELECT emp_id FROM $this->table_emp WHERE emp_code = '$username'";
        return $this->db->query($sql)->getRow();
    }

    public function get_employee_by_id($id) {
        $sql = "SELECT * FROM $this->table_emp WHERE emp_id = '$id'";
        return $this->db->query($sql)->getRow();
    }

    public function check_login($username, $password) {
        $sql = "SELECT * FROM $this->table_emp 
                WHERE $this->table_emp.emp_code = '$username' AND $this->table_emp.emp_password = '$password'";

        $data['emp'] = $this->db->query($sql)->getResult();

        if(count($data['emp']) == 1) {
            return true;
        } else {
            return false;
        }
    }

    public function change_password($id, $old_pass, $new_pass) {
        $sql = "SELECT * FROM $this->table 
                WHERE $this->table_emp.emp_id = '$id' AND $this->table_emp.emp_password = '$old_pass'";
        
        $data['emp'] = $this->db->query($sql)->getResult();

        if(count($data['emp']) == 1) {
            $sql = "UPDATE $this->table_emp 
                    SET $this->table_emp.emp_password = '$new_pass'
                    WHERE $this->table_emp.emp_id = '$id'";
            $this->db->query($sql);
            return true;
        } else {
            return false;
        }
    }
}