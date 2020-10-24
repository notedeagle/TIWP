<html lang="">
<head>
    <title>Draw</title></head>
<body>
<canvas id="draw" width="500" height="500" style="border: solid 1px black;">
    Twoja przegladraka nie obsluguje elementu Canvas.
</canvas>

<button id="fioletowy">fioletowy</button>
<button id="zielony">zielony</button>
<button id="zolty">zolty</button>
<button id="brazowy">brazowy</button>

<button id="male">male</button>
<button id="srednie">srednie</button>
<button id="duze">duze</button>
<button id="ogromne">ogromne</button>
<button id="gumka">gumka</button>
<button id="czysc">wyczysc plotno</button>

<script type="text/javascript">
    var clickX = [];
    var clickY = [];
    var clickDrag = [];
    var paint = false;
    var context = null;
    var canvas;

    const colorPurple = "#cb3594";
    const colorGreen = "#659b41";
    const colorYellow = "#ffcf33";
    const colorBrown = "#986928";
    const colorWhite = "white";
    var curColor = colorPurple;
    var clickColor = [];
    //nowo�� tablica rozmiar�w
    var clickSize = [];
    var curSize = 5;

    male.onclick = function() {
        curSize = 3;
    }

    srednie.onclick = function() {
        curSize = 5;
    }

    duze.onclick = function() {
        curSize = 7;
    }

    ogromne.onclick = function() {
        curSize = 9;
    }

    fioletowy.onclick = function() {
        curColor = colorPurple;
    }

    zielony.onclick = function() {
        curColor = colorGreen;
    }

    zolty.onclick = function() {
        curColor = colorYellow;
    }

    brazowy.onclick = function() {
        curColor = colorBrown;
    }

    czysc.onclick = function() {
        context.clearRect(0, 0, 500, 500);
        clickX = [];
        clickY = [];
        clickDrag = [];
        clickColor = [];
        clickSize = [];
    }

    gumka.onclick = function() {
        curColor = colorWhite;
        curSize = 15;
    }

    canvas = document.getElementById('draw');
    context = canvas.getContext('2d');

    canvas.onmousedown = function(e){
        paint = true;
        addClick(e.pageX - this.offsetLeft, e.pageY - this.offsetTop, false);
        redraw();
    }

    canvas.onmousemove = function(e){
        if(paint){
            addClick(e.pageX - this.offsetLeft, e.pageY - this.offsetTop, true);
            redraw();
        }
    }

    canvas.onmouseup = function(){
        paint = false;
    }

    function addClick(x, y, dragging)
    {
        clickX.push(x);
        clickY.push(y);
        clickDrag.push(dragging);
        clickColor.push(curColor);
        //nowo�� zapami�tanie rozmiaru
        clickSize.push(curSize);
    }

    function redraw(){
        context.clearRect(0, 0, 500, 500);
        context.lineJoin = "round";
        // usunieto context.lineWidth = 5;

        for(var i=0; i < clickX.length; i++)
        {
            context.beginPath();
            if(clickDrag[i]){
                context.moveTo(clickX[i-1], clickY[i-1]);
            }else{
                context.moveTo(clickX[i], clickY[i]);
            }
            context.lineTo(clickX[i], clickY[i]);
            context.closePath();
            context.strokeStyle = clickColor[i];
            //ustaw grubo�� linii
            context.lineWidth = clickSize[i];
            context.stroke();
        }
    }

    function reset() {
        context.clearRect(0, 0, 500, 500);
    }

</script>

</body>
</html>
