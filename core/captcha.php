<?php
session_start();

// Kiểm tra xem thư viện GD có được bật không
if (!extension_loaded('gd')) {
    die("Lỗi: PHP chưa bật thư viện GD.");
}

// Tạo mã CAPTCHA gồm chữ thường, chữ hoa và số (tránh ký tự dễ nhầm lẫn)
$captcha_code = substr(str_shuffle("abcdefghjkmnpqrstuvwxyzABCDEFGHJKLMNPQRSTUVWXYZ23456789"), 0, 6);
$_SESSION["captcha"] = $captcha_code;

// Cấu hình ảnh
$width = 200;
$height = 60;
$image = imagecreatetruecolor($width, $height);

// Màu sắc
$bg_color = imagecolorallocate($image, 255, 255, 255); // Nền trắng
$text_color = imagecolorallocate($image, 0, 0, 0); // Chữ đen
$noise_color = imagecolorallocate($image, 150, 150, 150); // Xám nhạt

// Đổ nền trắng
imagefilledrectangle($image, 0, 0, $width, $height, $bg_color);

// Thêm nhiễu chấm nhỏ
for ($i = 0; $i < 100; $i++) {
    imagesetpixel($image, rand(0, $width), rand(0, $height), $noise_color);
}

// Thêm đường chéo nhiễu
// for ($i = 0; $i < 5; $i++) {
//     imageline($image, rand(0, $width), rand(0, $height), rand(0, $width), rand(0, $height), $noise_color);
// }

// Đường dẫn font chữ Birdgo.ttf (đảm bảo file font nằm trong cùng thư mục)
$font = __DIR__ . "/The-Fruit-Star.ttf";
if (!file_exists($font)) {
    die("Lỗi: Không tìm thấy font chữ The-Fruit-Star.ttf tại " . $font);
}

// Vẽ CAPTCHA với font Birdgo
$font_size = 28; // Cỡ chữ lớn
$x = 20;
$y = 45; // Điều chỉnh để chữ hiển thị đúng
for ($i = 0; $i < strlen($captcha_code); $i++) {
    // $angle = rand(-15, 15); // Xoay nhẹ từng chữ
    imagettftext($image, $font_size, 0, $x, $y, $text_color, $font, $captcha_code[$i]);
    $x += 25; // Giãn cách các ký tự
}

// Xuất ảnh PNG
header("Content-Type: image/png");
imagepng($image);
imagedestroy($image);
?>
