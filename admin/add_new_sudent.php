<?php 
    require_once "templates/header.php";
 ?>



									<!-- ADMIN  PANEL SECTION  -->

                                    <div class="row">
                                        <div class="col-md-10  " style="margin: 50px 0px 50px 50px;">
                                            <section class="panel b-a" style=" min-height:500px;">


                                                <div class="panel-heading b-b"> <span class="badge bg-warning pull-right">10</span> <a href="#" class="font-bold">Add new Student</a> </div>

                                      <?php 

                                   if (isset($_POST['submit'])) {

                                         $name = $_POST['name'];
                                          
                                         //Roll Number check   
                                         $roll = $_POST['roll'];
                                         $roll_check = rollNumberCheck($roll, $conn);

                                         //Registration Number check
                                         $reg = $_POST['reg'];
                                         $reg_check = regNumberCheck($reg, $conn);

                                         $board = $_POST['board'];
                                         $ins = $_POST['ins'];
                                        
                                        
                              


                                        $img_name = $_FILES['pic']['name'];
                                        $img_tname = $_FILES['pic']['tmp_name'];


                                      $unique_name = time().rand().$img_name;
                                      $extention_array = explode('.', $unique_name);
                                      $extention_name = end($extention_array);
                                      $enc_name = md5($unique_name).'.'.strtolower($extention_name);
                                        move_uploaded_file($img_tname, 'student_photos/'.$enc_name);


                                         


                                          if (empty($name) || empty($roll) || empty($reg) || empty($board) || empty($ins) || empty($img_name) ) {
                                           $message = "<p class='alert alert-danger'> Field must mot be Empty !! <button class='close' data-dismiss='alert'>&times;</button> </p>";

                                        }else if ( $roll_check == false) {
                                             $message = "<p class='alert alert-danger'>Roll Number Already Exists !!<button class='close' data-dismiss='alert'>&times;</button> </p>";
                                           }  
                                              else if ( $reg_check == false) {
                                             $message = "<p class='alert alert-danger'>Reg. No Already Exists !!<button class='close' data-dismiss='alert'>&times;</button> </p>";
                                           }

                                       elseif (in_array($extention_name, ['jpg','JPG','PNG','JPEG','png','jpeg','GIF','gif']) == false) {
                                               

                                                $message = "<p class='alert alert-danger'>Invalid image Format !!<button class='close' data-dismiss='alert'>&times;</button> </p>";
                                             }      
                                                                    
                                        else{




                                          $sql = "INSERT INTO students_info(name, roll, reg, board, ins, photo, status) VALUES('$name','$roll', '$reg', '$board','$ins', '$enc_name', 'Active')";
                                            $conn -> query($sql);

                                           $message = "<p class='alert alert-success'>Student Added Successfully !! <button class='close' data-dismiss='alert'>&times;</button> </p>";

                                        }
                                      }


                                  ?>

                

                 <div class="card w-75">

                          <div class="mess">
                    <?php 

                      if (isset($message)) {
                        echo $message;
                      }

                     ?>          



                     <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">
                    <div class="list-group">
                        <div class="list-group-item">
                            <input name="name" placeholder="Student Name" type="text" class="form-control no-border"> </div>
                        <div class="list-group-item">
                            <input name="roll" placeholder="Student Roll" type="text" class="form-control no-border"> </div>
                        <div class="list-group-item">
                            <input name="reg" type="text" placeholder="Reg. No" class="form-control no-border"> </div>



                         <div class="list-group-item">


                            <select name="board">
                              
                               <option value=""selected>Select Board</option>
                               <option value="barisal">Barisal</option>
                               <option value="chittagong">Chittagong</option>
                               <option value="comilla">Comilla</option>
                               <option value="dhaka">Dhaka</option>
                               <option value="dinajpur">Dinajpur</option>
                               <option value="jessore">Jessore</option>
                               <option value="rajshahi">Rajshahi</option>
                               <option value="sylhet">Sylhet</option>
                               <option value="madrasah">Madrasah</option>
                               <option value="tec">Technical</option>
                               <option value="dibs">DIBS(Dhaka)</option>


                            </select>

                         </div>



                            <div class="list-group-item">
                            <input name="ins" type="text" placeholder="Institute Name" class="form-control no-border"> </div>
                         <div class="list-group-item">

                            <input name="pic" type="file" class="form-control no-border"> </div>
                        
                    </div>
                   
                    <button name="submit" type="submit" class="btn btn-lg btn-primary">Add Student</button>
                    <div class="line line-dashed"></div>
                    <a href="dashboard.php" class="btn btn-lg btn-default btn-block">Back</a> </form>
            </section>
        </div>
    </section>

 </section>
                                        </div>
                                    </div>



<?php 
    require_once "templates/footer.php";
 ?>
