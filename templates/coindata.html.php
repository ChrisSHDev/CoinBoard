<div class="row justify-content-center">

  <div class="title-box d-flex align-items-baseline">
    <h2>Coin Status</h2>
    <p class="ms-auto">From</p>
    <img src="/assets/Coinbase.png">
  </div>
  <div class="col-12">
    <table class="table">
      <thead class="table-light price-table">
        <tr>
          <th scope="col">Name</th>
          <th scope="col">Price (CAD)</th>
          <th scope="col">Price (USD)</th>
          <th scope="col">24 Hours Changes(USD)</th>
          <th scope="col">24 Hours Volume</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($coins as $coin) : ?>
        <tr>
          <td scope="row" class="coin-symbol"><img src="/assets/<?php echo $coin['name'] ?>.png" /></td>
          <td><?php echo number_format(htmlspecialchars($coin['CAD'], ENT_QUOTES, 'UTF-8'), 2, '.', ',') ?></td>
          <td><?php echo number_format(htmlspecialchars($coin['USD'], ENT_QUOTES, 'UTF-8'), 2, '.', ',') ?></td>
          <td>
            <?php echo number_format(htmlspecialchars($coin['changes'], ENT_QUOTES, 'UTF-8'), 2, '.', ',')?>
            ( <span id="change-ratio">
              <?php echo '' . number_format(htmlspecialchars($coin['ratio'], ENT_QUOTES, 'UTF-8'), 2, '.', ',') . '%' ?>
            </span> )
          </td>
          <td>
            <?php echo number_format(htmlspecialchars($coin['volume'], ENT_QUOTES, 'UTF-8'), 2, '.', ',').' [' .htmlspecialchars($coin['name'], ENT_QUOTES, 'UTF-8').']' ?>
          </td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</div>