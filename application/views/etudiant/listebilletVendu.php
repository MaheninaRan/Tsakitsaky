<style>
  .container{
    font-size: 16px;
  }
  #tableau{
    width: 55%;
    margin: auto;

  }
  th{
    text-align: center;
    background-color: white;
    color: black;
    font-family: Arial, Helvetica, sans-serif;
  }
  tr{
    background-color: #ededed;
    color: black;
    font-family: monospace;
  }
  h3{
    text-align: center;
  }
</style>
<?php

$idetudiant=0;
$isfirst = true;

?>
<div class="container">
  <div class="row" >
      <h2> <u>Liste billet vendu par chaque étudiant</u></h2>
        <?php foreach($liste as $listes) { ?>
          
              <?php if ($listes->getEtudiant()->getId()!=$idetudiant) { ?>

                <?php if (!$isfirst) { ?>
                      </table> 
                      
                  <?php } 
                    $idetudiant=$listes->getEtudiant()->getId();
                    $isfirst = false;
                  ?>
                    <div style="margin-top: 30px;">  <h3> <span style="font-size: 50px;">.</span> <?= $listes->getEtudiant()->getNom() ?> <?= $listes->getEtudiant()->getPrenom() ?> </h3> </div>
                      <table id="tableau" class="table table-bordered" style="">
                        <th>Packet</th>
                        <th>Quantite</th>
              <?php } ?> 
              <tr> 
                  <td><?= $listes->getPacket()->getNom() ?> (<?= $listes->getPacket()->getPrix()?> Ar) </td>
                  <td><?= $listes->getQuantite() ?>  </td>
              </tr> 
          
        <?php  } ?> 
      
       
  </div>
</div>