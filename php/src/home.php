<?php include('includes/config.php') ?>
<?php
$twhere ="";
if($_SESSION['login_type'] != 1)
  $twhere = "  ";
?>
  <?php 

    $where = "";
    if($_SESSION['login_type'] == 2){
      $where = " where manager_id = '{$_SESSION['login_id']}' ";
    }elseif($_SESSION['login_type'] == 3){
      $where = " where concat('[',REPLACE(user_ids,',','],['),']') LIKE '%[{$_SESSION['login_id']}]%' ";
    }
     $where2 = "";
    if($_SESSION['login_type'] == 2){
      $where2 = " where p.manager_id = '{$_SESSION['login_id']}' ";
    }elseif($_SESSION['login_type'] == 3){
      $where2 = " where concat('[',REPLACE(p.user_ids,',','],['),']') LIKE '%[{$_SESSION['login_id']}]%' ";
    }
    ?>

<div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
                        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
                    </div>

                        <!-- Content Column -->
                        <div>

                            <!-- Project Card Example -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Latest Tasks</h6>
                                </div>
                                <div class="card-body">
                                      <?php
                                        $i = 1;
                                        $stat = array("Pending","Started","In-Progress","On-Hold","Over Due","Done");
                                        $where = "";
                                        if($_SESSION['login_type'] == 2){
                                          $where = " where manager_id = '{$_SESSION['login_id']}'";
                                        }elseif($_SESSION['login_type'] == 3){
                                          $where = " where concat('[',REPLACE(user_ids,',','],['),']') LIKE '%[{$_SESSION['login_id']}]%' ";
                                        }
                                        $qry = $conn->query("SELECT * FROM project_list $where order by name asc limit 10");
                                        while($row= $qry->fetch_assoc()):
                                      ?>
                                  <div class="row">
                                    <div class="col-10">
                                        <h4 class="small font-weight-bold"><?= ucwords($row['name']) ?>
                                        <?php
                                          if($stat[$row['status']] =='Pending'){
                                            echo "<span class='badge badge-secondary'>{$stat[$row['status']]}</span>";
                                          }elseif($stat[$row['status']] =='Started'){
                                            echo "<span class='badge badge-primary'>{$stat[$row['status']]}</span>";
                                          }elseif($stat[$row['status']] =='In-Progress'){
                                            echo "<span class='badge badge-info'>{$stat[$row['status']]}</span>";
                                          }elseif($stat[$row['status']] =='On-Hold'){
                                            echo "<span class='badge badge-warning'>{$stat[$row['status']]}</span>";
                                          }elseif($stat[$row['status']] =='Over Due'){
                                            echo "<span class='badge badge-danger'>{$stat[$row['status']]}</span>";
                                          }elseif($stat[$row['status']] =='Done'){
                                            echo "<span class='badge badge-success'>{$stat[$row['status']]}</span>";
                                          }
                                        ?>
                                    </div>
                                    <div class="col-2">
                                      <a href="./index.php?page=view_project&id=<?php echo $row['id'] ?>" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"> View</a>
                                    </div>
                                  </div>
                                  <br>
                                  <?php endwhile; ?>
                              </div>
                        </div>
                    </div>
                </div>
                <!-- /.container-fluid -->
