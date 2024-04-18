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
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Pridi">
    <style>
        body {
            font-family: Pridi;
            background-color: #F0F0F0;
        }

    </style>
    <title>เข้าสู่ระบบ</title>
</head>
<body>
    <div class="container my-5">
        <div class="row">
            <div class="col-12 my-5">
                <div class="container my-5 p-5 rounded-3 shadow" style="width: 450px; background-color: white;">
                    <h1 style="text-align: center;">ระบบคลังยา</h1><hr>
                    <form action="<?php echo site_url().'/user/check_login'; ?>" method="POST">
                        <p style="color: red; text-align:center;"><?php if(session()->getFlashdata('msg')){ echo session()->getFlashdata('msg'); } ?></p>
                        <div class="input-group mb-3 input-group-lg">
                            <span class="input-group-text" id="inputGroup-sizing-default"><i class="bi bi-person"></i></span>
                            <input type="text" placeholder="ชื่อผู้ใช้งาน" name="username" class="form-control" required>
                        </div>
                        <div class="input-group mb-3 input-group-lg">
                            <span class="input-group-text" id="inputGroup-sizing-default"><i class="bi bi-key"></i></span>
                            <input type="password" placeholder="รหัสผ่าน" name="password" class="form-control" required>
                        </div>
                        <?php if(session()->getFlashdata('token')) { ?>
                            <input type="hidden" name="token" value="<?php echo session()->getFlashdata('token'); ?>">
                        <?php } ?>
                        <div class="d-grid gap-2">
                            <button class="btn btn-primary btn-lg" type="submit">เข้าสู่ระบบ</button>
                        </div>
                    </form>
                </div>  
            </div>
        </div>
    </div>

</body>
</html>