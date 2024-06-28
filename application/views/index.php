<style>
    .container{
        margin-top: 13%;
    }
    .log{
        text-align: center;
        padding: 3%;
        font-size: 30px;
        border-top: 5px solid green;
        border-left: 5px solid green;
        border-right: 5px solid green;
        box-shadow: 2px 2px 2px -5px;
        border-radius: 10px 100px 2px 50%;
        color: green;
        font-weight: bold;
        cursor: pointer;
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
    padding: 20px;
    width: 30%;
    border-radius: 10px;
  }
  #anarana{
    text-align: center;
    font-size: 25px;
    color: white;
  }
  .login{
    background-color: green;
    margin-top: -6%;
    width: 112%;
    margin-left: -6%;
  }
  #close{
    color: white;
    background-color: red;
    text-align: center;
    font-weight: bold;
    font-size: 30px;
    cursor: pointer;
  }
  #password,#email{
    height: 40px;
  }
  .valide{
    width: 50%;
    margin: auto;
  }
  .valide input{
    background-color: green;
    color: white;
    border: none;
    margin-top: 6%;
    border-radius: 50% 0% 50% 0%;
  }
</style>

<div class="container">
    <div class="row" >
        <div class="col-lg-2"></div>
        <div class="col-lg-3 log" onclick="loginAdmin()">Admin <br></div>
        <div class="col-lg-2"></div>
        <div class="col-lg-3 log" onclick="loginService()">Etudiant<br></div>
    </div>
</div>

<div id="popup" class="popup" >
  <div class="popup-content">
    <div class="row login">
        <div class="col-lg-3"></div>
      <div class="col-lg-5" id="anarana">Login Admin</div>
      <div class="col-lg-2"></div>
      <div class="col-lg-2 close" id="close" onclick="manidy()">X</div>
    </div> <br>
    <form action="<?= base_url("index.php/AdminController/connexionAdmin") ?>" method="post">
        <div class="row">
            <div class="col-lg-1"></div>
            <input class="col-lg-10 email" type="email" id="email" placeholder="Email" name="email"> <br>
        </div> <br>
        <div class="row">
            <div class="col-lg-1"></div>
            <input class="col-lg-10 password" type="password" id="password" placeholder="password" name="password"> <br>
        </div>
      <input type="hidden" name="idCv" id="idCv">
      <div class="row valide">
        <input type="submit" value="connecter">
      </div>
    </form>
  </div>
</div>
<div id="loginService" class="popup" style="display:none">
  <div class="popup-content">
    <div class="row login">
        <div class="col-lg-3"></div>
      <div class="col-lg-5" id="anarana">Login Etudiant</div>
      <div class="col-lg-2"></div>
      <div class="col-lg-2 close" id="close" onclick="manidy1()">X</div>
    </div> <br>
    <form action="<?= base_url("index.php/EtudiantController/connexionEtudiant") ?>" method="post">
        <div class="row">
            <div class="col-lg-1"></div>
            <input class="col-lg-10 email" type="text" id="email" placeholder="Email" name="email"> <br>
        </div> <br>
        <div class="row">
            <div class="col-lg-1"></div>
            <input class="col-lg-10 password" type="password" id="password" placeholder="password" name="password"> <br>
        </div>
      <input type="hidden" name="idCv" id="idCv">
      <div class="row valide">
        <input type="submit" value="connecter">
      </div>
    </form>
  </div>
</div>

<script>
    function loginAdmin(){
        const connexionAdmin=document.getElementById('popup');
        connexionAdmin.style.cssText="display:flex";
    }
    function manidy(){
        const connexionAdmin=document.getElementById('popup');
        connexionAdmin.style.cssText="display:none";
    }
    function loginService(){
        const connexionservice=document.getElementById('loginService');
        connexionservice.style.cssText="display:flex";
    }
    function manidy1(){
        const connexionservice=document.getElementById('loginService');
        connexionservice.style.cssText="display:none";
    }
</script>