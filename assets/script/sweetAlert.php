<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
    // parametros do sweet alert "warning", "error", "success" and "info".

    function swalConfirm(e, titulo="Confirma?", text="Deseja confirmar a ação?", cancel="Não, cancelar!", confirm="Sim, confirmar" ){

    swal({
        title: titulo,
        text: text ,
        icon: 'warning',
        buttons: [cancel , confirm]})
        .then((isConfirm)=>{
        if(isConfirm){
            e.form.submit();
        }});
    }

    function swalSuccess( titulo="Sucesso", text="Ação foi executada com sucesso"){
    swal({
        title: titulo,
        text: text ,
        icon: 'success'
        })
    }

    function swalError( titulo="Erro", text="Algo de errado aconteceu!"){
    swal({
        title: titulo,
        text: text ,
        icon: 'error'
        })
    }


    window.addEventListener('DOMContentLoaded', ()=>{     

        <?php if(isset($_GET['success'])) echo "swalSuccess('Sucesso','".$_GET['success']."');"; ?>
        <?php if(isset($_GET['error'])) echo "swalError('Erro','".$_GET['error']."');"; ?>

    })


</script>
<!-- exemplo de form de confirm com swal -->
<!-- 
<form method="GET">
        <input type="hidden" name="error" value="Ficha de treino não foi encontrada!">
        <button type="button" onclick="swalConfirm(this)">Chama fio</button>
</form> -->