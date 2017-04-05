<?php require("header.php"); ?>


<div class="container">
        <div class="row">
         
            <div class="col-md-3"> </div>
            <div class='col-md-6' style='margin-top:10%; margin-bottom:10%;'>
                   <h3 class="text-center"> Configure Payment List Release Time </h3>
                   <div class='text-danger text-center'> <?=$data['errors']?> </div>
            <form method='post' action='<?=URL?>/mylala/set_time/accept'>

            <span> Time of action </span>
                 <input class='form-control'  placeholder="HH::MM" value="<?=$data['action_time']['action_time']?>" name='next_time'/>
                 <br/>

           <span> Repeat after (hours) </span>
                 <input class='form-control' value="<?=$data['action_time']['action_repeat']?>" type='number' name='repeat_after'/>  

                 <button style='margin-top:10px;' class='btn btn-primary text-center'> Save Changes </button>
            </form>
            
              <form method='post' action='<?=URL?>/mylala/set_list/accept' style='margin-top:20px;'>

            <span> No of People Per list </span>
                 <input class='form-control'  placeholder="No of People per list" value="<?=$data['no']?>" name='no'/>
                 <br/>

           
                 <button style='margin-top:10px;' class='btn btn-primary text-center'> Save Changes </button>
            </form>
            
             <div style='margin-top:30px'>
            <span style='margin-top:30px'> <?php echo $data['list_status'] == '1'? "List is Visible": "List is hidden ";?> </span> 
            
            
            	 <a href="<?=URL?>/mylala/set_list_status/<?php echo $data['list_status'] == '1'? "0": "1";?>">  <br/><button class='btn btn-primary'> <?php echo $data['list_status']=='1'? "Hide List": "Display List ";?> </button> </a>
              
 	</div>
             
             
             <form method='post' action='<?=URL?>/mylala/set_announcement/accept' style='margin-top:20px;'>

            <span> Current Announcement </span>
                 <textarea class='form-control'  placeholder="Brief News here"  name='news'><?=$data['news']?></textarea>
                 <br/>

           
                 <button style='margin-top:10px;' class='btn btn-primary text-center'> Publish </button>
            </form>
            </div>
            

            <div class='col-md-3'></div>
        </div>
    </div>
     
<?php require("footer.php"); ?>