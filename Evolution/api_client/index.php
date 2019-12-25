
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
 
        <title></title>
    </head>
    <body>
 
        <h2>Monthly website statistics</h2>
        <form  action="" method="POST">
     
                <select name="month">
                    <option>Select Month</option>
                    <option value="january">January</option>
                    <option value="february">February</option>
                </select>
            </div>
            <button type="submit" name="submit">Submit</button>
        </form>
        <p>&nbsp;</p>
        <h3>
            <?php
            if (isset($_POST['submit']))
            {
                $name = $_POST['month'];
                $url = "http://localhost/GoogleAnalyticsAPI/Evolution?month=" . $name;
                $client = curl_init($url);
                curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
                $response = curl_exec($client);
                $result = json_decode($response);
                if (!empty($result))
                {
                    echo $result->error;
                    echo $result->message;
                    foreach ($result->data as $key => $value)
                    {
                        echo $key . ': ' . $value . '<br>';
                    }
                }
            }
            ?>
        </h3>
 
    </body>
</html>