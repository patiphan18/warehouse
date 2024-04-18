<?php
namespace App\Models;
use CodeIgniter\Model;

class M_status_lot extends Model {
    protected $table_stat = "wh_status_lot";
    protected $primaryKey = "stat_id";

    // ดึงข้อมูลสถานะล็อตยาทั้งหมด
    public function get_all_status() {
        $sql = "SELECT * FROM $this->table_stat";
        return $this->db->query($sql)->getResult();
    }
}