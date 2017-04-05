<?php 

$approvals = $data["approvals_list"];
$approvals_list_num = count($approvals["payee_fullname"]);


$pay = $data["pay"];


//print_r($pay);exit;


?>

<?php require $this->header; ?>

  <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Dashboard</h1>
                </div>
                <!-- /.col-lg-12 -->
           

            <?php if($data["num"] != 0): ?>
                    <div class="col-md-12">
                        <div class="alert alert-success text-center big-text"><span class="fa fa-check"></span> Congratulation you have <?=$data["num"]?> pending payment.  
                        </div>
                    </div>
                  
                     <?php elseif($pay!=false): ?>
                    <div class="col-md-12">
                        <div class="alert alert-info text-center"><span class="fa fa-warning"></span> Please clear your pending reservations.  <br> You will not be able to make new reservations till you do. Thanks
                            <br>
                             </div>
                    </div>
                    <?php endif ?>
 </div>
             <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-green">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-arrow-right fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge">Sent</div>
                                    <div>&#8358;<?=number_format($data["transaction"][1])?>.00</div>
                                </div>
                            </div>
                        </div>
                       
                    </div>
                </div>

                 <div class="col-lg-3 col-md-6">
                    <div class="panel panel-yellow">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa  fa-arrow-left fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge">Received</div>
                                    <div>&#8358;<?=number_format($data["transaction"][0])?>.00</div>
                                </div>
                            </div>
                        </div>
                      
                    </div>
                </div>

                  <div class="col-lg-3 col-md-6">
                    <div class="panel panel-purple">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-pause fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge">Pending (Unlisted)</div>
                                    <div>&#8358;<?=number_format($data["transaction"][2])?>.00</div>
                                </div>
                            </div>
                        </div>
                      
                    </div>
                </div>


                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-w">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-users fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge">Multiplier</div>
                                    <div>50%</div>
                                </div>
                            </div>
                        </div>
                      
                    </div>
                </div>
                  
             </div>
      
      <div class="row">
                    
                    

                    <div class="col-md-4 col-lg-4">
                        <div class="panel panel-info">
                            <div class="panel-heading">
                                <h3 class="panel-title">Pending Payments From</h3>
                            </div>
                            <div class="panel-body">
                                <?php if($approvals !== false): ?>

                                    <?php for($i = 0; $i < $approvals_list_num; ++$i): ?>
                                    <div class="row">
                                        <div class="col-md-offset-1 col-md-10">
                                            <div class="alert" style="border: 1px solid #ebebeb; padding: 1rem; border-radius:8px; text-align: center;">
                                                <div><h3 style="color: #000"><?=$approvals["payee_fullname"][$i]?></h3> Has been matched to pay you <?="&#8358 ".$approvals["pay_amount"][$i]?></div>

                                                <!--<div>Please kindly contact user with this information below.</div>-->

                                                <br><div style="background-color: #a44">Contact Information</div>
                                                <br><br>

                                                <p>Phone No: <span style="color: #4aa"><?=$approvals["payee_phone"][$i]?></span></p>
                                                <p>Email: <span style="color: #4aa"><?=$approvals["payee_email"][$i]?></span></p>

                                                

                                                <form action="<?=URL?>/dashboard/accept_pay" method="post" onsubmit="are_you_sure(event, 'You are about to confirm <?=$approvals["payee_fullname"][$i]?> ?')">

                                                    <input type="hidden" value="<?=$approvals["payee_id"][$i]?>" name="p_i">
                                                    <input type="hidden" value="<?=$approvals["pay_section"][$i]?>" name="s_p">
                                                    <input type="hidden" value="<?=$approvals["queue_id"][$i]?>" name="q">
                                                    <input type="hidden" value="<?=$approvals["section_id"][$i]?>" name="s_i">

                                                    <p><button class="btn btn-primary btn-bg btn-rounded">Approve</button>
                                                        <!--<a onclick="are_you_sure(event, 'Are you sure you want to purge <?=$approvals["payee_fullname"][$i]?>')" class="btn btn-danger" href="<?=URL?>/dashboard/purge/<?=base64_encode($approvals["queue_id"][$i])?>" >Purge</a> -->
                                                    </p>
                                                    <!--<button class="btn btn-info">Approve Payment</button>-->
                                                </form>
                                               
                                               
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <?php endfor; ?>
                                <?php else: ?>No Pending Payments</div>

                                <?php endif; ?>
</div>
                            </div>
                         </div>

<div class="row">
                    <div class="col-md-4 col-lg-4">
                        <div class="panel panel-info">
                            <div class="panel-heading">
                             <h3 class="panel-title">Pending Payments To</h3>
                            </div>
                           
                              
                                        <div class="panel-body">
                                        <?php if(!isset($pay[1])) : ?>
											<?php if(isset($pay[2]) || isset($pay[3]) || isset($pay[4]) || isset($pay[5])): ?>
											<div class="text-center">Hi, <?=cookie::get("name")?> You have been ask to provide help.</div>
											<?php else: ?>
                                       
                                                                                       No Pending Payments.

  <a href="<?=URL?>/dashboard/view_list/<?=base64_encode($data['my_data']['idu'])?>"> <button class='btn btn-primary'>Make Donation</button> </a>
                                                                                        
											<?php endif; ?>
                                        <?php else: ?>

                                           <div class="pricing-title timer text-center text-danger big-text" data-expire-date="<?=$pay[1]["expire_date"]?>">

                                                You have <small><i id="hr">0</i> hours <i id="min">0</i> minutes <i id="sec">0</i> seconds </small>

                                            </div>
                                            <table class="table table-striped text-center table-responsive">
                                                <tbody>
                                                    
                                                    <tr>
                                                        <td>To pay: <?=$pay[1]["username"]?></td>
                                                    </tr>

                                                    <tr>
                                                        <td>&#8358 <?=$pay[1]["amount"]?></td>
                                                    </tr>
                                                    
                                                    <tr>
                                                        <td style="background-color: #66CDAA; color: #fff;">Contact Information</td>
                                                    </tr>

                                                    

                                                    <tr>
                                                        <td><?=$pay[1]["phonenumber"]?></td>
                                                    </tr>

                                                    <tr>
                                                        <td><?=$pay[1]["email"]?></td>
                                                    </tr>
                                                    <tr>
                                                        <td style="background-color: #66CDAA; color: #fff;">Account Information</td>
                                                    </tr>
                                                    <tr>
                                                        <td><?=$pay[1]["bank_name"]?></td>
                                                    </tr>

                                                    <tr>
                                                        <td><?=$pay[1]["acc_name"]?></td>
                                                    </tr>

                                                    <tr>
                                                        <td><?=$pay[1]["acc_number"]?></td>
                                                    </tr>
                                                </tbody>
                                            </table>

                                        <?php endif; ?>

                                        </div>
                                    </div>
                            
                    
                    
                    </div>
                    </div>
                    
               
          
      <div class="col-md-12">

            <div class="panel panel-info" data-sortable-id="index-2">
                <div class="panel-heading">

                    <h4 class="panel-title">Latest Info</h4>
                </div>
                <div class="panel-body">
                    <div>
                        <ul class="media-list media-list-with-divider">
                        <li class="media media-lg text-info">
                                <a href="javascript:;" class=""> 
                                   <h4 style='color:red' > <i class='fa fa-bell'></i> Important Announcement </h4>
                                </a>

                                <?php global $CONF; ?>
                                <div class="media-body">
<?=$data['news']?>
                                </div>
                            </li>
                            
                            <li class="media media-lg">
                                <a href="javascript:;" >
                                   <h4> Steps to Get Paid </h4>
                                </a> <br>

                                <?php global $CONF; ?>
                                <div class="media-body">

                                    You simply pick someone who is to
                                    receive money from the donation list and pay either part or the entire money the
                                    person is to receive,
                                    once your payment has been confirmed you would be queued on the list
                                    to be payed <strong style="color: #ffa911">150%</strong> of the money you donated
                                    i.e you get <strong style="color: #ffa911">50%</strong> interest.
                                    You can donate a minimum <strong style="color: #ffa911">N<?=number_format($CONF['min_pledge'])?> </strong>
                                    and a maximum <strong style="color: #ffa911">₦<?=number_format($CONF['max_pledge'])?></strong>
                                </div>
                            </li>
                          
                            <li class="media media-lg">
                                <a href="javascript:;" class="pull-left">
                                    <span class="fa fa-asterisk"></span>
                                </a>
                                <div class="media-body">

                                    You get paid <strong style="color: #ffa911">2 - 48 hours</strong> after your payment has been confirmed.


                                </div>
                            </li>
                            <li class="media media-lg">
                                <a href="javascript:;" class="pull-left">
                                    <span class="fa fa-asterisk"></span>
                                </a>
                                <div class="media-body">

                                    Remember to crosscheck your bank details and make sure they're accurate to avoid complications

                                </div>
                            </li>
                            <li class="media media-lg">
                                <a href="javascript:;" class="pull-left">
                                    <span class="fa fa-asterisk"></span>
                                </a>
                                <div class="media-body">
                                    You have <strong style="color: #ffa911"><?=$CONF['pay_limit']?> Hours</strong> to pay for your reservation else your reservation will cancelled and account suspended so please do not reserve if you cannot pay.
                                </div>
                            </li>
                            <li class="media media-lg">
                                <a href="javascript:;" class="pull-left">
                                    <span class="fa fa-asterisk"></span>
                                </a>
                                <div class="media-body">

                                    The admin reserves the right to suspend users operating multiple accounts, although
                                    you can manage accounts for others but the details must be different.
                                </div>
                            </li>

                        </ul>
                    </div>
                </div>
            </div>
        <!-- end col-8 -->
        <!-- begin col-4 -->


    
        <div class="col-md-12">

            <div style="padding: 2em;">
                <strong>Risk:</strong> Giving donation and expecting incentives involves significant risk.
                The purpose of this risk disclaimer is to inform users of the potential financial
                risks involved in providing help and getting help in return. The transaction or operations on our
                platform does involve a substantial degree of risk, and should not be undertaken until the user has
                carefully evaluate whether their financial situation is appropriate for such transactions. Transactions
                may result in a substantial or complete loss of funds and therefore should only be undertaken with
                money you can spare. Any information included in this website does not constitute an offer of services
                for users residing in any jurisdictions where such offer is not authorized
            </div>

    </div>
    <!-- end col-4 -->
</div>
</div>

            </div>
        </div>
    </div>
    

    <script type="text/javascript">
        


    function are_you_sure(e, message) {


        var con = confirm(message);


        if (con === false) {

            e.preventDefault();
            return false;


        }

    }


function time_parse(mainTime) {

    parts = mainTime.split(/[T ]/); //split T or space

    date = parts[0];
    time = parts[1];

    dt = new Date();




    parts = date.split(/[-\/]/); // split date on - or /
    dt.setFullYear(parseInt(parts[0], 10));
    dt.setMonth(parseInt(parts[1], 10), -1) ;// Month start at 0 in js
    dt.setDate(parseInt(parts[2], 10)) ;

    parts = time.split(/:/); //split time on :
    dt.setHours(parseInt(parts[0], 10));
    dt.setMinutes(parseInt(parts[1], 10));
    dt.setSeconds(parseInt(parts[2], 10));

    return dt;

}


function timeCounter() {
    var timer_div = document.querySelectorAll(".timer");

    for($i = 0; $i < timer_div.length; ++$i) {


        var expire = timer_div[$i].dataset.expireDate;


        var until = time_parse(expire);
        var now   = new Date();


        var timeDiff =  until.getTime() - now.getTime();
        var x = new Date(timeDiff);


        if (timeDiff <=0) {
            //return false;
            timer_div[$i].innerHTML = "This match is now expired.Do NOT make payment.";
            
        }


        var days    = Math.floor(hours / 24);
        var seconds = Math.floor(timeDiff / 1000);
        var minutes = Math.floor(seconds / 60);
        var hours   = Math.floor(minutes / 60);


        hours   %= 24;
        minutes %= 60;
        seconds %= 60;

        var hr  = timer_div[$i].childNodes[1].childNodes[0];
        var min = timer_div[$i].childNodes[1].childNodes[2];
        var sec = timer_div[$i].childNodes[1].childNodes[4];
        
        
        hr.innerHTML = hours;
        min.innerHTML = minutes;
        sec.innerHTML = seconds;
        //console.log(sec);

    }




    /*//var date = document.getElementById("date").dataset;
    var expire = date.expireDate;
    var start  = date.startDate;



    var until = time_parse(expire);
    //console.log(time_parse(expire).toUTCString());
    var now   = new Date();

    //console.log(now.toUTCString());
    //console.log(until.toUTCString());

    var timeDiff =  until.getTime() - now.getTime();
    var x = new Date(timeDiff);
    //console.log(x.toUTCString());

    if (timeDiff <=0) {
        return false;
    }

    var days    = Math.floor(hours / 24);
    var seconds = Math.floor(timeDiff / 1000);
    var minutes = Math.floor(seconds / 60);
    var hours   = Math.floor(minutes / 60);

    hours   %= 24;
    minutes %= 60;
    seconds %= 60;

    
    var hrs = document.getElementById("hr");
    var min = document.getElementById("min");
    var sec = document.getElementById("sec");

    hrs.innerHTML = hours;
    min.innerHTML = minutes;
    sec.innerHTML = seconds; */



}



window.onload = function() {
    timeCounter();
    setInterval('timeCounter()', 1000);
};




    </script>

    <?php require $this->footer; ?>

