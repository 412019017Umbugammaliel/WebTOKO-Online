<!DOCTYPE html>
<html>

<head>
    <title>Login</title>
    <style>
        <?php include 'css/style.css'; ?>
    </style>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        function validateForm() {
            var username = document.forms["loginForm"]["username"].value;
            var password = document.forms["loginForm"]["password"].value;

            if (username === "" || password === "") {
                alert("Tolong isi semua field");
                return false;
            }

            return true;
        }

        $(document).ready(function () {
            $("form[name='loginForm']").submit(function (event) {
                event.preventDefault(); // Menghentikan pengiriman form secara default

                if (!validateForm()) {
                    return; // Mencegah pengiriman form jika validasi gagal
                }

                var username = $("input[name='username']").val();
                var password = $("input[name='password']").val();

                // Kirim data login menggunakan AJAX
                $.ajax({
                    type: "POST",
                    url: "./backend/login_process.php",
                    data: {
                        username: username,
                        password: password
                    },
                    success: function (response) {
                        if (response === "success") {
                            window.location.href = "dashboard.php";
                        } else {
                            alert("Username or password is incorrect");
                        }
                    },
                    error: function () {
                        alert("Terjadi kesalahan saat Login");
                    }
                });
            });
        });
    </script>
</head>

<body>
    <div class="container">
        <h2 style="text-align: center;">Login</h2>
        <form name="loginForm" method="post" action="login_process.php">
            <input type="text" name="username" placeholder="Username"><br>
            <input type="password" name="password" placeholder="Password"><br>
            <input type="submit" name="submit" value="Login" class="btn" style="margin-bottom: 10px;">
        </form>
        <form name="registerForm" action="register.php" method="post" onsubmit="return validateRegisterForm()">
            <button class="register" type="submit">Register</button>
        </form>
        <form action="../index.php" method="get">
            <button class="btn-back" type="submit">Back to Home</button>
        </form>
    </div>
</body>

</html>