<?php
    if (isset($_SESSION['success'])){
        $msg = $_SESSION['success'];
           
        ?>
        <div id="salert" class="alert alert-success" role="alert" style="color: #27a4b0; background: #abe7ed ;display: ''; height: 70px;margin-bottom: 0px;text-align: center;padding-top: 0px;padding-right: 0;">
            <div class="container">
                <div class="row">
                    <div class="col-md-11 alertmessage"><span><strong><?php echo $msg ?></strong></span></div>
                    <div class="col-md-1 offset-md-0 alertbutton">
                        <button onclick="closent('salert');"class="btn btn-primary salertbtn" type="button">
                            <i class="fa fa-times" style="color:green;width: 12px;"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <?php
         }
            $_SESSION['success'] = null;
        ?>