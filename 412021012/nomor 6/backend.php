<?php
session_start();
require_once 'dbcon.php';
$list = array();
$respon = "";
// if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if(isset($_POST['UID'])){
        $userid = $_POST['UID'];

        if ($userid == ''){
            $respon = "Isi User_ID";
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
                        $respon = "Isi kolom password";
                    }else{
                        if($list[0]["Password"] === $pass){
                            $respon = "Autentikasi Berhasil";
                            $_SESSION['autentikasi'] = true;
                        }
                        else{
                            $respon = "Password salah";
                        }
                    }

                }
            }
            else{
                $respon = "User tidak terdaftar";
            }
        }
        echo($respon);
    }
    
// }
?>