<?php
namespace App\Models;
use CodeIgniter\Model;

class M_medicine extends Model {
    protected $table_emp = "wh_employee";
    protected $table_lot = "wh_lot";
    protected $table_med = "wh_medicine";
    protected $table_moving = "wh_moving";
    protected $table_stat = "wh_status_lot";
    protected $table_type = "wh_type_medicine";

    protected $primaryKey = "med_id";


    public function get_all_medicine() {
        $sql = "SELECT * FROM $this->table_med
                LEFT JOIN $this->table_type 
                ON wh_medicine.type_id = wh_type_medicine.type_id";
                

        return $this->db->query($sql)->getResult();
    }

    public function get_all_medicine_by_limit($start, $num) {
        $sql = "SELECT * FROM $this->table_med
                LEFT JOIN $this->table_type 
                ON wh_medicine.type_id = wh_type_medicine.type_id
                LIMIT $start, $num";      

        return $this->db->query($sql)->getResult();
    }

    public function get_last_id() {
        $sql = "SELECT MAX(med_id) AS med_id FROM $this->table_med";
        return $this->db->query($sql)->getRow();
    }

    public function get_image_by_id($id) {
        $sql = "SELECT med_img AS med_img FROM $this->table_med WHERE med_id = '$id'";
        return $this->db->query($sql)->getRow();
    }

    public function get_price_by_code($code) {
        $sql = "SELECT med_price AS med_price FROM $this->table_med WHERE med_code = '$code'";
        return $this->db->query($sql)->getRow();
    }

    public function insert_medicine($med_code, $med_name, $med_img, $med_price, $med_type) {
        $sql = "INSERT INTO $this->table_med (med_id, med_code, med_name, med_img, med_price, type_id)
                VALUES(NULL, '$med_code', '$med_name', '$med_img', '$med_price', '$med_type')";
        $this->db->query($sql);
    }

    public function update_medicine($med_id, $med_code, $med_name, $med_img, $med_price, $med_type) {
        $count = 0;
        $sql = "UPDATE $this->table_med SET ";

        if ($med_code != NULL) {
            $sql .= "med_code = '$med_code'";
            $count++;
        }

        if ($med_name != NULL) {
            if($count == 0) {
                $sql .= "med_name = '$med_name'";
                $count++;
            } else {
                $sql .= ",med_name = '$med_name'";
                $count++;
            }      
        }

        if ($med_price != NULL) {
            if($count == 0) {
                $sql .= "med_price = '$med_price'";
                $count++;
            } else {
                $sql .= ",med_price = '$med_price'";
                $count++;
            }      
        }

        if ($med_type != NULL) {
            if($count == 0) {
                $sql .= "type_id = '$med_type'";
                $count++;
            } else {
                $sql .= ",med_type = '$med_type'";
                $count++;
            }      
        }

        if ($med_img != NULL) {
            if($count == 0) {
                $sql .= "med_img = '$med_img'";
                $count++;
            } else {
                $sql .= ",med_img = '$med_img'";
                $count++;
            } 
        }

        $sql .= " WHERE med_id = '$med_id'";

        $this->db->query($sql);
    }

    public function check_value($med_code, $med_name, $med_img, $med_price, $med_type) {
        if(is_numeric($med_code) == false || is_numeric($med_price) == false || is_numeric($med_type) == false) {
            return false;
        }

        if(strlen($med_name) < 1 || $med_img->isValid() == false) {
            return false;
        }

        $same_code = "SELECT * FROM $this->table_med WHERE med_code = '$med_code'";
        $data['arr_med'] = $this->db->query($same_code)->getResult();

        if (count($data['arr_med']) >= 1) {
            return false;
        }

        return true;
    }

}