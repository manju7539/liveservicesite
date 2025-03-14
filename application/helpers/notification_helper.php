<?php
function send_push_notification($deviceToken, $title, $body)
{
    $url = 'https://fcm.googleapis.com/fcm/send';

    $fields = array(
        'to' => $deviceToken,
        'sound' => 'true',
        'vibrate' => 'true',
        'notification' => array(
            'title' => $title,
            'body' => $body
        )
    );

    $fields = json_encode($fields);

    $headers = array(
        'Authorization: key=' . "AAAAqyrCjLU:APA91bHoRzZbIPULso_nr5lqOWVjoL0VJ6arMi2x7RPZLtN75wb0FsPY0IPq4tNOt7WkN7m4w_JKvzNAn1ewfNQTZRHvFcGBna3t8KUxqb72Nsy5LNLO27Bqvs5UZYiwxvI4m3i645V8",
        'Content-Type: application/json'
    );

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
    curl_setopt($ch, CURLOPT_TIMEOUT, 1); // timeout in seconds
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, false);

    $result = curl_exec($ch);
    curl_close($ch);

    return $result;
}
// notification for staff apk
function send_push_notification_for_staff($deviceToken, $title, $body)
{
    $url = 'https://fcm.googleapis.com/fcm/send';

    $fields = array(
        'to' => $deviceToken,
        'sound' => 'true',
        'vibrate' => 'true',
        'notification' => array(
            'title' => $title,
            'body' => $body
        )
    );

    $fields = json_encode($fields);

    $headers = array(
        'Authorization: key=' . "AAAA4xgzwIs:APA91bEJBRzOiQqQnAzVfe48wbrR_zWn8BI5eme4hPymOwS3pvN_wfh8eoc-nGbINpQaFdwMK5Iwhd8zJiFxh-u3YYzNH3EwwOVjrBmcaTlJFzL_VCDsPU2B6ppbXKKad9QUA1fK42vH",
        'Content-Type: application/json'
    );

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
    curl_setopt($ch, CURLOPT_TIMEOUT, 1); // timeout in seconds
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, false);

    $result = curl_exec($ch);
    curl_close($ch);

    return $result;
}

