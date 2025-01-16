<?php
// Bank management system

$accounts = [
    ["name" => "Charles", "balance" => 4342.53],
    ["name" => "Agnes", "balance" => 632.093],
    ["name" => "victor", "balance" => 1000.85],
    ["name" => "Ruth", "balance" => 6002.233],
    ["name" => "Bob", "balance" => 43.534]
];

$transactions = [
    ["from" => 2, "to" => 1, "amount" => 432],
    ["from" => 3, "to" => 2, "amount" => 50043.21], //will affect another (transfer from Ruth to Victor)
    ["from" => 3, "to" => 4, "amount" => 99.12],
    ["from" => 1, "to" => 3, "amount" => 250],
    ["from" => 2, "to" => 0, "amount" => 1000], //will affect another (transfer from Victor to Bob)
    ["from" => 4, "to" => 0, "amount" => 20],
    ["from" => 0, "to" => 1, "amount" => 10000.00]
];

// Old Account Details
echo "Old Account Details <br>";
echo "<pre>";
print_r($accounts);
echo "</pre>";


sort($transactions); // sort the transactions array

$failedTransections = []; //handles failed transactions
$accountNumbers = array_keys($accounts); // creates an array of accounts numbers using the keys


foreach ($transactions as $transaction) {
    $from = $transaction["from"];
    $to = $transaction["to"];
    $TransAmount = $transaction["amount"];

    $senderCheck = array_search($from, $accountNumbers);
    $receiverCheck = array_search($to, $accountNumbers);

    // var_dump($senderCheck) . "<br>";

    if ($senderCheck === false) {
        $failedTransections[] = ["From" => $from, "To" => $to, "Transaction Status" => "Failed", "Reason" => "invalid account details (Account not found)"];
    }

    if ($receiverCheck === false) {
        $failedTransections[] = ["From" => $from, "To" => $to, "Transaction Status" => "Failed", "Reason" => " invalid account details (Account not found)"];
    }

    if ($senderCheck !== false && $receiverCheck !== false) { //Checks if the vars are $senderCheck and $receiverCheck contain a values other than false so we can affect the 0th key also hence it is important to use the strict comparison operator (!==)
        $accountSender = &$accounts[$from];
        $accountReceiver = &$accounts[$to];
        if ($accountSender["balance"] - $TransAmount < 0) {
            $failedTransections[] = ["From" => $from, "To" => $to, "Transaction Status" => "Failed", "Reason" => "Insufficient Funds", "Amount" => $TransAmount];
            continue;
        } else {
            $balance = &$accountSender["balance"];
            $balance -= $TransAmount;
        }
        if (!isset($accountReceiver["balance"])) {
            $failedTransections[] = ["From" => $from, "To" => $to, "Transaction Status" => "Failed", "Reason" => "Unknown account", "Amount" => $TransAmount];
        } else {
            $balance = &$accountReceiver["balance"];
            $balance += $TransAmount;
        }
    }
}


// Updated Account Details
echo " <br> Updated Account Details <br>";
echo "<pre>";
print_r($accounts);
echo "</pre>";

// Failed Transations
echo " <br> Failed Transations <br>";
echo "<pre>";
print_r($failedTransections);
echo "</pre>";
