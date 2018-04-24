 <style>
    .nostyle li {
                list-style: none;
            }
            .navi-tabs li {
                display: inline-block;
                padding: 5px;
            }
            .nav-base li a{
                color: #fff;
                display: block;
                line-height: 150%;
                text-decoration: none;
                border-bottom: 3px solid #fff;
                font-size: 11pt;
                font-family: "Trebuchet MS","tahoma","raleway",sans-serif;
            }
     .nav-base li a:hover{
         border-bottom: 2px solid #ff7f4d;
         transition: .5s ease;
     }
     .nav-base li:last-child a{
     }
     ul li:last-child{
         float: right;   
     }
</style>
                   <ul class="navi-tabs nostyle nav-base">
                    <li><a href="inventoryaddpackage.php" target="_self">Create package</a></li>
                    <li><a href="inventoryadditem.php" target="_self">Fill Package</a></li>
                    <li><a href="inventoryviewing.php" target="_self">View Items</a></li>
                    <li><a href="inventorysales.php" target="_self">Create Sales</a></li>
                    <li><a href="inventorysalesreport.php" target="_self">Sales Report</a></li>
                    <li><a href="inventorypackages.php" target="_self">View Packages</a></li>
                    <li><a href="inventorycreatedelivers.php" target="_blank">Add Deliveres</a></li>
                    <li><a href="inventoryrecords.php" target="_blank">Logs</a></li>
                    <li><a href="settings.php" target="_blank">Settings</a></li>
                    <li><a href="logout.php">Log out</a></li>
                    </ul>