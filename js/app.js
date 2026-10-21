$(function () {
    const $page = $('#pageContent');
    const $modal = $('#myModel');
    const $form = $('#contactForm');
    let editingId = null;

    function escapeHtml(value) {
        return $('<div>').text(value || '').html();
    }

    function loadContacts() {
        $('.loader').show();
        $.get('contacts.php')
            .done(function (html) { $page.html(html); })
            .fail(function () { $page.html('<div class="callout alert">Unable to load contacts.</div>'); })
            .always(function () { $('.loader').hide(); });
    }

    function resetForm() {
        editingId = null;
        $form[0].reset();
        $('#contactId').val('');
        $('#modalTitle').text('Add Contact');
        $('#submitContact').val('Save Contact');
    }

    $('.add-btn').on('click', function () {
        resetForm();
        $modal.foundation('open');
    });

    $form.on('submit', function (event) {
        event.preventDefault();
        const endpoint = editingId ? 'edit_contact.php' : 'add_contact.php';
        const data = $form.serialize() + (editingId ? '&id=' + encodeURIComponent(editingId) : '');
        $('#submitContact').prop('disabled', true).val('Saving...');

        $.post(endpoint, data, null, 'json')
            .done(function (response) {
                if (response.success) {
                    $modal.foundation('close');
                    loadContacts();
                    resetForm();
                } else {
                    alert(response.message || 'Unable to save contact.');
                }
            })
            .fail(function (xhr) {
                alert(xhr.responseJSON?.message || 'Unable to save contact.');
            })
            .always(function () { $('#submitContact').prop('disabled', false).val(editingId ? 'Update Contact' : 'Save Contact'); });
    });

    $(document).on('click', '.edit-contact', function () {
        const contact = $(this).data();
        editingId = contact.id;
        $('#contactId').val(contact.id);
        Object.keys(contact).forEach(function (key) {
            const $field = $('[name="' + key + '"]');
            if ($field.length) $field.val(contact[key]);
        });
        $('#modalTitle').text('Edit Contact');
        $('#submitContact').val('Update Contact');
        $modal.foundation('open');
    });

    $(document).on('click', '.delete-contact', function () {
        const id = $(this).data('id');
        if (!id || !confirm('Delete this contact? This cannot be undone.')) return;
        $.post('delete_contact.php', { id: id }, null, 'json')
            .done(function (response) { if (response.success) loadContacts(); else alert(response.message); })
            .fail(function () { alert('Unable to delete contact.'); });
    });

    $(document).on('input', '#contactSearch', function () {
        const query = $(this).val().toLowerCase();
        $('#contactsTable tbody tr').each(function () {
            $(this).toggle($(this).text().toLowerCase().indexOf(query) !== -1);
        });
    });

    loadContacts();
});
