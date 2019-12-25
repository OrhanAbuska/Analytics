<?php
// 1. Create a Json decloration
header("Content-Type:application/json");
if (!empty($_GET['month']))
{
    $numberOfMonth = $_GET['month'];
    $monthData = get_month($numberOfMonth);
    if (empty($monthData))
    {
        response(TRUE, "Information is not available", NULL);
    } else
    {
        response(FALSE, "", $monthData);
    }
} else
{
    response(400, "Invalid Request", NULL);
}
function response($status, $status_message, $data)
{
    header("HTTP/1.1 " . $status);
    $response['error'] = $status;
    $response['message'] = $status_message;
    $response['data'] = $data;
    $json_response = json_encode($response);
    echo $json_response;
}
function get_month($numberOfMonth)
{
    $monthlyStats = [
        "january" => ['Google Analytics' => 50, 'Positive Guys' => 500],
        "february" => ['Google Analytics' => 150, 'Positive Guys' => 5000],
    ];

    foreach ($monthlyStats as $mKey => $curentMonth)
    {
        if ($mKey == $numberOfMonth)
        {
            return $curentMonth;
            break;
        }
    }
}
?>
