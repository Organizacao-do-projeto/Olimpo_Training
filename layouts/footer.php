<style>
.footerRoot {
  height: 177px;
  background: linear-gradient(to right,
    #f0f0f0, #ede5c1, #ebdba8);;
  margin: 0 auto;
  width: 100%;
}

.flex{
    display: flex;
    align-items: center;
    justify-content: space-between;
}

.flex-column{
    display: flex;
    flex-direction: column;
    gap: 20px;
}

.container{
    width: 80vw;
    margin: 0 auto;
    height: 100%;
}


.footerRoot section img {
  height: 30px;
  width: 30px;
}

.footerRoot figure img {
  height: 150px;
  width: 150px;
}

.container > section > h2 {
  height: 7px;
  width: 668px;
  left: 5446px;
  font-family: 'Rubik';
  font-size: 35px;
  font-weight: 40;
  line-height: flex;
  text-align: center;
  color: #000000;
  margin-top: 7px;
}

.container > section > h3 {
  height: 31px;
  width: 320px;
  font-family: 'Rubik';
  font-size: 22px;
  font-weight: 400;
  line-height: 40px;
  text-align: left;
  color: #000000;
  margin: 0 auto;
  margin-top: 5px;
}

.footer-icons {
  display: flex;
  justify-content: center;
  align-items: center;
  gap: 20px;
}

</style>
<footer class="footerRoot">
    <div class="container flex">
        <a href="../index.php">
            <figure>
            <img src="../assets/img/logos/logo_principal.png" />
            </figure>
        </a>
        <section class="flex-column">
          <h2>TRANSFORME O SEU TREINO AQUI.</h2>
          <h3>SIGA NOSSAS REDES SOCIAIS</h3>
          <div class="footer-icons">
            <a href=""><img src="https://cdn-icons-png.flaticon.com/512/3955/3955024.png" /></a>
            <a href=""><img src="https://cdn-icons-png.flaticon.com/512/124/124010.png" /></a>
            <link rel="stylesheet" href="../assets/css/boot.css">
          </div>
        </section>
      </div>
</footer>