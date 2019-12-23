<div class="register-form">
    <div class="form pd-form">
        <div class="note">
            <p>PERSONAL DETAILS</p>
        </div>
        <div class="form-content">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="formEmail">Email (username)</label>
                        <input type="text" name="txtEmail" id="txtEmail" class="form-control" placeholder="Email" value="<?php print $email; ?>" maxlength="50" required/>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="formDOB">DOB</label>
                        <input type="date" name="dateDOB" id="dateDOB" class="form-control" value="<?php print $dob; ?>" required/>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="formName">Name</label>
                        <input type="text" onkeypress="return !isNumberKey(event)" name="txtName" id="txtName" class="form-control" placeholder="Your Name" value="<?php print $name; ?>" maxlength="100" required/>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="formClass">Class</label>
                        <select id="formClass" name="selClass" id="selClass" class="form-control" value="" required/>
                        <option value="none" selected disabled hidden> Select Class </option> 
                        <?php
                        $sql1 = "Select * from EM_Classes Where 1 AND isDeleted = 'N' Order by ID ASC";
                        $rsl1 = $db_conn->query($sql1);
                        while ($row1 = $rsl1->fetch_assoc()) {
                            $ClsId = $row1["ID"];
                            $ClsYear = $row1["Year"];
                            if ($ClsId == $classID) {
                                $selected = "Selected";
                            } else {
                                $selected = "";
                            }
                            print('<option value="'.$ClsId.'" '.$selected.'>'.$ClsYear.'</option>');
                        }
                        ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="formPhone">Phone Number</label>
                        <input type="text" name="txtPhone" id="txtPhone" class="form-control" placeholder="Phone Number" minlength="10" maxlength="10" value="<?php print $contact; ?>" onkeypress="return isNumberKey(event)" required/>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="formBranch">Branch</label>
                        <select id="formBranch" name="selBranch" id="selBranch" class="form-control" value="" required/>
                        <option value="none" selected disabled hidden> Select Branch </option> 
                        <?php
                        $sql2 = "Select * from EM_Branches Where 1 AND isDeleted = 'N' Order by ID ASC";
                        $rsl2 = $db_conn->query($sql2);
                        while ($row2 = $rsl2->fetch_assoc()) {
                            $BchId = $row2["ID"];
                            $BchYear = $row2["Name"];
                            if ($BchId == $branchID) {
                                $selected = "Selected";
                            } else {
                                $selected = "";
                            }
                            print('<option value="' . $BchId . '" ' . $selected . '>' . $BchYear . '</option>');
                        }
                        ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="formPassword">Password</label>
                        <input type="password" name="txtPassword" id="txtPassword" class="form-control" placeholder="Password" maxlength="50" required/>
                    </div>          
                </div>
                <div class="col-md-6">          
                    <div class="form-group">
                        <label for="formEmail">Confirm Password</label>
                        <input type="password" name="txtConfirm" id="txtConfirm" class="form-control" placeholder="Confirm Password" maxlength="50" required/>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
