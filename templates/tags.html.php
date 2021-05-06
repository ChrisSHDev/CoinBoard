<h2>Tags</h2>

<a href="/tag/edit">Add Tags</a>

<?php foreach ($tags as $tag): ?>
<blockquote>
  <p>
    <?php echo htmlspecialchars($tag['name'], ENT_QUOTES, 'UTF-8') ?>

    <a href="/tag/edit?id=<?php echo $tag['id']?>">Edit</a>
  <form action="/tag/delete" method="post">
    <input type="hidden" name="id" value="<?php echo $tag['id'];?>">
    <input type="submit" value="Delete">
  </form>
  </p>
</blockquote>

<?php endforeach; ?>