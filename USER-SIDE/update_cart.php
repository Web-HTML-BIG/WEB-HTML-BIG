<?php
session_start();
$userCartCookie = "cart_" . $_SESSION["IDKH"];

if (isset($_POST["productId"]) && isset($_POST["quantity"])) {
    $cartItems = json_decode($_COOKIE[$userCartCookie], true);

    $cartItems[$_POST["productId"]] = $_POST["quantity"]; // Update quantity

    // Update the cookie
    setcookie($userCartCookie, json_encode($cartItems), time() + (86400 * 30), "/");
    echo "Quantity updated"; // Optional response for debugging
}
?>