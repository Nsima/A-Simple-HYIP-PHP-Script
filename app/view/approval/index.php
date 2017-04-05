<?php 

$approvals = $data["approvals_list"];
$approvals_list_num = count($approvals["payee_fullname"]);



?>

<body id="top" data-spy="scroll">
    <!--top header-->

   <?php require $this->header; ?>
   <br>
   <br>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
            

            </div>
        </div>
    </div>
    <section>

    </section>
	
	
	 <script type="text/javascript">
        


    function are_you_sure(e, message) {


        var con = confirm(message);


        if (con === false) {

            e.preventDefault();
            return false;


        }

    }


    </script>