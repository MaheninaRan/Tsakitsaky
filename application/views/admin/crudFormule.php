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
  
  .popup {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    display: none;
    justify-content: center;
    align-items: center;
  }
  .popup-content {
    background-color: #fff;
    padding: 30px;
    width: 30%;
    border-radius: 10px;
  }
  #anarana{
    text-align: center;
    font-size: 25px;
    color: white;
  }
  .entete{
    background-color: green;
    margin-top: -6%;
    width: 112%;
    margin-left: -6%;
    text-align: center;
  }
  #close{
    color: white;
    background-color: red;
    text-align: center;
    font-weight: bold;
    font-size: 30px;
    cursor: pointer;
  }
 
  .valide{
    width: 50%;
    margin: auto;
  }
  .valide input{
    background-color: green;
    color: white;
    border: none;
    font-size: 16px;
    margin-top: 6%;
    border-radius: 30% 0% 30% 0%;
  }
  #champ{
        font-size: 16px;
    }
    input{
        height: 40px;
    }
    #upload{
        margin-left: 50px;
    }
    #photo{
     width: 70%;
     height: 200px;
     margin: auto;
  }
  #nouveau{
    width: 20%;
    margin: auto;
    font-size: 18px;
  }
  #edit{
    margin-top: 35px;
  }
  .edit{
        font-size: 16px;
        background-color: green;
        color: white;
        border: none;
    }
    .delete{
        font-size: 14px;
        background-color: red;
        color: white;
        border: none;
    }
</style>

<div class="container">
  
<h2> <u>Liste formule d'un packet</u></h2>
 <?php 
    if(isset($error) && $error!= ''){ ?>
    <div class="alert alert-danger"> <?= $error ?> </div>
    <?php   }
 ?>
<div class="row">
      <button id="nouveau" onclick="Ajouter()">Nouvelle formule <i class="fas fa-plus"></i> </button>
</div>
  <div class="row">
    
    <?php 
          $idpacket = 0;
          $isfirst = true;
          $prixTotal = 0;

          foreach ($liste as $item) {
            if ($item->getPacket()->getId() != $idpacket) {
              if (!$isfirst) { 
                 ?>
                <tr><td colspan='5'>Total: <?= $prixTotal ?>  Ar</td></tr>
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
                        <th colspan="2">Option</th>
                      </tr>
              <?php } 
                $prixTotal += $item->getProduit()->getPrix();
              ?>
            <tr>
                    <td><?= $item->getProduit()->getNom() ?></td>
                    <td><?= $item->getQuantite() ?></td>
                    <td><?= $item->getProduit()->getPrix() ?></td>
                    <td style="color:red;" > <button style="border: none;background-color:white" onclick="Supprimer(<?= $item->getId() ?>)"> <i class="fas fa-trash" ></i></button></td>
                    <td style="color:green">  <button style="border: none;background-color:white" onclick="Edit(<?= $item->getId() ?>,'<?= $item->getProduit()->getNom() ?>','<?= $item->getQuantite() ?>')"> <i class="fas fa-edit" ></i></button></td>

                  </tr>
                  <?php }
          if (!$isfirst) {  ?>
            <tr><td colspan='5'>Total:<?= $prixTotal ?> Ar</td></tr>
            </table>
          <?php } ?> 


          
<div id="supprimer" class="popup" style="display:none">
  <div class="popup-content">
    <div class="row entete"><p id="anarana">Vous êtes sur de supprimer ?</p></div><br>
    <form action="<?= base_url("index.php/CrudController/deleteFormule") ?>" method="post">
        <div class="row"> 
            <input type="hidden" id="idpacket" name="idformule">
            <button class="edit col-lg-offset-1 col-lg-4" type="submit">Valider <i class="fas fa-check-circle "></i></button>
            <button class="delete col-lg-offset-2 col-lg-4" type="button" onclick="manidy1()">Annuler <i class="fas fa-times-circle "></i> </button>
        </div>
    </form>
  </div>
</div>
  </div>
</div>

<div id="edit" class="popup" style="display:none">
  <div class="popup-content">
      <div class="row entete">
        <div class="col-lg-10"><p id="anarana" style="margin-left: 50px;">Modifier un formule</p></div>
        <div class="col-lg-2" id="close" onclick="manidy2()">X</div>
      </div><br>
      <form action="<?= base_url("index.php/CrudController/editFormule") ?>" method="post" enctype="multipart/form-data"> 
            <div class="row">
                <div class="col-lg-3" id="champ" >Produit</div>
                <select name="produit" id="produit" class="col-lg-7">
                    <?php foreach($produit as $produits){ ?>
                        <option value="<?= $produits->getId() ?>"><?= $produits->getNom() ?></option>
                    <?php } ?>
                </select>
            </div><br>
            <div class="row">
                <div class="col-lg-3" id="champ">Quantite</div>
                <input type="text" name="quantite" id="quantite" class="col-lg-7">
            </div><br>
            <input type="hidden" name="idformule" id="idformule">
            <div class="row valide"><input type="submit" value="Valider"></div>
      </form>
  </div>
</div>


<div id="ajouter" class="popup" style="display:none">
  <div class="popup-content">
      <div class="row entete">
        <div class="col-lg-10"><p id="anarana" style="margin-left: 50px;">Modifier un formule</p></div>
        <div class="col-lg-2" id="close" onclick="manidy3()">X</div>
      </div><br>
      <form action="<?= base_url("index.php/CrudController/ajoutFormule") ?>" method="post" enctype="multipart/form-data"> 
            <div class="row">
                <div class="col-lg-3" id="champ" >Produit</div>
                <select name="packet" id="packet" class="col-lg-7">
                    <?php foreach($packet as $packets){ ?>
                        <option value="<?= $packets->getId() ?>"><?= $packets->getNom() ?></option>
                    <?php } ?>
                </select>
            </div><br>
            <div class="row">
                <div class="col-lg-3" id="champ" >Produit</div>
                <select name="produit" id="produit" class="col-lg-7">
                    <?php foreach($produit as $produits){ ?>
                        <option value="<?= $produits->getId() ?>"><?= $produits->getNom() ?></option>
                    <?php } ?>
                </select>
            </div><br>
            <div class="row">
                <div class="col-lg-3" id="champ">Quantite</div>
                <input type="text" name="quantite" id="quantite" class="col-lg-7">
            </div><br>
            <input type="hidden" name="idformule" id="idformule">
            <div class="row valide"><input type="submit" value="Valider"></div>
      </form>
  </div>
</div>


<script>
    function Ajouter(){
      const BoiteAjouter=document.getElementById('ajouter');
        BoiteAjouter.style.cssText="display:flex";
    }
    function manidy3(){
        const connexionAdmin=document.getElementById('ajouter');
        connexionAdmin.style.cssText="display:none";
    }
    function Supprimer(id){
        const Boitesupprimer=document.getElementById('supprimer');
        var inputIdPacket = document.getElementById('idpacket');
        inputIdPacket.value=id;
        Boitesupprimer.style.cssText="display:flex";
    }
    function manidy1(){
        const connexionAdmin=document.getElementById('supprimer');
        connexionAdmin.style.cssText="display:none";
    }
    function manidy2(){
        const connexionAdmin=document.getElementById('edit');
        connexionAdmin.style.cssText="display:none";
    }

    function Edit(id,produit,quantite){
        const boiteEdit=document.getElementById('edit');
        var idFormule = document.getElementById('idformule');
        idFormule.value=id;
        var inputQuantite = document.getElementById('quantite');
        inputQuantite.value=quantite;
        boiteEdit.style.cssText="display:flex";
    }
</script>


