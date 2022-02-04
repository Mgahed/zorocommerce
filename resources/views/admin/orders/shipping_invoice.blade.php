<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Vendors Style-->
    <link rel="stylesheet" href="{{asset('admin-dashboard/css/vendors_css.css')}}">

    <!-- Style-->
    <link rel="stylesheet" href="{{asset('admin-dashboard/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('admin-dashboard/css/skin_color.css')}}">
    <title>Invoice</title>
</head>
<body>
<center>
    <button id="print1" class="btn btn-rounded btn-warning m-3" type="button"><span><i
                class="fa fa-print"></i> Print</span></button>
</center>
<section class="printableArea">
    <div class="container">
        <table width="100%" style="background: #F7F7F7; padding:0 20px 0 20px;">
            <tr>
                <td valign="top">
                <!-- {{-- <img src="" alt="" width="150"/> --}} -->
                    <h2 style="color: #157ED2; font-size: 26px;"><strong>Zurro Store</strong></h2>
                </td>
                <td style="float: right;">
                    @php
                        $social = \App\Models\SocialMedia::findOrFail(1);
                    @endphp
                    Zurro Head Office <br>
                    Email: {{$social->email}} <br>
                    Mob:  {{$social->number}}<br>
                    {{$social->address}}<br>
                </td>
            </tr>

        </table>
        <table width="100%" style="background:white; padding:2px;"></table>
        <table width="100%" style="background: #F7F7F7; padding:0 5px 0 5px;" class="font background">
            <tr>
                <td>
                    <p style="margin-left: 20px;">
                        <strong>Name:</strong> {{ $order->name }}<br>
                        <strong>Email:</strong> {{ $order->email }} <br>
                        <strong>Phone:</strong> {{ $order->phone }} <br>
                        @php
                            $div = $order->division->name_en;
                        @endphp

                        <strong>Address:</strong> {{ $div }}, {{ $order->district_id?$order->district->name_en.',':'' }} {{ $order->address }} <br>
                    </p>
                </td>
                <td style="float: right;">
                    <p>
                    <h3 style="white-space: nowrap;"><span
                            style="color: #157ED2;">Invoice:</span> {{ $order->invoice_number}}</h3>
                    <h4 style="white-space: nowrap;"><span style="color: #157ED2;">Order number:</span>
                        #{{ $order->order_number}}</h4>
                    Order Date: {{ $order->created_at->format('Y-m-d') }} <br>
                    {{--Delivery Date: {{ $order->delivered_date }} <br>--}}
                    Payment Type : {{ $order->payment_method }} </span>
                    </p>
                </td>
            </tr>
        </table>
        <br>
        <table width="100%" style=" padding:0 10px 0 10px;">
            <tr>
                <center>
                    {{--<h2><span style="color: #157ED2;">Subtotal:</span>{{ $order->amount }}{{'EGP'}}</h2>--}}
                    <h2><span style="color: #157ED2;">Total:</span> {{ $order->amount }}{{'EGP'}}</h2>
                    {{-- <h2><span style="color: #157ED2;">Full Payment PAID</h2> --}}
                </center>
            </tr>
        </table>
    </div>
</section>
<!-- Vendor JS -->
<script src="{{asset('admin-dashboard/js/vendors.min.js')}}"></script>
<script src="{{asset('assets/icons/feather-icons/feather.min.js')}}"></script>
<script src="{{asset('assets/vendor_plugins/JqueryPrintArea/demo/jquery.PrintArea.js')}}"></script>
<script src="{{asset('admin-dashboard/js/pages/invoice.js')}}"></script>

<!-- Sunny Admin App -->
<script src="{{asset('admin-dashboard/js/template.js')}}"></script>
</body>
</html>
