<?php
use \PhpPot\Service\StripePayment;

require_once "config.php";

if (!empty($_POST["token"])) {
    require_once 'StripePayment.php';
    $stripePayment = new StripePayment();
    
    $stripeResponse = $stripePayment->chargeAmountFromCard($_POST);
    
    require_once "DBController.php";
    $dbController = new DBController();
    
    $amount = $stripeResponse["amount"] /100;
    $name = $_POST['name'];
    $email = $_POST['email'];
    $card_number = $_POST['card-number'];
    $item_number = $_POST['item_number'];
    $sub_expiry_date = $_POST['sub_expiry_date'];
    $currency = $stripeResponse["currency"];
    $balance_transaction = $stripeResponse["balance_transaction"];;
    $status = $stripeResponse["status"];

    // $param_type = 'sssssss';
    // $param_value_array = array(
    //     $_POST['email'],
    //     $_POST['item_number'],
    //     $amount,
    //     $stripeResponse["currency"],
    //     $stripeResponse["balance_transaction"],
    //     $stripeResponse["status"],
    //     json_encode($stripeResponse)
    // );
    // $query = "INSERT INTO tbl_payment (email, item_number, amount, currency_code, txn_id, payment_status, payment_response) values (?, ?, ?, ?, ?, ?, ?)";
    // $id = $dbController->insert($query, $param_type, $param_value_array);
    // foreach ($param_value_array as $value) {
    //   echo $value;
    // }

    if ($stripeResponse['amount_refunded'] == 0 && empty($stripeResponse['failure_code']) && $stripeResponse['paid'] == 1 && $stripeResponse['captured'] == 1 && $stripeResponse['status'] == 'succeeded') {
        $successMessage = "Stripe payment is completed successfully. The TXN ID is " . $stripeResponse["balance_transaction"];
    }
}
?>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1, shrink-to-fit=no" name="viewport">
    <link href="style.css" rel="stylesheet" type="text/css"/ >
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js" integrity="sha512-qTXRIMyZIFb8iQcfjXWCO8+M5Tbc38Qi5WzdPOYZHIlZpzBHG3L3by84BBBOiRGiEb7KKtAOAs5qYdUiZiQNNQ==" crossorigin="anonymous"></script>
</head>
<body>
    <?php if(!empty($successMessage)) { ?>
    <div id="success-message"><?php echo $successMessage; ?></div>
    <p id="demo"></p>
    <form name="count">
        <input type="text" size="69" name="count2">
    </form>
    <?php  } ?>
    <div id="error-message"></div>
                
            <form id="frmStripePayment" action=""
                method="post">
                <div class="field-row">
                    <label>Card Holder Name</label> <span
                        id="card-holder-name-info" class="info"></span><br>
                    <input type="text" id="name" name="name"
                        class="demoInputBox">
                </div>
                <div class="field-row">
                    <label>Email</label> <span id="email-info"
                        class="info"></span><br> <input type="text"
                        id="email" name="email" class="demoInputBox">
                </div>
                <div class="field-row">
                    <label>Card Number</label> <span
                        id="card-number-info" class="info"></span><br> <input
                        type="text" id="card-number" name="card-number"
                        class="demoInputBox">
                </div>
                <div class="field-row">
                    <div class="contact-row column-right">
                        <label>Expiry Month / Year</label> <span
                            id="userEmail-info" class="info"></span><br>
                        <select name="month" id="month"
                            class="demoSelectBox">
                            <option value="01">01</option>
                            <option value="02">02</option>
                            <option value="03">03</option>
                            <option value="04">04</option>
                            <option value="05">05</option>
                            <option value="06">06</option>
                            <option value="07">07</option>
                            <option value="08">08</option>
                            <option value="09">09</option>
                            <option value="10">10</option>
                            <option value="11">11</option>
                            <option value="12">12</option>
                        </select> <select name="year" id="year"
                            class="demoSelectBox">
                            <option value="18">2018</option>
                            <option value="19">2019</option>
                            <option value="20">2020</option>
                            <option value="21">2021</option>
                            <option value="22">2022</option>
                            <option value="23">2023</option>
                            <option value="24">2024</option>
                            <option value="25">2025</option>
                            <option value="26">2026</option>
                            <option value="27">2027</option>
                            <option value="28">2028</option>
                            <option value="29">2029</option>
                            <option value="30">2030</option>
                        </select>
                    </div>
                    <div class="contact-row cvv-box">
                        <label>CVC</label> <span id="cvv-info"
                            class="info"></span><br> <input type="text"
                            name="cvc" id="cvc"
                            class="demoInputBox cvv-input">
                    </div>
                </div>
                <div>
                    <input type="submit" name="pay_now" value="Submit"
                        id="submit-btn" class="btnAction"
                        onClick="stripePay(event);">

                    <div id="loader">
                        <img alt="loader" src="LoaderIcon.gif">
                    </div>
                </div>
                <input type='hidden' name='amount' value='5000'> <input
                    type='hidden' name='currency_code' value='USD'> <input
                    type='hidden' name='item_name' value='Test Product'>
                <input type='hidden' name='item_number'
                    value='PHPPOTEG#1'>
            </form>

      <div class="test-data">
        <h3>Test Card Information</h3>
        <p>Use this 4242424242424242 with CVV (123) with any dummy details to test.</p>
        <table class="tutorial-table" cellspacing="0" cellpadding="0" width="100%">
            <tr>
                <th>CARD NUMBER</th>
                <th>BRAND</th>
            </tr>
            <tr>
                <p><td>CARD HOLDER:</td></p>
                <td><?= ucwords($name); ?></td>
            </tr>
            <tr>
                <p><td>CARD NUMBER:</td></p>
                <td><?= $card_number; ?></td>
            </tr>
            <tr>
                <p><td>TRANSACTION ID:</td></p>
                <td><?= $balance_transaction; ?></td>
            </tr>
            <tr>
                <p><td>AMOUNT:</td></p>
                <td>$<?= number_format($amount); ?></td>
            </tr>
            <tr>
                <p><td>CURRENCY:</td></p>
                <td><?= strtoupper($currency); ?></td>
            </tr>
            <tr>
                <p><td>PAYMENT STATUS:</td></p>
                <td><?= ucfirst($status); ?></td>
            </tr>
            <tr>
                <p><td>SUB EXPIRY DATE:</td></p>
                <td><?= $sub_expiry_date; ?></td>
            </tr>
        </table>
    </div>
    <script type="text/javascript" src="https://js.stripe.com/v2/"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script>
function cardValidation () {
    var valid = true;
    var name = $('#name').val();
    var email = $('#email').val();
    var cardNumber = $('#card-number').val();
    var sub_expiry_date = $('#sub-expiry').val();
    var month = $('#month').val();
    var year = $('#year').val();
    var cvc = $('#cvc').val();

    $("#error-message").html("").hide();

    if (name.trim() == "") {
        valid = false;
    }
    if (email.trim() == "") {
    	   valid = false;
    }
    if (cardNumber.trim() == "") {
    	   valid = false;
    }

    if (month.trim() == "") {
    	    valid = false;
    }

    if (sub_expiry_date.trim() == "") {
            valid = false;
    }

    if (year.trim() == "") {
        valid = false;
    }
    if (cvc.trim() == "") {
        valid = false;
    }

    if(valid == false) {
        $("#error-message").html("All Fields are required").show();
    }

    return valid;
}
//set your publishable key
Stripe.setPublishableKey("<?php echo STRIPE_PUBLISHABLE_KEY; ?>");

//callback to handle the response from stripe
function stripeResponseHandler(status, response) {
    if (response.error) {
        //enable the submit button
        $("#submit-btn").show();
        $( "#loader" ).css("display", "none");
        //display the errors on the form
        $("#error-message").html(response.error.message).show();
    } else {
        //get token id
        var token = response['id'];
        //insert the token into the form
        $("#frmStripePayment").append("<input type='hidden' name='token' value='" + token + "' />");
        //submit form to the server
        $("#frmStripePayment").submit();
    }
}
function stripePay(e) {
    e.preventDefault();
    var valid = cardValidation();

    if(valid == true) {
        $("#submit-btn").hide();
        $( "#loader" ).css("display", "inline-block");
        Stripe.createToken({
            number: $('#card-number').val(),
            cvc: $('#cvc').val(),
            exp_month: $('#month').val(),
            exp_year: $('#year').val()
        }, stripeResponseHandler);

        //submit from callback
        return false;
    }
}
// moment().add(1, 'months').calendar();


// var startDate = new Date();
// var endDateMoment = moment(startDate); // moment(...) can also be used to parse dates in string format
// endDateMoment.add(1, 'months');

// Set the date we're counting down to
// var today = new Date(<?= $sub_expiry_date; ?>).getTime();
// var today2 = '27 Jan 2021';

// Add 2 months to 31 Dec 2016 -> 28 Feb 2017
var countDownDate = moment().add(1, 'months').calendar();

// Update the count down every 1 second
// var x = setInterval(function() {

//   // Get today's date and time
//   var now = new Date().getTime();
    
//   // Find the distance between now and the count down date
//   var distance = countDownDate - now;
    
//   // Time calculations for days, hours, minutes and seconds
//   var days = Math.floor(distance / (1000 * 60 * 60 * 24));
//   var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
//   var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
//   var seconds = Math.floor((distance % (1000 * 60)) / 1000);
    
//   // Output the result in an element with id="demo"
//   document.getElementById("demo").innerHTML = days + "d " + hours + "h "
//   + minutes + "m " + seconds + "s ";
    
//   // If the count down is over, write some text 
//   if (distance < 0) {
//     clearInterval(x);
//     document.getElementById("demo").innerHTML = "EXPIRED";
//   }
// }, 1000);


//change the text below to reflect your own,
var before="Subscription ends!"
var current="Your Subscription hs ended, please kindly subscribe to enjoy all our features."
var montharray=new Array("Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec")

function countdown(yr,m,d){
theyear=yr;themonth=m;theday=d
var today=new Date()
var todayy=today.getYear()
if (todayy < 1000)
todayy+=1900
var todaym=today.getMonth()
var todayd=today.getDate()
var todayh=today.getHours()
var todaymin=today.getMinutes()
var todaysec=today.getSeconds()
var todaystring=montharray[todaym]+" "+todayd+", "+todayy+" "+todayh+":"+todaymin+":"+todaysec
futurestring=montharray[m-1]+" "+d+", "+yr
dd=Date.parse(futurestring)-Date.parse(todaystring)
dday=Math.floor(dd/(60*60*1000*24)*1)
dhour=Math.floor((dd%(60*60*1000*24))/(60*60*1000)*1)
dmin=Math.floor(((dd%(60*60*1000*24))%(60*60*1000))/(60*1000)*1)
dsec=Math.floor((((dd%(60*60*1000*24))%(60*60*1000))%(60*1000))/1000*1)
if(dday==0&&dhour==0&&dmin==0&&dsec==1){
document.forms.count.count2.value=current
return
}
else
document.forms.count.count2.value="Only "+dday+ " days, "+dhour+" hours, "+dmin+" minutes, and "+dsec+" seconds left until "+before
setTimeout("countdown(theyear,themonth,theday)",1000)
}
//enter the count down date using the format year/month/day
countdown(countDownDate);

</script>
</body>
</html>