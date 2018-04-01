var parentElement = document.getElementsByClassName('dropdown');
var element = document.getElementsByClassName('dropdown-menu');

parentElement[0].onclick = function () {
    element[0].style.display === 'none' ?
        element[0].style.display = 'block' :
        element[0].style.display = 'none';
};
