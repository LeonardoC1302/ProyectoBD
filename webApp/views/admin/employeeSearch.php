<h1 class="line">Employee Search</h1>

<div class="actions">
    <a href="/admin/employees" class="link-btn">Return to Employees</a>
    <a class="line"> Today's Date: <?php echo date('y-m-d') ?> </a>
    <a href="/admin/employeeReport" class="link-btn"> Click Here for Salary Report </a>
</div>

<div class="container">
        <form class="square-container" method="POST">
            <!-- Add search input fields and buttons here -->
            <h2 class="search-header">Search:</h2>
            <div class="input-container">
                <label for="Name">Name:</label>
                <input type="text" id="Name" name="Name" placeholder="-- Enter name --">
            </div>
            <div class="input-container">
                <label for="Surname">Surname:</label>
                <input type="text" id="Surname" name="Surname" placeholder="-- Enter surname --">
            </div>
            <div class="drop-down">
                <legend>Rol</legend>
                <select name="Rol" id="Rol">
                <option value="" disabled selected>-- Select Rol --</option>
                <?php foreach($rol as $r){ ?>
                    <option value="<?php echo $r->id ?>"><?php echo $r->rol ?></option>
                <?php } ?>
                </select>
            </div>
            <div class="drop-down">
                <legend>Country</legend>
                <select name="Country" id="Country">
                <option value="" disabled selected>-- Select Country --</option>
                <?php foreach($country as $c){ ?>
                    <option value="<?php echo $c->id ?>"><?php echo $c->name ?></option>
                <?php } ?>
                </select>
            </div>
            
            <input class="search-button" type="submit" value="Search" onclick="return confirm('Aceptar?')">

            <div> <p>NOTE: If not all data is introduced, search will return all employees</p> </div>

        </form>

        

        <div class="square-container">
            <div class="scrollable-content">
                <h2 class="search-header">Results:</h2>
                <ul class = "result-list">
                <?php 
                    $index = 1;
                    foreach($results as $r){?>
                <li><?php echo $index . "." ?></li>
                <li>Name: <?php echo $r->Name ?> </li>
                <li>Deparment: <?php echo $r->Department ?></li>
                <li>Rol: <?php echo $r->Rol ?></li>
                <li>Hours Worked This Period: <?php echo $r->hours ?></li>
                <li>Pay per Hour: ₡<?php echo $r->salary ?> - Social Charge: <?php echo $r->socialcharge*100 ?>%</li>
                <li>Current Salary To Pay: ₡<?php echo round($r->CurrentSalary,2) ?></li>
                <li>Next Pay: <?php echo $r->NextPay ?> </li>
                <?php $index = $index+1; 
                        }?>
                </ul>
            </div>
        </div>
    </div>
</div>