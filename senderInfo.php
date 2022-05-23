<?php
function getSenderHeader ($message_id){
    $remitente_id=zurron_obtenerRemitenteID($message_id);
    $infoSender=zurron_infoSender($remitente_id['id']);
    echo "<div style='display: flex; lex-direction: row; lustify-content: space-around; align-items: center; border: 1px dotted black'>";
        echo "<div style='margin: 1rem;' >";
            echo $infoSender['nick'];
        echo "</div>";
        echo "<div style='margin: 1rem;'>";
            if(isset($infoSender['name']))
                echo $infoSender['name'];
        echo "</div>";
        echo "<div style='margin: 1rem;'>";
            if(isset($infoSender['surname']))
                echo $infoSender['surname'];
        echo "</div>";
        echo "<div style='margin: 1rem;'>";
            if(isset($infoSender['email']))
                echo $infoSender['email'];
        echo "</div>";
        echo "<div style='margin: 1rem;'>";
            if(isset($infoSender['direccion']))
                echo $infoSender['direccion'];
        echo "</div>";
        echo "<div style='margin: 1rem;'>";
            if(isset($infoSender['age']))
                echo $infoSender['age'];
        echo "</div>";
        switch ($infoSender['pfp']) {
            case 1:
                echo "<div style='margin: 1rem; '>";
                echo"<img src='./Perfil1.png' alt='' style='height:40px;' >";
                echo "</div>";
            break;
            case 2:
                echo "<div style='margin: 1rem; '>";
                echo"<img src='./Perfil2.png' alt='' style='height:40px;' >";
                echo "</div>";
            break;
            case 3:
                echo "<div style='margin: 1rem; '>";
                echo"<img src='./Perfil3.png' alt='' style='height:40px;' >";
                echo "</div>";
            break;
            case 4:
                echo "<div style='margin: 1rem; '>";
                echo"<img src='./Perfil4.png' alt='' style='height:40px;' >";
                echo "</div>";
            break;
            case 5:
                echo "<div style='margin: 1rem; '>";
                echo"<img src='./Perfil5.png' alt='' style='height:40px;' >";
                echo "</div>";
            break;
            case 6:
                echo "<div style='margin: 1rem; '>";
                echo"<img src='./Perfil6.png' alt='' style='height:40px;' >";
                echo "</div>";
            break;
            case 7:
                echo "<div style='margin: 1rem; '>";
                echo"<img src='./Perfil7.png' alt='' style='height:40px;' >";
                echo "</div>";
            break;
            case 8:
                echo "<div style='margin: 1rem; '>";
                echo"<img src='./Perfil8.png' alt='' style='height:40px;' >";
                echo "</div>";
            break;
            case 9:
                echo "<div style='margin: 1rem; '>";
                echo"<img src='./Perfil9.png' alt='' style='height:40px;' >";
                echo "</div>";
            break;
            case 10:
                echo "<div style='margin: 1rem; '>";
                echo"<img src='./Perfil10.png' alt='' style='height:40px;' >";
                echo "</div>";
            break;
            case 11:
                echo "<div style='margin: 1rem; '>";
                echo"<img src='./Perfil11.png' alt='' style='height:40px;' >";
                echo "</div>";
            break;
            case 12:
                echo "<div style='margin: 1rem; '>";
                echo"<img src='./Perfil12.png' alt='' style='height:40px;' >";
                echo "</div>";
            break;
            case 13:
                echo "<div style='margin: 1rem; '>";
                echo"<img src='./Perfil13.png' alt='' style='height:40px;' >";
                echo "</div>";
            break;
            case 14:
                echo "<div style='margin: 1rem; '>";
                echo"<img src='./Perfil14.png' alt='' style='height:40px;' >";
                echo "</div>";
            break;
            case 99:
                echo "<div style='margin: 1rem; '>";
                echo"<img src='./Perfil99.png' alt='' style='height:40px;' >";
                echo "</div>";
            break;
            
            default:
                echo "<div style='margin: 1rem; '>";
                echo"<img src='./Perfil99.png' alt='' style='height:40px;' >";
                echo "</div>";
            break;
        }
        
        

    echo "</div>";
    echo "<br>";

}