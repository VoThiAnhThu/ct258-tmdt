<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="/ct258-tmdt/css/home.css">
    <?php include_once __DIR__ . '/layouts/style.php'; ?>
</head>
<body>
    <!--Start Header-->
    <?php
    include_once __DIR__ . '/layouts/header.php';
    ?>

    <span id= "ref">
        <div class="square">
            <h2 style="margin:20px;">Chat Messages</h2>
            <br/>
            <?php
            include_once __DIR__ . '/dbconnect.php';
            $query = "SELECT * FROM chats ORDER BY chats_date DESC";
            $res= mysqli_query($conn, $query);
            while($data= mysqli_fetch_array($res, MYSQLI_ASSOC)){
                $chats_user= $data['chats_user'];
                $chats_chatbot= $data['chats_chatbot'];
                $chats_date= $data['chats_date'];

                $chats_action= $data['chats_action'];
            
            ?>

            <?php if($chats_action=='text'){ ?>
            <div class="container1" style="position: relative; left: 20%;">
                <img src="/ct258-tmdt/assets/img/customer.png" atl="avatar" style="width:5%;"/>
                <span id="message"><?= $chats_user; ?></span><br>
                <span class="time-right"><?= $chats_date; ?></span>
            </div>
            <div class="container1 darker" style="position: relative;left: 70%;">
                <img src="/ct258-tmdt/assets/img/customer_icon.png" atl="avatar" class="right" style="width:5%;"/>
                <span ><?= $chats_chatbot; ?></span><br>
                <span class="time-left"><?= $chats_date; ?></span>
            </div>
            <?php }else { ?>
            <div class="container1" style="position: relative; left: 20%;">
                <img src="/ct258-tmdt/assets/img/customer.png" atl="avatar" style="width:5%;"/>
                <span id="message"><?= $chats_user; ?></span><br>
                <span class="time-right"><?= $chats_date; ?></span>
            </div>
            <div class="container1 darker" style="position: relative; left: 70%;">
                <img src="/ct258-tmdt/assets/img/customer_icon.png" atl="avatar" class="right" style="width:5%;"/>
                <span ><?php eval($chats_chatbot); ?></span><br>
                <span class="time-left"><?= $chats_date; ?></span>
            </div>
            <?php } ?>

            
            <?php } ?>
            <div class="sticky">
                <div class="row">
                    <div class="col-md-2"></div>
                    <div style="margin-top:15px" class="col-md-8">
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" id="msg"/>
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary" type="button" onclick="send()">Send</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </span>
    <!--Start Footer-->
    <?php
    include_once __DIR__ . '/layouts/footer.php';
    ?>

    <?php
    include_once __DIR__ . '/layouts/script.php';
    ?>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script type="text/javascript">
        function send() {
            var text = $('#msg').val().toLowerCase();
            
            $.ajax({
                type: "POST",
                url: "mysearch.php",
                data: { text: text },
                success: function(data) {
                    // Xử lý dữ liệu trả về từ mysearch.php
                    // Ví dụ: cập nhật nội dung của phần tử có id là "ref" với dữ liệu trả về
                    $("#ref").html(data);
                },
                // error: function(xhr, status, error) {
                //     // Xử lý lỗi nếu có
                //     console.log("Lỗi khi gửi yêu cầu: " + error);
                // }
            });
            setTimeout(function() {
            location.reload();
            }, 1000);
        }
        // Sử dụng setTimeout để gọi hàm reload sau một khoảng thời gian (ví dụ: 5000ms hoặc 5 giây)
        


    </script>
    
</body>
</html>
