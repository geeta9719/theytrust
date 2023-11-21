@php 
@endphp
@extends(false? 'layouts.home-master' : 'layouts.home')
@section('content') 

<style>
    .pricetable-box{
        width: 1160px
px
;
    background-color: #f5f8fd;
    border: 1px solid #ccc;
    /* margin-top: -194px; */
    padding: 40px 0;
    margin-bottom: 40px;
    box-shadow: 0 0 10px 0 rgb(0 0 0 / 20%);
    background-image: url(../images/form-bg.png);
}
.pricetable-box .table-striped tbody tr:nth-of-type(odd){
    background-color: rgb(245 248 253)!important;
}
.pricetable-box .table th {
    padding: 0.75rem;
    vertical-align: top;
    border-top: 1px solid #dee2e6;
    width: 25%;
}
.price-inner{
    background-color: #fff;
    border-radius: 22px;
    padding: 20px;
}
</style>
    <div class="container-fluid my-4 ">
        
        <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pricing Table</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container my-4 pricetable-box">
        <div class="price-inner">
        <h2 class="text-center mb-4">Pricing Table</h2>
        <table class="table table-responsive table-striped table-hover">
            <thead>
                <tr>
                    <th>Plan Details</th>
                    <th>Basic</th>
                    <th>Premium Local</th>
                    <th>Featured Regional</th>
          
                </tr>
                <tr>
                
            </thead>
            <tbody>
                <tr>
                    <td>Profile depth</td>
                    <td></td>
                    <td>500</td>
                    <td>Online Reservations on Yelp, Google Search, Apple Maps</td>
                </tr>
                <tr>
                <th>Badges & Widgets</th>
                    <th>...</th>
                    <th>....</th>
                    <th>....</th>
                </tr>
                <tr>
                <th>Market Insights</th>
                    <th>...</th>
                    <th>....</th>
                    <th>....</th>
                </tr>
                <tr>
                <th>Verified Profile</th>
                    <th>...</th>
                    <th>....</th>
                    <th>....</th>
                </tr>
                <tr>
                <th>Portfolio Display</th>
                    <th>...</th>
                    <th>....</th>
                    <th>....</th>
                </tr>
                <tr>
                <th>Video Testimonials</th>
                    <th>...</th>
                    <th>....</th>
                    <th>....</th>
                </tr>
                <tr>
                <th>Ranking Control</th>
                    <th>...</th>
                    <th>....</th>
                    <th>....</th>
                </tr>
                <tr>
                <th>Multiple Business Locations</th>
                    <th>...</th>
                    <th>....</th>
                    <th>....</th>
                </tr>
                <tr>
                <th>Analytics & Reports</th>
                    <th>...</th>
                    <th>....</th>
                    <th>....</th>
                </tr>
                <tr>
                <th>Priority Publishing of Review</th>
                    <th>...</th>
                    <th>....</th>
                    <th>....</th>
                </tr>

                <tr>
                <th>Priority Support</th>
                    <th>...</th>
                    <th>....</th>
                    <th>....</th>
                </tr>

                <tr>
                <th>Priority Phone Support / Dedicated Account Success Specialist</th>
                    <th>...</th>
                    <th>....</th>
                    <th>....</th>
                </tr>

                <tr>
                <th>Enhanced Regional Visibility</th>
                    <th>...</th>
                    <th>....</th>
                    <th>....</th>
                </tr>

            
                
                </tr>
             
            </tbody>
        </table>
        <h2>Basic - Free</h2>
    </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
       @endsection
@section('script')
@endsection
