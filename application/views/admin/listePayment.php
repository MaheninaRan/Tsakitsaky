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
</style>
<div class="container">
    <div class="row">
        <table id="tableau" class="table table-bordered">
            <th>Etudiant</th>
            <th>Payer</th>
            <th>Reste</th>
            <?php foreach($liste as $listes){ ?>
                <tr>
                    <td><?= $listes->getEtudiant()->getNom()?> <?= $listes->getEtudiant()->getPrenom()?></td>
                    <td><?= $listes->getPayer() ?></td>
                    <td><?= $listes->getReste() ?></td>
                </tr>
            <?php } ?>

        </table>
    </div>
</div>