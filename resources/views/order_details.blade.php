<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Order Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  </head>
  <body>
      <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                Order Details
            </div>
            <div class="card-body">
                    <div class="form-group row">
                        <div class="col-lg-10">
                            <p><strong>Order Id</strong> : {{$razorpayOrder->id}}</p>
                            <p><strong>Amount</strong> : {{ number_format($razorpayOrder->amount / 100,2)}}</p>
                        </div>
                    </div>
                    <div class="form-group text-center mt-3">
                      <button class="btn btn-primary" id="rzp-button1">Pay Now</button>
                    </div>
            </div>
        </div>

    </div>
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <script>
    var url = "{{ route('pay') }}"
    var options = {
        "key": "{{config('razorpay.key')}}", // Enter the Key ID generated from the Dashboard
        "amount": "{{$razorpayOrder->amount}}", // Amount is in currency subunits. Default currency is INR. Hence, 50000 refers to 50000 paise
        "currency": "INR",
        "name": "Test", //your business name
        "description": "Test Transaction",
        "image": "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQlh8k6fimmwzSXs3owBvqRY76KWwZkNNn72uJibxw65fj70RSKtki7vXzGj0rkdmq5T6s&usqp=CAU",
        "order_id": "{{$razorpayOrder->id}}", //This is a sample Order ID. Pass the `id` obtained in the response of Step 1
        "handler":function (response){
            var paymentId = response.razorpay_payment_id;
            var razorpayOrderId = response.razorpay_order_id;
            var redirectTo = url + '?payment_id=' + paymentId + '&razorpay_order_id=' + razorpayOrderId;
            window.location.href = redirectTo;
        },
        "callback_url": "https://eneqd3r9zrjok.x.pipedream.net/",
        "prefill": { //We recommend using the prefill parameter to auto-fill customer's contact information especially their phone number
            "name": "Gaurav Kumar", //your customer's name
            "email": "gaurav.kumar@example.com",
            "contact": "6238951606" //Provide the customer's phone number for better conversion rates 
        },
        "notes": {
            "address": "Razorpay Corporate Office"
        },
        "theme": {
            "color": "#3399cc"
        }
    };
    var rzp1 = new Razorpay(options);
    document.getElementById('rzp-button1').onclick = function(e){
        rzp1.open();
        e.preventDefault();
    }
    </script>
  </body>
</html>