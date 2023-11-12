<h1 class="line">Employees</h1>
<table class = "line">
    <thead>
        <tr>
            <th class="line">Name</th>
            <th class="line">Surname</th>
            <th class="line">Rol</th>
            <th class="line">Department</th>
            <th class="line">Hours</th>
            <th class="line">Last Pay</th>
            <th class="line">Countries</th>
            <th class="line">Payed in this 2 week period</th>
        </tr>

    </thead>

    <tbody> 
        <?php foreach($employee as $em){ ?>
        <tr>
            <td><?php echo $em->name ?></td>
            <td><?php echo $em->surname ?></td>
            <td><?php foreach($rol as $r){
                    if($r->id == $em->rolId){
                        echo $r->rol; ?></td>
              <td><?php foreach($department as $dep){
                        if($r->departmentId == $dep->id){
                            echo $dep->name;
                        }
                    }
                }
            }
                ?></td>
            
            <td><?php echo $em->hours ?></td>
            <td><?php echo $em->lastPay ?></td>
            <td><?php foreach($country as $c){
                    if($c->id == $em->countryId){
                        echo $c->name;
                    }
                }
                ?></td> 
            <td><?php echo $em->pay ?></td>
        </tr>
        <?php } ?>
    </tbody>
</table>

<div class="actions">
    <a> </a>
    <a href="/admin/employeeSearch" class="link-btn">Employee Query</a>
    <a> </a>
</div>