<h1 class="service_title">Order Info</h1>
<div class="actions">
    <a href="/customerService" class="link-btn">Return Customer Service</a>
</div>
<div class="squareContainer">
    <div class="scrollable-content">
        <ul class = "result-list">
        <li>Client Name: <?php echo $orderInfo[0]["clientId"]; ?></li>
            <li>Order ID: <?php echo $orderInfo[0]["id"]; ?></li>
            <li>Sale Date: <?php echo $orderInfo[0]["date"]; ?></li>
            <li>Total: <?php echo $orderInfo[0]["total"]; ?></li>
            <li>Status: <?php echo $orderInfo[0]["status"]; ?></li>
            <li>Comments: <?php echo $orderInfo[0]["description"]; ?></li>
        </ul>
    </div>
</div>

<div class="service-form">
        <div class="actions">
            <a href="/orderReport" class="boton">Report a problem</a>
        </div>  
</div>