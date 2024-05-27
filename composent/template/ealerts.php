<?php
if (isset($_SESSION['error'])){
    $msg = "ERREUR : ".$_SESSION['error'];
           
?>
<div id="ealert" class="alert alert-success" role="alert" style="color: #e73d4a; background: #fbe1e3; display: ''; height: 70px;margin-bottom: 0px;text-align: center;padding-top: 0px;padding-right: 0;">
    <div class="container">
        <div class="row">
            <div class="col-md-11 alertmessage"><span><strong><?php echo $msg ?></strong></span></div>
            <div class="col-md-1 offset-md-0 alertbutton">
                <button onclick="closent('ealert');"class="btn btn-primary alertbtn" type="button" style="">
                    <i class="fa fa-times" style="color:blue;width: 12px;"></i>
                </button>
            </div>
        </div>
    </div>
</div>
<?php
 }
    $_SESSION['error'] = null;
?>