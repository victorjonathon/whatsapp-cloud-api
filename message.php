<?php
$toPhone = "TO_PHONE_NUMBER";
$fileLink = "LINK_OF_FILE";
$fileName = "Sales Report";
$jsonData = '{
    "messaging_product": "whatsapp",
    "recipient_type": "individual",
    "to": "'.$toPhone.'",
    "type": "template",
    "template": {
        "name": "customer_statement",
        "language": {
            "code": "en_GB"
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