<h2>Projects Section</h2>
<form method="POST" enctype="multipart/form-data">
    <input type="hidden" name="project_action" value="add">
    <label>Title:</label>
    <input type="text" name="title" required>
    <label>Description:</label>
    <textarea name="description" required></textarea>
    <label>Media Type:</label>
    <select name="media_type" required>
        <option value="image">Image</option>
        <option value="video">Video</option>
    </select>
    <label>Media:</label>
    <input type="file" name="media">
    <button type="submit">Add</button>
</form>
<ul>
    <?php while ($project = $projects_result->fetch_assoc()): ?>
        <li>
            <form method="POST" enctype="multipart/form-data" style="margin-bottom: 10px;">
                <input type="hidden" name="project_action" value="edit">
                <input type="hidden" name="id" value="<?php echo $project['id']; ?>">
                <label>Title:</label>
                <input type="text" name="title" value="<?php echo htmlspecialchars($project['title']); ?>" required>
                <label>Description:</label>
                <textarea name="description" required><?php echo htmlspecialchars($project['description']); ?></textarea>
                <label>Media Type:</label>
                <select name="media_type" required>
                    <option value="image" <?php echo $project['media_type'] === 'image' ? 'selected' : ''; ?>>Image</option>
                    <option value="video" <?php echo $project['media_type'] === 'video' ? 'selected' : ''; ?>>Video</option>
                </select>
                <label>Media:</label>
                <input type="file" name="media">
                <input type="hidden" name="existing_media" value="<?php echo htmlspecialchars($project['media_path']); ?>">
                <button type="submit">Save</button>
            </form>
            <a href="?delete_project=<?php echo $project['id']; ?>" style="color: red;">Delete</a>
        </li>
    <?php endwhile; ?>
</ul>
