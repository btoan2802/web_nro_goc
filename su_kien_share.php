<?php
require_once ('core/config.php');
require_once ('core/head.php');
?>
<style>
    .announcement {
        background-color: #fff6c4;
        color: #333;
        font-weight: bold;
        margin-bottom: 10px;
        border-radius: 7px;
        border: 3px solid black;
        padding: 5px;
    }

    .announcement-text {
        font-size: 50px;
        font-weight: bold;
        margin: 0;
    }

    .announcement p {
        margin: 0;
    }

    .announcement-info {
        font-size: 15px;
        margin-top: 10px;
        background-color: white;
        border: 2px solid white;
        padding: 10px;
        border-radius: 5px;
    }

    .ent-info {
        font-size: 12px;
        margin-top: 10px;
        background-color: white;
        border: 2px solid white;
        padding: 10px;
        border-radius: 5px;
    }

    .row1 {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        /* Canh giữa các thẻ trong dòng */
        padding 10px;
    }
</style>

<main>

    <script>
        window.addEventListener('resize', function () {
            const buttons = document.getElementsByClassName('auto-resize');
            for (let i = 0; i < buttons.length; i++) {
                const button = buttons[i];
                const fontSize = parseInt(window.getComputedStyle(button, null).getPropertyValue('font-size'));
                const buttonWidth = button.offsetWidth;
                const textWidth = button.scrollWidth;
                if (textWidth > buttonWidth) {
                    button.style.fontSize = (fontSize - 1) + 'px';
                }
            }
        });
        window.dispatchEvent(new Event('resize'));
    </script>

    <div class="p-1 mt-1 ibox-content"
        style="background-color: rgba(254, 217, 0, 0.9); border-radius: 7px; box-shadow: 0px 2px 5px black;">

        <div class="p-1 text-white">
            <div class="announcement">
                <div class="announcement-title" style="color:white;">
                    <div class="post-item d-flex align-items-center my-2">
                        <div class="post-image"><img src="/public/images/icon/share.png"
                                style="width: 55px;margin-left:10px ; margin: 8px; height: auto; object-fit: contain;">
                        </div>
                        <div>
                            <a class="fw-bold">Sự kiện Share Bài viết Nhận code</a>
                            <div class="text-muted font-weight-bold">Đăng bởi <span
                                    style="color: red;">Admin</span><span class="fb-comments-count"
                                    data-href="#"></span></div>
                        </div>
                        <div class="post-image">
                            <img src="/public/images/logo/new.gif"
                                style="width: 80% ; margin-left: 10px; margin: 8px; height: auto; object-fit: contain; float: left;">
                        </div>
                    </div>
                </div>
                <div id="info1" class="ent-info">
					<div class="post-image">
                            <img src="/public/images/logo/new.gif"
                                style="width: 5% ; margin-left: 10px; margin: 8px; height: auto; object-fit: contain; float: left;">
                        </div><span style="color: red; font-weight: bold; font-size: 15px;">Diễn ra từ: 18/02/2025 đến hết ngày 01/03/2025</span><br><br>
                    <span style="color: blue; font-weight: bold; font-size: 15px;">Cách thức Tham gia</span><br><br>
                    🎖️Bước 1: Tham gia Cộng đồng Zalo Ngọc rồng  BT - Dame Gốc <br>
                    🎖️Bước 2: Copy bài "🧧🧧Ngọc rồng Ngọc rồng  BT - Dame Gốc🧧🧧" tại ghim (Gồm cả hình) lên 1 nhóm chia sẽ game, game lậu,...
					trên 1.000 Thành viên vào các nhóm Facebook ở chế độ Công khai <br>
					<span style="color: red; font-weight: bold;">(*Lưu ý: chỉ share bài ở Nhóm Facebook trên 1.000 Thành viên mới được tính Thành công)</span><br>
					<img src="/public/images/icon/hinh1.jpg" alt="Hình bài đăng 1" style="width: 100%; max-width: 180px; margin-top: 10px;"><br><br>
                    🎖️Bước 3: Đợi duyệt bài viết, Sau đó chụp ảnh màn hình bài đăng gửi Key Vàng <br>
					🎖️Bước 4: Ibox "Tên nhân vật trong Game" cho Key Vàng <br>
					<span style="color: red; font-weight: bold;">(Khi mình tim tin nhắn hoặc trả lời bạn tức là đã phát code)</span><br>
					🎖️Bước 5: Vào website Đăng nhập tài khoản vào, bấm vào nút "Danh sách Giftcode Riêng" để xem mã <br>
					<img src="/public/images/icon/hinh2.jpg" alt="Hình bài đăng 2" style="width: 100%; margin-top: 10px;"><br><br>
					🎖️Bước 6: Vào game tại npc nhà, bấm vào nút cuối "Nhập Code Riêng" để nhập mã
					<img src="/public/images/icon/hinh3.jpg" alt="Hình bài đăng 3" style="width: 100%; margin-top: 10px;"><br><br>
					<span style="color: red; font-weight: bold; font-size: 15px;">🎁 Phần thưởng: Giftcode 10 Hộp đồ thần linh🎁</span><br>
					<span style="color: red; font-weight: bold; font-size: 15px;">(Mỗi người chỉ nhận được 1 Lần)</span><br>
                </div>
            </div>
        </div>
    </div>
</main>

<br>

<?php require_once ('core/end.php'); ?>


<script type="text/javascript">
    $(document).ready(function () {
        $('#Noti_Home').modal('show');
    })
</script>
<?php require_once ('core/end.php'); ?>