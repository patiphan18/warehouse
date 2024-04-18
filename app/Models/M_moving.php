<?php
namespace App\Models;
use CodeIgniter\Model;

class M_moving extends Model {
    protected $table_emp = "wh_employee";
    protected $table_lot = "wh_lot";
    protected $table_med = "wh_medicine";
    protected $table_moving = "wh_moving";
    protected $table_stat = "wh_status_lot";
    protected $table_type = "wh_type_medicine";
    
    protected $moving_key = "move_id";

    public function get_all_moving() {
        $sql = "SELECT * FROM $this->table_moving
        LEFT JOIN $this->table_lot ON $this->table_moving.lot_id = $this->table_lot.lot_id 
        LEFT JOIN $this->table_med ON $this->table_lot.med_id = $this->table_med.med_id
        LEFT JOIN $this->table_emp ON $this->table_moving.emp_id = $this->table_emp.emp_id
        LEFT JOIN $this->table_stat ON $this->table_moving.stat_id = $this->table_stat.stat_id";
        return $this->db->query($sql)->getResult();
    }

    public function get_last_id() {
        $sql = "SELECT MAX(move_id) AS move_id FROM $this->table_moving";
        return $this->db->query($sql)->getRow();
    }

    public function get_moving_by_range($max, $min) {
        $sql = "SELECT * FROM $this->table_moving 
            LEFT JOIN $this->table_lot ON $this->table_moving.lot_id = $this->table_lot.lot_id 
            LEFT JOIN $this->table_med ON $this->table_lot.med_id = $this->table_med.med_id
            LEFT JOIN $this->table_emp ON $this->table_moving.emp_id = $this->table_emp.emp_id
            LEFT JOIN $this->table_stat ON $this->table_moving.stat_id = $this->table_stat.stat_id
            WHERE $this->table_moving.move_id <= '$max' AND $this->table_moving.move_id > '$min'";
        return $this->db->query($sql)->getResult();
    }

    public function get_moving_by_limit($start, $num) {
        $sql = "SELECT * FROM $this->table_moving 
            LEFT JOIN $this->table_lot ON $this->table_moving.lot_id = $this->table_lot.lot_id 
            LEFT JOIN $this->table_med ON $this->table_lot.med_id = $this->table_med.med_id
            LEFT JOIN $this->table_emp ON $this->table_moving.emp_id = $this->table_emp.emp_id
            LEFT JOIN $this->table_stat ON $this->table_moving.stat_id = $this->table_stat.stat_id
            LIMIT $start, $num";
        return $this->db->query($sql)->getResult();
    }

    public function get_moving_by_id($id) {
        $sql = "SELECT * FROM $this->table_moving 
            LEFT JOIN $this->table_lot ON $this->table_moving.lot_id = $this->table_lot.lot_id 
            LEFT JOIN $this->table_med ON $this->table_lot.med_id = $this->table_med.med_id
            LEFT JOIN $this->table_emp ON $this->table_moving.emp_id = $this->table_emp.emp_id
            LEFT JOIN $this->table_stat ON $this->table_moving.stat_id = $this->table_stat.stat_id
            WHERE $this->table_moving.move_id == '$id'";
        return $this->db->query($sql)->getResult();
    }

    public function insert_im_history($lot_id, $emp_id) {
        date_default_timezone_set("Asia/Bangkok");
        $now = date("Y-m-d H:i:s");

        $sql = "INSERT INTO $this->table_moving VALUES(NULL, '$lot_id', $emp_id, 1, '$now')";
        $this->db->query($sql);
    }

    public function insert_ex_history($lot_id, $emp_id, $stat_id) {
        date_default_timezone_set("Asia/Bangkok");
        $now = date("Y-m-d H:i:s");

        $sql = "INSERT INTO $this->table_moving VALUES(NULL, '$lot_id', $emp_id, $stat_id, '$now')";
        $this->db->query($sql);
    }

}