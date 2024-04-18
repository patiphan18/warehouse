<?php
namespace App\Models;
use CodeIgniter\Model;

class M_type_medicine extends Model {
    protected $table_type = "wh_type_medicine";
    protected $primaryKey = "type_id";

    // ดึงข้อมูลประเภทยาทั้งหมด
    public function get_all_type() {
        $sql = "SELECT * FROM $this->table_type";
        return $this->db->query($sql)->getResult();
    }
}