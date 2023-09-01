<!DOCTYPE html>
<html>

<head>
    <title>Register</title>
    <style>
        <?php include 'css/style.css'; ?>
    </style>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {
            function validateForm() {
                var username = document.forms["registerForm"]["username"].value;
                var email = document.forms["registerForm"]["email"].value;
                var password = document.forms["registerForm"]["password"].value;

                if (username === "" || email === "" || password === "") {
                    alert("Tolong Isi Semua");
                    return false;
                }

                return true;
            }

            $("form[name='registerForm']").submit(function (event) {
                event.preventDefault();

                if (!validateForm()) {
                    return;
                }

                var username = $("input[name='username']").val();
                var email = $("input[name='email']").val();
                var password = $("input[name='password']").val();

                // Kirim data registrasi menggunakan AJAX
                $.ajax({
                    type: "POST",
                    url: "backend/register_process.php",
                    data: {
                        username: username,
                        email: email,
                        password: password
                    },
                    success: function (response) {
                        if (response === "success") {
                            alert("Registrasi Sukses. Silahkan Login.");
                            window.location.href = "login.php";
                        } else if (response === "exists") {
                            alert("Username atau Email sudah ada");
                        } else {
                            alert("Registrasi Gagal. Coba Lagi.");
                        }
                    },
                    error: function () {
                        alert("Terjadi kesalahan selama proses Registrasi");
                    }
                });
            });
        });
    </script>
</head>

<body>
    <div class="container">
        <h2 style="text-align: center;">Register</h2>
        <form name="registerForm" method="post" action="register_process.php">
            <input type="text" name="username" placeholder="Username"><br>
            <input type="email" name="email" placeholder="Email"><br>
            <input type="password" name="password" placeholder="Password"><br>
            <input type="submit" name="submit" value="Register" onclick="return validateForm()">
        </form>
        <form action="login.php" method="post">
            <button class="login" type="submit">Login</button>
        </form>
        <form action="../index.php" method="get">
            <button class="btn-back" type="submit">Back to Home</button>
        </form>
    </div>
</body>

</html>