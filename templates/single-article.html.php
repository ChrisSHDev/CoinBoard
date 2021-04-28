<div class="article-box">
  <div class="article-subject">
    <h1>
      <?php echo htmlspecialchars($article['articlesubject'], ENT_QUOTES, 'UTF-8')  ?>
    </h1>
  </div>
  <div class="article-list-box d-flex justify-content-between">
    <ul class="list-group list-group-horizontal">
      <li class="list-group-item d-flex justify-content-between align-items-center">
        <?php echo htmlspecialchars($user, ENT_QUOTES, 'UTF-8')  ?>
      </li>
      <li class="list-group-item d-flex justify-content-between align-items-center">
        Date
        <span class="badge bg-primary rounded-pill">
          <?php echo htmlspecialchars($article['articledate'], ENT_QUOTES, 'UTF-8')  ?></span>
      </li>
    </ul>
    <ul class="list-group list-group-horizontal">
      <li class="list-group-item d-flex justify-content-between align-items-center">
        Like
        <span class="badge bg-primary rounded-pill">1</span>
      </li>
      <li class="list-group-item d-flex justify-content-between align-items-center">
        Dislike
        <span class="badge bg-primary rounded-pill">1</span>
      </li>
      <li class="list-group-item d-flex justify-content-between align-items-center">
        Comment
        <span class="badge bg-primary rounded-pill">1</span>
      </li>
    </ul>

  </div>
  <div class="article-body">
    <?php echo htmlspecialchars($article['articlecontents'], ENT_QUOTES, 'UTF-8')  ?>
  </div>
</div>