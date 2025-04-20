<?php 
session_start();
if(isset($_SESSION['IDKH']))
$idkh = $_SESSION['IDKH'];
else 
header("location:dangnhap.html");
$conn = mysqli_connect('localhost','root','','web_db');
$sql0 = "SELECT * FROM kh WHERE IDKH = '$idkh'";
$result0 = $conn->query($sql0);
$row0 = $result0->fetch_assoc(); 
?>
<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Ashion Template">
    <meta name="keywords" content="Ashion, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ashion with Fashion</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Cookie&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800;900&display=swap"
    rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="css/elegant-icons.css" type="text/css">
    <link rel="stylesheet" href="css/jquery-ui.min.css" type="text/css">
    <link rel="stylesheet" href="css/magnific-popup.css" type="text/css">
    <link rel="stylesheet" href="css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="css/slicknav.min.css" type="text/css">
    <link rel="stylesheet" href="css/style.css" type="text/css">
    <link rel="stylesheet" href="css/test1.css" type="text/css">

</head>

<body>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

    <!-- Offcanvas Menu Begin -->
    <div class="offcanvas-menu-overlay"></div>
    <div class="offcanvas-menu-wrapper">
        <div class="offcanvas__close">+</div>
        <ul class="offcanvas__widget">
            <li><span class="icon_search search-switch"></span></li>
        </ul>
        <div class="offcanvas__logo">
            <a href="./index.html"><img src="img/logo.png" alt=""></a>
        </div>
        <div id="mobile-menu-wrap"></div>
        <div class="offcanvas__auth">
            <a href="#">Đăng Nhập</a>
            <a href="#">Đăng Kí</a>
        </div>
    </div>
    <!-- Offcanvas Menu End -->

    <!-- Header Section Begin -->
    <?php include 'header.php' ?>
    <!-- Header Section End -->


    <!-- Breadcrumb Begin -->
    <div class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__links">
                        <a href="/index.php"><i class="fa fa-home"></i> Trang chủ</a>
                        <span>Giỏ hàng</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->
    <!--123-->
    
    <div style="width:90%;margin-left:80px;" class="cart-container">
        <table>
            <thead>
                <tr>
                    <th>Sản Phẩm</th>
                    <th>Thong tin Sản Phẩm</th>
                    <th>Giá</th>
                    <th>Số Lượng</th>
                    <th>Tổng(Tạm tính )</th>
                    <th>Chỉnh sửa đơn hàng</th>
                </tr>
            </thead>
            <?php
            $userCartCookie = "cart_" . $_SESSION["IDKH"];
            print_r($_COOKIE);
            if(!isset($_COOKIE[$userCartCookie]))
            echo '<td colspan="6" style="padding: 50px;"><h4>Bạn chưa thêm sản phẩm nào.</h4></td>';
            else{
            $usercart = json_decode($_COOKIE[$userCartCookie],true);
            foreach($usercart as $productid=>$quantity) { 
                $sql = "SELECT * FROM sp WHERE IDSP = $productid";
            $result = $conn->query($sql);    
            $row = $result->fetch_assoc();
            ?>
            <tbody>
                <tr>
                    <td>
                        <div class="product__item__pic1 set-bg" data-setbg="<?php echo $row['URL']; ?>"></div>
                    </td>
                    <td><?php echo $row['TEN']; ?></td>
                    <td><?php echo number_format($row['GIABANKM'],0,"",".") ."đ"; ?></td>
                    <td>
                    <input type="number" value="<?php echo $quantity; ?>" min="1" class="quantity-input"
                        data-productid="<?php echo $productid; ?>"
                        data-price="<?php echo $row['GIABANKM']; ?>"
                        oninput="updateRowTotal(this)">
                    </td>
                    <td class="total-price"><?php echo number_format(($row['GIABANKM'] * $quantity),0,"",".") ."đ"; ?></td>
                    <td> 
                    <button onclick="removeItem('<?php echo $productid; ?>', this)">Xóa</button>
                        <script>function removeItem(productId, button) {
                        let row = button.closest("tr"); // Find the row of the item
                        row.remove(); // Remove the row from the table

                        alert("Sản phẩm đã xóa khỏi giỏ hàng.");

                        // Remove from cookie using AJAX
                        let xhr = new XMLHttpRequest();
                        xhr.open("POST", "remove_from_cart.php", true);
                        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                        xhr.send("productId=" + productId);

                        }
                    </script>
                    </td>
                </tr>
            </tbody>
            <?php }
            }
            ?>
        </table>
        <script>
        function updateRowTotal(input) {
    let price = parseFloat(input.dataset.price);  // Get price
    let quantity = parseInt(input.value);         // Get updated quantity
    let productId = input.dataset.productid;      // Get product ID
    let row = input.closest("tr");                // Locate the row
    let totalCell = row.querySelector(".total-price"); // Locate total price cell

    if (totalCell) {
        let total = price * quantity;
        totalCell.textContent = formatNumber(total) + "đ"; // Format total price
    }


    // Send update request to server
    updateCookieQuantity(productId, quantity);
}

// Format number with thousand separators
function formatNumber(num) {
    return num.toLocaleString('vi-VN'); // Formats number with dots (Vietnamese locale)
}

// Send request to update cookie in PHP
function updateCookieQuantity(productId, quantity) {
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "update_cart.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.send("productId=" + productId + "&quantity=" + quantity);
}
        </script>
        <div id="notification" class="notification">Đã xóa sản phẩm</div>
        <div class="cart-total">
            <a href="sanpham.php">
                <button id="return">Tiếp tục mua sắm</button>
            </a>
        </div>
    <!--123-->
    <!-- Checkout Section Begin -->
    <section class="checkout spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <!--h6 class="coupon__link"><span class="icon_tag_alt"></span> <a href="#">Have a coupon?</a> Click
                    here to enter your code.</h6>-->
                </div>
            </div>
            <form action="#" class="checkout__form">
                <div class="row">
                    <div class="col-lg-8">
                        <h5>Chi tiết hóa đơn</h5>
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="checkout__form__input">
                                    <p>Họ Tên<span>*</span></p>
                                    <input type="text" value="<?php echo $row0['NAME'];?>" >
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="checkout__form__input">
                                    <p>Số Điện Thoại  <span>*</span></p>
                                    <input type="text" value="<?php echo $row0['SDT'];?>" >
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="checkout__form__input">
                                    <p>Địa chỉ <span>*</span></p>
                                    <input type="text" value="<?php echo $row0['DC'];?>" placeholder="Địa chỉ nhà " >
                                </div>
                            </div>
                            
                            <div class="col-lg-12">
                                <div class="checkout__form__input">
                                    <p>Ghi chú đặt hàng <span>*</span></p>
                                    <input type="text"
                                    placeholder="Lưu ý về đơn đặt hàng của bạn, ví dụ: thông báo đặc biệt khi giao hàng">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="checkout__order">
                                <h5>Đơn của bạn </h5>
                                <div class="checkout__order__product">
                                    <ul>
                                        <li>
                                            <span class="top__text">Sản phẩm</span>
                                            <span class="top__text__right">Đơn giá</span>
                                        </li>
                                        <?php
                                        $count = 1;
                                        $tong_gio_hang = 0;
                                        foreach ($usercart as $productid => $quantity) {
                                            $sql = "SELECT * FROM sp WHERE IDSP = '$productid'";
                                            $result = $conn->query($sql);
                                            $row = $result->fetch_assoc();
                                            echo "<li>" . $count . ". " . $row['TEN'] . "<span>" . number_format($row['GIABANKM'],0,"",".") . "đ" . "</span></li>";
                                            $tong_gio_hang += $quantity*$row['GIABANKM'];
                                            $count++;
                                        }
                                        ?>
                                    </ul>
                                </div>
                                <div class="checkout__order__total">
                                    <ul>
                                        <li>Tổng <span><?php echo number_format($tong_gio_hang,0,"",".");?>VND</span></li>
                                    </ul>
                                </div>
                                <div class="checkout__order__widget">
                                    
                                    <label for="check-payment">
                                        Thanh toán khi nhận hàng 
                                        <input type="checkbox" id="check-payment" name="payment" onclick="selectOnly(this)">
                                        <span class="checkmark"></span>
                                    </label>
                                    <label for="paypal">
                                        Chuyển khoản
                                        <input type="checkbox" id="paypal" name="payment" onclick="selectOnly(this)">
                                        <span class="checkmark"></span>
                                    </label>
                                    <label for="card">
                                        Thanh toán bằng thẻ 
                                        <input type="checkbox" id="card" name="payment" onclick="selectOnly(this)">
                                        <span class="checkmark"></span>
                                    </label>
                                    
                                    <script>
                                        function selectOnly(selectedCheckbox) {
                                            const checkboxes = document.querySelectorAll('input[name="payment"]');
                                            checkboxes.forEach(checkbox => {
                                                if (checkbox !== selectedCheckbox) {
                                                    checkbox.checked = false;
                                                }
                                            });
                                        }
                                    </script>
                                    
                                    <div class="card-info" id="card-info">
                                        <div class="form-group">
                                            <label for="card-name">Tên trên thẻ:</label>
                                            <input type="text" id="card-name" placeholder="Nhập tên trên thẻ" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="card-number">Số thẻ:</label>
                                            <input type="text" id="card-number" placeholder="Nhập số thẻ" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="card-expiry">Ngày hết hạn (MM/YY):</label>
                                            <input type="text" id="card-expiry" placeholder="MM/YY" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="card-cvv">CVV:</label>
                                            <input type="text" id="card-cvv" placeholder="Nhập CVV" required>
                                        </div>
                                    </div>
                                </div>
                                <td> 
                                    <button onclick="dathang()" class="site-btn">Đặt hàng</button>
                                    <script>
                                        function dathang() {
                                            const paymentMethods = document.querySelectorAll('input[name="payment"]');
                                            let paymentSelected = false;
                                            let selectedMethod = "";

                                            // Check if any payment method is selected
                                            paymentMethods.forEach(method => {
                                                if (method.checked) {
                                                    paymentSelected = true;
                                                    selectedMethod = method.id; // Store the selected payment method
                                                }
                                            });

                                            // If no payment method is selected, show an alert
                                            if (!paymentSelected) {
                                                alert("Vui lòng chọn phương thức thanh toán trước khi đặt hàng!");
                                                return;
                                            }

                                            // If "Thanh toán bằng thẻ" is selected, check if all fields are filled
                                            if (selectedMethod === "card") {
                                                const cardFields = ["card-name", "card-number", "card-expiry", "card-cvv"];
                                                let allFilled = true;

                                                cardFields.forEach(field => {
                                                    let input = document.getElementById(field);
                                                    if (!input.value.trim()) {
                                                        allFilled = false;
                                                        input.style.border = "2px solid red"; // Highlight empty fields
                                                    } else {
                                                        input.style.border = ""; // Reset border if filled
                                                    }
                                                });

                                                if (!allFilled) {
                                                    alert("Vui lòng điền đầy đủ thông tin thẻ trước khi đặt hàng!");
                                                    return;
                                                }
                                                    
                                            }
                                            <?php
                                            //turn cart cookie into json 
                                            $cartItems = json_decode($_COOKIE[$userCartCookie] ?? "{}", true);
                                            //check if cart cookie empty
                                            if (empty($cartItems)) {
                                                die("Giỏ hàng trống, không thể tạo đơn hàng.");
                                            }
                                            // Calculate total amount
                                            $tongTien = 0;
                                            foreach ($cartItems as $productId => $quantity) {
                                                $query = "SELECT GIABANKM FROM sp WHERE IDSP = ?";
                                                $stmtSP = $conn->prepare($query);
                                                $stmtSP->bind_param("i", $productId);
                                                $stmtSP->execute();
                                                $resultSP = $stmtSP->get_result();
                                                $rowSP = $resultSP->fetch_assoc();
                                                $tongTien += $rowSP['GIABANKM'] * $quantity;
                                            }

                                            // Insert into `dh`
                                            $sqlInsertDH = "INSERT INTO dh (IDKH, TONG) VALUES (?, ?)";
                                            $stmtDH = $conn->prepare($sqlInsertDH);
                                            $stmtDH->bind_param("si", $_SESSION["IDKH"], $tongTien);
                                            $stmtDH->execute();

                                            //get IDDH for ctdh insert
                                            $orderId = $conn->insert_id;
                                            //insert products into ctdh
                                            $sqlInsertCTDH = "INSERT INTO ctdh (IDDH, IDSP, SL) VALUES (?, ?, ?)";
                                            $stmtCTDH = $conn->prepare($sqlInsertCTDH);
                                            foreach ($cartItems as $productId => $quantity) {
                                                $stmtCTDH->bind_param("iii", $orderId, $productId, $quantity);
                                                $stmtCTDH->execute();
                                            }
                                            ?>
                                            // Proceed with placing the order
                                            alert("Đã đặt hàng thành công!");
                                        }
                                    </script>
                                </td>
                                <!---->
                                <script>
                                    // Hiển thị/Ẩn bảng thông tin thẻ khi checkbox được chọn/bỏ chọn
                                    const cardCheckbox = document.getElementById('card');
                                    const cardInfo = document.getElementById('card-info');
                            
                                    cardCheckbox.addEventListener('change', function () {
                                        if (this.checked) {
                                            cardInfo.style.display = 'block';
                                        } else {
                                            cardInfo.style.display = 'none';
                                        }
                                    });
                            
                                    
                                </script>
                            </div>
                        </div>
                    </div>
                </form>
        </section>
        <!-- Checkout Section End -->

        <!-- Instagram Begin -->
        <div class="instagram">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-2 col-md-4 col-sm-4 p-0">
                        <div class="instagram__item set-bg" data-setbg="img/instagram/insta-1.jpg">
                            <div class="instagram__text">
                                <i class="fa fa-instagram"></i>
                                <a href="#">@ ashion_shop</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-4 col-sm-4 p-0">
                        <div class="instagram__item set-bg" data-setbg="img/instagram/insta-2.jpg">
                            <div class="instagram__text">
                                <i class="fa fa-instagram"></i>
                                <a href="#">@ ashion_shop</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-4 col-sm-4 p-0">
                        <div class="instagram__item set-bg" data-setbg="img/instagram/insta-3.jpg">
                            <div class="instagram__text">
                                <i class="fa fa-instagram"></i>
                                <a href="#">@ ashion_shop</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-4 col-sm-4 p-0">
                        <div class="instagram__item set-bg" data-setbg="img/instagram/insta-4.jpg">
                            <div class="instagram__text">
                                <i class="fa fa-instagram"></i>
                                <a href="#">@ ashion_shop</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-4 col-sm-4 p-0">
                        <div class="instagram__item set-bg" data-setbg="img/instagram/insta-5.jpg">
                            <div class="instagram__text">
                                <i class="fa fa-instagram"></i>
                                <a href="#">@ ashion_shop</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-4 col-sm-4 p-0">
                        <div class="instagram__item set-bg" data-setbg="img/instagram/insta-6.jpg">
                            <div class="instagram__text">
                                <i class="fa fa-instagram"></i>
                                <a href="#">@ ashion_shop</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Instagram End -->

        <!-- Footer Section Begin -->
        <footer class="footer">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4 col-md-6 col-sm-7">
                        <div class="footer__about">
                            <div class="footer__logo">
                                <a href="./index.html"><img src="img/logo.png" alt=""></a>
                            </div>
                            <p>Trang web bán giày chuyên cung cấp các mẫu giày thời trang, đa dạng từ thể thao đến công sở. Sản phẩm đảm bảo chất lượng cao, với nhiều lựa chọn về kiểu dáng và kích cỡ phù hợp cho mọi lứa tuổi.</p>
                            <div class="footer__payment">
                                <a href="#"><img src="img/payment/payment-1.png" alt=""></a>
                                <a href="#"><img src="img/payment/payment-2.png" alt=""></a>
                                <a href="#"><img src="img/payment/payment-3.png" alt=""></a>
                                <a href="#"><img src="img/payment/payment-4.png" alt=""></a>
                                <a href="#"><img src="img/payment/payment-5.png" alt=""></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-3 col-sm-5">
                        <div class="footer__widget">
                            <h6>Đường dẫn</h6>
                            <ul>
                                <li><a href="#">Về chúng tôi</a></li>
                                <li><a href="#">Thông tin liên lạc</a></li>
                                <li><a href="#">Hỏi đáp cùng Ashion</a></li>
                                <li><a href="#">Blogs</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-3 col-sm-4">
                        <div class="footer__widget">
                            <h6>Tài khoản</h6>
                            <ul>
                                <li><a href="#">Tài khoản của tôi</a></li>
                                <li><a href="#">Theo dõi đơn hàng</a></li>
                                <li><a href="#">Thanh toán</a></li>
                                <li><a href="#">Danh sách yêu thích</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-8 col-sm-8">
                        <div class="footer__newslatter">
                            <h6>Tạp chí Ashion</h6>
                            <form action="#">
                                <input type="text" placeholder="Email">
                                <button type="submit" class="site-btn">Theo dõi</button>
                            </form>
                            <div class="footer__social">
                                <a href="#"><i class="fa fa-facebook"></i></a>
                                <a href="#"><i class="fa fa-twitter"></i></a>
                                <a href="#"><i class="fa fa-youtube-play"></i></a>
                                <a href="#"><i class="fa fa-instagram"></i></a>
                                <a href="#"><i class="fa fa-pinterest"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                        <div class="footer__copyright__text">
                            <p>Copyright &copy; <script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a></p>
                        </div>
                        <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                    </div>
                </div>
            </div>
        </footer>
        <!-- Footer Section End -->

        <!-- Search Begin -->
        <div class="search-model">
            <div class="h-100 d-flex align-items-center justify-content-center">
                <div class="search-close-switch">+</div>
                <form class="search-model-form">
                    <input type="text" id="search-input" placeholder="Search here.....">
                </form>
            </div>
        </div>
        <!-- Search End -->

        <!-- Js Plugins -->
        <script src="js/jquery-3.3.1.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/jquery.magnific-popup.min.js"></script>
        <script src="js/jquery-ui.min.js"></script>
        <script src="js/mixitup.min.js"></script>
        <script src="js/jquery.countdown.min.js"></script>
        <script src="js/jquery.slicknav.js"></script>
        <script src="js/owl.carousel.min.js"></script>
        <script src="js/jquery.nicescroll.min.js"></script>
        <script src="js/main.js"></script>
    </body>

    </html>
