<?php if (empty($article['id']) || $userId == $article['userId']): ?>

<form action="" method="post">
  <input type="hidden" name="article[id]" value="<?php echo $article['id'] ?? ''; ?>">
  <label for="title">Title</label>
  <input id="title" name="article[articlesubject]" type="text" maxlength="300" tabindex="100" value=""
    data-min-length="15" data-max-length="150">
  <label for="articlecontents">Body</label>
  <textarea id="articlecontents" name="article[articlecontents]" cols="92" rows="15" tabindex="101" data-min-length=""
    spellcheck="false">
    <?php echo $article['articlecontents'] ?? ''; ?>
    </textarea>
  <input type="submit" name="submit" value="Submit">
</form>
<?php else: ?>

<p>You can edit only your own article.</p>

<?php endif; ?>