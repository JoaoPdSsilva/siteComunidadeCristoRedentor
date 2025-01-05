$(document).ready(function(){
    $('#AnoAtual').text(new Date().getFullYear());
    $('#santoDia').text(new Date().toLocaleDateString());
    
    var dataSanto = (String(new Date().getMonth() + 1).padStart(2, '0')) + '-' + String(new Date().getDate()).padStart(2, '0');
    $('a[href="view/SantoDoDia.php?data="]').attr('href', 'view/SantoDoDia.php?data=' + dataSanto);


});
