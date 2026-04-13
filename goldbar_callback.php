<?php
require_once('core/config.php');
include('set.php');

unset($_SESSION["errors"]);

$giatien = $_POST['giatien'];
$thoivang = $_POST['thoivang'];

$_username = $_SESSION['logger']['username'];
$sqlk = "SELECT * FROM account WHERE username = '$_username'";
$resultk = $config->query($sqlk);

if ($resultk->num_rows > 0) {
    // Lấy id từ kết quả truy vấn
    $rowk = $resultk->fetch_assoc();
    $accountId = $rowk["id"];
}

$sql = "SELECT * FROM account WHERE id = $accountId";
$result = $config->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $vnd = $row['vnd'];
}

if ($giatien != 0 && $thoivang != 0) {
    if ($vnd >= $giatien) {

        $sql_gold = "INSERT INTO `history_receive_goldbar` (`player_id`, `user_name`, `gold_before_receive`, `gold_after_receive`, `vnd_before`, `vnd_after`) 
                VALUES ('" . $rowk['id'] . "', '" . $rowk['username'] . "', '" . $row['thoi_vang'] . "', '" . $row['thoi_vang'] + $thoivang . "', '" . $row['vnd'] . "', '" . $row['vnd'] - $giatien . "')";
        $result_gold = $config->query($sql_gold);

        $sql = "UPDATE account SET account.vnd = account.vnd - $giatien WHERE account.username = '$_username'";
        $result = $config->query($sql);

        $sqlk = "UPDATE account SET account.thoi_vang = account.thoi_vang + $thoivang WHERE account.username = '$_username'";
        $resultk = $config->query($sqlk);
        if ($result === TRUE) {
            $thongbao = 'Nhận Thành công <span style="color: blue; font-weight: bold;">' . number_format($thoivang) . ' Thỏi vàng</span>';
            $script = '
                var thongbao = ' . json_encode($thongbao) . ';
                if (thongbao !== "") {
                    Swal.fire({
                        title: "Thành Công",
                        html: thongbao,
                        icon: "success",
                        confirmButtonText: "Đóng"
                    });
                    setTimeout(function () {
                        window.location.href = "DoiThoiVang";
                    }, 2000);
                }
                ';
            echo '<script>' . $script . '</script>';
        } else {
            $thongbao = '<span style="color: red; font-size: 12px; font-weight: bold;">Xảy ra lỗi!</span>';
        }
    } else {
        $thongbao = 'Bạn không đủ ' . $giatien . ' VNĐ!';
        $script = '
            var thongbao = ' . json_encode($thongbao) . ';
            if (thongbao !== "") {
                Swal.fire({
                    title: "Thất bại",
                    html: thongbao,
                    icon: "error",
                    confirmButtonText: "Đóng",
                    allowOutsideClick: () => Swal.getConfirmButton().click()
                }).then((result) => {
                    if (result.isConfirmed) {
                    }
                });
            }
            ';
        echo '<script>' . $script . '</script>';
    }
}

?>