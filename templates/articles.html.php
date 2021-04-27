<div class="col discussion-box">

  <h3>All Articles</h3>
  <p>There are <?php echo $totalArticles ?> Articles in total.</p>

  <table class="table table-striped table-hover">
    <tbody>
      <?php foreach ($articles as $article): ?>
      <tr>
        <td>
          <?php echo htmlspecialchars($article['articlesubject'], ENT_QUOTES, 'UTF-8')  ?>
        </td>

        <td>
          <a href="mailto:<?php echo htmlspecialchars($article['email'], ENT_QUOTES, 'UTF-8') ?>">
            <?php echo htmlspecialchars($article['name'], ENT_QUOTES, 'UTF-8') ?>
          </a>
        </td>

        <td>
          <?php echo $article['articledate']; ?>
        </td>
        <?php if ($userId == $article['userId']) : ?>
        <td class="d-flex">

          <?php echo $userId ?>
          <a class="btn btn-dark" role="button" href="/article/edit?id=<?php echo $article['id']?>">Edit</a>

          <form action="/article/delete" method="post">
            <input type="hidden" name="id" value="<?=$article['id']?>">
            <input class="btn btn-dark" type="submit" value="Delete">
          </form>

        </td>
        <?php endif; ?>
      </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>