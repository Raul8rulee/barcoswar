<?php
$j1 = $_GET["Jugador1"];
$j2 = $_GET["Jugador2"];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>batalla.php</title>
    <link rel="stylesheet" href="css/imagenes.css">
</head>
<body style="background-image: url('img/ame.jpeg'); background-size: cover; background-repeat: no-repeat;">
<div>
    <center>
        <div style="margin: auto; float: left; width: 50%;">
        <h1>Jugador <?php echo $j1?> <br>barcos tirados= <span id="bTj1">0</span></h1>
            <table>
            <?php
                //Crear el tablero para el jugador 2
                for($i=0;$i<10;$i++){
                ?>
                    <tr>
                    <?php
                    for($j=0;$j<10;$j++){
                    ?>
                    <td id="<?php echo $i;?>-<?php echo $j;?>-j2" style="width: 60px; height: 60px; background-color: aqua; border: solid 2px aqua; border-radius: 2px;" onclick="tirar('<?php echo $i;?>','<?php echo $j;?>','j1')"></td>
                    <?php
                    }
                    ?>
                    </tr>
                <?php
                }
                ?>
            </table>
        </div>
        <div style="margin: auto; float: right; width: 50%;">
        <h1>Jugador <?php echo $j2?> <br>barcos tirados= <span id="bTj2">0</span></h1>
            <table>
            <?php
                //Crear el tablero para el jugador 2
                for($i=0;$i<10;$i++){
                ?>
                    <tr>
                    <?php
                    for($j=0;$j<10;$j++){
                    ?>
                    <td id="<?php echo $i;?>-<?php echo $j;?>-j1" style="width: 60px; height: 60px; background-color: aqua; border: solid 2px aqua; border-radius: 2px;" onclick="tirar('<?php echo $i;?>','<?php echo $j;?>','j2')"></td>
                    <?php
                    }
                    ?>
                    </tr>
                <?php
                }
                ?>
            </table>
        </div>
    </center>
    <script>
        var nombrej1="<?php echo $j1;?>";
        var nombrej2="<?php echo $j2;?>";
        var tj1=[[],[],[],[],[],[],[],[],[],[]];
        var tj2=[[],[],[],[],[],[],[],[],[],[]];
        var bj1=0;
        var bj2=0;
        var bj1x=[];
        var bj1y=[];
        var bj2x=[];
        var bj2y=[];
        var turnoj1=true;
        var turnoj2=false;
        var ganar=false;
        btj1=0;
        btj2=0;
        
        for(let i=0;i<10;i++){
            for(let j=0;j<10;j++){
                tj1[i][j]=0;
                tj2[i][j]=0;
            }
        }
        while(bj1<10){
            let x = Math.floor(Math.random()*(9-0)+0);
            let y = Math.floor(Math.random()*(9-0)+0);
            if(tj1[y][x]!=1){
                bj1x[bj1]=x;
                bj1y[bj1]=y;
                tj1[y][x]=1
                bj1++
            }
        }
        while(bj2<10){
            let x = Math.floor(Math.random()*(9-0)+0);
            let y = Math.floor(Math.random()*(9-0)+0);
            if(tj2[y][x]!=1){
                bj2x[bj2]=x;
                bj2y[bj2]=y;
                tj2[y][x]=1
                bj2++
            }
        }
        console.log(tj1);
        console.log(tj2);

        function tirar(y,x,j){
            if(ganar==false){
                if(turnoj1==true){
                    if(j=='j1'){
                        if(tj2[y][x]==1){
                            document.getElementById(y+"-"+x+"-j2").style.backgroundImage="url('img/tormenta.jpg')";
                            document.getElementById(y+"-"+x+"-j2").style.backgroundSize="cover";
                            tj2[y][x]=2;
                            turnoj1=true;
                            bj2--;
                            btj1++
                            document.getElementById("bTj1").textContent=btj1;
                            //comparar si el jugador 1 ha tirado todos los barcos
                            if(bj2==0){
                                alert(nombrej1+" ha ganado");
                                ganar=true;
                            }
                        }else if(tj2[y][x]==2){
                            turnoj1=true;
                        }else if(tj2[y][x]==0){
                            document.getElementById(y+"-"+x+"-j2").style.filter="brightness(0.5)";
                            tj2[y][x]=2;
                            turnoj1=false
                        }
                        if(turnoj1==false){
                            turnoj2=true;
                        }
                    }
                }else if(turnoj2==true){
                    if(j=='j2'){
                        if(tj1[y][x]==1){
                            document.getElementById(y+"-"+x+"-j1").style.backgroundImage="url('img/tormenta.jpg')";
                            document.getElementById(y+"-"+x+"-j1").style.backgroundSize="cover";
                            tj1[y][x]=2;
                            turnoj2=true;
                            bj1--;
                            btj2++
                            document.getElementById("bTj2").textContent=btj2;
                            //comparar si el jugador 2 ha tirado todos los barcos
                            if(bj1==0){
                                alert(nombrej2+" ha ganado");
                                ganar=true;
                            }
                        }else if(tj1[y][x]==2){
                            turnoj2=true;
                        }else if(tj1[y][x]==0){
                            document.getElementById(y+"-"+x+"-j1").style.filter="brightness(0.5)";
                            tj1[y][x]=2;
                            turnoj2=false;
                        }
                        if(turnoj2==false){
                            turnoj1=true;
                        }
                    }
                }
            }
        }   
    </script>
    </body>
</html>