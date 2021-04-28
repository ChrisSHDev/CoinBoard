<div class="row board-section">
  <div class="col-6 freeboard-box">
    <h3>Bitcoin Forum</h3>
    <table class="table table-striped table-hover">
      <tbody>
        <?php foreach ($articles as $article): ?>
        <?php if ($article['categoryId'] == '1'): ?>
        <tr>

          <td class="table-subject">
            <a href="/article/page?id=<?php echo $article['id'] ?>">
              <?php echo htmlspecialchars($article['articlesubject'], ENT_QUOTES, 'UTF-8')  ?>
            </a>
          </td>

          <td>
            <a href="mailto:<?php echo htmlspecialchars($article['email'], ENT_QUOTES, 'UTF-8') ?>">
              <?php echo htmlspecialchars($article['name'], ENT_QUOTES, 'UTF-8') ?>
            </a>
          </td>

          <td class="table-date">
            <?php echo $article['articledate']; ?>
          </td>

        </tr>
        <?php endif ?>
        <?php endforeach; ?>
      </tbody>
    </table>

  </div>

  <div class="col-6 freeboard-box">
    <h3>Altcoin Forum</h3>
    <table class="table table-striped table-hover">
      <tbody>
        <?php foreach ($articles as $article): ?>
        <?php if ($article['categoryId'] == '2'): ?>
        <tr>

          <td class="table-subject">
            <a href="/article/page?id=<?php echo $article['id'] ?>">
              <?php echo htmlspecialchars($article['articlesubject'], ENT_QUOTES, 'UTF-8')  ?>
            </a>
          </td>

          <td>
            <a href="mailto:<?php echo htmlspecialchars($article['email'], ENT_QUOTES, 'UTF-8') ?>">
              <?php echo htmlspecialchars($article['name'], ENT_QUOTES, 'UTF-8') ?>
            </a>
          </td>

          <td class="table-date">
            <?php echo $article['articledate']; ?>
          </td>

        </tr>
        <?php endif ?>
        <?php endforeach; ?>
      </tbody>
    </table>

  </div>

</div>