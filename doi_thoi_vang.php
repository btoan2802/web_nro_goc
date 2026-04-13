<?php
require_once('core/config.php');
require_once('core/head.php');


if (!isset($_SESSION['logger']['username'])) {
    $thongbao = 'Bạn chưa đăng nhập!';
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
                    setTimeout(function () {
                        window.location.href = "Login";
                    }, 1000);
                }
            });
        }
        ';
    echo '<script>' . $script . '</script>';
    exit;
}

require_once('goldbar_callback.php');

unset($_SESSION["errors"]);
$_username = $_SESSION['logger']['username'];
$sqlk = "SELECT id FROM account WHERE username = '$_username'";
$resultk = $config->query($sqlk);

if ($resultk->num_rows > 0) {
    // Lấy id từ kết quả truy vấn
    $rowk = $resultk->fetch_assoc();
    $accountId = $rowk["id"];
}

$sql = "SELECT vnd FROM account WHERE id = $accountId";
$result = $config->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $vnd = $row['vnd'];
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Xử lý dữ liệu được chọn từ trang web
    $selectedAction = $_POST['selectedAction'];
    $giatien = 0;
    $thoivang = 0;

    switch ($selectedAction) {
        case "action1":
            $giatien = 10000;
            $thoivang = 50;
            break;
        case "action2":
            $giatien = 20000;
            $thoivang = 100;
            break;
        case "action3":
            $giatien = 30000;
            $thoivang = 150;
            break;
        case "action4":
            $giatien = 40000;
            $thoivang = 200;
            break;
        case "action5":
            $giatien = 50000;
            $thoivang = 250;
            break;
        case "action6":
            $giatien = 100000;
            $thoivang = 500;
            break;
        case "action7":
            $giatien = 200000;
            $thoivang = 1000;
            break;
        case "action8":
            $giatien = 500000;
            $thoivang = 3000;
            break;
        case "action9":
            $giatien = 700000;
            $thoivang = 5000;
            break;
        case "action10":
            $giatien = 1000000;
            $thoivang = 10000;
            break;
        case "action11":
            $giatien = 2000000;
            $thoivang = 22000;
            break;
        case "action12":
            $giatien = 5000000;
            $thoivang = 60000;
            break;
        default:
            $giatien = 0;
            $thoivang = 0;
            break;
    }
    if ($giatien != 0 && $thoivang != 0) {
        $thongbao = 'Bạn có chắc chắn muốn đổi 
    <span style="color: red; font-weight: bold;">' . number_format($giatien) . 'VNĐ
    </span> thành <span style="color: blue; font-weight: bold;">' . number_format($thoivang) . ' Thỏi vàng</span>';
        $script = '
    var thongbao = ' . json_encode($thongbao) . ';
    Swal.fire({
        title: "Xác nhận đổi",
        html: thongbao,
        icon: "question",
        showCancelButton: true,
        confirmButtonText: "Đồng ý",
        cancelButtonText: "Hủy",
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
                var giatien = ' . $giatien . ';
                var thoivang = ' . $thoivang . ';
                $.ajax({
                    url: "QuyDoi",
                    method: "POST",
                    data: { giatien: giatien, thoivang: thoivang },
                    success: function(response) {
                        $("body").append(response);
                    }
                });
        } else if (result.dismiss === Swal.DismissReason.cancel) {
            Swal.fire("Đã Huỷ", "Đã huỷ quy đổi!", "info");
            setTimeout(function () {
                window.location.href = "DoiThoiVang";
            }, 2000);
        }
    });
';
        echo '<script>' . $script . '</script>';

    } else {
        $thongbao = 'Bạn chưa chọn mục đổi!';
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
                    window.location.href = "DoiThoiVang";
                }
            });
            setTimeout(function () {
                window.location.href = "DoiThoiVang";
            }, 2000);
        }
        ';
        echo '<script>' . $script . '</script>';
    }
}
?>
<style>
    @media (max-width: 576px) {
        .post-item {
            flex-direction: column;
            align-items: center;
            text-align: center;
        }
        .post-image {
            margin: 0;
        }
        .post-image img {
            width: 80%;
        }
    }
    .announcement {
        background-color: #fff1f0;
        color: #333;
        font-weight: bold;
        margin-bottom: 5px;
        border-radius: 10px;
        border: 3px solid black;
        padding: 5px;
    }

    .announcement-text {
        font-size: 50px;
        font-weight: bold;
        margin: 0;
    }

    .announcement-info {
        font-size: 15px;
        display: none;
        margin-top: 10px;
        background-color: white;
        border: 2px solid white;
        padding: 10px;
        border-radius: 5px;
    }

    .announcement-info.active {
        display: block;
    }

    .row1 {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
    }
</style>

<main>

    <div class="p-1 mt-1 ibox-content"
        style="background-color: rgba(254, 217, 0, 0.9); border-radius: 7px; box-shadow: 0px 2px 5px black;">

        <div class="p-1 text-white">
            <h5 class="h3 mb-3 font-weight-normal text-white"
                style="text-align:center;padding-top: 3px; font-weight: bold; text-shadow: 2px 2px 2px #000;">Đổi Thỏi
                Vàng
            </h5>
            <div class="text-center row1">
                <button class="announcement col-3" onclick="highlightElement(this)" data-action="action1">
                    <div class="announcement-title" style="color:white;">
                        <div class="post-item d-flex align-items-center my-2">
                            <div class="post-image"><img src="/public/images/logo/thoivang.png"
                                    style="width: 50px; margin-left:10px ; margin: 8px; height: auto; object-fit: contain;">
                            </div>
                            <div>
                                <a style="color:blue; ">10.000 Coin<br><span style="color: #fd3500;">50 Thỏi
                                        vàng</span></a>
                            </div>

                        </div>
                    </div>
                </button>
                <button class="announcement col-3" onclick="highlightElement(this)" data-action="action2">
                    <div class="announcement-title" style="color:white;">
                        <div class="post-item d-flex align-items-center my-2">
                            <div class="post-image"><img src="/public/images/logo/thoivang.png"
                                    style="width: 50px;margin-left:10px ; margin: 8px; height: auto; object-fit: contain;">
                            </div>

                            <div>
                                <a style="color:blue; ">20.000 Coin<br><span style="color: #fd3500;">100 Thỏi
                                        vàng</span></a>
                            </div>
                        </div>
                    </div>
                </button>
                <button class="announcement col-3" onclick="highlightElement(this)" data-action="action3">
                    <div class="announcement-title" style="color:white;">
                        <div class="post-item d-flex align-items-center my-2">
                            <div class="post-image"><img src="/public/images/logo/thoivang.png"
                                    style="width: 50px;margin-left:10px ; margin: 8px; height: auto; object-fit: contain;">
                            </div>

                            <div>
                                <a style="color:blue; ">30.000 Coin<br><span style="color: #fd3500;">150 Thỏi
                                        vàng</span></a>
                            </div>
                        </div>
                    </div>
                </button>
                <button class="announcement col-3" onclick="highlightElement(this)" data-action="action4">
                    <div class="announcement-title" style="color:white;">
                        <div class="post-item d-flex align-items-center my-2">
                            <div class="post-image"><img src="/public/images/logo/thoivang.png"
                                    style="width: 50px;margin-left:10px ; margin: 8px; height: auto; object-fit: contain;">
                            </div>

                            <div>
                                <a style="color:blue; ">40.000 Coin<br><span style="color: #fd3500;">200 Thỏi
                                        vàng</span></a>
                            </div>
                        </div>
                    </div>
                </button>
            </div>
            <div class="text-center row1">
                <button class="announcement col-3" onclick="highlightElement(this)" data-action="action5">
                    <div class="announcement-title" style="color:white;">
                        <div class="post-item d-flex align-items-center my-2">
                            <div class="post-image"><img src="/public/images/logo/thoivang.png"
                                    style="width: 50px;margin-left:10px ; margin: 8px; height: auto; object-fit: contain;">
                            </div>

                            <div>
                                <a style="color:blue; ">50.000 Coin<br><span style="color: #fd3500;">250 Thỏi
                                        vàng</span></a>
                            </div>
                        </div>
                    </div>
                </button>
                <button class="announcement col-3" onclick="highlightElement(this)" data-action="action6">
                    <div class="announcement-title" style="color:white;">
                        <div class="post-item d-flex align-items-center my-2">
                            <div class="post-image"><img src="/public/images/logo/thoivang.png"
                                    style="width: 50px;margin-left:10px ; margin: 8px; height: auto; object-fit: contain;">
                            </div>

                            <div>
                                <a style="color:blue; ">100.000 Coin<br><span style="color: #fd3500;">500 Thỏi
                                        vàng</span></a>
                            </div>
                        </div>
                    </div>
                </button>
                <button class="announcement col-3" onclick="highlightElement(this)" data-action="action7">
                    <div class="announcement-title" style="color:white;">
                        <div class="post-item d-flex align-items-center my-2">
                            <div class="post-image"><img src="/public/images/logo/thoivang.png"
                                    style="width: 50px;margin-left:10px ; margin: 8px; height: auto; object-fit: contain;">
                            </div>

                            <div>
                                <a style="color:blue; ">200.000 Coin<br><span style="color: #fd3500;">1.000 Thỏi
                                        vàng</span></a>
                            </div>
                        </div>
                    </div>
                </button>
                <button class="announcement col-3" onclick="highlightElement(this)" data-action="action8">
                    <div class="announcement-title" style="color:white;">
                        <div class="post-item d-flex align-items-center my-2">
                            <div class="post-image"><img src="/public/images/logo/thoivang.png"
                                    style="width: 50px;margin-left:10px ; margin: 8px; height: auto; object-fit: contain;">
                            </div>

                            <div>
                                <a style="color:blue; ">500.000 Coin<br><span style="color: #fd3500;">3.000 Thỏi
                                        vàng</span></a>
                            </div>
                        </div>
                    </div>
                </button>
            </div>

            <div class="text-center row1">
                <button class="announcement col-3" onclick="highlightElement(this)" data-action="action9">
                    <div class="announcement-title" style="color:white;">
                        <div class="post-item d-flex align-items-center my-2">
                            <div class="post-image"><img src="/public/images/logo/thoivang.png"
                                    style="width: 50px;margin-left:10px ; margin: 8px; height: auto; object-fit: contain;">
                            </div>

                            <div>
                                <a style="color:blue; ">700.000 Coin<br><span style="color: #fd3500;">5.000 Thỏi
                                        vàng</span></a>
                            </div>
                        </div>
                    </div>
                </button>
                <button class="announcement col-3" onclick="highlightElement(this)" data-action="action10">
                    <div class="announcement-title" style="color:white;">
                        <div class="post-item d-flex align-items-center my-2">
                            <div class="post-image"><img src="/public/images/logo/thoivang.png"
                                    style="width: 50px;margin-left:10px ; margin: 8px; height: auto; object-fit: contain;">
                            </div>

                            <div>
                                <a style="color:blue; ">1.000.000 Coin<br><span style="color: #fd3500;">10.000 Thỏi
                                        vàng</span></a>
                            </div>
                        </div>
                    </div>
                </button>
                <button class="announcement col-3" onclick="highlightElement(this)" data-action="action11">
                    <div class="announcement-title" style="color:white;">
                        <div class="post-item d-flex align-items-center my-2">
                            <div class="post-image"><img src="/public/images/logo/thoivang.png"
                                    style="width: 50px;margin-left:10px ; margin: 8px; height: auto; object-fit: contain;">
                            </div>

                            <div>
                                <a style="color:blue; ">2.000.000 Coin<br><span style="color: #fd3500;">22.000 Thỏi
                                        vàng</span></a>
                            </div>
                        </div>
                    </div>
                </button>
                <button class="announcement col-3" onclick="highlightElement(this)" data-action="action12">
                    <div class="announcement-title" style="color:white;">
                        <div class="post-item d-flex align-items-center my-2">
                            <div class="post-image"><img src="/public/images/logo/thoivang.png"
                                    style="width: 50px;margin-left:10px ; margin: 8px; height: auto; object-fit: contain;">
                            </div>

                            <div>
                                <a style="color:blue; ">5.000.000 Coin<br><span style="color: #fd3500;">60.000 Thỏi
                                        vàng</span></a>
                            </div>
                        </div>
                    </div>
                </button>
            </div>
            <form method="POST">
                <input type="hidden" id="selectedAction" name="selectedAction">
                <button
                    style="background-color: #FB1B1B; color: white; font-weight: bold; border-radius: 5px; display: block; margin: 0 auto; padding: 15px 20px;">Xác
                    nhận</button>
            </form>
        </div>
        
</main>
<br>

<div class="p-1 mt-1"
		style="background-color: rgba(254, 217, 0, 0.9); border-radius: 7px; box-shadow: 0px 2px 5px black;">

		<div class="atm-body">
			<center>
				<h1 class="h3 mb-3 font-weight-normal text-white"
					style="padding-top: 3px; font-weight: bold; text-shadow: 2px 2px 2px #000;">Lịch Sử đổi Thỏi vàng
				</h1>
			</center>

			<div class="table-responsive">
				<table style="border-collapse: collapse; width: 100%;">
					<thead>
						<tr>
							<th
								style="padding: 8px; text-align: left; border: 1px solid black; background-color: #b8f9f1;font-weight: bold;text-shadow: 2px 2px 2px #fff;">
								STT</th>
							<th
								style="padding: 8px; text-align: left; border: 1px solid black; background-color: #b8f9f1;font-weight: bold;text-shadow: 2px 2px 2px #fff;">
								Tài Khoản</th>
							<th
								style="padding: 8px; text-align: left; border: 1px solid black; background-color: #b8f9f1;font-weight: bold;text-shadow: 2px 2px 2px #fff;">
								Gold Trước</th>
							<th
								style="padding: 8px; text-align: left; border: 1px solid black; background-color: #b8f9f1;font-weight: bold;text-shadow: 2px 2px 2px #fff;">
								Gold Sau</th>
							<th
								style="padding: 8px; text-align: left; border: 1px solid black; background-color: #b8f9f1;font-weight: bold;text-shadow: 2px 2px 2px #fff;">
								VNĐ Trước</th>
							<th
								style="padding: 8px; text-align: left; border: 1px solid black; background-color: #b8f9f1;font-weight: bold;text-shadow: 2px 2px 2px #fff;">
								VNĐ Sau</th>
							<th
								style="padding: 8px; text-align: left; border: 1px solid black; background-color: #b8f9f1;font-weight: bold;text-shadow: 2px 2px 2px #fff;">
								Thời Gian</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$queryk = "SELECT * FROM history_receive_goldbar
								  WHERE history_receive_goldbar.user_name = '" . $_SESSION['logger']['username'] . "'";
						$resultk = $config->query($queryk);
						$stt = 1;
						if ($resultk === false) {
							echo 'Lỗi truy vấn SQL: ' . $config->error;
						} elseif ($resultk->num_rows > 0) {
							while ($rowk = $resultk->fetch_assoc()) {
								echo '<tr>
							  <td style="padding: 8px; text-align: left; border: 1px solid black;background-color: white; font-weight: bold";">' . $stt . '</td>
							  <td style="padding: 8px; text-align: left; border: 1px solid black;background-color: white; font-weight: bold";">' . $rowk['user_name'] . '</td>
							  <td style="padding: 8px; text-align: left; border: 1px solid black;background-color: white; font-weight: bold; color: blue;">' . number_format($rowk['gold_before_receive']) . '</td>
							  <td style="padding: 8px; text-align: left; border: 1px solid black;background-color: white; font-weight: bold; color: #fd3500;">' . number_format($rowk['gold_after_receive']) . '</td>
							  <td style="padding: 8px; text-align: left; border: 1px solid black;background-color: white; font-weight: bold; color: blue;">' . number_format($rowk['vnd_before']) . '</td>
							  <td style="padding: 8px; text-align: left; border: 1px solid black;background-color: white; font-weight: bold; color: #fd3500;">' . number_format($rowk['vnd_after']) . '</td>
							  <td style="padding: 8px; text-align: left; border: 1px solid black;background-color: white; font-weight: bold; color: green;">' . $rowk['time_receive'] . '</td>
							</tr>';
								$stt++;
							}
						} else {
							echo ' <tr>
							  <td colspan="8" align="center"><span style="font-size:100%;font-weight: bold; text-shadow: 2px 2px 2px #000; color:white;"><< Danh sách trống >></span></td>
							</tr>';
						}
						?>
					</tbody>
				</table>
			</div>
		</div>
	</div>

<script>
    var selectedElement = null;

    function highlightElement(element) {
        if (selectedElement !== null) {
            selectedElement.style.backgroundColor = ''; // Xóa màu nền của ô trước đó
        }
        element.style.backgroundColor = '#fcde9b'; // Tô màu nền cho ô được chọn
        selectedElement = element; // Cập nhật ô được chọn
    }

    document.querySelectorAll('.announcement').forEach(item => {
        item.addEventListener('click', function () {
            document.getElementById('selectedAction').value = this.getAttribute('data-action');
        });
    });
</script>

<?php require_once('core/end.php'); ?>