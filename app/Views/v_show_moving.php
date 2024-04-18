<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
	<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Sarabun">
    <style>
        body {
            font-family: Sarabun;
            background-color: 	#F0F0F0;
        }
    </style>
    <title>หน้าแรก</title>
</head>
<body>

    <div class="p-3 mb-3 border-bottom bg-light bg-gradient fixed-top shadow-sm p-3 mb-5 bg-body rounded">
        <div class="container-fluid">
            <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">

                <ul class="nav col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
                    <li><a href="<?php echo base_url()?>" class="nav-link px-2 link-dark fw-bold">หน้าแรก</a></li>
                    <li><a href="<?php echo base_url() . "/medicine/show_medicine" ?>" class="nav-link px-2 link-dark fw-bold">ข้อมูลยา</a></li>
                    <li><a href="<?php echo base_url() . "/moving/show_moving" ?>" class="nav-link px-2 link-primary fw-bold">ประวัติการเคลื่อนย้าย</a></li>
                    <li><a href="<?php echo base_url() . "/warehouse/show_lot" ?>" class="nav-link px-2 link-dark fw-bold">ยาในคลัง</a></li>
                </ul>

                <div class="dropdown text-end">
                    <a href="#" class="d-block link-dark text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-person-circle" style="font-size: 25px;"></i>
                    </a>
                    <ul class="dropdown-menu text-small my-1" aria-labelledby="dropdownUser1">
                        <li><a class="dropdown-item px-3 py-2" href="<?php echo base_url() . "/user/show_profile" ?>"><i class="bi bi-person-lines-fill"></i> ข้อมูลส่วนตัว</a></li>
                        <li><a class="dropdown-item px-3 py-2" href="<?php echo base_url() . "/user/show_change_password" ?>"><i class="bi bi-key"></i> เปลี่ยนรหัสผ่าน</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item px-3 py-2" href="<?php echo base_url() . "/user/logout" ?>"><i class="bi bi-box-arrow-in-left"></i> ออกจากระบบ</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="container" style="height: 100px;"></div>
    <div class="container p-0" >
        <div class="ro">
        <div class="col-6 my-2">
            <form action="">
                <div class="input-group flex-nowrap">
                    <span class="input-group-text p-0" id="addon-wrapping">
                        <select name="med_type" class="form-select form-select-md" aria-label=".form-select-lg example" required>
                            <option value="0" selected >ทั้งหมด</option>
                            <?php for($i = 0; $i < count($opt_stat); $i++) { ?>
                                    <option value="<?php echo $opt_stat[$i]->stat_id ?>"><?php echo $opt_stat[$i]->stat_name ?></option>
                            <?php } ?>
                        </select>
                    </span>   
                    <input type="text" name="search" class="form-control px-3" placeholder="กรอกข้อมูลเพื่อค้นหา" >
                    <span class="input-group-text p-0" id="addon-wrapping"><button type="submit" class="btn btn-primary" style="color: white;" ><i class="bi bi-search"></i> ค้นหา</button></span>   
                </div>
            </form>
            </div>
        </div>
        <table class="table table-bordered ">
            <tr class="table-primary" style="text-align: center; ">
                <th>ลำดับ</th>
                <th>เลขล็อต</th>
                <th>ชื่อยา</th>
                <th>สถานะ</th>
                <th>วัน-เวลา</th>
                <th>ผู้บันทึก</th>
                <th>ปุ่มดำเนินการ</th>
            </tr>
            <?php $count = ($page - 1) * $row_data + 1; ?>
            <?php if (count($arr_moving) >= 1) : for($i = count($arr_moving)-1; $i >= 0; $i--) { 
                $id = "#detailModal" . $i;    
            ?>
            <tr style="text-align: center; background-color: white;">
                <td><?php echo $count; ?></td>
                <td><?php echo $arr_moving[$i]->lot_id; ?></td>
                <td><?php echo $arr_moving[$i]->med_name; ?></td>
                <td><?php echo $arr_moving[$i]->stat_name; ?></td>
                <td><?php echo $arr_moving[$i]->move_date; ?></td>
                <td><?php echo $arr_moving[$i]->emp_name; ?></td>
                <td><button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="<?php echo $id; ?>" style="color: white;"><i class="bi bi-receipt" ></i> ดูข้อมูล</button></td>
            </tr>
            <?php $count++; ?>
            <?php } else : ?>
            <tr>
                <td colspan="9"><?php echo "<p style='text-align:center;'>ไม่มีข้อมูล</p>"; ?></td>
            </tr>
            <?php endif; ?>
        </table>
        <nav aria-label="...">
            <ul class="pagination">
                <?php if($page == 1) { ?>
                    <li class="page-item disabled"><a class="page-link" href="#" tabindex="-1" aria-disabled="true">ย้อนกลับ</a></li>
                <?php } else {?>
                    <li class="page-item"><a class="page-link" href="<?php echo base_url() . "/warehouse/show_moving/".$page - 1 ?>" tabindex="-1" aria-disabled="true">ย้อนกลับ</a></li>
                <?php } ?>

                <?php 
                    for($i=$first_page; $i<=$last_page; $i++) {
                        if($page == $i) { ?>
                            <li class="page-item active"><a class="page-link" href="#"><?php echo $i; ?></a></li>
                <?php   } else { ?>
                            <li class="page-item"><a class="page-link" href="<?php echo base_url() . "/warehouse/show_moving/".$i ?>"><?php echo $i; ?></a></li>
                <?php   } 
            
                    } // end loop?>

                <?php   
                    if($page == $last_page) { ?>
                        <li class="page-item disabled"><a class="page-link" href="#">ถัดไป</a></li>
                <?php } else { ?>              
                    <li class="page-item"><a class="page-link" href="<?php echo base_url() . "/warehouse/show_moving/".$page + 1 ?>">ถัดไป</a></li>
                <?php } ?>
            </ul>
        </nav>
    </div>
    <div class="container" style="height: 100px;"></div>

    <?php for($i = count($arr_moving)-1; $i >= 0; $i--) { 
        $id = "detailModal" . $i;
    ?>
    <div class="modal fade" id="<?php echo $id ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="detailModalLabel" aria-hidden="true">
        <div class="modal-dialog">
           
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="detailModalLabel">รายละเอียดข้อมูล</h5>
                        <button type="reset" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="container">
                            <table class="table table-bordered">
                                <tr class="table-primary"><th colspan="2">ข้อมูลยา</th></tr>
                                <tr>
                                    <td>รหัสยา</td>
                                    <td><?php echo $arr_moving[$i]->med_code; ?></td>
                                </tr>
                                <tr>
                                    <td>ชื่อยา</td>
                                    <td><?php echo $arr_moving[$i]->med_name; ?></td>
                                </tr>
                                <tr>
                            </table>
                           <hr>
                            <table class="table table-bordered">
                                <tr class="table-primary"><th colspan="2"> ข้อมูลล็อต</th></tr>
                                <tr>
                                    <td>เลขล็อต</td>
                                    <td ><?php echo $arr_moving[$i]->lot_id; ?></td>
                                </tr>
                                    <td>จำนวน</td>
                                    <td><?php echo number_format($arr_moving[$i]->lot_qty); ?></td>
                                </tr>
                                <tr>
                                    <td>ราคา</td>
                                    <td><?php echo number_format($arr_moving[$i]->lot_price); ?></td>
                                </tr>
                                <tr>
                                    <td>วันผลิต</td>
                                    <td><?php echo $arr_moving[$i]->lot_msg; ?></td>
                                </tr>
                                <tr>
                                    <td>วันหมดอายุ</td>
                                    <td><?php echo $arr_moving[$i]->lot_exp; ?></td>
                                </tr>
                                <tr>
                            </table>
                        </div>
                    </div>
                </div>
            
        </div>
    </div>
    <?php } ?>
</body>
</html>
</html>
