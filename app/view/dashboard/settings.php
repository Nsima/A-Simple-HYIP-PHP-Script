    <?php require $this->header; ?>


    <?php 
       // print_r($data["user"]); exit;

    ?>
 <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">My Details</h1>
                </div>
             
           <?php if(isset($_GET["success"])): ?>
                
            <p class="alert alert-success"><?=$_GET["success"]?></p>
            
            <?php endif;?>
            
            <div>    <div class="col-lg-6">
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            <h3 class="pane-title" style="color:white;">My Details</h3>
                        </div>
                            <div class="panel-body">
                                <div class="col-xs-3">
                                    <i class="fa fa-user fa-5x"></i>
                                </div>
                                <div class=" text-right">
                                   <table style="color: black;" class="table table-striped table-bordered table-responsive" cellpadding="2" cellspacing="2">
                                       <tr>
                                           <th>Name</th>
                                           <td><?=$data["user"]["name"]?></td>
                                       </tr>
                                       <tr>
                                           <th>Username</th>
                                           <td><?=$data["user"]["username"]?></td>
                                       </tr>
                                       <tr>
                                           <th>Email</th>
                                           <td><?=$data["user"]["email"]?></td>
                                       </tr>
                                       <tr>
                                           <th>Phone</th>
                                           <td><?=$data["user"]["phonenumber"]?></td>
                                       </tr>
                                       <tr>
                                           <th>Bank</th>
                                           <td><?=$data["user"]["bank_name"]?></td>
                                       </tr>
                                        <tr>
                                           <th>Account Name</th>
                                           <td><?=$data["user"]["acc_name"]?></td>
                                       </tr>
                                        <tr>
                                           <th>Account Number</th>
                                           <td><?=$data["user"]["acc_number"]?></td>
                                       </tr>
                                        


                                   </table>
                                </div>
                            </div>
                        </div>
                      
                    </div>
                </div>
                
    </div>

    </div>
