<?php
    include_once __DIR__ . '/layouts/script.php';
?>
<?php
include_once __DIR__ . '/dbconnect.php';
if(isset($_POST['text'])){
   
    $msg=$_POST['text'];
    $query=mysqli_query($conn, "SELECT * FROM question WHERE q_question LIKE '%" . $msg . "%'");
    $count = mysqli_num_rows($query);

    if($count == "0"){
        $data= "I am sorry but i am not exactly clear how to help you";
        $query4= mysqli_query($conn, "INSERT INTO chats
                                        (chats_user, chats_chatbot,chats_action, chats_date)
                                        VALUES ('$msg', '$data','text', NOW())");
    }else{
        while($row= mysqli_fetch_array($query, MYSQLI_ASSOC)){
            $data= $row['q_answer'];
            $action=$row['q_action'];
            $query4= mysqli_query($conn, "INSERT INTO chats
            (chats_user, chats_chatbot,chats_action, chats_date)
            VALUES ('$msg', '$data','$action', NOW())");
        }
    }
}

 //echo '<script>location.href="chatbot.php"</script>'; 
?>