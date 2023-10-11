<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HOME</title>
    <link rel="stylesheet" href="/ct258-tmdt/css/home.css">
    <?php include_once __DIR__ . '/layouts/style.php'; ?>
</head>
<body>
    <!--Start Header-->
    <?php
    include_once __DIR__ . '/layouts/header.php';
    ?>

    


    <!--Start Main-->
    <div class="container">
        <h3 class="lienhe-title">Liên Hệ</h3>
        <div class="container text-center">
            <div class="row">
                <div class="lienhe-address col-4">
                    <span><b>Địa chỉ:</b>Xuân Khánh, Ninh Kiều, Cần Thơ</span><br>
                    <span><b>Điện thoại:</b>(+84)16011996</span><br>
                    <span><b>info:</b>kumainfo@gmail.com</span>
                </div>
                <div class="col">
                    <form action="">
                        <div class="lienhe-container form-group ">
                            <div class="row">
                                <div class="col-3">
                                    <label for="">Name:</label>
                                </div>
                                <div class="col">
                                    <input type="text" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="lienhe-container form-group ">
                            <div class="row">
                                <div class="col-3">
                                    <label for="">Email:</label>
                                </div>
                                <div class="col">
                                    <input type="email" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="lienhe-container form-group ">
                            <div class="row">
                                <div class="col-3">
                                    <label for="">Số điện thoại:</label>
                                </div>
                                <div class="col">
                                    <input type="text" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="lienhe-container form-group ">
                            <div class="row">
                                <div class="col-3">
                                    <label for="">Message:</label>
                                </div>
                                <div class="col">
                                    <textarea class="form-control"></textarea>
                                </div>
                            </div>
                        </div>
                        <button class="btnSend lienhe-container btn-primary ">Gửi</button>
                    </form>
                </div>
            </div>
        </div>
        <iframe class="map" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3928.841518442541!2d105.76803501018243!3d10.029933690035627!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31a0895a51d60719%3A0x9d76b0035f6d53d0!2zVHLGsOG7nW5nIMSQ4bqhaSBo4buNYyBD4bqnbiBUaMah!5e0!3m2!1svi!2s!4v1696044820184!5m2!1svi!2s" 
             allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>
    <!--Start Footer-->
    <?php
    include_once __DIR__ . '/layouts/footer.php';
    ?>

    <?php
    include_once __DIR__ . '/layouts/script.php';
    ?>

    
</body>
</html>