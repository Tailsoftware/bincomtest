<?php
include('controller.php');
$lga = null;

if(isset($_POST['lgaid'])){
    if($_POST['lgaid'] !=''){
       $lga= htmlspecialchars($_POST['lgaid']);
    }
}

$sumscore= 0;

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



    <div class="w-50 m-auto">
        <h4>Question 2</h4>
        <form action="<?=$_SERVER['PHP_SELF']?>" class="w-100" method="POST">
            <div class="input-group">
            <select name="lgaid" id="" class="form-control">
                <option value="">Select LGA</option>
                <?php
                $functions->query="SELECT * FROM lga";
                $functions->send = $functions->conn->query($functions->query);
                $functions->resultnum=mysqli_num_rows($functions->send);
                if($functions->resultnum>0){
                    while($functions->result=mysqli_fetch_assoc($functions->send)){
                        $lganame = $functions->result['lga_name'];
                        $lgaid = $functions->result['lga_id'];
                        ?>
                       <option value="<?=$lgaid?>"><?=$lganame?></option>

                        <?php
                    }
                }
                
                ?>
            </select>
            <button class="btn btn-dark">Check</button>
            </div>
           
        </form>
    </div>
           
       
    <div class="table-responsive w-50 m-auto">
     
     <table class="table">
         <tr>
             <th>unit</th>
             <th>Party</th>
             <th>Score</th>
         </tr>

         <?php
      $functions->query="SELECT * FROM polling_unit WHERE lga_id ='$lga';";
         $functions->send = $functions->conn->query($functions->query);
        $functions->resultnum = mysqli_num_rows($functions->send);
         if($functions->resultnum>0){
             while($functions->result=mysqli_fetch_assoc($functions->send)){
                 $unit = $functions->result['uniqueid'];
                $functions->query2="SELECT * FROM announced_pu_results WHERE polling_unit_uniqueid ='$unit' ORDER BY party_score DESC";
                 $functions->send2=$functions->conn->query($functions->query2);
                 $functions->resultnum2=mysqli_num_rows($functions->send2);
                 if($functions->resultnum2>0){

                     while($functions->result2=mysqli_fetch_assoc($functions->send2)){
                        $unit = $functions->result['uniqueid'];
                         $score = $functions->result2['party_score'];
                         $sumscore+=$score;
                         $party = $functions->result2['party_abbreviation'];
                        ?>
                        <tr>    
                           <td><?=$unit?></td>
                           <td><?=$party?></td>
                           <td><?=$score?></td>
                        </tr>

                      <?php               
                                        
                        
                                    
                         }
                                   
                            }
                            
                            }
                        }
                       

                        $functions->query="SELECT * FROM lga WHERE lga_id ='$lga'";
                        $functions->send = $functions->conn->query($functions->query);
                        $functions->resultnum=mysqli_num_rows($functions->send);
                        if($functions->resultnum>0){
                            $functions->result=mysqli_fetch_assoc($functions->send);
                            $lganame = $functions->result['lga_name'];

                        }
         ?>
        
     </table>
  
              
     <h4>Sum total result of all unit under <?=$lganame?> = <?=$sumscore?></h4>
 </div>



 
</body>
</html>