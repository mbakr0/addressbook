<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AddressBook</title>
    <link rel="stylesheet" href="css/foundation.css">
    <link rel="stylesheet" href="css/foundation-prototype.css">
    <link rel="stylesheet" href="css/app.css">
    <link rel="stylesheet" href="css/custom.css">
</head>
<body>
<main class="app-shell">
    <header class="app-header">
        <div>
            <span class="eyebrow">PERSONAL CONTACTS</span>
            <h1>AddressBook</h1>
            <p>Keep your contacts organized, searchable and easy to update.</p>
        </div>
        <button class="add-btn button primary" type="button">+ Add Contact</button>
    </header>

    <section class="toolbar">
        <label class="search-box">🔎 <input id="contactSearch" type="search" placeholder="Search contacts..."></label>
        <span class="privacy-note">Your contacts stay in your database.</span>
    </section>

    <div class="loader" aria-label="Loading contacts"></div>
    <section id="pageContent" aria-live="polite"></section>
</main>

<div id="myModel" class="large reveal contact-modal" data-reveal data-animation-in="fade-in" data-animation-out="fade-out">
    <h2 id="modalTitle">Add Contact</h2>
    <form id="contactForm" method="post">
        <input id="contactId" type="hidden" name="id">
        <div class="grid-x grid-padding-x">
            <div class="cell medium-6"><label>First Name<input name="first_name" required maxlength="100"></label></div>
            <div class="cell medium-6"><label>Last Name<input name="last_name" required maxlength="100"></label></div>
            <div class="cell medium-6"><label>Email<input name="email" type="email" maxlength="190"></label></div>
            <div class="cell medium-6"><label>Phone<input name="phone" type="tel" maxlength="50"></label></div>
            <div class="cell medium-6"><label>Group<select name="contact_group"><option value="Family">Family</option><option value="Friends">Friends</option><option value="Business">Business</option></select></label></div>
            <div class="cell medium-6"><label>City<input name="city" maxlength="100"></label></div>
            <div class="cell medium-8"><label>Address<input name="address1" maxlength="255"></label></div>
            <div class="cell medium-4"><label>ZIP Code<input name="zipcode" maxlength="20"></label></div>
            <div class="cell medium-6"><label>Address 2<input name="address2" maxlength="255"></label></div>
            <div class="cell medium-6"><label>State<input name="state" maxlength="100"></label></div>
            <div class="cell"><label>Notes<textarea name="notes" rows="3" maxlength="2000"></textarea></label></div>
        </div>
        <div class="modal-actions">
            <button type="button" class="button secondary" data-close>Cancel</button>
            <input id="submitContact" type="submit" class="button primary" value="Save Contact">
        </div>
    </form>
    <button class="close-button" data-close aria-label="Close modal" type="button"><span aria-hidden="true">&times;</span></button>
</div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="js/vendor/what-input.js"></script>
<script src="js/vendor/foundation.js"></script>
<script src="js/app.js"></script>
</body>
</html>
