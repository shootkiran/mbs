<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Print Token</title>
    <link href="{{ asset('css/paper.css') }}" rel="stylesheet">
    <style>
        @page {
            size: A4
        }

        body {
            font-size: 5mm;
            text-align: center;;
        }

        .padding-10mm {
            padding-left: 2mm;
            padding-right: 2mm;
        }

        .col {
            width: 100%;
            display: block;

        }

        .subject {
            font-size: 12mm;
            font-weight: bolder;
        }

        .subject2 {
            font-size: 13mm;
            font-weight: bolder;
        }

        .examdate {
            font-size: 8mm;
            font-weight: bolder;
        }

        .text {
            line-height: 10px;
        }

        .regid {
            text-align: center;
            padding-bottom: 0mm;
            margin-top: -5mm;
            font-size: 15mm;
            font-weight: bolder;
        }

        .barcode {
            text-align: center;
        }

        .notecontainer {
            float: left;
            text-align: left;
        }

        .note {
            font-size: 15px;
            margin-bottom: -12px;
        }
        .notenep {
            font-size: 15px;
            margin-bottom: -12px;
        }

        .note2 {
            line-height: 10px;
            font-size: 15px;
            font-weight: bolder;
            margin-bottom: -12px;
        }
        .note2nep {
            line-height: 10px;
            font-size: 15px;
            font-weight: bolder;
            margin-bottom: -12px;
        }
    </style>
</head>

<!-- Set "A5", "A4" or "A3" for class name -->
<!-- Set also "landscape" if you need -->
<body class="A4x">

<!-- Each sheet element should have the class "sheet" -->
<!-- "padding-**mm" is optional: you can set 10, 15, 20 or 25 -->
<section class="sheet padding-10mm">

    <!-- Write HTML just like a web page -->
    <article>
        <div class="col">
            <div class="subject"> 2020 slkadjflksdaj 1sdkfjaldksj;fkjsd NAT-TEST</div>
            <div class="subject2">2020-1</div>

        </div>
        <img src="/"
        <div class="xbarcode"> {!! QrCode::size(250)->generate($registration->venue->gps); !!}</div>


        <div class="examdate">Exam Date:2020-02-15(Saturday)</div>

        <div class="notecontainer">
            <p class="note">
                *Please bring this coupon to collect your <b>Admission Ticket</b> between 2020-02-09 and 2020-02-14.
            </p>
            <p class="note">
                *कृपया यो कुपन 2020-02-09 देखि 2020-02-14मा आफ्नो <b>Admission Ticket</b> लिनको लागि लिएर आउनुहोला
            </p>
            <p class="note"> *You can also click a photo of this coupon in case you lose it. </p>
            <p class="note"> *यो कुपनको फोटो खिचेर राख्नु भयो भने यो कुपन हराएको खण्डमा सहायता गर्न सक्छ |</p>
            <p class="note">*For any queries please contact </p>
            <p class="note2">Nat-Test Kathmandu Management Committee</p>
            <p class="note2">Chabahil, Kathmandu.TEL:014482809 MOB:9851126834 </p>
        </div>


    </article>

</section>

</body>

<script src="{{ asset('js/app.js') }}"></script>
<script type="text/javascript">
    var is_chrome = function () {
        return Boolean(window.chrome);
    }
    if (is_chrome) {
       /* window.print();
        setTimeout(function () {
            document.location.href = "/collection";
        }, 2000);*/
        //give them 2 seconds to print, then close
    } else {
   /*     window.print();
        document.location.href = "/collection";*/
    }

</script>
</html>
