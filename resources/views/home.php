<?php

    namespace views;

    require '../../app/autoloader.php';
    include "./layouts/main.php";
    use Controllers\auth\LoginController as LoginController;
    $ua = new LoginController;
    head($ua);

?>

<div class="row mx-auto mt-1 w-100 px-1">
    <div class="col-4">
        <div id="prev-posts" class="list-group">

        </div>
    </div>
    <div class="col-6">
        <div id="content" class="content">
        
        </div>
    </div>
    
    <div class="col">
        <div id="autores" class="list-group">
        &&&&&&
        </div>
    </div>
</div>

<?php scripts(); ?>

<script type="text/javascript">
$(function(){    
    app.uid = "<?=$ua->uid?>";
    app.sv = <?php echo $ua->sv ? "true" : "false"; ?>;
    app.previousPosts();
    app.lastPost(1,app.sv,app.uid);    
});
</script>

<?php    
    foot();
    

    