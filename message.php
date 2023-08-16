<?php
$toPhone = "TO_PHONE_NUMBER";
$fileLink = "LINK_OF_FILE"; //HTTP or HTTPS link to the file on your server
$fileName = "FILE_NAME"; //FILE name that you want to appear on whatsapp
$jsonData = '{
    "messaging_product": "whatsapp",
    "recipient_type": "individual",
    "to": "'.$toPhone.'",
    "type": "template",
    "template": {
        "name": "MESSAGE_TEMPLATE_NAME",
        "language": {
            "code": "MESSAGE_TEMPLATE_LANGUAGE CODE"
        },
		"components":[
			{
				"type": "header",
				"parameters":[
					{
						"type": "document",
						"document": {
							"link": "'.$fileLink.'",
							"filename": "'.$fileName.'"
						}
					}
				]
			}
		]
    }
}';

try{
$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, 'https://graph.facebook.com/v17.0/PHONE_NUMBER_ID/messages');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);

$headers = array();
$headers[] = 'Authorization: Bearer REPLACE_WITH_ACCESS_TOKEN';
$headers[] = 'Content-Type: application/json';
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

$result = curl_exec($ch);
if (curl_errno($ch)) {
    echo 'Error:' . curl_error($ch);
}
curl_close($ch);
}catch(Exception $e) {
  echo 'Message: ' .$e->getMessage();
}

die('Message delivered!!!');