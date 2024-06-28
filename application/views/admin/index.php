<style>
    
    .cadre{
        border: 1px solid;
        background-color: white;
        margin-top: 20px;
        padding: 1%;
        margin-left: 60px;
    }
    .titre{
        text-align: center;
        font-size: 25px;
        font-family: serif;
        color: black;
        font-weight: bold;
    }
    img{
        width: 100%;
        height: 60%;
    }
    .prix{
        margin-top: 10px;
        text-align: center;
        font-size: 20px;
        font-family: monospace;
    }
    a{
        text-decoration: none;
        color: white;
    }
    a:hover{
        text-decoration: none;
        color: white;
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
    i{
        font-size: 14px;
        margin-left: 5%;
    }
</style>  <!-- Style Cadre -->

<style>
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
</style> <!-- Style modal -->
<div class="container">
<h2> <u>Liste tous les packets</u></h2>
 <?php 
    if(isset($error) && $error!= ''){ ?>
    <div class="alert alert-danger"> <?= $error ?> </div>
    <?php   }
 ?>
<div class="row">
      <button id="nouveau" onclick="Ajouter()">Nouvelle packet <i class="fas fa-plus"></i> </button>
</div>
    <div class="row"> 
        <?php foreach($packet as $packets) { ?>
            <div class="cadre col-lg-3">
                <p class="titre"><?= $packets->getNom() ?></p>
                <img src="<?= base_url($packets->getPhoto()) ?>" alt="">
                <p class="prix"><b>Prix : </b> <?= $packets->getPrix() ?> Ar</p>
                <div class="row"> 
                    <button class="edit col-lg-offset-1 col-lg-4" 
                        onclick="Edit( <?= $packets->getId() ?>, 
                                      '<?= $packets->getPhoto() ?>',
                                      '<?= $packets->getNom() ?>',
                                      '<?= $packets->getPrix() ?>'
                        )">  
                        Edit <i class="fas fa-edit"></i>
                    </button>
                    <button class="delete col-lg-offset-2 col-lg-4" onclick="Supprimer(<?= $packets->getId() ?>)">Delete <i class="fas fa-trash"></i> </button>
                </div>
            </div>
            
        <?php } ?>
    </div>
</div>

<div id="supprimer" class="popup" style="display:none">
  <div class="popup-content">
    <div class="row entete"><p id="anarana">Vous êtes sur de supprimer ?</p></div><br>
    <form action="<?= base_url("index.php/CrudController/deletePacket") ?>" method="post">
        <div class="row"> 
            <input type="hidden" id="idpacket" name="idpacket">
            <button class="edit col-lg-offset-1 col-lg-4" type="submit">Valider <i class="fas fa-check-circle "></i></button>
            <button class="delete col-lg-offset-2 col-lg-4" type="button" onclick="manidy1()">Annuler <i class="fas fa-times-circle "></i> </button>
        </div>
    </form>
  </div>
</div>

<div id="edit" class="popup" style="display:none">
  <div class="popup-content">
      <div class="row entete">
        <div class="col-lg-10"><p id="anarana" style="margin-left: 50px;">Modifier un packet</p></div>
        <div class="col-lg-2" id="close" onclick="manidy2()">X</div>
      </div><br>
      <form action="<?= base_url("index.php/CrudController/editPacket") ?>" method="post" enctype="multipart/form-data">
            <div class="row"><img src="" id="photo" alt="Photo"></div> <br>
            <div class="row">
                <div class="col-lg-3" id="champ">Image</div>
                <input type="file" id="upload" name="userfile" class="col-lg-7">
            </div><br>
            <div class="row">
                <div class="col-lg-3" id="champ" >Nom</div>
                <input type="text" name="nom" id="nom" class="col-lg-7">
            </div><br>
            <div class="row">
                <div class="col-lg-3" id="champ">Prix</div>
                <input type="text" name="prix" id="prix" class="col-lg-7">
            </div><br>
            <input type="hidden" name="idpacket" id="idpacketedit">
            <input type="hidden" name="currentphoto" id="currentphoto">
            <div class="row valide"><input type="submit" value="Valider"></div>
      </form>
  </div>
</div>


<div id="ajouter" class="popup" style="display:none">
  <div class="popup-content">
      <div class="row entete">
        <div class="col-lg-10"><p id="anarana" style="margin-left: 50px;">Nouvelle packet</p></div>
        <div class="col-lg-2" id="close" onclick="manidy3()">X</div>
      </div><br>
      <form action="<?= base_url("index.php/CrudController/ajouter") ?>" method="post" enctype="multipart/form-data">
            <div class="row">
                <div class="col-lg-3" id="champ">Image</div>
                <input type="file" id="upload" name="userfile" class="col-lg-7">
            </div><br>
            <div class="row">
                <div class="col-lg-3" id="champ" >Nom</div>
                <input type="text" name="nom" id="nom" class="col-lg-7">
            </div><br>
            <div class="row">
                <div class="col-lg-3" id="champ">Prix</div>
                <input type="text" name="prix" id="prix" class="col-lg-7">
            </div><br>
            <input type="hidden" name="idpacket" id="idpacketedit">
            <input type="hidden" name="currentphoto" id="currentphoto">
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

    function Edit(id,photo,nom,prix){
        const boiteEdit=document.getElementById('edit');
        var inputIdPacket = document.getElementById('idpacketedit');
        inputIdPacket.value=id;
        var inputPhoto = document.getElementById('currentphoto');
        inputPhoto.value=photo;
        const baseUrl = '<?= base_url() ?>' + photo;
        var image = document.getElementById('photo');
        image.src=baseUrl;
        var inputNom = document.getElementById('nom');
        inputNom.value=nom;
        var inputPrix = document.getElementById('prix');
        inputPrix.value=prix;
        boiteEdit.style.cssText="display:flex";
    }
</script>