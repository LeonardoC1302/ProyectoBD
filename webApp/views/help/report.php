
<h1 class="service_title">Report a Problem
</h1>

<div class="actions">
    <a href="/orderInfo?id=<?php echo $orderInfo[0]["id"];?>" class="link-btn">Return to Order Info</a>
    <a class="line"> Today's Date: <?php echo date('y-m-d') ?> </a>
</div>

<div class="container">
        <form class="square-container" method="POST">
            <div class="input-container">
                <label for="OrderID">OrderID:     <?php echo "  " . $orderInfo[0]["id"];?></label>
            </div>
            <div class="input-container">
                <label for="ClientID">ClientID:     <?php echo "  ". $clientInfo[0]["name"];?></label>
            </div>
            <div class="drop-down">
                <legend>Report Type</legend>
                <select name="Type" id="Type">
                <option value="" disabled selected>-- Select type --</option>
                <?php $index = 0; 
                foreach($comment as $t){ ?>
                    <option value="<?php echo $comment[$index]["id"]?>"><?php echo $comment[$index]["commentType"] ?></option>
                <?php $index++; } ?>
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