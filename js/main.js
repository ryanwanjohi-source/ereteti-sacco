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
    showMessage('Enter a 4-digit member number.');
    return false;
  }
}

// Guarded, like blocks 3 and 4: pages without #member skip this.
if (member) member.addEventListener('input', checkMember);

// ---- 3. deliveries.html: check the delivery form

const deliveryForm = document.querySelector('#delivery-form');
const formMessage = document.querySelector('#form-message');

if (deliveryForm) {
  deliveryForm.addEventListener('submit', function (event) {
    event.preventDefault();

    checkMember();
    if (member.classList.contains('invalid')) {
      member.focus();
      return;
    }

    if (!checkLitres()) {
      litres.focus();
      return;
    }

    formMessage.textContent = 'Checked: ' + member.value + ', ' +
      litres.value + ' litres. Nothing is sent yet: ' +
      'that needs a server.';
  });
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
    if (cells[4].textContent.trim() === 'Yes') {
      total += Number(cells[3].textContent);
    }
  });

  acceptedTotalCell.textContent = total.toFixed(2);
}

// Guarded, like blocks 3 and 4: pages without #accepted-total skip this.
if (acceptedTotalCell) showTotal();
