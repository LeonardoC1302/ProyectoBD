<h1 class="service_title">Consults</h1>
<h1>Clients reports</h1>

<div class="actions">
    <a href="/customerService" class="link-btn">Return to Customer Service</a>
    <a class="line"> Today's Date: <?php echo date('y-m-d') ?> </a>
</div>
<div class = 'center'>
    <form method = 'POST'>
        <label class='extra-margin' for="datePicker">Select a Date to Filter: </label>
        <input type="date" id="datePicker" name="selectedDate" placeholder="YYYY-MM-DD">
        <input class="link-btn" type="submit" value="Search">
    </form>
</div>

<?php $i = 0;
    foreach($consultInfo as $c){  ?>
    <div class='container'> 
    <div class = 'scrollable-content'>
    <li class='square-container-list'> 
        <ul class='result-list'>
            <li><b> <?php echo $i?>. <?php echo $consultInfo[$i]["clientName"] ?>  </b></li> 
            <li> Order ID: <?php echo $consultInfo[$i]['ordenID']?>  </li> 
            <li> Report Type: <?php echo $consultInfo[$i]['typeName']?> </li> 
            <li> Description:  <?php echo $consultInfo[$i]['description']?>  </li> 
        </ul>
    </li>
    </div>
    </div>
<?php $i++;
    } ?>
