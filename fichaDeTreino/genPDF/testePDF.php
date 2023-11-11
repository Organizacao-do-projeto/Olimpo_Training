<?php

include_once "dompdf/autoload.inc.php";

use Dompdf\Dompdf;

$textHTML = "<!DOCTYPE html>
<html lang='pt_br'>

<head>
  <meta charset='UTF-8'>
  <meta name='viewport' content='width=device-width, initial-scale=1.0'>
  <title>Gerar PDF</title>

  <style>
    /* link de backgrounds
https://img.freepik.com/premium-vector/seamless-backgroundon-theme-ancient-greece_600765-10069.jpg?w=740

https://www.google.com/imgres?imgurl=https%3A%2F%2Fst4.depositphotos.com%2F1536490%2F23131%2Fv%2F1600%2Fdepositphotos_231318870-stock-illustration-vector-seamless-pattern-theme-ancient.jpg&tbnid=hKV1YsTpeBZMOM&vet=10CGsQMyiXAWoXChMIuOz5pqr0gQMVAAAAAB0AAAAAEBc..i&imgrefurl=https%3A%2F%2Fdepositphotos.com%2Fvector%2Fvector-seamless-pattern-theme-ancient-greece-antique-manuscript-sketches-illegible-231318870.html&docid=r5nGernP6oo7pM&w=1600&h=1700&q=antuque%20greece%20wallpaper&ved=0CGsQMyiXAWoXChMIuOz5pqr0gQMVAAAAAB0AAAAAEBc

https://as2.ftcdn.net/v2/jpg/02/76/89/43/1000_F_276894370_yRQBrl3paubc8x1vOzB01Dh0h2ExxtYl.jpg

https://www.google.com/imgres?imgurl=https%3A%2F%2Fas1.ftcdn.net%2Fv2%2Fjpg%2F03%2F10%2F12%2F82%2F1000_F_310128207_pzfFfNF0BwE0QwWPy3sqXXhC0oZ7zdkf.jpg&tbnid=7K8nYU4WVWfRvM&vet=12ahUKEwj1ktWlqvSBAxVetJUCHQV_B_wQMyg7egUIARDOAQ..i&imgrefurl=https%3A%2F%2Fstock.adobe.com%2Fbr%2Fimages%2Fvector-seamless-pattern-on-the-theme-of-ancient-greece-with-sketches-of-architectural-monuments-and-symbols-of-ancient-greek-culture-wallpaper-wrapping-paper-or-fabric-with-hand-drawn-illustrations%2F310128207&docid=8NzAwBI9A7kgmM&w=1000&h=1000&q=antuque%20greece%20wallpaper&ved=2ahUKEwj1ktWlqvSBAxVetJUCHQV_B_wQMyg7egUIARDOAQ

https://i.pinimg.com/originals/1e/e2/fb/1ee2fb9717554a1dbb09b924f19f8e72.png */

    html{
      margin: 0cm;
    }

    *{
      font-family: 'Ubuntu', sans-serif, Arial, Helvetica;
    }

    body {
      margin: 0 auto;
    }

    #body_container {
      /* background-image: url(http://localhost/site_etc/teste/backgroundFicha.jpg); */
      background-position: center;
      background-repeat: repeat;
      background-size: contain;
      width: 1200px;
      min-height: 900px;
      display: inline-block;
      position: relative;
    }

    #backgroundFicha {
      width: 100%;
      height: 100%;
      position: absolute;
    }

    #nome_olimpo {
      position: absolute;
      margin-left: 20px;
      margin-top: 10px;
      width: 210px;
      height: 150px;
      filter: invert(100%);
    }


    .fichaFundo {
      position: absolute;
      margin-top: 125px;
      width: 100%;
      height: 800px;
      display: flex;
      justify-content: center;
      margin-left: 45px;

    }

    .ficha {
      position: absolute;
      width: 700px;
      border: 5px solid goldenrod;
      border-radius: 16px 16px;
    }

    .fichaCabecalho {
      background-color: white;
      border-radius: 10px 10px 0px 0px;
      width: 100%;

    }

    #observacoes {
      text-align: end;
      font-size: 18px;
    }

    #observacoes p {
      margin: 8px;
    }

    #observacoes span {
      margin: 8px;
      word-wrap: break-word;
      max-width: 50%;
    }

    
    .tableCabecalho > td {
      max-width: 50%;

    }

    #tableCabecalho_1td{
      height: 180px;
    }
    
    #tableCabecalho_1td > h1{
      font-size: 1.7rem;
      margin: 0 auto;
      margin-bottom: 40px;
    }

    #tableCabecalho_1td > p{
      font-size: 1.2rem;
    }

    #tabelaFicha {
      background-color: #C0C0C0;
      width: 100%;
      border: 1px solid;
      border-collapse: collapse;
      table-layout: fixed;
    }

    td {
      color: black;
      text-align: center;
    }
    
    #tabelaFicha td {
      border: 1px solid #fff;
      border-collapse: collapse;
      font-size: 18px;
      height: 60px;
    }
    
    #tabelaFicha th {
      font-size: 18px;
      height: 60px;
    }

    /* DOBRA FOOTER*/

    footer {
      display: flex;
      justify-content: center;
      align-items: center;

    }
    footer {
      position: absolute;
      margin-top: 1200px;
      
    }
    
    footer img {
      width: 50px;
      height: 50px;
    }
    
    
    #logo_baixo {
      display: flex;
      height: 220px;
      width: 220px;
      margin-left: 310px;
      
    }
  </style>
</head>

<body>

  <div id='body_container'>
    <img src='http://localhost/site_etc/teste/fichaDeTreino/genPDF/img/backgroundFicha.jpg' id='backgroundFicha' width='1300px' height='100%'>
    <img src='http://localhost/site_etc/teste/fichaDeTreino/genPDF/img/nome_olimpo.png' id='nome_olimpo'>
    <div class='fichaFundo'>
      <div class='ficha'>
        <div class='fichaCabecalho'>
          <table width='100%' class='tableCabecalho'>
            <td id='tableCabecalho_1td'>
              <h1>Treino A</h1>
              <p>Descanso: 45s</p>
            </td>
            <td id='observacoes'>
              <span>Obs.: Puxada pronada até a metade.</span>
              <p>Data de criação: 19/08/2023</p>
            </td>
          </table>
        </div>
        <table id='tabelaFicha'>
          <thead>
            <th width='50%'>Nome</th>
            <th width='10%'>Series</th>
            <th width='10%'>Repe.</th>
            <th width='10%'>Carga</th>
            <th width='10%'>Desc.</th>
          </thead>
          <tr>
            <td width='50%'>Flexao</td>
            <td width='10%'>3</td>
            <td width='10%'>20</td>
            <td width='10%'>15kg</td>
            <td width='10%'>30s</td>
          </tr>

        </table>

      </div>
    </div>
  </div>

</body>

</html>";

$dompdf = new Dompdf( ["enable_remote" => true] );

$dompdf->loadhtml($textHTML);

$dompdf->setPaper('A4', 'portrait');

$dompdf->render();

//aqui é o nome
$dompdf->stream("hdsahfhasdjhf");
