<style>
  .container {
    font-size: 16px;
  }
  #tableau {
    width: 55%;
    margin: auto;
  }
  th, td {
    text-align: center;
    background-color: white;
    color: black;
    font-family: Arial, Helvetica, sans-serif;
    padding: 10px;
  }
  tr:nth-child(even) {
    background-color: #ededed;
  }
  h3 {
    text-align: center;
  }
</style>

<div class="container">
  <div class="row">
    <h2><u>Matiere premier pour fabriquer un packet</u></h2>
    <?php 
          $idpacket = 0;
          $isfirst = true;
          $prixTotal = 0;

          foreach ($liste as $item) {
            if ($item->getPacket()->getId() != $idpacket) {
              if (!$isfirst) { 
                 ?>
                <tr><td colspan='3'>Total: <?= $prixTotal ?>  Ar</td></tr>
                </table>"; 
              <?php }
                  $idpacket = $item->getPacket()->getId();
                  $isfirst = false;
                  $prixTotal = 0;
              ?>
              <div style='margin-top: 30px;'><h3><span style='font-size: 50px;'> </span> <?= $item->getPacket()->getNom() ?></h3></div>
              <table id='tableau' class='table table-bordered'>
                      <tr>
                        <th>Produit</th>
                        <th>Quantite</th>
                        <th>Prix total</th>
                      </tr>
              <?php } 
                $prixTotal += $item->getPrix();
              ?>
            <tr>
                    <td><?= $item->getProduit()->getNom() ?></td>
                    <td><?= $item->getQuantite() ?></td>
                    <td><?= $item->getPrix() ?></td>
                  </tr>
                  <?php }
          if (!$isfirst) {  ?>
            <tr><td colspan='3'>Total:<?= $prixTotal ?> Ar</td></tr>
            </table>
          <?php } ?> 
  </div>
</div>
