<?php if (empty($article['id']) || $userId == $article['userId']): ?>

<form action="" method="post">
  <input type="hidden" name="article[id]" value="<?php echo $article['id'] ?? ''; ?>">
  <div class="mb-3">
    <label for="title" class="form-label">Title</label>
    <input id="articlesubject" class="form-control" name="article[articlesubject]" type="text" maxlength="300"
      tabindex="100" data-min-length="15" data-max-length="150" value="<?php echo $article['articlesubject'] ?? ''; ?>">
  </div>
  <div class="mb-3">
    <label for="articlecontents" class="form-label">Body</label>
    <textarea id="articlecontents" class="form-control" name="article[articlecontents]" cols="92" rows="15"
      tabindex="101" data-min-length="" spellcheck="false"><?php echo $article['articlecontents'] ?? ''; ?></textarea>
  </div>
  <div class="mb-3">
    <label for="category" class="form-label">Disabled select menu</label>
    <select id="categoryId" name="article[categoryId]" class="form-select">
      <option value="1">Bitcoin</option>
      <option value="2">Altcoin</option>
    </select>
  </div>
  <div class="mb-3">
    <label for="tag" class="form-label">Tags</label>
    <?php foreach ($tags as $tag): ?>
    <?php if ($articletags['articleId']) {
    ;
} ?>
    <input type="checkbox" checked name="tag[]" value="<?php echo $tag['id']; ?>" />

    <input type="checkbox" name="tag[]" value="<?php echo $tag['id']; ?>" />

    <label><?php echo $tag['name']; ?></label>
    <?php endforeach; ?>
  </div>
  <input type="submit" name="submit" value="Submit">
</form>
<?php else: ?>

<p>You can edit only your own article.</p>

<?php endif; ?>