<h1 class="line">Employee Report</h1>
<h1>Salaries, Payments and Performance</h1>

<div class="actions">
    <a href="/admin/employeeSearch" class="link-btn">Return Search to Page</a>
    <a class="line"> Today's Date: <?php echo date('y-m-d') ?> </a>
    <a href="/admin/employeeReport2" class="link-btn">Reports by Filters</a>
</div>

<div class = 'center'>
    <form method = 'POST'>
        <label class='extra-margin' for="datePicker">Select a Date to Filter: </label>
        <input type="date" id="datePicker" name="selectedDate" placeholder="YYYY-MM-DD">
        <input class="link-btn" type="submit" value="Search">
    </form>
</div>

<!-- shows all data form the employee query  -->

<?php $i = 1;
    foreach($results as $r){  ?>
    <div class='container'> 
    <div class = 'scrollable-content'>
    <li class='square-container-list'> 
        <ul class='result-list'>
            <?php $flatSalary =  $r->CurrentSalary/(1-$r->socialcharge) ?>
            <li><b> <?php echo $i?>. <?php echo $r->Name ?>  </b></li> 
            <li class='line'><b> Salary Information:  </b></li> 
            <li> Hours worked this period: <?php echo $r->hours . " Hours - Hourly Salary:" ?> ₡<?php echo $r->salary?>  </li> 
            <li> Current flat salary for this period: ₡<?php echo $flatSalary?> </li> 
            <li class='line'><b> Pay Reductions:  </b></li> 
            <li> Social Charge: ₡<?php echo $r->socialcharge*$flatSalary . " (-" . $r->socialcharge * 100 . "%) "?> </li> 
            <li> Additional Taxes: ₡0 </li> 
            <li class='line'><b> Current Final Salary  </b></li> 
            <li> Final Pay: ₡<?php echo round($r->CurrentSalary, 2)?> </li> 
            <li> Scheduled Next Pay: <?php echo $r->NextPay?> </li> 
            <li>
                <form method="POST" class="w-100" action="/admin/payment">
                    <input type="hidden" name="id" value="<?php echo $r->id ?>">
                    <input type="hidden" name="totalSalary" value="<?php echo $r->CurrentSalary ?>">
                    <input type="submit" class="submit-btn" value='Proceed with payment' onclick="return confirm('Desea pagar el salario para este periodo?')">
                </form>
            </li>
        </ul>
    </li>
    </div>
    </div>
<?php $i++;
    } ?>

<!-- shows data from employee performance and salary costs  -->

<h1 class="line"> Employee Performance Rundown: </h1>

<table class = "line">
    <thead>
        <tr>
            <th class="line">Performance#</th>
            <th class="line">Employee ID</th>
            <th class="line">Comment</th>
            <th class="line">Rating</th>
        </tr>
    </thead>

    <tbody> 
        <?php
        foreach($performance as $p){ ?>
        <tr>
            <td><?php echo $p->id ?></td>
            <td><?php echo $p->employeeId ?></td>
            <td><?php echo $p->report ?></td>
            <td><?php echo $p->rating ?></td>
        </tr>
        <?php } ?>
    </tbody>
</table>

<h1 class="line"> SpreadSheet Salary Costs: </h1>

<table class = "line">
    <thead>
        <tr>
            <th class="line">Log Register ID</th>
            <th class="line">Amount Payed</th>
            <th class="line">Employee ID</th>
            <th class="line">Date Payed</th>
        </tr>

    </thead>

    <tbody> 
        <?php $total = 0;
        foreach($payLog as $pay){ 
            $total += $pay->amount?>
        <tr>
            <td><?php echo $pay->id ?></td>
            <td>₡<?php echo $pay->amount ?></td>
            <td><?php echo $pay->employeeId ?></td>
            <td><?php echo $pay->datePayed ?></td>
        </tr>
        <?php } ?>
    </tbody>
</table>

<b class="align-right"> Total Salary Costs: ₡<?php echo $total ?></b>