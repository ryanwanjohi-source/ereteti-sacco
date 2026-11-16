<?php
// process-register.php — takes the form, checks it, and writes one row.
ini_set('display_errors', 1);
error_reporting(E_ALL);
require __DIR__ . '/includes/db.php';
$errors = [];
$routes = [
 1 => 'Kikuyu',
 2 => 'Ngong',
 3 => 'Kiambu',
 4 => 'Limuru',
 5 => 'Ruiru',
 6 => 'Thika',
];
if (isset($_POST['first_name'])) {
 $first_name = trim($_POST['first_name']);
 $phone = trim($_POST['phone']);
 $route_id = (int) $_POST['route_id'];
 if ($first_name === '') {
 $errors[] = 'Please enter your name.';
 }
 if (strlen($phone) < 9) {
 $errors[] = 'Please enter a valid phone number.';
 }
 if (!isset($routes[$route_id])) {
 $errors[] = 'Please choose a route.';
 }
 if (empty($errors)) {
 try {
 $stmt = $pdo->prepare(
 'INSERT INTO members (first_name, phone, route_id)
 VALUES (:first_name, :phone, :route_id)'
 );
 $stmt->execute([
 ':first_name' => $first_name,
 ':phone' => $phone,
 ':route_id' => $route_id,
 ]);
 header('Location: register.php?action=success');
 exit;
 } catch (PDOException $e) {
 $errors[] = 'Could not save your application. ' . $e->getMessage();
 }
 }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Registration</title>
</head>
<body>
<?php if (!empty($errors)): ?>
 <p>The form had a problem:</p>
 <ul>
 <?php foreach ($errors as $error): ?>
 <li><?= htmlspecialchars($error) ?></li>
 <?php endforeach; ?>
 </ul>
 <p><a href="register.php">Back to the form</a></p>
<?php elseif (!isset($_POST['first_name'])): ?>
 <p>No application. This page answers the membership form. Fill it in first.</p>
 <p><a href="register.php">Back to the form</a></p>
<?php endif; ?>
</body>
</html>
