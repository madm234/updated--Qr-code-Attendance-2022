<?php
include('header.php');
if($_SESSION['QR_USER_ROLE']==1)
{    
   $res =mysqli_query($con,"select * from event where user_id=$_SESSION[QR_USER_ID] and user_pid=$_SESSION[QR_USER_ROLE]");
   if(mysqli_num_rows($res)>0){
   $ee =mysqli_fetch_assoc($res);
   $res2 =mysqli_query($john,"select * from $ee[code]");
   
?>
<h1 style="text-align: center; color:deeppink"><?php echo $ee['name'] ?></h1>
<h5 style="text-align: center;"><b>From:</b> <?php echo $ee['stime'] ?> - <?php echo $ee['etime'] ?></h5>
<h5 style="text-align: center;"><b>Venue:</b> <?php echo $ee['building'] ?><?php echo $ee['room_no'] ?></h5>
<center>
<a href="https://chart.googleapis.com/chart?cht=qr&chs=300x300&chl=<?php echo $qr_file_path ?>?event=<?php echo $ee['code'] ?>"><img style="border: solid;" width="120px" src="https://chart.googleapis.com/chart?cht=qr&chs=300x300&chl=<?php echo $qr_file_path ?>?event=<?php echo $ee['code'] ?>" alt=""></a>
</center>
<br>
<table class="table table-bordered border-primary">
  <thead>
    <tr>
      <th scope="col"><b>S.no</b></th>
      <th scope="col"><b>User name</b></th>
      <th scope="col"><b>Position</b></th>
      <th scope="col"><b>Entry time</b></th>
    </tr>
  </thead>
  <tbody>
    <?php 
    $i =0;
    while($row =mysqli_fetch_assoc($res2)){
        $i++;
        ?>
    <tr>
      <th scope="row"><?php echo $i ?></th>
      <td><?php echo $row['user_name'] ?></td>
      <?php if($row['user_type']==1){ ?>
      <td>Staff</td>
      <?php }else if($row['user_type']==2){ ?>
        <td>Student</td>
      <?php }else if($row['user_type']==2){ ?>
        <td>Employee</td>
      <?php }?>

      <td><?php echo $row['check_in'] ?></td>
    </tr>
    <?php } ?>
  </tbody>
</table>


</div>
</div>
<?php
   }else{
        echo ("No events to show!");
   }
include('footer.php');
}
else{
    redirect('login.php');
}
?>