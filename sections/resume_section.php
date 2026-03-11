<h2>Resume Section</h2>
<form method="POST">
    <input type="hidden" name="resume_action" value="add">
    <label>Title:</label>
    <input type="text" name="title" required>
    <label>Content:</label>
    <textarea name="content" required></textarea>
    <label>Icon:</label>
    <input type="text" name="icon">
    <button type="submit">Add</button>
</form>
<ul>
    <?php while ($resume = $resume_result->fetch_assoc()): ?>
        <li>
            <form method="POST" style="margin-bottom: 10px;">
                <input type="hidden" name="resume_action" value="edit">
                <input type="hidden" name="id" value="<?php echo $resume['id']; ?>">
                <label>Title:</label>
                <input type="text" name="title" value="<?php echo htmlspecialchars($resume['title']); ?>" required>
                <label>Content:</label>
                <textarea name="content" required><?php echo htmlspecialchars($resume['content']); ?></textarea>
                <label>Icon:</label>
                <input type="text" name="icon" value="<?php echo htmlspecialchars($resume['icon']); ?>">
                <button type="submit">Save</button>
            </form>
            <a href="?delete_resume=<?php echo $resume['id']; ?>" style="color: red;">Delete</a>
        </li>
    <?php endwhile; ?>
</ul>
