<?php
include('header.php');
auth();
$vaal = "";
$date2 = date('U');
$date = date('Y-m-d H:i:s');

if (isset($_POST['generate'])) {
    $event = get_safe_value($_POST['event']);
    $motive = get_safe_value($_POST['motive']);
    $edate = get_safe_value($_POST['edate']);
    $stime = get_safe_value($_POST['stime']);
    $etime = get_safe_value($_POST['etime']);
    $building = get_safe_value($_POST['building']);
    $room = get_safe_value($_POST['room']);

    $snapy = explode(' ', $event);
    $evnt_name = $snapy[0] . $date2;
    $byuser =$_SESSION['QR_USER_ID'].','.$_SESSION['QR_USER_ROLE'];

    $sql2 = "insert into event(name,motive,date,stime,etime,building,room_no,user_id,user_pid,code) values('$event','$motive','$edate','$stime','$etime','$building','$room','$_SESSION[QR_USER_ID]','$_SESSION[QR_USER_ROLE]','$evnt_name')";
    $res2 = mysqli_query($con,$sql2);
    $sql3 = "create table $evnt_name(id int not null AUTO_INCREMENT primary key,user_name varchar(255) not null,user_type int not null,check_in varchar(255) not null)";
    $res3 = mysqli_query($john,$sql3);
    mysqli_query($con,"insert into messages(email,des,date,byuser,topic,timeupto,event) values('0','$motive','$date','$byuser','$event','$date2','1')");
    redirect("https://chart.googleapis.com/chart?cht=qr&chs=300x300&chl=$qr_file_path?event=$evnt_name");
}

if (isset($_POST['send'])) {
    $topic = get_safe_value($_POST['topic']);
    $desc = get_safe_value($_POST['desc']);

    date_default_timezone_set('Asia/Kolkata');
    $us = $_SESSION['QR_USER_ID'] . ',' . $_SESSION['QR_USER_ROLE'];
    $res = mysqli_query($con, "insert into messages(email,des,date,byuser,topic,timeupto) values('0','$desc','$date','$us','$topic','$date2')");
}

if (isset($_GET['del']) && $_GET['del'] != '') {

    $del = get_safe_value($_GET['del']);

    mysqli_query($con, "delete from messages where email=0 and id='$del' ");
}


if ($_SESSION['QR_USER_ROLE'] != 0) {
?>


<form action="" method="post">
    <div class="row">
        <div class="col-sm-6">
            <div class="card" style="background: url(img/aski.avif) no-repeat center ; background-size:cover;">
                <div class="card-body" style=" text-align:center">
                    <h5 class="card-title"><b><span style="color: #EE5007;">Request |</span> <span
                                style="color: #EE5007;">Ask |</span> <span style="color: #EE5007;">Suggest</span></b></h5>
                    <br>

                    <form action="" method="post">
                        <label for="" style="color: black;"><b>*Topic:</b> </label>
                        <br>
                        <input type="text"
                            style="background: transparent; border:solid; border-color:#EE5007; border-radius:22px; color:#EE5007"
                            name="topic" required>
                        <br>
                        <br>
                        <label for="" style="color: black;"><b>*Description:</b> </label>
                        <br>
                        <textarea required name="desc" id="" cols="30px" rows="10px"
                            style="resize:none; color:#EE5007; background: transparent; border:solid; border-color:#EE5007; border-radius:22px"></textarea>

                    </form>

                    <br>
                    <br>
                    <button class="btn btn-sm btn-danger" name="send">Send</button>
                </div>

            </div>
            <br>
        </div>
</form>



<?php if ($_SESSION['QR_USER_ROLE'] == 2) { ?>
<div class="col-sm-6">
    <div class="card" style="background-image:url('https://images.unsplash.com/photo-1579546929662-711aa81148cf?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxleHBsb3JlLWZlZWR8MTR8fHxlbnwwfHx8fA%3D%3D&w=1000&q=80')">
        <br>
        <div class="card-title" style="text-align:center;" >
            <h3 class="card-title"><b style="color: white;">Important Contacts</b></h3>

            <div class="card-body">
                <div style="background-color: white; border-radius:15px; display:inline-block; padding:0 8px">
                    <span style="color: black;"><b>STUDENT CELL:</b>&nbsp;+91 9897491211</span>
                </div>
                <br>
                <br>
                <div style="background-color: white; border-radius:15px; display:inline-block; padding:0 8px">
                    <span style="color: black;"><b>CHIEF ADMINISTRATION:</b>&nbsp;+919927067047</span>
                </div>
                <br>
                <br>
                <div style="background-color: white; border-radius:15px; display:inline-block; padding:0 8px">
                    <span style="color: black;"><b>EXAMINATION:</b>&nbsp;+918938806676</span>
                </div>
                <br>
                <br>
                <div style="background-color: white; border-radius:15px; display:inline-block; padding:0 8px">
                    <span style="color: black;"><b>REGISTRAR:</b>&nbsp;+916397417566</span>
                </div>
                <br>
                <br>
                <div style="background-color: white; border-radius:15px; display:inline-block; padding:0 8px">
                    <span style="color: black;"><b>HOSTEL:</b>&nbsp;+919045760293</span>
                </div>
            </div>
        </div>


    </div>
</div>
<?php } ?>

<?php if ($_SESSION['QR_USER_ROLE'] == 1) { ?>
<div class="col-sm-6">
    <div class="card" style="background: url(img/room4.jpg) no-repeat center ; background-size:cover;">
        <div class="card-body">
            <h5 class="card-title" style=" text-align:center"><b style="color:yellow;">Book an Event</b></s< /h5>
                <br>
                <br>
                <br>

                <form action="" method="post">
                    <div class="row">
                        <label class="col" for="" style="color: white;"><b>*Event name:</b> </label>
                        <input class="col" name="event" type="text" required
                            style="background: transparent; color:white; border:solid; border-color:white; border-radius:22px">
                    </div>
                    <br>

                    <div class="row">
                        <label class="col" for="" style="color: white;"><b>Motive:</b> </label>
                        <input class="col" name="motive" type="text"
                            style="background: transparent; color:white; border:solid; border-color:white; border-radius:22px ">
                    </div>
                    <br>


                    <div class="row">
                        <label class="col" for="" style="color: white;"><b>* Date:</b> </label>
                        <input class="col-6" name="edate" type="date" required
                            style=" background: transparent; color:white; border:solid; border-color:white; border-radius:22px ">
                    </div>
                    <br>


                    <div class="row">
                        <label class="col" for="" style="color: white;"><b>*Start time:</b> </label>
                        <input class="col" name="stime" type="time" required
                            style="background: transparent; color:white; border:solid; border-color:white; border-radius:22px ">
                    </div>
                    <br>


                    <div class="row">
                        <label class="col" for="" style="color: white;"><b>*End time:</b> </label>
                        <input class="col" name="etime" type="time" required
                            style="background: transparent; color:white; border:solid; border-color:white; border-radius:22px ">
                    </div>
                    <br>


                    <div class="row">
                        <label class="col" for="" style="color: white;"><b>*Building:</b> </label>
                        <select class="col" name="building" type="time" required
                            style="background: transparent; color:white; border:solid; border-color:white; border-radius:22px ">
                            <option value="Vedanta" style="color: black;">Vedanta</option>
                            <option value="Vishveswarya" style="color: black;">Vishveswarya</option>
                            <option value="Chanakya" style="color: black;">Chanakya</option>
                            <option value="Workshop" style="color: black;">Workshop</option>
                            <option value="Vastu" style="color: black;">Vastu</option>
                        </select>
                    </div>
                    <br>


                    <div class="row">
                        <label class="col" for="" style="color: white;"><b>*Room:</b> </label>
                        <input class="col" name="room" type="text" required
                            style="background: transparent; color:white; border:solid; border-color:white; border-radius:22px ">
                    </div>
                    <br>
                    <input type="submit" value="Generate QR" name="generate" class="btn btn-outline-light">
                    <!-- <a href="https://chart.googleapis.com/chart?cht=qr&chs=200x200&chl=ty"
                    class="btn btn-sm btn-outline-light">Generate QR</a> -->
                    <br>
                </form>
                <br>


                <small style="text-align:center; color:yellow">**<i>Make sure to download the QR after
                        generating.</i></small>
        </div>

    </div>
</div>
<br>
<?php }
} else {
    $sql = mysqli_query($con, "select * from messages where email=0");
    ?>
<h2><b>Messages for you!</b></h2>
<br>

<?php
    if (mysqli_num_rows($sql) == 0) {
    ?>
<center>
    <h3>No Messages to show right now.</h3>
</center>
<?php } else {
        $ind = 0;

    ?>
<div class="table-responsive">
    <table class="table table-dark table-sm " style="border-radius: 10px; overflow: hidden;">
        <thead>
            <tr>
                <th scope="col">Sno. </th>
                <th scope="col">From</th>
                <th scope="col">Topic</th>
                <th scope="col">Description</th>
                <th scope="col">Delete</th>
                <th scope="col">Reply</th>
                <!-- <th scope="col">Reply</th> -->
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            <?php while ($res = mysqli_fetch_assoc($sql)) {

                        $arr = explode(",", $res['byuser']);
                        $id = $arr[0];
                        $pid = $arr[1];
                    ?>
                    
            <tr>
                <td style="text-align:center"><?php echo ++$ind ?></td>
                <?php if ($pid == 1) { ?>
                <td><span style="font-family:'Lucida Handwriting', Courier, monospace" ;><a
                            href="profile.php?admreq=<?php echo $id ?>&pid=<?php echo $pid ?>"
                            style="color: pink;">Staff&nbsp;</a></span></td>&nbsp;
                <?php } ?>
                <?php if ($pid == 2) { ?>
                <td><span style="font-family:'Lucida Handwriting', Courier, monospace"><a
                            href="profile.php?admreq=<?php echo $id ?>&pid=<?php echo $pid ?>"
                            style="color: pink;">Student&nbsp;</a></span></td>
                <?php } ?>

                <?php if ($pid == 3) { ?>
                <td><span style="font-family:'Lucida Handwriting', Courier, monospace"><a
                            href="profile.php?admreq=<?php echo $id ?>&pid=<?php echo $pid ?>"
                            style="color: pink;">Employee&nbsp;</a></span></td>&nbsp;
                <?php } ?>

                <td><b><?php echo $res['topic'] ?></b></span></td>
                <td><?php echo $res['des'] ?></td>
                <td style="text-align:center"><a href="?del=<?php echo $res['id'] ?>"><img src="img/delete.png" alt=""
                            width="25"></a></td>
                <td style="text-align:center"><a
                        href="profile.php?admreq=1&pid=0&bet=<?php echo $id ?>&set=<?php echo $pid ?>"><img
                            src="img/message.png" alt="" width="25"></a></td>
                <!-- <td><button class="btn btn-danger">Delete</button></td> -->
            </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
<?php }
} ?>


<!-- <label class="switch">
  <input type="checkbox">
  <span class="slider round"></span>
</label> -->





</div>
</div>
<?php
include('footer.php');
?>