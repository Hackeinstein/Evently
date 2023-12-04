<?php

$json='{
    "status": true,
    "message": "Verification successful",
    "data": {
        "id": 3341089260,
        "domain": "test",
        "status": "success",
        "reference": "trf449905",
        "receipt_number": null,
        "amount": 10247,
        "message": null,
        "gateway_response": "Successful",
        "paid_at": "2023-12-04T00:00:28.000Z",
        "created_at": "2023-12-03T23:59:55.000Z",
        "channel": "card",
        "currency": "NGN",
        "ip_address": "129.205.124.225",
        "metadata": "",
        "log": {
            "start_time": 1701648022,
            "time_spent": 7,
            "attempts": 1,
            "errors": 0,
            "success": true,
            "mobile": false,
            "input": [],
            "history": [
                {
                    "type": "action",
                    "message": "Attempted to pay with card",
                    "time": 7
                },
                {
                    "type": "success",
                    "message": "Successfully paid with card",
                    "time": 7
                }
            ]
        },
        "fees": 154,
        "fees_split": null,
        "authorization": {
            "authorization_code": "AUTH_5ywv7wjhlw",
            "bin": "408408",
            "last4": "4081",
            "exp_month": "12",
            "exp_year": "2030",
            "channel": "card",
            "card_type": "visa ",
            "bank": "TEST BANK",
            "country_code": "NG",
            "brand": "visa",
            "reusable": true,
            "signature": "SIG_RmGADeGDLR9P96iPxWBY",
            "account_name": null
        },
        "customer": {
            "id": 144277883,
            "first_name": null,
            "last_name": null,
            "email": "hackeinsteinvictor@gmail.com",
            "customer_code": "CUS_rsliyvr5oj4sq23",
            "phone": null,
            "metadata": null,
            "risk_action": "default",
            "international_format_phone": null
        },
        "plan": null,
        "split": {},
        "order_id": null,
        "paidAt": "2023-12-04T00:00:28.000Z",
        "createdAt": "2023-12-03T23:59:55.000Z",
        "requested_amount": 10247,
        "pos_transaction_data": null,
        "source": null,
        "fees_breakdown": null,
        "transaction_date": "2023-12-03T23:59:55.000Z",
        "plan_object": {},
        "subaccount": {}
    }
}';

$res = json_decode($json, true);

echo $res["data"]['reference'] ;
echo $res["data"]['status'] ;

?>