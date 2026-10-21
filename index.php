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

<div id="myModel" class="large reveal contact-modal" aria-hidden="true">
    <div class="modal-header">
        <div class="modal-icon" aria-hidden="true">+</div>
        <div class="modal-heading">
            <h2 id="modalTitle">Add Contact</h2>
            <p>Save someone new to your address book.</p>
        </div>
        <button class="close-button" data-close aria-label="Close modal" type="button"><span aria-hidden="true">&times;</span></button>
    </div>

    <form id="contactForm" method="post">
        <input id="contactId" type="hidden" name="id">

        <div class="form-section">
            <h3>Contact details</h3>
            <div class="grid-x grid-padding-x">
                <div class="cell medium-6"><label>First name <span class="required-mark">*</span><input name="first_name" placeholder="e.g. Mohamed" required maxlength="100" autocomplete="given-name"></label></div>
                <div class="cell medium-6"><label>Last name <span class="required-mark">*</span><input name="last_name" placeholder="e.g. Abobakr" required maxlength="100" autocomplete="family-name"></label></div>
                <div class="cell medium-6"><label>Email address<input name="email" type="email" placeholder="name@example.com" maxlength="190" autocomplete="email"></label></div>
                <div class="cell medium-6"><label>Phone number<input name="phone" type="tel" placeholder="+20 100 000 0000" maxlength="50" autocomplete="tel"></label></div>
            </div>
        </div>

        <div class="form-section">
            <h3>Address & organization</h3>
            <div class="grid-x grid-padding-x">
                <div class="cell medium-6"><label>Group<select name="contact_group"><option value="Family">Family</option><option value="Friends">Friends</option><option value="Business">Business</option></select></label></div>
                <div class="cell medium-6"><label>City<input name="city" placeholder="City" maxlength="100" autocomplete="address-level2"></label></div>
                <div class="cell medium-8"><label>Street address<input name="address1" placeholder="Street and building" maxlength="255" autocomplete="street-address"></label></div>
                <div class="cell medium-4"><label>ZIP / postal code<input name="zipcode" placeholder="Postal code" maxlength="20" autocomplete="postal-code"></label></div>
                <div class="cell medium-6"><label>Address line 2 <span class="optional-mark">Optional</span><input name="address2" placeholder="Apartment, suite, etc." maxlength="255"></label></div>
                <div class="cell medium-6"><label>State / region<input name="state" placeholder="State or region" maxlength="100" autocomplete="address-level1"></label></div>
                <div class="cell"><label>Notes <span class="optional-mark">Optional</span><textarea name="notes" rows="3" maxlength="2000" placeholder="Add any details you want to remember..."></textarea></label></div>
            </div>
        </div>

        <div class="modal-actions">
            <button type="button" class="button secondary" data-close>Cancel</button>
            <input id="submitContact" type="submit" class="button primary" value="Save Contact">
        </div>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="js/vendor/what-input.js"></script>
<script src="js/vendor/foundation.js"></script>
<script src="js/app.js"></script>
</body>
</html>
