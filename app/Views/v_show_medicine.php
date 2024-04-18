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
                    <li><a href="<?php echo base_url() . "/medicine/show_medicine" ?>" class="nav-link px-2 link-primary fw-bold">ข้อมูลยา</a></li>
                    <li><a href="<?php echo base_url() . "/moving/show_moving" ?>" class="nav-link px-2 link-dark fw-bold">ประวัติการเคลื่อนย้าย</a></li>
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
        <div class="row">
            <div class="col-6 my-2">
            <form action="">
                <div class="input-group flex-nowrap">
                    <input type="text" name="search" class="form-control px-3" placeholder="กรอกข้อมูลเพื่อค้นหา" >
                    <span class="input-group-text p-0" id="addon-wrapping"><button type="submit" class="btn btn-primary" style="color: white;" ><i class="bi bi-search"></i> ค้นหา</button></span>   
                </div>
            </form>
            </div>
            <div class="col-6 my-2">           
                <button type="button" style="float: right;" class="btn btn-primary" style="color: white;"  data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@mdo"><i class="bi bi-box-arrow-in-down"></i> เพิ่มข้อมูลยา</button>
            </div>
        </div>
        <table class="table table-bordered ">
            <tr class="table-primary" style="text-align: center; ">
                <th>รหัสยา</th>
                <th>ภาพยา</th>
                <th>ชื่อยา</th>
                <th>ราคา</th>
                <th>หมวดหมู่ยา</th>
                <th>ปุ่มดำเนินการ</th>
            </tr>
            <?php if (count($arr_med) >= 1) : for($i = count($arr_med)-1; $i >= 0; $i--) { ?>
            <?php $id = "#editModal" . $i ?>
            <tr style="text-align: center; background-color: white;">
                <td><?php echo $arr_med[$i]->med_code ?></td>
                <td><img width=100px src="<?php echo base_url() . '/picture/'. $arr_med[$i]->med_img ?>"></td>
                <td><?php echo $arr_med[$i]->med_name ?></td>
                <td><?php echo $arr_med[$i]->med_price ?></td>
                <td><?php echo $arr_med[$i]->type_name ?></td>
                <td><button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="<?php echo $id;?>" style="color: white;"><i class="bi bi-pencil-fill"></i> แก้ไข</button></td>
            </tr>
            <?php } else : ?>
            <tr>
                <td colspan="6"><?php echo "<p style='text-align:center;'>ไม่มีข้อมูล</p>"; ?></td>
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

    <div class="modal fade" id="exampleModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form method="POST" action="<?php echo site_url().'/medicine/insert_medicine'; ?>" enctype="multipart/form-data">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">เพิ่มข้อมูลยา</h5>
                        <button type="reset" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="container">

                            <div class="input-group mb-3">
                                <span class="input-group-text" id="addon-wrapping" style="width: 100px;">หมวดหมู่</span>   
                                <select name="med_type" class="form-select form-control form-select-md " required>
                                    <option selected value="" disabled>เลือกหมวดหมู่ยา</option>
                                    <?php for($j = 0; $j < count($opt_med_type); $j++) { ?>
                                        <option value="<?php echo $opt_med_type[$j]->type_id ?>"><?php echo $opt_med_type[$j]->type_name ?></option>
                                    <?php } ?>
                                </select>
                            </div>

                            <div class="input-group mb-3">
                                <span class="input-group-text" style="width: 100px;">รหัสยา</span>
                                <input type="text" class="form-control" name="med_code" placeholder="กรอกรหัสยา" required>
                            </div>
                            <div class="input-group mb-3">
                                <span class="input-group-text" style="width: 100px;">ชื่อยา</span>
                                <input type="text" class="form-control" name="med_name"  placeholder="กรอกชื่อยา" required>
                            </div>
                            <div class="input-group mb-3">
                                <span class="input-group-text" style="width: 100px;">ราคา</span>
                                <input type="text" class="form-control" name="med_price" placeholder="กรอกราคายา" required>
                            </div>
                            <div class="mb-3">
                                <label for="formFile" class="form-label">ภาพยา:</label>
                                <input class="form-control" value="" name="med_img" type="file" accept="image/png, image/jpeg" id="formFile" required>
                            </div>
                            <div class="modal-footer">
                                <button type="reset" class="btn btn-secondary" data-bs-dismiss="modal">ยกเลิก</button>
                                <button type="submit" class="btn btn-primary">บันทึก</button>
                            </div>              
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <?php for($i = count($arr_med)-1; $i >= 0; $i--) { ?>
    <?php $id = "editModal" . $i ?>
    <div class="modal fade" id="<?php echo $id;?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        
        <div class="modal-dialog">
            <form method="POST" action="<?php echo site_url() . '/medicine/edit_medicine'; ?>" enctype="multipart/form-data">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel">แก้ไขข้อมูลยา</h5>
                        <button type="reset" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                    <div class="container">

                        <div class="input-group mb-3">
                            <span class="input-group-text" id="addon-wrapping" style="width: 100px;">หมวดหมู่</span>   
                            <select name="med_type" class="form-select form-control form-select-md ">
                                <option selected value=""><?php echo $arr_med[$i]->type_name ?></option>
                                <?php for($j = 0; $j < count($opt_med_type); $j++) { ?>
                                    <option value="<?php echo $opt_med_type[$j]->type_id ?>"><?php echo $opt_med_type[$j]->type_name ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        
                        <div class="input-group mb-3">
                            <span class="input-group-text" style="width: 100px;">รหัสยา</span>
                            <input type="text" class="form-control" name="med_code" placeholder="<?php echo $arr_med[$i]->med_code ?>">
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text" style="width: 100px;">ชื่อยา</span>
                            <input type="text" class="form-control" name="med_name"  placeholder="<?php echo $arr_med[$i]->med_name ?>">
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text" style="width: 100px;">ราคา</span>
                            <input type="text" class="form-control" name="med_price" placeholder="<?php echo $arr_med[$i]->med_price ?>">
                        </div>
                        <div class="mb-3">
                            <label for="formFile" class="form-label">ภาพยา:</label>
                            <input class="form-control" value="" name="med_img" type="file" accept="image/png, image/jpeg" id="formFile">
                        </div>
                        <input type="hidden" name="med_id" value="<?php echo $arr_med[$i]->med_id ?>">
                        <div class="modal-footer">
                            <button type="reset" class="btn btn-secondary" data-bs-dismiss="modal">ยกเลิก</button>
                            <button type="submit" class="btn btn-primary">บันทึก</button>
                        </div>              
                    </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <?php } ?>
</body>
</html>
</html>