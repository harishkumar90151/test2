<!DOCTYPE html>

<html dir="***" id="******">

<head>

    <?php include_once "title.php"; ?>

    <!--Map Script Starts Here-->

        <script type="text/javascript" src="https://www.google.com/jsapi"></script>

        <script type="text/javascript">

            google.load("visualization", "1", {packages:["map"]});

            google.setOnLoadCallback(drawChart);

            function drawChart() {

                var data = google.visualization.arrayToDataTable([

                    ['Lat', 'Long', 'Name'],

                    <?php

                        $query = "SELECT DISTINCT * FROM information ORDER BY id DESC ";        

                        $result = $dbConnection->prepare($query);

                        $result->execute();                                     

                        if($result->rowCount() >0)

                        {

                            $num = $result->rowCount();

                            while($row = $result->fetch())

                            {

                                $mobile = $row['mobile'];

                                $latitude = $row['latitude'];

                                $longitude = $row['longitude'];



                                $query1 = "SELECT * FROM information WHERE mobile=? ORDER BY id DESC";      

                                $result1 = $dbConnection->prepare($query1);

                                $result1->execute(array($mobile));      

                                $row1 = $result1->fetch();

                                $cname = $row1['name'];



                                echo "[$latitude, $longitude, '$cname'],";  

                            }

                        }

                    ?>

                ]);

                var map = new google.visualization.Map(document.getElementById('map_div'));

                map.draw(data, {showTip: true, enableScrollWheel: true, useMapTypeControl: true});

            }

        </script>

    <!--Map Script Ends Here-->

</head>