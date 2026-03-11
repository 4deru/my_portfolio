<h2>Contact Info Section</h2>
<ul>
    <?php while ($contact_info = $contact_info_result->fetch_assoc()): ?>
        <li>
            <form method="POST" style="margin-bottom: 10px;">
                <input type="hidden" name="contact_info_action" value="edit">
                <input type="hidden" name="id" value="<?php echo $contact_info['id']; ?>">
                <label>Section Title:</label>
                <input type="text" name="section_title" value="<?php echo htmlspecialchars($contact_info['section_title']); ?>" required>
                <label>Description:</label>
                <textarea name="description" required><?php echo htmlspecialchars($contact_info['description']); ?></textarea>
                <label>Email:</label>
                <input type="email" name="email" value="<?php echo htmlspecialchars($contact_info['email']); ?>" required>
                <label>Phone:</label>
                <input type="text" name="phone" value="<?php echo htmlspecialchars($contact_info['phone']); ?>">
                <label>Location:</label>
                <input type="text" name="location" value="<?php echo htmlspecialchars($contact_info['location']); ?>">
                <button type="submit">Save</button>
            </form>
            <a href="?delete_contact_info=<?php echo $contact_info['id']; ?>" style="color: red;">Delete</a>
        </li>
    <?php endwhile; ?>
</ul>
