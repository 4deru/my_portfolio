<h2>Hero Section</h2>
<form method="POST" enctype="multipart/form-data">
    <input type="hidden" name="hero_action" value="update">
    <label>Heading:</label>
    <input type="text" name="heading" value="<?php echo htmlspecialchars($hero['heading'] ?? ''); ?>">
    <label>Description:</label>
    <textarea name="description"><?php echo htmlspecialchars($hero['description'] ?? ''); ?></textarea>
    <label>Name:</label>
    <input type="text" name="name" value="<?php echo htmlspecialchars($hero['name'] ?? ''); ?>">
    <label>Image:</label>
    <input type="file" name="image">
    <button type="submit">Save</button>
</form>
