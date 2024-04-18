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
    <title>เปลี่ยนรหัสผ่าน</title>
</head>
<body>
    
    <div class="p-3 mb-3 border-bottom bg-light bg-gradient fixed-top shadow-sm p-3 mb-5 bg-body rounded">
        <div class="container-fluid">
                <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">

                <ul class="nav col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
                    <li><a href="<?php echo base_url()?>" class="nav-link px-2 link-dark fw-bold">หน้าแรก</a></li>
                    <li><a href="<?php echo base_url() . "/medicine/show_medicine" ?>" class="nav-link px-2 link-dark fw-bold">ข้อมูลยา</a></li>
                    <li><a href="<?php echo base_url() . "/moving/show_moving" ?>" class="nav-link px-2 link-dark fw-bold">ประวัติการเคลื่อนย้าย</a></li>
                    <li><a href="<?php echo base_url() . "/warehouse/show_lot" ?>" class="nav-link px-2 link-primary fw-bold">ยาในคลัง</a></li>
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
    <div class="container">
        <div class="row">
            <div class="col"></div>
            <div class="col-5">
                <div class="container my-5 p-5 rounded" style="background-color: white;">
                    <h4 style="text-align: center;">เปลี่ยนรหัสผ่าน</h4>
                    <hr>
                    <form method="POST">
                        <div class="mb-2">
                            <label class="form-label">รหัสผ่านเก่า:</label>
                            <input type="password" name="old_pass" class="form-control" required>
                        </div>
                        <div class="mb-2">
                            <label class="form-label">รหัสผ่านใหม่:</label>
                            <input type="password" name="new_pass" class="form-control" required>
                        </div>
                        <div class="mb-2">
                            <label class="form-label">ยืนยันรหัสผ่านใหม่:</label>
                            <input type="password" name="confirm_pass" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-primary">เปลี่ยนรหัสผ่าน</button>
                    </form>
                </div>
            
            </div>
            <div class="col"></div>
        </div>
    
    </div>
    
</body>
</html>