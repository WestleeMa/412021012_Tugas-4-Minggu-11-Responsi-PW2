<?php
require_once 'dbcon.php';
$list = array();
$respon = "";
// if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if(isset($_POST['UID'])){
        $userid = $_POST['UID'];

        if ($userid == ''){
            $respon = "Isi User_ID<br/>";
        }else{
            $queryUser = $conn->prepare("SELECT `User_ID`, `Password` FROM `user` WHERE `User_ID` = ?");

        
            $queryUser->bind_param("s", $userid);
            $queryUser->execute();
            $data = $queryUser->get_result();
    
            if($data->num_rows > 0){
                while ($result = $data->fetch_assoc()){
                    $list[] = $result;
                }
    
                if(isset($_POST['Pass'])){
    
                    $pass = $_POST['Pass'];
                    if($pass == ''){
                        $respon = "Isi kolom password<br/>";
                    }else{
                        if($list[0]["Password"] === $pass){
                            $respon = "Autentikasi Berhasil<br/>";
                        }
                        else{
                            $respon = "Password salah<br/>";
                        }
                    }

                }
            }
            else{
                $respon = "User tidak terdaftar<br/>";
            }
        }
        echo($respon);
        $inijson = json_encode($list);
        echo($inijson);
    }
    
// }
?>