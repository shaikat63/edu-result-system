<?php 
    require_once "templates/header.php";
 ?>



									<!-- ADMIN  PANEL SECTION  -->
 <div class="row">
                        <div class="col-md-10  " style="margin: 10px 0px 50px 50px;">
                            <section class="panel b-a" style=" min-height:500px;">


                                <div class="panel-heading b-b"> <span class="badge bg-warning pull-right">10</span> <a href="#" class="font-bold">Add new Students</a> </div>

                                <div class="card " style="padding:0px 50px 50px 50px;">
                                  <div class="card-body">

                                    <?php  

                                        if( isset($_GET['id']) ){
                                            $sid = $_GET['id'];
                                          }else{
                                            $sid = 'no id';
                                          }




                                        if( isset($_POST['submit']) ){

                                          

                                          // get Single user data by id
                                          $sql = "SELECT * FROM students_info WHERE stu_id = '$sid'";
                                          $data =  $conn -> query( $sql);

                                          $data_by_id = $data -> fetch_assoc();

                                            $name = $data_by_id['name'];
                                            $roll = $data_by_id['roll'];
                                            $reg = $data_by_id['reg'];
                                            $board = $data_by_id['board'];
                                            $institute = $data_by_id['ins'];
                                            $photo = $data_by_id['photo'];
                              





                                          // bangla  Management 
                                            $ban = $_POST['ban'];
                                            $ban_g = checkGrad($ban);
                                            $ban_gpa = checkGpa($ban );



                                            //English Management
                                            $eng = $_POST['eng'];
                                            $eng_g = checkGrad($eng);
                                            $eng_gpa = checkGpa($eng );


                                            //Math Management
                                            $math = $_POST['math'];
                                            $math_g = checkGrad($math);
                                            $math_gpa = checkGpa($math );


                                            //Science 
                                            $science = $_POST['science'];
                                            $s_g = checkGrad($science);
                                            $s_gpa = checkGpa($science );



                                            $ss = $_POST['ss'];
                                            $ss_g = checkGrad($ss);
                                            $ss_gpa = checkGpa($ss );





                                            $religion = $_POST['religion'];
                                            $r_g = checkGrad($religion);
                                            $r_gpa = checkGpa($religion );





                                             $student_cgpa = checkCgpa($ban_gpa, $eng_gpa, $math_gpa, $s_gpa, $ss_gpa, $r_gpa);


                                            $result = checkResult($ban_gpa, $eng_gpa, $math_gpa, $s_gpa, $ss_gpa, $r_gpa);
                                             $round_cgpa = round($student_cgpa, '2');

                                             $tgrade = checkGrade($round_cgpa , $ban_gpa, $eng_gpa, $math_gpa, $s_gpa, $ss_gpa, $r_gpa);

                                            


                                           
                                              //

                                            //

                                            if( empty($ban) || empty($eng) || empty($math) || empty($science) || empty($ss) || empty( $religion)  ){
                                                $mess = "<p class='alert alert-danger'>Field must not be empty !<button class='close' data-dismiss='alert'>&times;</button></p>";
                                            }else{
                                                $sql = "INSERT INTO students_results (  name, roll, reg, board, ins, photo , bn_m, bn_g, bn_gpa, en_m, en_g, en_gpa, math_m, math_g, math_gpa, s_m, s_g, s_gpa, ss_m, ss_g, ss_gpa, r_m, r_g, r_gpa, tgrade, cgpa, result) VALUES ( '$name', '$roll', '$reg', '$board', '$institute', '$photo', '$ban', '$ban_g', '$ban_gpa', '$eng', '$eng_g', '$eng_gpa', '$math', '$math_g', '$math_gpa', '$science', '$s_g', '$s_gpa', '$ss', '$ss_g', '$ss_gpa', '$religion', '$r_g', '$r_gpa', '$tgrade', '$round_cgpa', '$result')";
                                                $conn -> query($sql);

                                                 $mess = "<p class='alert alert-success'>Result successfully added !<button class='close' data-dismiss='alert'>&times;</button></p>";


                                            }


                                        }


                                    ?>

                                    <div class="mess">
                                        <?php  

                                          if( isset($mess) ){
                                            echo $mess;
                                          }

                                        ?>
                                    </div>



                                    <form action="<?php  echo $_SERVER['PHP_SELF'];?>?id=<?php echo $sid;  ?>" method="POST">
                                      
                                      <div class="form-group">
                                        <label for="">Bangla</label>
                                        <input name="ban" class="form-control" type="text">
                                      </div>

                                      <div class="form-group">
                                        <label for="">English</label>
                                        <input name="eng" class="form-control" type="text">
                                      </div>

                                      <div class="form-group">
                                        <label for="">Math</label>
                                        <input name="math" class="form-control" type="text">
                                      </div>

                                      <div class="form-group">
                                        <label for="">Science</label>
                                        <input name="science" class="form-control" type="text">
                                      </div>

                                      <div class="form-group">
                                        <label for="">Social Science</label>
                                        <input name="ss" class="form-control" type="text">
                                      </div>

                                      <div class="form-group">
                                        <label for="">Religion</label>
                                        <input name="religion" class="form-control" type="text">
                                      </div>
                                    


                                      <div class="form-group">
                                    
                                        <input name="submit" class="btn btn-success" type="submit" value="Add student">
                                      </div>

                                    </form>
                    
                                   </div>
                                </div>
                            </section>
                        </div>
                    </div>






                                                




					
                                            </section>
                                        </div>
                                    </div>



<?php 
    require_once "templates/footer.php";
 ?>
