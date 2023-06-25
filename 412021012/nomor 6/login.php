<?php
session_start();
if(isset($_SESSION['autentikasi'])){
    header("Location: index1.php");
}
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>412021012_Westlee Matthew Agustinus_Autentikasi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <script src="https://code.jquery.com/jquery-3.7.0.js"
        integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script>
</head>

<body>

    <div class="container">
        <h1>Login</h1>
        <h5>412021012_Westlee Matthew Agustinus</h5>
        <form method="POST">
            <div class="mb-3">
                <label for="userid" class="form-label">User_ID</label>
                <input type="text" class="form-control" id="userid" name="iduser">
            </div>
            <div class="mb-3">
                <label for="pw" class="form-label">Password</label>
                <input type="password" class="form-control" id="pw" name="pass">
            </div>
            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="exampleCheck1" onclick="showpass()">
                <label class="form-check-label" for="exampleCheck1">Show Password</label>
            </div>
            <button type="button" class="btn btn-primary" id="tombol" name="klik">Submit</button>
        </form>

        <p id="result"></p>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="inimodal" tabindex="-1" aria-labelledby="inimodalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="inimodalLabel">Terdapat Kesalahan</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p id="pesanmodal"></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">OK</button>
                    <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz"
        crossorigin="anonymous"></script>
</body>

<script>
    function showpass() {
        var passArr = $('#pw');
        if (passArr.attr("type") == "password") {
            passArr.attr("type", "text");
        } else {
            passArr.attr("type", "password");
        }
    }

    $(document).ready(function () {
        $('button').on('click', function () {
            let buathtml = '';
            var input = {
                UID: $('#userid').val(),
                Pass: $('#pw').val(),
            }

            const url = 'backend.php'
            $.ajax({
                url: url,
                type: 'post',
                data: input,
                success: function (response) {
                    if (response == "Autentikasi Berhasil") {
                        alert(response)
                        window.location.replace("index1.php");
                    }
                    else {
                        $("#pesanmodal").html(response);
                        $("#inimodal").modal("show");
                    }
                }
            })
        })

    })
</script>

</html>