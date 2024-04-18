<?php
namespace App\Models;
use CodeIgniter\Model;

class M_lot extends Model {
    protected $table_emp = "wh_employee";
    protected $table_lot = "wh_lot";
    protected $table_med = "wh_medicine";
    protected $table_moving = "wh_moving";
    protected $table_stat = "wh_status_lot";
    protected $table_type = "wh_type_medicine";

    protected $primaryKey = "lot_id";


    public function get_all_lot() {
        $sql = "SELECT * FROM $this->table_lot";
        return $this->db->query($sql)->getResult();
    }

    public function get_lot_in_warehouse() {
        $sql = "SELECT * FROM $this->table_lot 
                LEFT JOIN $this->table_med ON $this->table_lot.med_id = $this->table_med.med_id
                WHERE $this->table_lot.stat_id = '1'";
        return $this->db->query($sql)->getResult();
    }

    public function get_lot_in_warehouse_by_limit($start, $num) {
        $sql = "SELECT * FROM $this->table_lot 
                LEFT JOIN $this->table_med ON $this->table_lot.med_id = $this->table_med.med_id
                WHERE $this->table_lot.stat_id = '1'
                LIMIT $start, $num";
        return $this->db->query($sql)->getResult();
    }

    public function get_lot_by_id($id) {
        $sql = "SELECT * FROM $this->table_lot WHERE $this->table_lot.lot_id = '$id'";
        return $this->db->query($sql)->getResult();
    }

    public function insert_lot($med_code, $lot_qty, $mfg_date, $exp_date, $total_price) {
        $sql = "SELECT med_id AS med_id FROM $this->table_med WHERE med_code = '$med_code'";
        $ojb_med = $this->db->query($sql)->getRow();
        $med_id = $ojb_med->med_id;

        $sql = "INSERT INTO $this->table_lot VALUES(NULL, '$med_id', '$lot_qty', '$mfg_date', '$exp_date', '$total_price', 1)";
        $this->db->query($sql);;
    }

    public function update_lot_status($lot_id, $stat_id) {
        $sql = "UPDATE $this->table_lot 
                SET $this->table_lot.stat_id = '$stat_id' 
                WHERE $this->table_lot.lot_id = '$lot_id'"; 
        $this->db->query($sql);;
    }

    public function get_last_id() {
        $sql = "SELECT MAX(lot_id) AS lot_id FROM $this->table_lot";
        return $this->db->query($sql)->getRow();
    }
}