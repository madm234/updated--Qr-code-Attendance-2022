<?php
include('header.php');
auth();
$rt =1;
$sum =0;
if(isset($_GET['sid']) && $_GET['sid']>0 && isset($_GET['pid']) && $_GET['pid']>=0)
{

    $sid =get_safe_value($_GET['sid']);
    $pid =get_safe_value($_GET['pid']);

    if($pid==1)
    $mes =mysqli_query($con,"select * from staff where id ='$sid' ");

    else if($pid==2)
    $mes =mysqli_query($con,"select * from student where id ='$sid' ");

    else if($pid==3)
    $mes =mysqli_query($con,"select * from employee where id ='$sid' ");

    $rip =mysqli_fetch_assoc($mes);
}

// if($_SESSION['QR_USER_ROLE']=1)
// $res =mysqli_query($con,"select * from staff where id ='$id' ");

// if($pid==2)
// $res =mysqli_query($con,"select * from student where email ='$_SESSION[QR_USER_EMAIL]' ");

// if($_SESSION['QR_USER_ROLE']=3)
// $res =mysqli_query($con,"select * from employee where id ='$id' ");
if(mysqli_num_rows($mes)==0)
{
  echo "No user found!";
  die();
}
else 
{
    // $row =mysqli_fetch_assoc($rip);
    $zinc =mysqli_query($con,"select * from attendance where sap_id ='$rip[sap_id]' ");
    $row2 =mysqli_fetch_assoc($zinc);
    $fni1 =explode(',',$rip['subject1']);
    $fni2 =explode(',',$rip['subject2']);
    $fni3 =explode(',',$rip['subject3']);
    $fni4 =explode(',',$rip['subject4']);
    $fni5 =explode(',',$rip['subject5']);

    $sub1 =$fni1[0];
    $sec1 =$fni1[1];

    $sub2 =$fni2[0];
    $sec2 =$fni2[1];

    $sub3 =$fni3[0];
    $sec3 =$fni3[1];

    $sub4 =$fni4[0];
    $sec4 =$fni4[1];

    $sub5 =$fni5[0];
    $sec5 =$fni5[1];
    $totps=0;
    $totab=0;
}
?>
<h1><b>Your Attendance</b> </h1>
<p><i>*Following attendance is made accordance to 5 subjects only!</i></p>
<br>

<div class="row">
<div class="table-responsive col-6">
<table class="table table-striped">
<thead class="table-dark">
    <tr>
      <th scope="col"><b>SUBJECT</b></th>
      <th scope="col"><b>SECTION</b></th>
      <th scope="col"><b>PRESENT</b> </th>
      <th scope="col"><b>ABSENT</b></th>
    </tr>
  </thead>

  <tbody class="table-hover">
    <tr class="table-primary">
      <th scope="row"><?php echo $sub1 ?></th>
      <th scope="row"><?php echo $sec1 ?></th>
      <?php if(mysqli_num_rows($zinc)>0) {?>
      <td><?php echo $row2['subject1'];
      $sum +=$row2['subject1'];
      ?></td>
      <?php }else { ?>
        <td> 0</td>
        <?php } ?>
      <td>1</td>
    </tr>
    
    <tr class="table-success">
    <th scope="row"><?php echo $sub2 ?></th>
      <th scope="row"><?php echo $sec2 ?></th>
      <?php if(mysqli_num_rows($zinc)>0) {?>
      <td><?php echo $row2['subject2'];
      $sum +=$row2['subject2']; ?></td>
      <?php }else { ?>
        <td>0</td>
        <?php } ?>
      <td>0</td>
    </tr>
   
    <tr class="table-danger">
    <th scope="row"><?php echo $sub3 ?></th>
      <th scope="row"><?php echo $sec3 ?></th>
      <?php if(mysqli_num_rows($zinc)>0) {?>
      <td><?php echo $row2['subject3'];
      $sum +=$row2['subject3']; ?></td>
      <?php }else { ?>
        <td>0</td>
        <?php } ?>
      <td >2</td>
    </tr>
    
    <tr class="table-warning">
    <th scope="row"><?php echo $sub4 ?></th>
      <th scope="row"><?php echo $sec4 ?></th>
      <?php if(mysqli_num_rows($zinc)>0) {?>
      <td><?php echo $row2['subject4']; 
      $sum +=$row2['subject4'];?></td>
      <?php }else { ?>
        <td>0</td>
        <?php } ?>
      <td >0</td>
    </tr>
    
    <tr class="table-info">
    <th scope="row"><?php echo $sub5 ?></th>
      <th scope="row"><?php echo $sec5 ?></th>
      <?php if(mysqli_num_rows($zinc)>0) {?>
      <td><?php echo $row2['subject5'];
      $sum +=$row2['subject5']; ?></td>
      <?php }else { ?>
        <td>0</td>
        <?php } ?>
      <td >0</td>
    </tr>
  </tbody>
</table>
</div>

<div class="col-6">
  <div class="card brus" >
    <h4>Overall Attendance(in %)</h4>
  <div class="circular-progress">
        <div class="value-container"></div>
      </div>
  </div>
</div>
</div>


<?php
$rt = ($sum/($sum +3))*100;
$rt = floor($rt);

if($rt<=0)
{
  $rt =1;
}
?>
<script>
  let progressBar = document.querySelector(".circular-progress");
let valueContainer = document.querySelector(".value-container");

let progressValue = 0;
let progressEndValue = <?php echo $rt ?>;
let speed = 10;

let progress = setInterval(() => {
  progressValue++;
  valueContainer.textContent = `${progressValue}%`;
  progressBar.style.background = `conic-gradient(
      #4d5bf9 ${progressValue * 3.6}deg,
      #cadcff ${progressValue * 3.6}deg
  )`;
  if (progressValue == progressEndValue) {
    clearInterval(progress);
  }
}, speed);

</script>

 <br>
</div>
 </div>
 <?php
 include('footer.php');
 ?>