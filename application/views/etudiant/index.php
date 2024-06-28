<style>
  #champ{
      font-size: 20px; 
  }
  legend{
    font-size: 25px;
    font-family: Arial, Helvetica, sans-serif;
  }
  select{
    font-size: 15px;
  }
  input{
    font-size: 15px;
  }
  input::placeholder{
    color: red;
  }
</style>
<div class="container">
  <div class="row">
  <h2> <u>Insertion billet à vendre</u></h2>
    
      <form class="col-lg-offset-2 col-lg-8" action="<?= site_url("index.php/EtudiantController/billetVendu") ?>" method="post">
         <legend class="text-center">Billet</legend>
         
         <div class="row">
           <div class="col-lg-offset-2 col-lg-2" id="champ">Packet</div>
           <select class="col-lg-5" name="packet">
             <?php foreach($packet as $pack){ ?>
               <option value="<?= $pack->getId() ?>"><?= $pack->getNom() ?></option>
             <?php } ?>
          </select>
         </div><br>
         <div class="row">
           <div class="col-lg-offset-2 col-lg-2" id="champ">Client</div>
           <input type="text" name="client" class="col-lg-5"  required placeholder="<?= strip_tags(form_error('client'))?>">
         </div><br>
         <div class="row">
           <div class="col-lg-offset-2 col-lg-2" id="champ" >Date Heure</div>
           <input type="datetime-local" name="dateheure" class="col-lg-5" required>
         </div><br>
         <div class="row">
           <div class="col-lg-offset-2 col-lg-2" id="champ">Packet</div>
           <select class="col-lg-5" name="lieu">
             <?php foreach($lieu as $lieux){ ?>
               <option value="<?= $lieux->getId() ?>"><?= $lieux->getNom() ?></option>
             <?php } ?>
          </select>
         </div><br>
         <div class="row">
           <div class="col-lg-offset-2 col-lg-2" id="champ" >Etat</div>
           <select class="col-lg-5" name="etat">
               <option value="1" >Payer</option>
               <option value="0">En attente</option>
          </select>
         </div><br>
         <div class="row"><button class="col-lg-offset-5 col-lg-2" style="background-color: blue;color:white">Valider</button></div>
      </form>
  </div>
</div>