$(function () {
    const $page = $('#pageContent');
    const $modal = $('#myModel');
    const $form = $('#contactForm');
    let editingId = null;

    function loadContacts() {
        $('.loader').show();
        $.get('contacts.php')
            .done(function (html) { $page.html(html); })
            .fail(function () { $page.html('<div class="callout alert">Unable to load contacts. Please refresh the page and try again.</div>'); })
            .always(function () { $('.loader').hide(); });
    }

    function openModal() {
        $modal.addClass('is-open').attr('aria-hidden', 'false');
        $('body').addClass('modal-open');
        window.setTimeout(function () {
            $modal.find('input[name="first_name"]').trigger('focus');
        }, 50);
    }

    function closeModal() {
        $modal.removeClass('is-open').attr('aria-hidden', 'true');
        $('body').removeClass('modal-open');
    }

    function resetForm() {
        editingId = null;
        $form[0].reset();
        $('#contactId').val('');
        $('#modalTitle').text('Add Contact');
        $('#submitContact').val('Save Contact');
    }

    $('.add-btn').on('click', function (event) {
        event.preventDefault();
        resetForm();
        openModal();
    });

    $modal.on('click', '[data-close]', function (event) {
        event.preventDefault();
        closeModal();
    });

    $modal.on('click', function (event) {
        if (event.target === this) closeModal();
    });

    $(document).on('keydown', function (event) {
        if (event.key === 'Escape' && $modal.hasClass('is-open')) closeModal();
    });

    $form.on('submit', function (event) {
        event.preventDefault();
        const endpoint = editingId ? 'edit_contact.php' : 'add_contact.php';
        const data = $form.serialize() + (editingId ? '&id=' + encodeURIComponent(editingId) : '');
        const $submit = $('#submitContact');
        $submit.prop('disabled', true).val('Saving...');

        $.post(endpoint, data, null, 'json')
            .done(function (response) {
                if (response && response.success) {
                    closeModal();
                    resetForm();
                    loadContacts();
                } else {
                    alert((response && response.message) || 'Unable to save contact.');
                }
            })
            .fail(function (xhr) {
                const message = xhr.responseJSON && xhr.responseJSON.message;
                alert(message || 'Unable to save contact. Please check your connection and try again.');
            })
            .always(function () {
                $submit.prop('disabled', false).val(editingId ? 'Update Contact' : 'Save Contact');
            });
    });

    $(document).on('click', '.edit-contact', function () {
        const contact = $(this).data();
        editingId = contact.id;
        $('#contactId').val(contact.id);

        Object.keys(contact).forEach(function (key) {
            const $field = $('[name="' + key.replace(/-/g, '_') + '"]');
            if ($field.length) $field.val(contact[key]);
        });

        $('#modalTitle').text('Edit Contact');
        $('#submitContact').val('Update Contact');
        openModal();
    });

    $(document).on('click', '.delete-contact', function () {
        const id = $(this).data('id');
        if (!id || !confirm('Delete this contact? This cannot be undone.')) return;

        $.post('delete_contact.php', { id: id }, null, 'json')
            .done(function (response) {
                if (response && response.success) loadContacts();
                else alert((response && response.message) || 'Unable to delete contact.');
            })
            .fail(function () { alert('Unable to delete contact. Please try again.'); });
    });

    $(document).on('input', '#contactSearch', function () {
        const query = String($(this).val() || '').toLowerCase();
        $('#contactsTable tbody tr').each(function () {
            $(this).toggle($(this).text().toLowerCase().indexOf(query) !== -1);
        });
    });

    loadContacts();
});
