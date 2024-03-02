<?php


include('controller.php');
if(isset($_POST['party']) AND isset($_POST['unit']) AND isset($_POST['score'])){
    if($_POST['party'] !='' AND $_POST['unit'] !='' AND $_POST['score'] !=''){
       $party= htmlspecialchars($_POST['party']);
       $unit= htmlspecialchars($_POST['unit']);
       $score= htmlspecialchars($_POST['score']);
      $functions->insertunitscore($party,$unit,$score);
    }
}

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
            <select name="party" id="" class="form-control">
                <option value="">Select Party</option>
                <?php
                $functions->query="SELECT * FROM party";
                $functions->send = $functions->conn->query($functions->query);
                $functions->resultnum=mysqli_num_rows($functions->send);
                if($functions->resultnum>0){
                    while($functions->result=mysqli_fetch_assoc($functions->send)){
                        $partyid = $functions->result['partyid'];
                        ?>
                       <option value="<?=$partyid?>"><?=$partyid?></option>

                        <?php
                    }
                }
                
                ?>
            </select>


            <input type="text" class="form-control" placeholder="polling Unit" name="unit">
            <input type="number" class="form-control" placeholder="score" name="score">
            
           <button class="btn btn-dark">Submit</button>
        </form>
    </div>
           
       
    <div class="table-responsive w-50 m-auto">
     
     <table class="table">
        <tr>
             <th>Unit</th>
             <th>Party</th>
             <th>Score</th>
         </tr>
     <?php
     $functions->query = "SELECT * FROM newunit";
     $functions->send = $functions->conn->query($functions->query);
     $functions->resultnum = mysqli_num_rows($functions->send);
     if($functions->resultnum>0){
        while($functions->result=mysqli_fetch_assoc($functions->send)){
            $unit = $functions->result['unit'];
            $party = $functions->result['party'];
            $score = $functions->result['score'];
            ?>
         <tr>
             <td><?=$unit?></td>
             <td><?=$party?></td>
             <td><?=$score?></td>
         </tr>
            <?php
        }
     }
     
     
     
     ?>
        

       
     </table>
  
              
 </div>



 
</body>
</html>