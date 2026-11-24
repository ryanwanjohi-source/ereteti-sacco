// ---- 1. deliveries.html: check the litres
// Find the form fields and the message under them.

const litres = document.querySelector('#litres');
const litresMessage = document.querySelector('#litres-message');

function checkLitres() {
  let valid = true;

  litres.classList.remove('invalid');
  litresMessage.textContent = '';

  if (isNaN(Number(litres.value))) {
    litresMessage.textContent = 'Litres must be a number more than 0.';
    valid = false;
  } else if (Number(litres.value) <= 0) {
    litresMessage.textContent = 'Litres must be a number more than 0.';
    valid = false;
  } else if (Number(litres.value) > 60) {
    litresMessage.textContent =
      'Over 60 litres in one session. Check the reading.';
    valid = false;
  }

  if (!valid) litres.classList.add('invalid');
  return valid;
}

// Guarded, like blocks 3 and 4: pages without #litres skip this.
if (litres) litres.addEventListener('input', checkLitres);

// ---- 2. deliveries.html: check the member
// This takes one line to check the shape of the member number; the message for a
// different problem is in the showMessage function.

const memberPattern = /^ER-[0-9]{4}$/;
const member = document.querySelector('#member');
const memberMessage = document.querySelector('#member-message');

function showMessage(message) {
  memberMessage.textContent = message;
  member.classList.add('invalid');
}

function checkMember() {
  memberPattern.lastIndex = 0;
  const memberValue = member.value.toUpperCase();

  member.classList.remove('invalid');
  memberMessage.textContent = '';

  if (memberValue !== member.value) {
    member.value = memberValue;
  }

  if (memberPattern.test(memberValue)) {
    return true;
  } else {
    showMessage('A member number looks like ER-0001.');
    return false;
  }
}

// Guarded, like blocks 3 and 4: pages without #member skip this.
if (member) member.addEventListener('input', checkMember);

// ---- 3. deliveries.html: check the delivery form
// Lab 6: the form now has somewhere to go (process-delivery.php), so it is
// stopped only when something is wrong. A correct form goes through to PHP.

const deliveryForm = document.querySelector('#delivery-form');
const formMessage = document.querySelector('#form-message');

function recordDelivery(event) {
  checkMember();
  checkLitres();
  if (member.classList.contains('invalid')) {
    event.preventDefault(); // stop: the member number is wrong
    member.focus();
  } else if (litres.classList.contains('invalid')) {
    event.preventDefault(); // stop: the litres are wrong
    litres.focus();
  }
  // nothing wrong: the form goes on to process-delivery.php
}

if (deliveryForm) {
  deliveryForm.addEventListener('submit', recordDelivery);
}

// ---- 4. routes.html: filter the routes

const routeSearch = document.querySelector('#route-search');
const routeCount = document.querySelector('#route-count');
const routeSections = document.querySelectorAll('main section');

function showRoutes() {
  const term = routeSearch.value.trim().toLowerCase();
  let shown = 0;

  for (const section of routeSections) {
    const text = section.textContent.toLowerCase();
    const visible = text.includes(term);
    section.style.display = visible ? '' : 'none';
    if (visible) shown += 1;
  }

  routeCount.textContent =
    shown + ' of ' + routeSections.length + ' routes';
}

if (routeSearch) {
  routeSearch.addEventListener('input', showRoutes);
  showRoutes();
}

// ---- 5. deliveries.html: show deliveries accepted

const acceptedTotalCell = document.querySelector('#accepted-total');

function showTotal() {
  let total = 0;
  const rows = document.querySelectorAll('tbody tr');

  rows.forEach(function (row) {
    const cells = row.querySelectorAll('td');
    if (cells.length > 4 && cells[4].textContent === 'Yes') {
      total += Number(cells[3].textContent);
    }
  });

  acceptedTotalCell.textContent = total.toFixed(2);
}

// Guarded, like blocks 3 and 4: pages without #accepted-total skip this.
if (acceptedTotalCell) showTotal();
