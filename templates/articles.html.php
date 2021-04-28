<div class="col discussion-box">

  <div class="d-flex align-items-center justify-content-between gx-5 table-title-box">
    <h3>
      <?php if (!empty($categoryId)): ?>
      <?php switch ($categoryId) {
              case 1:
                echo 'Bitcoin';

                break;
              case 2:
                echo 'Altcoin';
                break; }  ?>
      <?php else: ?>
      <?php echo 'All' ?>
      <?php endif; ?>
      Articles
    </h3>

    <a href="/article/edit" class="btn btn-dark ml-1" role="button">Add</a>

  </div>
  <table class="table table-striped table-hover">
    <tbody>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Title</th>
        <th scope="col">Author</th>
        <th scope="col">Date</th>
        <th></th>
      </tr>
      <?php foreach ($articles as $article): ?>
      <tr>
        <td class="align-middle">
          <?php echo htmlspecialchars($article['id'], ENT_QUOTES, 'UTF-8')  ?>
        </td>

        <td class="align-middle">
          <a href="/article/page?id=<?php echo $article['id'] ?>">
            <?php echo htmlspecialchars($article['articlesubject'], ENT_QUOTES, 'UTF-8')  ?>
          </a>
        </td>

        <td class="align-middle">
          <a href="mailto:<?php echo htmlspecialchars($article['email'], ENT_QUOTES, 'UTF-8') ?>">
            <?php echo htmlspecialchars($article['name'], ENT_QUOTES, 'UTF-8') ?>
          </a>
        </td>

        <td class="align-middle">
          <?php echo $article['articledate']; ?>
        </td>

        <td class="table-btn-col">

          <?php if ($userId == $article['userId']) : ?>
          <div class="d-flex justify-content-around">
            <a class="btn btn-dark ml-1" role="button" href="/article/edit?id=<?php echo $article['id']?>">Edit</a>

            <form action="/article/delete" method="post">
              <input type="hidden" name="id" value="<?=$article['id']?>">
              <input class="btn btn-dark" type="submit" value="Delete">
            </form>
          </div>
          <?php endif; ?>

        </td>


      </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>