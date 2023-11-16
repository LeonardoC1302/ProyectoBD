<h1 class="line">Employee Report</h1>
<h1>Social Charge Report</h1>

<div class="actions">
    <a href="/admin/employeeReport" class="link-btn">Return Salary Report</a>
    <a class="line"> Today's Date: <?php echo date('y-m-d') ?> </a>
    <a href="/admin/employees" class="link-btn"> Return to Employee List </a>
</div>

<div class = 'center'>
    <form method = 'POST'>
        <div>
            <label class='extra-margin' for="datePicker">Select a Date to Filter: </label>
            <input type="date" id="datePicker" name="selectedDate" placeholder="YYYY-MM-DD">
        </div>
        <div class="extra-margin2">
                <select name="filter" id="filter">
                <option value="" disabled selected>-- Select Filter --</option>
                <option value="employees"> employee </option>
                <option value="roles"> rol </option>
                <option value="departments"> department </option>
                <option value="countries"> country </option>
            </select>
        </div>
        <input class="link-btn" type="submit" value="Search">
    </form>
</div>




<div class='container'> 
<div class = 'scrollable-content'>
<b> Salaries: <b><?php echo $filter ?></b></b>
<li class='square-container-list'> 
    <h2 class="search-header">Total salary costs of all <?php echo $filter ?>:</h2>
    <?php foreach($results as $r){ ?>
    <ul class='result-list'>
        <li> <?php echo $r->Name . " -> " ?>  ₡<?php echo round($r->TotalSalaryCost,2) ?> </li>  
    </ul>
    <?php } ?>
</li>

</div>
</div>
