@php use App\Models\Moadian\Product;use App\Models\Moadian\Unit; @endphp
    <!DOCTYPE html>

<html>
<head>
    <link href="/Content/css/Factor.css" rel="stylesheet"/>
    <script type="text/javascript" src="/Content/Scripts/jquery.min.js"></script>
    <title id="pagetitle">پرینت صورتحساب فروش کتاب</title>

    <meta name="twitter:image"/>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <link href="/Content/Images/favicon.png"/>
    <link rel="icon" href="/Content/Images/favicon.png"/>
    <link rel="shortcut icon" href="/Content/Images/favicon.png"/>
    <link rel="apple-touch-icon" href="/Content/Images/favicon.png"/>
    <meta name="theme-color" content="#346566"/>
    <meta name="msapplication-navbutton-color" content="#346566"/>
    <meta name="apple-mobile-web-app-status-bar-style" content="#346566"/>


    <style>
        .tblcover {
            background: url(../../content/files/sign/);
            background-repeat: no-repeat;
            background-position: left;
            background-size: cover
        }

        .tblcover.hide-bg {
            background-image: none;
        }

        .hader-table {
            text-align: center;
            vertical-align: middle;
            border-top: 1.0pt solid windowtext;
        }

        body {
            direction: rtl;
            font-family: "Vazir", tahoma;
            color: windowtext;
            font-style: normal;
            text-decoration: none;
            font-size: 9.0pt;
            font-weight: 800;
        }

        .titer-table {
            text-align: center;
            vertical-align: middle;
            border-top: .5pt solid windowtext;
            border-left: .5pt solid windowtext;
            border-bottom: .5pt solid windowtext;
            border-right: .5pt solid windowtext;
            background: #F2F2F2;
            background-color: rgb(242, 242, 242);
            background-position-x: 0%;
            background-position-y: 0%;
            background-repeat: repeat;
            background-attachment: scroll;
            background-image: none;
            background-size: auto;
            background-origin: padding-box;
            background-clip: border-box;
        }

        .info {
            text-align: right;
            vertical-align: middle;
            border-top: .5pt solid windowtext;
            border-left: .5pt solid windowtext;
            border-bottom: .5pt solid windowtext;
            border-right: .5pt solid windowtext;
            padding-right: 10px;
        }

        .titer-product {
            text-align: center;
            vertical-align: middle;
            border-top: .5pt solid windowtext;
            border-left: .5pt solid windowtext;
            border-bottom: .5pt solid windowtext;
            border-right: .5pt solid windowtext;
            word-wrap: break-word;
        }

        .product-table {
            text-align: center;
            vertical-align: middle;
            border-top: .5pt solid windowtext;
            border-left: .5pt solid windowtext;
            border-bottom: .5pt solid windowtext;
            border-right: .5pt solid windowtext;
        }

        .product-table {
            text-align: center;
            vertical-align: middle;
            border-top: .5pt solid windowtext;
            border-left: .5pt solid windowtext;
            border-bottom: .5pt solid windowtext;
            border-right: .5pt solid windowtext;
        }

        .footer-table {
            position: relative;
            z-index: 1;
            text-align: right;
            vertical-align: top;
            border-top: .5pt solid windowtext;
            border-left: .5pt solid windowtext;
            border-bottom: .5pt solid windowtext;
            border-right: .5pt solid windowtext;
            padding-right: 10px;
            padding-top: 6px;
        }
    </style>
    <link href="{{ asset('dash-assets/css/font.dash.css') }}" rel="stylesheet" type="text/css" />

</head>
<body oncontextmenu="return false">


<div id="main-container" align=center style=" margin-top:10px;">
    <input id="GuidCode" type="hidden" name="GuidCode" value="43a49a27-1b7d-4b5e-a6df-1f3116e35600"/>
    <table class="tblcover" border=0 cellpadding=0 cellspacing=0 style='border-collapse: collapse; width: auto;  '>

        <tr>
            <td colspan="3" height=38 class=hader-table
                style='border-right: .5pt solid windowtext; padding-right: 10px; text-align: right'>شماره سفارش: <span
                    id="modeltaxid">{{$order->id}}</span>

                    </td>
            <td colspan="3" style="border-top: .5pt solid windowtext;"></td>

                <td rowspan="2" colspan="15" class="hader-table" style="padding-left:160px;font-size:20px">فاکتور فروش
                    کالا
                </td>
            <td colspan="2" class="info" width="29" style='border:none;border-top:.5pt solid windowtext;'>شماره فاکتور:

                1231233

            </td>
            <td rowspan="2" colspan="3" class=titer-product width=83
                style='border: none; border-top: .5pt solid windowtext; border-left: .5pt solid windowtext;'>

                    <img src="{{ asset('/images/logo.png') }}"style="max-width: 80px; height: auto;">
            </td>
        </tr>
        <tr>
            <td colspan="4"
                style='border-right: .5pt solid windowtext; padding-right: 10px; padding-bottom: 5px; text-align: right'>
                تاریخ ارسال: <span id="modelissuedate">
                            <span>{{toPersianDate($order->created_at)}}</span>
                    </span>
            </td>
            <td colspan="3"></td>
            <td colspan="2" class=info style='border: none;padding-bottom:5px;'>تاریخ
                صدور: {{toPersianDate($order->created_at)}}</td>
            <td colspan="2" class=titer-product
                style='border: none; border-left: .5pt solid windowtext; padding-bottom: 5px; '></td>
        </tr>


        <tr height=30>
            <td colspan=25 class=titer-table>
                مشخصات فروشنده
            </td>

        </tr>
        <tr height=27>
            <td colspan=10 class=info>
                نام فروشنده: انتشارات دانشگاه شهید مدنی آذربایجان
            </td>
            <td colspan=10 class=info>
                شناسه ملی: ۱۴۰۰۳۴۵۷۳۸۲
            </td>

            <td colspan=5 class=info>
                کد اقتصادی: ۱۴۰۰۳۴۵۷۳۸۲
            </td>

        </tr>
        <tr height=27>
            <td colspan=3 class=info>
                استان:آذربایجان شرقی
            </td>
            <td colspan=4 class=info>
                شهرستان:تبریز
            </td>
            <td colspan=14 class=info>
                تلفن: ۰۴۱۳۴۳۲۷۵۰۰
            </td>
            <td colspan=4 class=info>
                کدپستی: ۵۳۷۵۱۷۱۳۷۹
            </td>

        </tr>
        <tr height=27>
            <td colspan=25 class=info>
                نشانی: آذربایجان شرقی-کیلومتر۳۵ جاده تبریز به مراغه
            </td>

        </tr>

        <tr height=32>
            <td colspan=25 class=titer-table>
                مشخصات خریدار
            </td>

        </tr>
        <tr height=27>
            <td colspan=13 class=info>

                نام شخص حقیقی/حقوقی: <span id="customername">{{optional($order->user)->name}}</span>
            </td>

{{--            <td colspan=3 class=info>--}}
{{--                استان: {{($order->receiver_state)}}--}}
{{--            </td>--}}
{{--            <td colspan=4 class=info>--}}
{{--                شهرستان: {{($order->receiver_city)}}--}}
{{--            </td>--}}
            <td colspan=12 class=info>
                تلفن: {{optional($order->user)->phone}}
            </td>

        </tr>

        @if($order->delivery_type == 'in_post')
        <tr height=27>
            <td colspan=21 class=info>
                نشانی: {{($order->receiver_address)}}
            </td>
            <td colspan=4 class=info>
                کدپستی: {{($order->receiver_postal_code)}}
            </td>

        </tr>
        @else
            <tr height=27>
                <td colspan=25 class=info>
                    نشانی: تحویل حضوری در محل فروشنده
                </td>
            </tr>
        @endif

        <tr>
            <td colspan=25 height=27 class=titer-table>
                مشخصات كالا
            </td>
        </tr>
        <tr>
            <td height=69 width="5%" class=titer-product> ردیف</td>
            <td colspan=4 class="titer-product" style="width:250px"> کتاب</td>
            <td colspan=2 class="titer-product" style="width:40px">واحد</td>
            <td colspan=6 class="titer-product" style="width:40px">تعداد/مقدار</td>
            <td colspan=4 class="titer-product" style="width:120px">مبلغ واحد (ریال)</td>

            <td colspan=4 class="titer-product" style="width:150px"> مالیات بر ارزش افزوده (ریال)</td>
            <td colspan=4 class="titer-product" style="width:150px">مبلغ کل (ریال)</td>
        </tr>

        @php($i = 0)
        @foreach($order->books()->get() as $book)
            <tr>
                <td height=29 class="product-table">{{++$i}}</td>
                <td colspan=4 class="product-table text-right">
                    {{$book->title}}
                </td>
                <td colspan=2 class="product-table">
                   عدد
                </td>
                <td colspan=6 class="product-table">
                    {{$book->pivot->quantity}}
                </td>

                <td colspan=4 class="product-table">{{number_format($book->price)}}</td>


                <td colspan=4 class="product-table"> 0 </td>
                <td colspan=4 class="product-table">{{number_format(($book->pivot->quantity) * ($book->price))}}</td>

            </tr>
        @endforeach
        <tr>
            <td colspan=5 height=34 class="product-table">
{{--                @if($order->discount_code_id != null)--}}
{{--                    @php()--}}
{{--                @endif--}}

                درصد کد تخفیف:
                @if($order->discount_code_id != null)
                    {{\App\Models\DiscountCode::where('id','=',$order->discount_code_id)->get()->first()->percent}}
                @else
                ندارد.
                @endif

            </td>
            <td colspan=5 height=34 class="product-table">

                 مالیات بر ارزش افزوده: 0 ریال
            </td>


        @if($order->delivery_type == 'in_post')
                <td colspan=8 height=34 class="product-table">

                    هزینه ارسال: {{number_format(\App\Models\Setting::latest()->first()->post_price ?? 0)}} ریال
                </td>
        @else
                <td colspan=8 height=34 class="product-table">

                    هزینه ارسال: 0 ریال
                </td>
        @endif

            <td colspan=7 height=34 class="product-table"  style="font-size:14px">

                مجموع صورتحساب: {{number_format($order->price)}} ریال
            </td>
{{--            <td colspan=5 class="product-table">0</td>--}}
{{--            <td colspan=4 class="product-table">60,000,000</td>--}}
{{--            <td colspan=2 class="product-table">5,400,000</td>--}}
        </tr>

        <tr height="100">
            <td colspan="12" class="footer-table" style="padding-top: 10px; vertical-align: top; border-left: 0px;">
                <strong>مهر و امضاء فروشنده:</strong>
            </td>
            <td colspan="1" class="footer-table" style="padding-top: 10px; vertical-align: top; border-right: 0px;">
                <div style="display: flex; align-items: center; gap: 10px;">
                </div>
            </td>

            <td colspan="12" class="footer-table" style="padding-top: 10px; vertical-align: top;">
                <div style="display: flex; align-items: center; gap: 10px;">
                    <strong>مهر و امضاء خریدار:</strong>

                </div>
            </td>
        </tr>

    </table>

</div>


<script type="text/javascript">
    $('#UserSendFactor').click(function () {

        $('#UserSendFactor').hide();
        $('#UserEditFactor').hide();
        $('#trpre').hide();

        let timerFormat = (s) => {
            return (s - (s %= 60)) / 60 + (9 < s ? ":" : ":0") + s;
        };

        let counter;
        let startTime = 120;

        timer = () => {
            startTime--;
            document.getElementById("countdown").innerHTML = "لطفا صبر نمایید " + timerFormat(startTime);
            if (startTime === 0) {
                clearInterval(counter);
                document.getElementById("TaxResult").innerHTML = "مجدد تلاش نمایید";
            }

        };
        counter = counter || setInterval(timer, 1000);

        var GuidCode = $("#GuidCode").val();
        var customername = $("#customername").val();

        $.ajax({
            type: 'POST',
            url: '/Invoice/SendTaxAsync',
            dataType: 'json',
            data: {id: GuidCode, internalno: false},
            success: function (data) {
                $('#countdown').hide();


                switch (data.Status) {
                    case 1:
                        document.getElementById("TaxResult").innerHTML = "صورتحساب ارسال شد";
                        document.getElementById("modeltaxid").innerHTML = data.ModelTaxId;
                        document.title = customername + " " + data.ModelTaxId;
                        document.getElementById("modelissuedate").innerHTML = data.IssueDate;
                        break;

                    case 4:
                        document.getElementById("TaxResult").innerHTML = "PENDING";
                        document.getElementById("PrintRefresh").innerHTML = "از دکمه استعلام لیست صورتحساب تلاش کنید";
                        document.title = customername;
                        document.getElementById("preerror").innerHTML = data.ErrorCode;
                        $('#trpre').show();

                        break;

                    default:
                        document.getElementById("TaxResult").innerHTML = "خطا";
                        document.getElementById("PrintRefresh").innerHTML = "برای تلاش مجدد کلیک کنید";
                        document.title = customername;
                        document.getElementById("preerror").innerHTML = data.ErrorCode;
                        $('#trpre').show();

                        break;
                }


                //$("#pricepan").hide();


                //document.getElementById("PriceDiscount").value = "0";


            },

            error: function (data) {

            }
        });

    });

    $('#PrintRefresh').click(function () {
        location.reload();
    });


    function printNoImg() {
        document.getElementById('sign').style.display = 'none';
        $('.tblcover').addClass("hide-bg");
        window.print();


        document.getElementById('sign').style.display = 'block';
        $('.tblcover').removeClass("hide-bg");
    }


</script>


<script>
    document.onkeydown = (e) => {
        if (e.key == 123) {
            e.preventDefault();
        }
        if (e.ctrlKey && e.shiftKey && e.key == 'I') {
            e.preventDefault();
        }
        if (e.ctrlKey && e.shiftKey && e.key == 'C') {
            e.preventDefault();
        }
        if (e.ctrlKey && e.shiftKey && e.key == 'J') {
            e.preventDefault();
        }
        if (e.ctrlKey && e.key == 'U') {
            e.preventDefault();
        }
    };
</script>


</body>
</html>
