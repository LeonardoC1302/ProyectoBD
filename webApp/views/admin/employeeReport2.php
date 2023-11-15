<h1 class="line">Employee Report</h1>
<h1>Social Charge Report</h1>

<div class="actions">
    <a href="/admin/employeeReport" class="link-btn">Return Salary Report</a>
    <a class="line"> Today's Date: <?php echo date('y-m-d') ?> </a>
    <a href="/admin/employees" class="link-btn"> Return to Employee List </a>
</div>

<div class = 'center'>
    <form method = 'POST'>
        <label class='extra-margin' for="datePicker">Select a Date to Filter: </label>
        <input type="date" id="datePicker" name="selectedDate" placeholder="YYYY-MM-DD">
        <input class="link-btn" type="submit" value="Search">
    </form>
</div>

<div class='container'> 
<div class = 'scrollable-content'>
<li class='square-container-list'> 
    <ul class='result-list'>
        <li> Social Charge Per Employee: </li> 
        <li> Social Charge Per Rol: </li> 
        <li> Social Charge Per Department:  </li> 
        <li> Social Charge Per Country: </li> 
    </ul>
</li>
</div>
</div>
