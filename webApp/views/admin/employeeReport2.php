<h1 class="line">Employee Report</h1>
<h1>Salary and Social Charge Cost Report</h1>

<div class="actions">
    <a href="/admin/employeeReport" class="link-btn">Return Salary info</a>
    <a class="line"> Today's Date: <?php echo date('y-m-d') ?> </a>
    <a href="/admin/employees" class="link-btn"> Return to Employee List </a>
</div>

<div class = 'center'>
    <form method = 'POST'>
        <div class="extra-margin2">
                <select name="filter" id="filter">
                <option value="" disabled selected>-- Select Filter --</option>
                <option value="employees"> employee </option>
                <option value="roles"> role </option>
                <option value="departments"> department </option>
                <option value="countries"> country </option>
            </select>
        </div>
        <div class="extra-margin2">
                <select name="filter2" id="filter2">
                <option value="" disabled selected>-- Select Report Type --</option>
                <option value="Salary"> Salary </option>
                <option value="Social Charge"> Social charge </option>
            </select>
        </div>
        <input class="link-btn" type="submit" value="Search">
    </form>
</div>

<!-- depending on filters entered shows corresponding data  -->


<div class='container'> 
<div class = 'scrollable-content'>
<b> <?php echo $filter2 ?>: <b><?php echo $filter ?></b></b>
<li class='square-container-list'> 
    <h2 class="search-header">Total <?php echo $filter2 ?> costs of all <?php echo $filter ?>:</h2>
    <?php foreach($results as $r){ 
        if($r->TotalSalaryCost != ""){?>
    <ul class='result-list'>
        <li> <?php echo $r->Name . " -> " ?>  ₡<?php echo round($r->TotalSalaryCost,2) ?> </li>  
    </ul>
    <?php }else{ ?>
        <ul class='result-list'>
        <li> <?php echo $r->Name . " -> " ?>  ₡<?php echo round($r->SocialChargeCost,2) ?> </li>  
    </ul>
    <?php }
    } ?>
</li>

</div>
</div>
