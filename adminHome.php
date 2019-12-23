<?php
@session_start();
include("dbconnect.php");
?>
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="admindashboard.php?admin">Change Password</a></li>
            </ol>
          </div>
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3>
                  <?php
                  $eveqry = "SELECT count(ID) FROM `EM_EventMaster` where 1 and isDeleted = 'N'";
                  $rslqry = $db_conn->query($eveqry);
                  $cnt = $rslqry->fetch_assoc()['count(ID)'];
                  print $cnt;
                  ?>
                </h3>

                <p>Events</p>
              </div>
              <div class="icon">
                <i class="ion ion-calendar"></i>
              </div>
              <a href="admindashboard.php?events" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3>
                <?php
                  $regqry = "SELECT count(ID) FROM `EM_Registration` where 1 and isDeleted = 'N'";
                  $regrslqry = $db_conn->query($regqry);
                  $regcnt = $regrslqry->fetch_assoc()['count(ID)'];
                  print $regcnt;
                ?>
                </h3>

                <p>User Registrations</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
        </div>
        <!-- /.row -->
    </section>
    <section class="connectedSortable">
    <div class="form-content">
        <div class='form-group'>
            <div class='table-responsive'>
                <table class='table'>
                    <thead>
                        <tr>
                            <th scope='col'></th>
                            <th scope='col'><b>Name</b></th>
                            <th scope='col'><b>Contact</b></th>
                            <th scope='col'><b>Email</b></th>
                            <th scope='col'><b>DOB</b></th>
                            <th scope='col'><b>Class</b></th>
                            <th scope='col'><b>Branch</b></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sqlcat = "SELECT a.*, a.Name as RegName, a.ID as Id, b.*, c.*, c.Name as BranchName FROM `EM_Registration` as a, `EM_Classes` as b, `EM_Branches` as c WHERE 1 AND a.fkClass = b.ID AND a.fkBranch = c.ID AND a.isDeleted = 'N'";
                        $rslcat = $db_conn->query($sqlcat);
                        while ($rowcat = $rslcat->fetch_assoc()) {
                            $id = $rowcat["Id"];
                            $name = $rowcat["RegName"];
                            $contact = $rowcat["Contact"];
                            $email = $rowcat["Email"];
                            $dob = $rowcat["DOB"];
                            $class = $rowcat["Year"];
                            $branch = $rowcat["BranchName"];
                            print("
                        <tr>
                        <td><a href='updateRegistration.php?id=" . $id . "'><input type='button' class='btn btn-primary' value='Edit'></a>
                        <a href='admindashboard.php?regdelid=" . $id . "'><input type='button' class='btn btn-danger' value='Decline' onclick='ConfirmDelete()'></a></td>                        
                        <td><p>" . $name . "</p></td>
                        <td><p>" . $contact . "</p></td>
                        <td><p>" . $email . "</p></td>
                        <td><p>" . $dob . "</p></td>
                        <td><p>" . $class . "</p></td>
                        <td><p>" . $branch . "</p></td>
                        </tr>
                    ");
                        }
                        print("
                </tbody>
                </table>
                </div>
            ");
                        ?>
            </div>
        </div>
    </section>
    <!-- /.content -->
  </div>
