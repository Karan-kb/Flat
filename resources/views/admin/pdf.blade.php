<html>
    <head>
        <title>Order PDF</title>
</head>
<body>


<h1>Rent Details</h1>


Customer Name:<h3>{{$rent->name}}</h3>
Customer Email:<h3>{{$rent->email}}</h3>
Customer Phone:<h3>{{$rent->phone}}</h3>
Customer Address:<h3>{{$rent->address}}</h3>
Customer ID:<h3>{{$rent->user_id}}</h3>
Flat Name:<h3>{{$rent->flat_title}}</h3>
Flat Rent:<h3>{{$rent->rent}}</h3>
Payment Status:<h3>{{$rent->payment_status}}</h3>
Flat ID:<h3>{{$rent->flat_id}}</h3>


<br><br>
<img height="250" width="450" src="flat/{{$rent->image}}">
</body>
    </html>