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
                        <div class="post-image"><img src="/public/images/logo/goku.png"
                                style="width: 55px;margin-left:10px ; margin: 8px; height: auto; object-fit: contain;">
                        </div>
                        <div>
                            <a class="fw-bold">Giải thích Cơ chế Game</a>
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
                    <span style="color: blue; font-weight: bold; font-size: 15px;">I. Thông tin đệ</span><br>
                    -Đệ tử Mabu : Săn Boss mabu nhận trứng nở ra Đệ tử Mabu <br>              
				    -Đệ tử Berus :tăng 20% chỉ số hợp thể,Đệ tử ngộ không : tăng 30% chỉ số hợp thể  <br>
                    -Đệ tử bup bê :tăng 40% chỉ số hợp thể <br>
                    <br><br>

                    <span style="color: blue; font-weight: bold; font-size: 15px;">II. Chi tiết</span><br>
                    <span style="color: red; font-weight: bold;">1.hệ thống trang bị:</span><br>
                    -sét KH up ở 3 máp đầu làng  <br>
                    -thần linh,hủy diệt,thiên sứ <br>
                    - trang bị thiên sứ trong hộp thiên sứ cũ có chỉ số ẩn tấn công lên các hành tinh<br>
                    -Set kích hoạt thiên sứ trao quà cho các top đua<br>
                    -sét chi tinh (20% chỉ số cộng thêm) xuất hiện ở các mốc nạp và đua top.<br>
				    - sét chí tôn thiết kế cho top nạp và mua ở npc chí tôn(40%chỉ số cộng thêm)<br><br>
				    - CÓ THỂ NÂNG CẤP CẢI TRANG,LINH THÚ,PÉT<br><br>

                    <span style="color: red; font-weight: bold;">2.Kiếm vàng và hồng ngọc cho dân cày:</span><br>
                    -có máp up thỏi vàng cho ae cày chay " căn cứ rapberry,thung lũng rapbery,thung lũng chết  <br>
                    -có map up hồng ngọc  là làng bunma(gặp npc pocolo đảo kame),và 3 máp bên nhẫn thời không nha <br>
					
                    <br><br>

                    <span style="color: red; font-weight: bold;">3.Cách kiếm các vật phẩm thông dụng:</span><br>
                    -Đồ thần ,Đồ Huỷ diệt:săn Boss <br>    
                    -Đồ Thiên sứ : <br><br>

                    <span style="color: blue; font-weight: bold; font-size: 15px;">III.NGUYÊN LIỆU NÂNG CẤP </span><br>
					
                    <span style="color: red; font-weight: bold;">4.Thông tin khác:</span><br>
					- BOSS BLACK GOKU RƠI SPL 4%SD,6%HP,KI <br>
					- BOSS BLACK GOKU tương lai rơi nhẫn thời không(qua bên đó up hn dc nhiều hơn)<br>
					- BOSS THỎI VÀNG VÀ HỒNG NGỌC CHO AE DÂN CÀY <br>
					- BOSS LỢN RỪNG RƠI ĐÁ BÓNG TỐI <br>
					- BOSS FIRE Vàng có TỈ LỆ RƠI CN SIÊU CẤP,BH,BK,GIÁP XÊN<br>
					- BOSS BABIWIGHT RƠI ĐAN<br>
					- BOSS liễu thần rơi đan<br>
					- BOSS SKH rơi hộp thiên sứ mới<br>
					- BOSS siêu goku blu rơi thỏi vàng,hn<br>
					- BOSS androi rơi 5-6-7-bổ huyết,bổ khí,giáp xên,cồng nộ<br>
					- BOSS thần hủy diệt champa rơi hộp thiên sứ mới <br>
					- BOSS maverl rơi 2 sao,BOSS kẻ giữ sao rơi 1 sao,BOSS vĩ thú rơi nr 1-7 sao<br>
					- BOSS thần zama tối thượng rơi hộp thầy giáo,hộp thiên sứ cũ<br>
					-up đá lưu hồn nâng cấp đệ ở map up đá lưu hồn(npc pocolo)<br>
					-up
                    -Tuyệt kĩ : Đánh mộc nhân rơi Bí kíp tuyệt kĩ lên Whis Hành tinh Kaio học <br>
 
                    -Chỉ số Bông tai Max : C2 là 15%, C3 là 24%  <br>
                    -Mảnh vỡ BT và mảnh hồn up map 123 Lãnh địa bang <br>
                    -Đồ max 8 sao và 8 cấp,SỨC ĐÁNH BẢN NÀY CÓ THỂ TĂNG VÔ HẠN NHỜ LONG LỰC ĐAN(100SD) <br>
                    -Pha lê hoá được Cải trang, Giáp luyện tập và Đồ <br>
                    -6 ô cuối hành trang lần lượt là : Pet, Danh hiệu ,cánh, Thú cưỡi, Linh thú, Chân mệnh
                  
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