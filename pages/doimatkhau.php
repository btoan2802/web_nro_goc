<?php 

require_once('../core/config.php'); 
require_once('../core/head.php'); 

$thongbao = null;

// Kiểm tra người dùng đã đăng nhập hay chưa
if (!isset($_SESSION['logger']['username'])) {
    header('Location: login.php');
    exit;
}

// Xử lý khi người dùng nhấn nút "Thực hiện"
if (isset($_POST['submit']) && !empty($_POST['oldpassword']) && !empty($_POST['newpassword']) && !empty($_POST['repassword'])) {
    $username = $_SESSION['logger']['username']; // Lấy tên đăng nhập từ session
    $oldpassword = $_POST['oldpassword']; // Lấy mật khẩu cũ
    $newpassword = $_POST['newpassword']; // Lấy mật khẩu mới
    $repassword = $_POST['repassword']; // Nhập lại mật khẩu mới

    // Kiểm tra mật khẩu mới và nhập lại mật khẩu mới có trùng khớp không
    if ($newpassword !== $repassword) {
        $thongbao = '<span style="color: red; font-size: 12px; font-weight: bold;">Mật khẩu mới không khớp. Vui lòng thử lại!</span>';
    } else {
        // Truy vấn cơ sở dữ liệu để kiểm tra mật khẩu cũ
        $sql = "SELECT password FROM account WHERE username = '$username' AND password = '$oldpassword'";
        $result = mysqli_query($config, $sql);

        if ($result && mysqli_num_rows($result) > 0) {
            // Cập nhật mật khẩu mới trong cơ sở dữ liệu
            $sql1 = "UPDATE account SET password = '$newpassword' WHERE username = '$username'";
            if (mysqli_query($config, $sql1)) {
                $thongbao = '<span style="color: green; font-size: 12px; font-weight: bold;">Đã đổi mật khẩu thành công. Vui lòng đăng nhập lại!</span>';
                echo '<script>window.location.href = "Logout";</script>';
            } else {
                $thongbao = '<span style="color: red; font-size: 12px; font-weight: bold;">Lỗi khi đổi mật khẩu. Vui lòng thử lại!</span>';
            }
        } else {
            $thongbao = '<span style="color: red; font-size: 12px; font-weight: bold;">Mật khẩu cũ không đúng!</span>';
        }
    }
} else {
    if (isset($_POST['submit'])) {
        $thongbao = '<span style="color: red; font-size: 12px; font-weight: bold;">Vui lòng điền đầy đủ thông tin!</span>';
    }
}

?>
<main>
    <div style="background-color: rgba(254, 217, 0, 0.9); border-radius: 7px; box-shadow: 0px 2px 5px black;" class="pb-1">
        <form class="text-center col-lg-5 col-md-10" style="margin: auto; padding: 20px;" method="post" action="">
            <center>
                <h1 class="h3 mb-3 font-weight-normal text-white" style="padding-top: 3px; font-weight: bold; text-shadow: 2px 2px 2px #000;">Đổi Mật Khẩu</h1>
            </center>
            <?=$thongbao;?>
            
            <!-- Nhập mật khẩu cũ -->
            <div style="position: relative;">
                <input style="height: 50px; border-radius: 15px; font-weight: bold; padding-right: 40px;" 
                       name="oldpassword" required="" type="password" id="oldpassword" 
                       class="form-control mt-1" placeholder="Mật khẩu cũ">
                <span onclick="togglePassword('oldpassword', this)" 
                      class="password-toggle">
                      👁️
                </span>
            </div>

            <!-- Nhập mật khẩu mới -->
            <div style="position: relative;">
                <input style="height: 50px; border-radius: 15px; font-weight: bold; padding-right: 40px;" 
                       name="newpassword" required="" type="password" id="newpassword" 
                       class="form-control mt-1" placeholder="Mật khẩu mới">
                <span onclick="togglePassword('newpassword', this)" 
                      class="password-toggle">
                      👁️
                </span>
            </div>

            <!-- Nhập lại mật khẩu mới -->
            <div style="position: relative;">
                <input style="height: 50px; border-radius: 15px; font-weight: bold; padding-right: 40px;" 
                       name="repassword" required="" type="password" id="repassword" 
                       class="form-control mt-1" placeholder="Nhập lại mật khẩu mới">
                <span onclick="togglePassword('repassword', this)" 
                      class="password-toggle">
                      👁️
                </span>
            </div>

            <div class="text-center mt-1">
                        <button class="btn btn-lg btn-dark btn-block" style="<?=$nutdangnhapdangkiTO;?>"
                                type="submit" name="submit" onmouseover="<?=$onmouseover;?>" onmouseout="<?=$onmouseout;?>">Thực Hiện</button>
                                
                    </div>
        </form>
    </div>
</main>
<?php require_once('../core/end.php'); ?>

<!-- CSS -->
<style>
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

<!-- JavaScript -->
<script>
    // Hàm bật/tắt hiển thị mật khẩu và thay đổi biểu tượng
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
</script>
