<h1 class="line">Employee Report</h1>
<h1>SpreadSheet Costs: Salaries</h1>

<div class="actions">
    <a href="/admin/employeeSearch" class="link-btn">Return Search to Page</a>
    <a class="line"> Today's Date: <?php echo date('y-m-d') ?> </a>
    <a href="/admin/employeeReport2" class="link-btn">Social Charges Filter</a>
</div>

<div class = 'center'>
<div>
    <label class='extra-margin' for="datePicker">Select a Date to Filter: </label>
    <input type="date" id="datePicker" name="selectedDate">
</div>
</div>


<?php $i = 1;
    foreach($results as $r){  ?>
    <div class='container'> 
    <div class = 'scrollable-content'>
    <li class='square-container-list'> 
        <ul class='result-list'>
            <li> <?php echo $i ?> .  </li> 
            <li> Nombre: <?php echo $r->Name ?> </li> 
        </ul>
    </li>
    </div>
    </div>
<?php $i++;
    } ?>

