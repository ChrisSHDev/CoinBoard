<div class="row col-lg-8 justify-content-center m-auto pt-5 pb-5">
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
          <div class="table-date-title"> Date </div>
          <div><span class="badge bg-primary rounded-pill">
              <?php echo htmlspecialchars($article['articledate'], ENT_QUOTES, 'UTF-8')  ?></span>
          </div>
        </li>
      </ul>
      <ul class="list-group list-group-horizontal">
        <li class="list-group-item d-flex justify-content-between align-items-center">
          Like
          <div><span class="badge bg-primary rounded-pill">1</span></div>
        </li>
        <li class="list-group-item d-flex justify-content-between align-items-center">
          Dislike
          <div><span class="badge bg-primary rounded-pill">1</span></div>
        </li>
        <li class="list-group-item d-flex justify-content-between align-items-center">
          Comment
          <div><span class="badge bg-primary rounded-pill">1</span></div>
        </li>
      </ul>

    </div>
    <div class="article-body">
      <?php echo htmlspecialchars($article['articlecontents'], ENT_QUOTES, 'UTF-8')  ?>
    </div>
  </div>
</div>