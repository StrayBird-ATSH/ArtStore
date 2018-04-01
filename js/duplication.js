window.onload = function () {
    console.log('add new trow run');
    var trow = document.querySelectorAll("#selected_row");
    var duplicationTimes = 5;
    console.log(trow);
    for (var i = 0; i < duplicationTimes; i++) {
        var newNode = document.createElement("tr");
        newNode = trow;
        newNode.id = ("newNode" + i).toString();
        this.parentNode.appendChild(newNode);
    }
};
