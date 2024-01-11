<?php
    $user = 'root';
    $password = '';
    
    $database = 'flood_data';
    
    $servername='localhost';
    $mysql = new mysqli($servername, $user, $password, $database);
    
    if ($mysql->connect_error) {
        die('Connect Error (' .
        $mysql->connect_errno . ') '.
        $mysql->connect_error);
    }
    
    $sql = " SELECT * FROM clustered_data";
    $result = $mysql->query($sql);
    $mysql->close();
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>FloodIn-sites - Data</title>
        <link rel="icon" href="Pictures/LOGO.png" type="image/icon type">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
        <link rel='stylesheet' href='https://cdn.datatables.net/1.13.5/css/dataTables.bootstrap5.min.css'>
        <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css'> 

        <style>
            body{
                margin: 0px;
                /* scroll-behavior: smooth; */
                overflow-anchor: none;
            }

            .top-nav-bar{
                background-color: #001a33;
                padding-top: 20px;
                padding-bottom: 16px;
                margin-top: -5px;
                box-shadow: 10px 11px 18px -4px rgba(0,0,0,0.64);
                -webkit-box-shadow: 10px 11px 18px -4px rgba(0,0,0,0.64);
                -moz-box-shadow: 10px 11px 18px -4px rgba(0,0,0,0.64);
                z-index: 999;
                position: fixed;
                width: 100%;
            }

            .top-nav-bar .topic{
                align-items: right;
                align-content: right;
                text-align: right;
                margin-right: 20px;
            }

            .top-nav-bar .topic a{
                color: whitesmoke;
                font-size: 21px;
                letter-spacing: 3px;
                font-family:'Courier New', Courier, monospace;
                text-transform: uppercase;
                text-decoration: none;
                padding-left: 20px;
                padding-right: 20px;
                padding-bottom: 21.5px;
                padding-top: 26px;
                margin-top: -5px;
                cursor: pointer;
                transition: all 0.5s ease;
            }

            .top-nav-bar .topic a:hover{
                background-color: whitesmoke;
                color: #001a33;
            }

            .top-nav-bar .topic .active{
                background-color: #dbe1ff;
                color: #001a33;
            }

            .top-nav-bar .topic .active:hover{
                background-color: #dbe1ff;
                color: #001a33;
            }

            .top-nav-bar .topic .pj-name{
                background-color: #001a33;
                color: whitesmoke;
                font-family: Aclonica;
                font-size: 28px;
                text-transform: capitalize;
                padding-right: 730px;
                padding-bottom: 20px;
                margin-top: 5px;
            }

            .top-nav-bar .topic .pj-name:hover{
                background-color: #001a33;
                color: whitesmoke;
                pointer-events: none;
            }

            .top-nav-bar .topic .pj-name img{
                width: 28px;
                height: auto;
                margin-top: -10px;
                /* padding-top: 5px; */
                /* margin-top: 5px; */
            }

            .main{
                margin: 0px;
                z-index: 111;
                position: absolute;
                width: 100%;
                height: auto;
                margin-top: 60px;
                background-color: #b3bfff;
            }

            .main .tables{
                width: 98%;
                margin-left: auto;
                margin-right: auto;
                margin-top: 33px;
                padding-bottom: 95px;
            }

            .main .tables table {
                margin: 0;
                font-size: 18px;
                background-color: whitesmoke;
                /* box-shadow: 0px 0px 8px 7px rgba(0,0,0,0.46);
                -webkit-box-shadow: 0px 0px 8px 7px rgba(0,0,0,0.46);
                -moz-box-shadow: 0px 0px 8px 7px rgba(0,0,0,0.46); */
            }
    
            .main .table tr{
                border-bottom: 0.5px solid #001a33;
            }
    
            .main .table table th,
            .main .table table td {
                padding-left: 8px;
                padding-right: 8px;
            }

            .main .table .heading th{
                padding-top: 15px;
                padding-bottom: 15px; 
                border-bottom: 2px solid #001a33;

            }
    
            .main .table td {
                font-weight: lighter;
            }

            .wrapper {
                margin-top: 5vh;
            }

            .dataTables_filter {
                float: right;
            }

            .table-hover > tbody > tr:hover {
                background-color: #b3bfff;
            }

            @media only screen and (min-width: 768px) {
                .table {
                    table-layout: fixed;
                    max-width: 100% !important;
                }
            }

            thead {
                background: #ddd;
            }

            .table td:nth-child(2) {
                overflow: hidden;
                text-overflow: ellipsis;
            }

            .highlight {
                background: #ffff99;
            }

            @media only screen and (max-width: 767px) {
                /* Force table to not be like tables anymore */
                table,
                thead,
                tbody,
                th,
                td,
                tr {
                    display: block;
                }

                /* Hide table headers (but not display: none;, for accessibility) */
                thead tr,
                tfoot tr {
                    position: absolute;
                    top: -9999px;
                    left: -9999px;
                }

                td {
                    /* Behave  like a "row" */
                    border: none;
                    border-bottom: 1px solid #eee;
                    position: relative;
                    padding-left: 50% !important;
                }

                td:before {
                    /* Now like a table header */
                    position: absolute;
                    /* Top/left values mimic padding */
                    top: 6px;
                    left: 6px;
                    width: 45%;
                    padding-right: 10px;
                    white-space: nowrap;
                }

                .table td:nth-child(1) {
                    background: #ccc;
                    height: 100%;
                    top: 0;
                    left: 0;
                    font-weight: bold;
                }

                /*
                Label the data
                */
                td:nth-of-type(1):before {
                    content: "Id";
                }

                td:nth-of-type(2):before {
                    content: "Date";
                }

                td:nth-of-type(3):before {
                    content: "Year";
                }

                td:nth-of-type(4):before {
                    content: "Month";
                }

                td:nth-of-type(5):before {
                    content: "Country";
                }

                td:nth-of-type(6):before {
                    content: "Country Code";
                }

                td:nth-of-type(7):before {
                    content: "State or UT";
                }

                td:nth-of-type(8):before {
                    content: "State Code";
                }

                td:nth-of-type(9):before {
                    content: "District";
                }

                td:nth-of-type(10):before {
                    content: "District Code";
                }

                td:nth-of-type(11):before {
                    content: "Place";
                }

                td:nth-of-type(12):before {
                    content: "Latitude";
                }

                td:nth-of-type(13):before {
                    content: "Longitude";
                }

                td:nth-of-type(14):before {
                    content: "Source";
                }

                .dataTables_length {
                    display: none;
                }
            }
        </style>
    </head>

    <body>
        <div class="top-nav-bar">
            <header><div class="topic">
            <a class="pj-name"><img id="logo" src="Pictures/LOGO.png"> FloodIn-sites</a>
                <a href="index.html">Home</a>
                <a href="map.html">Map</a>
                <a href="plot.html">Plots</a>
                <a class="active">Data</a>
            </div></header>
        </div>
        <div class="main">
            <div class="tables">
                <table id="example" class="table table-striped table-hover" cellspacing="0" width="100%">
                    <thead>
                        <tr class="heading">
                            <th class="th-sm">ID</th>
                            <th class="th-sm">Date</th>
                            <th class="th-sm">Year</th>
                            <th class="th-sm">Month</th>
                            <th class="th-sm">Country</th>
                            <th class="th-sm">Country code</th>
                            <th class="th-sm">State or UT</th>
                            <th class="th-sm">State Code</th>
                            <th class="th-sm">District</th>
                            <th class="th-sm">District Code</th>
                            <th class="th-sm">Place</th>
                            <th class="th-sm">Latitude</th>
                            <th class="th-sm">Longitude</th>
                            <th class="th-sm">Source</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            while(($row = $result->fetch_assoc()))
                            {
                        ?>
                            <tr>
                                <td><?php echo $row["Id"];?></td>
                                <td><?php echo $row["Date"]?></td>
                                <td><?php echo $row["Year"];?></td>
                                <td><?php echo $row["Month"];?></td>
                                <td><?php echo $row["Country"];?></td>
                                <td><?php echo $row["Country_code"];?></td>
                                <td><?php echo $row["State_or_UT"];?></td>
                                <td><?php echo $row["State_Code"];?></td>
                                <td><?php echo $row["District"];?></td>
                                <td><?php echo $row["Dist_Code"];?></td>
                                <td><?php echo $row["Place"];?></td>
                                <td><?php echo $row["lat_new"];?></td>
                                <td><?php echo $row["lon_new"];?></td>
                                <td><?php echo $row["Source"];?></td>
                            </tr>
                        <?php
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
        <script src='https://code.jquery.com/jquery-3.7.0.js'></script>
        <script src='https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js'></script>
        <script src='https://cdn.datatables.net/responsive/2.1.0/js/dataTables.responsive.min.js'></script>
        <script src='https://cdn.datatables.net/1.13.5/js/dataTables.bootstrap5.min.js'></script>
    </body>

    <script>
        $(document).ready(function() {
            $('#example').DataTable({
                //disable sorting on last column
                "columnDefs": [
                    { "orderable": false, "targets": [1,4,5,7,9,10,13] }
                ],
                language: {
                    //customize pagination prev and next buttons: use arrows instead of words
                    'paginate': {
                    'previous': '<span class="fa fa-chevron-left"></span>',
                    'next': '<span class="fa fa-chevron-right"></span>'
                    },
                    //customize number of elements to be displayed
                    "lengthMenu": 'Display <select class="form-control input-sm">'+
                    '<option value="10">10</option>'+
                    '<option value="20">20</option>'+
                    '<option value="30">30</option>'+
                    '<option value="40">40</option>'+
                    '<option value="50">50</option>'+
                    '<option value="-1">All</option>'+
                    '</select> results'
                }
            })  
        } );
    </script>
</html>