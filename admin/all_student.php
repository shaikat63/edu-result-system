<?php 
    require_once "templates/header.php";
 ?>

 <style type="text/css">
   
   .all{
    min-height: 750px;
   }
 </style>



									<!-- ADMIN  PANEL SECTION  -->

    <div class="row all">
          <div class="col-md-10  " style="margin: 50px 0px 50px 50px;">
              <section class="panel b-a" style=" min-height:750px;">


                  <div class="panel-heading b-b"> <span class="badge bg-warning pull-right">10</span> <a href="#" class="font-bold">Add new Student</a> </div>
                      <table class="table table-striped">
                         <thead>
                            <tr>
                              <th>SL</th>
                              <th>Student Name</th>
                              <th>Roll</th>
                              <th>Registration</th>
                              <th>Board</th>
                              <th>Institute</th>
                              <th>Photo</th>
                              <th>Action</th>
                            </tr>
                          </thead>
                             <tbody>


                              <?php 

                                $sql = "SELECT * FROM  students_info";
                                $data = $conn -> query($sql);
                                $i = 1;
                                while($all_data = $data -> fetch_assoc() ):

                                ?>



                                <tr>
                                  <td><?php echo $i; $i++;  ?></td>
                                                                      
                                  <td><?php echo $all_data['name']; ?></td>
                                  <td><?php echo $all_data['roll']; ?></td>
                                  <td><?php echo $all_data['reg']; ?></td>
                                  <td><?php echo $all_data['board']; ?></td>
                                  <td><?php echo $all_data['ins']; ?></td>
                                  <td>
                                     <img style="width: 50px; height: 50px; border: 5px solid #FFF; box-sizing:0px 0px 3px #aaa ;" src="student_photos/<?php echo $all_data['photo']; ?>">
                                  </td>

                                  <td>

                                     <?php 

                                        $res_num = resultCheck( $all_data['roll'], $all_data['reg'], $conn);

                                          if( $res_num == 0 ) :
                                     ?>
                             
                                  <a class="btn btn-success btn-sm" href="add_result.php?id=<?php echo $all_data['stu_id']?>">Add Result</a>

                                  <?php else: ?>

                                      <a class="btn btn-warning btn-sm" href="">Edit Result</a>

                                  <?php endif ?>     
                                                                       

                                  </td>
                                </tr>

                              <?php endwhile; ?>

                            </tbody>
                    </table>
          </section>
      </div>
    </div>



<?php 
    require_once "templates/footer.php";
 ?>
