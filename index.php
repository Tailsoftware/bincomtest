<?php
include('controller.php');

/* if(isset($_POST['lgaid'])){
    if($_POST['lgaid'] !=''){
       $lgaid = htmlspecialchars($_POST['lgaid']);
       $functions->summedpollingunitresult($lgaid);
    }
} */



?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="bootstrap.min.css">
    <title>Document</title>
</head>
<body>
<a href="index.php"> <h4>Question 1</h4></a>
<a href="page2.php"> <h4>Question 2</h4></a>
<a href="page3.php"> <h4>Question 3</h4></a>

    <div class="table-responsive w-50 m-auto">
     
        <table class="table">
            <tr>
                <th>Polling.Unit</th>
                <th>Party</th>
                <th>Score</th>
                <th>position</th>
            </tr>

            <?php
            $functions->query="SELECT * FROM polling_unit";
            $functions->send = $functions->conn->query($functions->query);
            $functions->resultnum = mysqli_num_rows($functions->send);
            if($functions->resultnum>0){
                while($functions->result=mysqli_fetch_assoc($functions->send)){
                    $uniqeid = $functions->result['uniqueid'];
                    $functions->query2="SELECT * FROM announced_pu_results WHERE polling_unit_uniqueid ='$uniqeid' ORDER BY party_score DESC";
                    $functions->send2=$functions->conn->query($functions->query2);
                    $functions->resultnum2=mysqli_num_rows($functions->send2);
                    if($functions->resultnum2>0){
                        $i=0;
                        $abbr=null;
                        while($functions->result2=mysqli_fetch_assoc($functions->send2)){
                            $i++;
                            if($i==1){
                                $abbr='st';
                            }
                            else if($i==2){
                                $abbr='nd';
                            }
                            else if($i==3){
                                $abbr='rd';
                            }
                            else{
                                $abbr='th';
                            }
                            $uniqeid = $functions->result2['polling_unit_uniqueid'];
                            $party = $functions->result2['party_abbreviation'];
                            $score = $functions->result2['party_score'];

                            ?>
                                 <tr>
                                      <td>polling:<?=$uniqeid?></td>
                                      <td><?=$party?></td>
                                      <td><?=$score?></td>
                                      <td><?=$i?><?=$abbr?></td>
                                 </tr>

                            <?php




                        }
                    }
                }
            }


            ?>
           
        </table>
    </div>





   
 
</body>
</html>