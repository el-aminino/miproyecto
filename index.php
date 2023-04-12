<?php
// include Header
 include 'src/header.php'; 
?>
<style>
    #wrapper{
        position: relative;
        width: 100%;
        height: auto;
    }
    .up-down {
        width: 100%;
        height: 30%;
        display: block;
    }
    .header {
        
        color: white;
        position: relative;
        text-shadow: -1px -1px -1p #000, 1px 1px 1px #000;
        z-index: 100;
    }

    .bg-c {
        position: absolute;
        top: 0;
        left: 0;
        z-index: -100;
    }
</style>
<div id="wrapper">

    <div class="up-down">

    </div>
        
    <div class="header">
        
        <h1>Title</h1>
        <h3>Descripcion para esta proyecto</h3>
        
    </div>

    <div class="up-down">
        
    </div>


    <div class="bg-c">
        <img src="src/bluerose.jpg" width="100%" height="auto" style=" opacity: 70%;"/>
    </div>
</div>
<?php 
//include footer
include 'src/footer.php' 
?>