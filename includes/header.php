<?php
// header.php — the top of every page.
$page_title = $page_title ?? 'Ereteti Dairy Sacco';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <!-- we add the viewport meta tag -->
   <meta name="viewport"
   content="width=device-width, intial-scale=1.0"

  <title><?php echo $page_title; ?> — Ereteti Dairy Sacco</title>


    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Source+Serif+4:ital,opsz,wght@0,8..60,200..900;1,8..60,200..900&display=swap" rel="stylesheet">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Source+Sans+3:ital,wght@0,200..900;1,200..900&family=Source+Serif+4:ital,opsz,wght@0,8..60,200..900;1,8..60,200..900&display=swap" rel="stylesheet">
<link rel="stylesheet" href="css/style.css">
<link rel="icon" type="image/png"
 href="C:\Users\Administrator\Desktop\ereteti-sacco\img\WhatsApp Image 2026-10-22 at 12.48.42 AM.jpeg">
      </head>
<body>

  <header>
    <h1>
      <!-- placeholder: swap for img/logo.png -->
      <img src="C:\Users\Administrator\Desktop\ereteti-sacco\img\WhatsApp Image 2026-10-22 at 12.48.57 AM.jpeg"
      alt="" class="logo" width="10%">
      <?php echo $page_title; ?>
    </h1>
    <p>Milk collected twice a day, on three routes
       out of Ngong.</p>
  </header>

  <nav>
    <ul>
      <li><a href="index.php">Home</a></li>
      <li><a href="about.php">About</a></li>
      <li><a href="routes.php">Routes</a></li>
      <li><a href="contact.php">Contact</a></li>
      <li><a href="register.php">Join</a></li>
      <li><a href="deliveries.php">Deliveries</a>
      </li>
    </ul>
  </nav>
