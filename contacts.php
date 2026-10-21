<?php
require_once __DIR__ . '/core/init.php';
$db = new Database();
$db->query('SELECT * FROM contacts ORDER BY first_name ASC, last_name ASC');
$contacts = $db->resultset();
?>
<div class="contacts-panel">
    <div class="contacts-heading">
        <div><h2>Contacts</h2><span><?php echo count($contacts); ?> saved contact<?php echo count($contacts) === 1 ? '' : 's'; ?></span></div>
    </div>
    <?php if (!$contacts): ?>
        <div class="empty-state"><div class="empty-icon">+</div><h3>No contacts yet</h3><p>Add your first contact to get started.</p></div>
    <?php else: ?>
    <div class="table-scroll">
        <table id="contactsTable" class="unstriped modern-table">
            <thead><tr><th>Name</th><th>Phone</th><th>Email</th><th>Location</th><th>Group</th><th>Actions</th></tr></thead>
            <tbody>
            <?php foreach ($contacts as $contact):
                $fullName = trim($contact->first_name . ' ' . $contact->last_name);
                $location = trim(implode(', ', array_filter([$contact->city, $contact->state, $contact->zipcode])));
                $attrs = '';
                foreach (['first_name','last_name','email','phone','address1','address2','city','state','zipcode','contact_group','notes'] as $field) {
                    $attrs .= ' data-' . str_replace('_', '-', $field) . '="' . htmlspecialchars((string)$contact->$field, ENT_QUOTES, 'UTF-8') . '"';
                }
            ?>
                <tr>
                    <td><strong><?php echo htmlspecialchars($fullName, ENT_QUOTES, 'UTF-8'); ?></strong></td>
                    <td><?php echo htmlspecialchars($contact->phone ?: '—', ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><?php echo htmlspecialchars($contact->email ?: '—', ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><?php echo htmlspecialchars($location ?: '—', ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><span class="group-badge"><?php echo htmlspecialchars($contact->contact_group ?: 'Other', ENT_QUOTES, 'UTF-8'); ?></span></td>
                    <td class="actions">
                        <button type="button" class="button tiny edit-contact" data-id="<?php echo (int)$contact->id; ?>" <?php echo $attrs; ?>>Edit</button>
                        <button type="button" class="button tiny alert delete-contact" data-id="<?php echo (int)$contact->id; ?>">Delete</button>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <?php endif; ?>
</div>
