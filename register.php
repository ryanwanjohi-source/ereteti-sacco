<?php $page_title = 'Register'; include 'includes/header.php'; ?>
<h1> Apply for membership </h1>

<main>

  <p> Any dairy farmer within reach of one of our three routes
 may apply to join Ereteti. <br>You will need your national ID
 number and a phone we can reach you on. <br> Once your
 membership number is issued you may deliver from that day,
 and you are paid once a month for the litres we accept. </p>

<?php
$routes = [
 1 => 'Kikuyu',
 2 => 'Ngong',
 3 => 'Kiambu',
 4 => 'Limuru',
 5 => 'Ruiru',
 6 => 'Thika',
];
?>
<?php if (isset($_GET['action']) && $_GET['action'] === 'success'): ?>
 <?php
 require __DIR__ . '/includes/db.php';
 $stmt = $pdo->query('SELECT * FROM members ORDER BY id DESC LIMIT 1');
 $member = $stmt->fetch();
 ?>
 <?php if ($member): ?>
 <p>Thank you, <?= htmlspecialchars($member['first_name']) ?>.</p>
 <p>We have your application to join the <?= htmlspecialchars($routes[$member['route_id']] ?? 'Unknown') ?> route.</p>
 <p>The office will call you on <?= htmlspecialchars($member['phone']) ?> when your member number is ready.</p>
 <?php endif; ?>
<?php endif; ?>

<form action="process-register.php" method="POST">

<fieldset>
<legend>Your details</legend>
<label for="first-name">First name</label>
<input type="text" id="first-name" name="first_name" required><br>
<label for="phone">Phone number</label>
<input type="tel" id="phone" name="phone"
                                          placeholder="07XXXXXXXX" required>
</fieldset>

<fieldset>
<legend>Your route</legend>
<label for="route">Route</label>
<select id="route" name="route_id" required>
<option value="">Choose a route</option>
<option value="1">Kikuyu</option>
<option value="2">Ngong</option>
<option value="3">Kiambu</option>
<option value="4">Limuru</option>
<option value="5">Ruiru</option>
<option value="6">Thika</option>
</select>
</fieldset>

<button type="submit">Apply to join</button>

</form>

</main>
<footer>
<p>Ereteti Dairy Sacco, PO Box 4021, Ngong.</p>
<p>Site built by Wanjiru Kiarie, DBT Year 1, 2026.</p>
</footer>
<script src="js/main.js" defer></script>

<?php include 'includes/footer.php'; ?>
