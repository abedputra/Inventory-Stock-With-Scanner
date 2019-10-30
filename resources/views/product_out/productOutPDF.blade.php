<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Invoice</title>
    <style>
        .invoice-box {
            max-width: 800px;
            margin: auto;
            padding: 30px;
            border: 1px solid #eee;
            box-shadow: 0 0 10px rgba(0, 0, 0, .15);
            font-size: 16px;
            line-height: 24px;
            font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
            color: #555;
        }
        
        .invoice-box table {
            width: 100%;
            /*line-height: inherit;*/
            text-align: left;
        }
        
        .invoice-box table td {
            padding: 5px;
            vertical-align: top;
        }
        
        .invoice-box table tr td:nth-child(5) {
            text-align: right;
        }
        
        .invoice-box table tr.top table td {
            padding-bottom: 20px;
        }
        
        .invoice-box table tr.top table td.title {
            font-size: 45px;
            line-height: 45px;
            color: #333;
        }
        
        .invoice-box table tr.information table td {
            padding-bottom: 40px;
        }
        
        .invoice-box table tr.heading td {
            background: #eee;
            border-bottom: 1px solid #ddd;
            font-weight: bold;
        }
        
        .invoice-box table tr.details td {
            padding-bottom: 20px;
        }
        
        .invoice-box table tr.item td{
            border-bottom: 1px solid #eee;
        }
        
        .invoice-box table tr.item.last td {
            border-bottom: none;
        }
        
        .invoice-box table tr.total td:nth-child(5) {
            border-top: 2px solid #eee;
            font-weight: bold;
        }
        
        @media only screen and (max-width: 600px) {
            .invoice-box table tr.top table td {
                width: 100%;
                display: block;
                text-align: center;
            }
            
            .invoice-box table tr.information table td {
                width: 100%;
                display: block;
                text-align: center;
            }
        }
        
        /** RTL **/
        .rtl {
            direction: rtl;
            font-family: Tahoma, 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
        }
        
        .rtl table {
            text-align: right;
        }
        
        .rtl table tr td:nth-child(5) {
            text-align: left;
        }
    </style>
</head>
<body>
<div class="invoice-box">
    <table cellpadding="0" cellspacing="0">
            <tr class="top">
                <td colspan="5">
                    <table>
                        <tr>
                            <td class="title">
                                <img src="{{ asset('upload/logo/'.$companyInfo->logo) }}" style="width:100%; width:200px;">
                            </td>

                            <td></td>
                            <td></td>
                            <td></td>
                            
                            <td>
                                Purchase Order #: {{rand(1000,10000)}}<br>
                                Created: {{date("Y-m-d",time())}}<br>
                                Due: February 1, 2015
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            
            <tr class="information">
                <td colspan="5">
                    <table>
                        <tr>
                            <td>
                                {{ $companyInfo->name }}<br>
                                {{ $companyInfo->address }}<br>
                                {{ $companyInfo->email }}
                            </td>

                            <td></td>
                            <td></td>
                            <td></td>
                            
                            <td>
                                {{$Product_Out[0]->customer->name}}<br>
                                {{$Product_Out[0]->customer->address}}<br>
                                {{$Product_Out[0]->customer->email}}
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>

       
            <tr class="heading">
                <td>Name</td>
                <td>Barcode</td>
                <td>Price</td>
                <td>Quantity</td>
                <td>Total</td>
            </tr>

            @php 
            $total = count($Product_Out); 
            $i=1;
            $allTotal = 0;
            @endphp

            @foreach($Product_Out as $productData)
            @php 
            $i++;
            
            if($i == $total){
                $tr = '';
            }else{
                $tr = 'last';
            }
            @endphp

            <tr class="item {{$tr}}">
                <td>{{ $productData->product->name }}</td>
                <td>{{ $productData->product->barcode->name }}</td>
                <td>{{ $productData->product->price }}</td>
                <td>{{ $productData->qty }}</td>
                <td>{{ number_format($productData->product->price * $productData->qty) }}</td>
            </tr>

            @php 
            $allTotal += $productData->product->price * $productData->qty; 
            @endphp
            @endforeach
        
            <tr class="total">
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td>
                   Total: {{number_format($allTotal)}}
                </td>
            </tr>
        </table>
    </div>
</body>
</html>