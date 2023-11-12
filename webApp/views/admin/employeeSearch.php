<h1 class="line">Employee Search</h1>

<div class="actions">
    <a href="/admin/employees" class="link-btn">Return to Employees</a>
</div>

<div class="container">
        <form class="square-container" method="POST">
            <!-- Add search input fields and buttons here -->
            <h2 class="search-header">Search:</h2>
            <div class="input-container">
                <label for="employeeName">Name:</label>
                <input type="text" id="employeeName" name="employeeName" placeholder="Enter name">
            </div>
            <div class="input-container">
                <label for="employeeRol">Rol:</label>
                <input type="text" id="employeeRol" name="employeeRol" placeholder="Enter Rol">
            </div>
            <div class="input-container">
                <label for="employeeDepartment">Department:</label>
                <input type="text" id="employeeDepartment" name="employeeDepartment" placeholder="Enter department">
            </div>
            <div class="input-container">
                <label for="Country">Country:</label>
                <input type="text" id="Country" name="Country" placeholder="Enter country">
            </div>
            
            <input class="search-button" type="submit" value="Search" onclick="return confirm('Aceptar?')">

        </form>

        <div class="square-container">
            <div class="scrollable-content">
                <h2 class="search-header">Results:</h2>
                <ul class = "result-list">
                <li><b>1. </b></li>
                <li>Name:</li>
                <li>Rol:</li>
                <li>Deparment:</li>
                <li>Hours Worked:</li>
                <li>Pay per Hour: - Social Charge:</li>
                <li>Current Salary:</li>

                <li><b>2. </b></li>
                <li>Name:</li>
                <li>Rol:</li>
                <li>Deparment:</li>
                <li>Hours Worked:</li>
                <li>Pay per Hour: - Social Charge:</li>
                <li>Current Salary:</li>
                </ul>
            </div>
        </div>
    </div>
</div>