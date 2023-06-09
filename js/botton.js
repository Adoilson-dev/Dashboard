function animateButton() {
    const button = document.querySelector('.search-bar button');
    button.classList.add('clicked');
  
    setTimeout(function () {
        button.classList.remove('clicked');
    }, 1000);
  
    const startDate = document.getElementById('startDate').value;
    const endDate = document.getElementById('endDate').value;
  
    // Executar a busca com as datas selecionadas
    console.log('Data Inicial:', startDate);
    console.log('Data Final:', endDate);
}
