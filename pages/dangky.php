<?php
require_once('../core/config.php');
require_once('../core/head.php');

$thongbao = null;

if (isset($_SESSION['logger']['username'])) {
	echo '<script>window.location.href = "/";</script>';
	exit();
}
//echo '<div class="p-1 mt-1  "
//    style="background-color: rgba(254, 217, 0, 0.9); border-radius: 7px; box-shadow: 0px 2px 5px black;">
//    <center>
//        <h1 class="h3 mb-3 font-weight-normal text-white"
//            style="padding-top: 15px; font-weight: bold; text-shadow: 2px 2px 2px #000;">
//            Chức năng đang tạm thời Bảo trì. Mở vào lúc 19h Ngày 18/02/2025
//        </h1>
//    </center>
//</div>';
//require_once('../core/end.php');
//exit;

if (isset($_POST['submit']) && !empty($_POST['username']) && !empty($_POST['password']) && !empty($_POST['captcha_code'])) {
	$username = mysqli_real_escape_string($config, $_POST['username']);
	$password = mysqli_real_escape_string($config, $_POST['password']);
	$repassword = mysqli_real_escape_string($config, $_POST['repassword']); // Nhập lại mật khẩu mới
	$captcha_input = trim($_POST['captcha_code']);
	$vndd = 0;

	// Kiểm tra CAPTCHA
	if ($password !== $repassword) {
		$thongbao = 'Mật khẩu nhập lại không khớp. Vui lòng thử lại!';
	} else if (!isset($_SESSION["captcha"]) || $captcha_input !== $_SESSION["captcha"]) {
		$thongbao = 'Mã CAPTCHA không đúng! Hãy nhập đúng chữ hoa và chữ thường.';
	} else {
		// Xóa CAPTCHA sau khi kiểm tra
		unset($_SESSION["captcha"]);

		// Kiểm tra username và password hợp lệ
		if (!preg_match('/^[a-zA-Z0-9]+$/', $username)) {
			$thongbao = 'Tên người dùng không hợp lệ!';
		} elseif (!preg_match('/^[a-zA-Z0-9]+$/', $password)) {
			$thongbao = 'Mật khẩu không hợp lệ!';
		} else {
			// Kiểm tra username đã tồn tại chưa
			$stmt = mysqli_prepare($config, "SELECT * FROM account WHERE username = ?");
			mysqli_stmt_bind_param($stmt, "s", $username);
			mysqli_stmt_execute($stmt);
			$result = mysqli_stmt_get_result($stmt);

			if (mysqli_num_rows($result) > 0) {
				$thongbao = 'Tài khoản đã tồn tại!';
			} else {
				// Mã hóa mật khẩu
				// $hashed_password = password_hash($password, PASSWORD_BCRYPT);

				// Lưu vào CSDL
				$stmt = mysqli_prepare($config, "INSERT INTO account (username, password, vnd, tongnap) VALUES (?, ?, ?, ?)");
				mysqli_stmt_bind_param($stmt, "ssii", $username, $password, $vndd, $vndd);
				mysqli_stmt_execute($stmt);

				echo '<script>
                    Swal.fire({
                        title: "Thành Công",
                        html: "Đăng ký thành công!",
                        icon: "success",
                        confirmButtonText: "Đóng"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = "Login";
                        }
                    });
                </script>';
				exit();
			}
		}
	}

	// Hiển thị thông báo lỗi nếu có
	if ($thongbao) {
		echo '<script>
            Swal.fire({
                title: "Thất Bại",
                html: ' . json_encode($thongbao) . ',
                icon: "error",
                confirmButtonText: "Đóng"
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "Register";
                }
            });
        </script>';
	}
}
?>

<main>
	<div style="background-color: rgba(254, 217, 0, 0.9); border-radius: 7px; box-shadow: 0px 2px 5px black;"
		class="pb-1">
		<form class="text-center col-lg-5 col-md-10" style="margin: auto; padding: 20px;" method="post" action="">
			<h1 class="h3 mb-3 font-weight-normal text-white"
				style="padding-top: 3px; font-weight: bold; text-shadow: 2px 2px 2px #000;">Đăng Kí</h1>
			<!-- Tên tài khoản -->
		<input style="height: 50px; border-radius: 15px; font-weight: bold;" name="username" required autofocus
			   type="text" class="form-control mt-1" placeholder="Tên tài khoản">

		<!-- Mật khẩu -->
		<div style="position: relative;">
			<input style="height: 50px; border-radius: 15px; font-weight: bold; padding-right: 40px;"
				   name="password" required type="password" id="password"
				   class="form-control mt-1" placeholder="Mật khẩu">
			<span onclick="togglePassword('password', this)"
				  class="password-toggle">👁️</span>
		</div>

		<!-- Nhập lại mật khẩu -->
		<div style="position: relative;">
			<input style="height: 50px; border-radius: 15px; font-weight: bold; padding-right: 40px;"
				   name="repassword" required type="password" id="repassword"
				   class="form-control mt-1" placeholder="Nhập lại Mật khẩu">
			<span onclick="togglePassword('repassword', this)"
				  class="password-toggle">👁️</span>
		</div>
			<center>
				<div style="display: flex; align-items: center; gap: 10px; justify-content: center; margin-top: 7px;">
					<input style="height: 40px; border-radius: 10px; font-weight: bold; flex: 1; max-width: 200px;"
						type="text" name="captcha_code" required class="form-control mt-1"
						placeholder="Nhập mã CAPTCHA">
					<img src="Captcha" alt="CAPTCHA" style="border-radius: 5px; height: 40px; cursor: pointer; pointer-events: none;"
						id="captcha_img">
				</div>
			</center>

			<div class="text-center mt-1">
				<button class="btn btn-lg btn-dark btn-block" style="<?= $nutdangnhapdangkiTO; ?>" type="submit"
					name="submit" onmouseover="<?= $onmouseover; ?>" onmouseout="<?= $onmouseout; ?>">Đăng Kí</button>
			</div>
		</form>
	</div>
</main>
<style>
    /* Định dạng biểu tượng mắt */
    .password-toggle {
        position: absolute;
        top: 50%;
        right: 10px;
        transform: translateY(-50%);
        cursor: pointer;
        font-size: 20px;
        user-select: none;
    }

    /* Thêm gạch chéo khi mật khẩu bị ẩn */
    .password-toggle.hidden::after {
        content: '';
        position: absolute;
        top: 50%;
        left: 10%;
        width: 80%;
        height: 2px;
        background: black;
        transform: rotate(45deg);
        transform-origin: center;
    }
</style>
<script>
    function togglePassword(inputId, icon) {
        const inputField = document.getElementById(inputId);

        // Thay đổi loại input giữa password và text
        if (inputField.type === 'password') {
            inputField.type = 'text';
            icon.classList.add('hidden'); // Thêm lớp "hidden" để hiển thị gạch chéo
        } else {
            inputField.type = 'password';
            icon.classList.remove('hidden'); // Gỡ lớp "hidden" để bỏ gạch chéo
        }
    }

    // Làm mới CAPTCHA khi click vào ảnh
    document.getElementById("captcha_img").addEventListener("click", function() {
        this.src = "captcha.php?" + Date.now();
    });
</script>


<?php require_once('../core/end.php'); ?>