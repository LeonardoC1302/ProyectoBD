<h1 class="service_title">Report a Problem
</h1>

<div class="actions">
    <a href="/orderInfo" class="link-btn">Return to Order Info</a>
    <a class="line"> Today's Date: <?php echo date('y-m-d') ?> </a>
</div>

<div class="container">
        <form class="square-container" method="POST">
            <div class="input-container">
                <label for="OrderID">OrderID:</label>
            </div>
            <div class="drop-down">
                <legend>Report Type</legend>
                <select name="type" id="type">
                <option value="" disabled selected>-- Select type --</option>
                <!-- 
                <?php foreach($rol as $r){ ?>
                    <option value="<?php echo $r->id ?>"><?php echo $r->rol ?></option>
                <?php } ?>
                -->
                </select>
                
            </div>
            <div scrollable-content>
                <div class="description-container">
                    <label for="description">Description:</label>
                    <textarea type="text" id="Description" name="Description" placeholder="-- Enter description --"></textarea>
                </div>
            </div>
            
            <input class="search-button" type="submit" value="Enviar">
        </form>
</div>