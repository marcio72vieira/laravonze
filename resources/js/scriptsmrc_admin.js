// OS SCRIPTS DESCRITOS AQUI, SERÃO EXECUTADOS INDEPENDENTE DA PÁGINA QUE VOCÊ ESTEJ, POIS ESTES SCRIPTS SÃO DE USO GERAL


// Recebe o seletor do campo preço
let inputPrice = document.getElementById('price');

// Verifique se existe o seletor no HTML. Obs: Dependendo da página que você esteja, é possível que este seletor não exista, por isso a necessidade de testar sua existência
if(inputPrice){

    // Aguardar o usuário digitar o valo no campo
    inputPrice.addEventListener('input', function(){

        // Obter o valor atual removendo qualquer caracter que não seja número
        let valuePrice = this.value.replace(/[^\d]/g, '');

        // Adicionar os separadores de milhares
        var formattedPrice = (valuePrice.slice(0, -2).replace(/\B(?=(\d{3})+(?!\d))/g, '.')) + '' + valuePrice.slice(-2);

        // Adicionar a vírgula e até dois dígitos se houver centavos
        if(formattedPrice.length > 2){
            formattedPrice = formattedPrice.slice(0, -2) + "," + formattedPrice.slice(-2);
        }


        // Atualizar o valor do campo
        this.value = formattedPrice;

    });
}

// Uso do SweetAlert2
// Receber o seletor apagar e percorrer a lista de registros
document.querySelectorAll('.btnDelete').forEach( function(button){

    // Aguardar o clique do usuário no botão apagar
    button.addEventListener('click', function(event){
        event.preventDefault();

        // Receber o atributo que possui o id do registro que deve ser excluído
        var deleteId = this.getAttribute('data-delete-id');
        var valueRecord = this.getAttribute('data-value-record');


        // SweetAlert
        Swal.fire({
            title: 'Deletar\n' + valueRecord + ' ?',
            text: 'Você não poderá reverter esta ação!',
            icon: 'warning',
            showCancelButton: true,
            cancelButtonColor: '#0d6efd',
            cancelButtonText: 'Cancelar',
            confirmButtonColor: "#dc3545",
            confirmButtonText: "Sim, Excluir!"
        }).then((result) => {
            // Carregar a página responsável em excluir se o usuário confirmar a exclusão
            if (result.isConfirmed) {

                document.getElementById(`formDelete${deleteId}`).submit();
            }
        });
    });
})

// Uso do Select2
// Quando carregar a página execute o Select2
// Acrescentar a classe ".select2" em todos os selects que houver a necessidade de utilizar o select2
$(function() {
    $('.select2').select2({
        theme: 'bootstrap-5',
    });
});
