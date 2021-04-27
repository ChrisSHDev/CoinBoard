<div class="article-box">
  <div class="article-subject">
    <h1>
      <?php echo htmlspecialchars($article['articlesubject'], ENT_QUOTES, 'UTF-8')  ?>
    </h1>
  </div>
  <div class="article-body">
    <?php echo htmlspecialchars($article['articlecontents'], ENT_QUOTES, 'UTF-8')  ?>
  </div>
</div>