<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'English App - Free') }}</title>

{{--<title>English App - Free</title>--}}

<!-- Bootstrap Core CSS -->
    <link href="{{URL::asset('backend/assets/plugins/bootstrap/bootstrap.css')}}" rel="stylesheet"/>

    <!-- Custom Fonts -->
    <link href="{{URL::asset('backend/assets/font-awesome/css/font-awesome.css')}}" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet"
          type="text/css">

    <!-- sweet alert -->
    <link rel="stylesheet" href="{{URL::asset('sweetalert/dist/sweetalert.css')}}"/>


    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
                'csrfToken' => csrf_token(),
        ]); ?>
    </script>

    <style>
        @media print {
            body * {
                visibility: hidden;
            }

            #need-print, #need-print * {
                visibility: visible;
            }

            #need-print {
                position: absolute;
                left: 0;
                top: 0;
            }
        }

        @page {
            margin: 1cm 2cm;
        }

        .page-break {
            page-break-after: always;
        }

        body {
            background-color: rgba(37, 29, 29, 0.7) !important;
        }

        #need-print {
            background: white;
            padding: 40px 50px;
        }

        #wrap-page {
            margin-top: 65px;
            margin-left: 10%;
        }

        @media (min-width: 1200px) {
            .container {
                width: 825px !important;
            }
        }

        .row {
            padding-left: 15px;
            padding-right: 15px;
        }

        .btn-default {
            margin-bottom: 5px !important;
        }

    </style>

    @yield('style')
</head>
<body>
<div class="container-fluid" id="wrap-page">
    <div class="row">
        <div id="need-print" class="col-lg-10 col-md-10 col-xs-10">
            {{--<div>--}}
                <div class="col-lg-6 col-md-6 col-xs-12">
                    <h4 class="col-6-full"><strong>Full name: .........................................</strong></h4>
                    <h4 class="col-6-full"><strong>Class: .............................................</strong></h4>
                </div>
                <div class="col-lg-6 col-md-6 col-xs-12">
                    <h4 class="col-6-full"><strong> {{$find_exam_type->title}}</strong></h4>
                    <h4 class="col-6-full"><strong>Time:</strong> {{$find_exam_type->time}}</h4>
                </div>
            {{--</div>--}}

            @yield('content')
        </div>

        <div class="col-lg-2 col-md-2 col-xs-2">
            {{--<div style="float:left;width: 100%">--}}
                <button class="btn btn-default" value="Print" id="print" style="position: fixed; float: left;">Print</button>
                <button class="btn btn-default" value="Preview" id="preview" onclick="preview_pdf()"
                style="position: fixed; margin-left: 60px;">Preview</button>
            {{--</div>--}}
            {{--<div style="float:left;width: 100%">--}}
            <div id="editor"></div>
            <button class="btn btn-success" value="Download PDF" id="download_pdf" style="position: fixed; margin-top: 40px;">Download PDF</button>
            {{--</div>--}}
        </div>

    </div>

</div>

<!-- Core Scripts - Include with every page -->
<script src="{{URL::asset('backend/assets/plugins/jquery-1.10.2.js')}}"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="{{URL::asset('backend/assets/plugins/bootstrap/bootstrap.min.js')}}"></script>
<script src="{{URL::asset('sweetalert/dist/sweetalert.min.js')}}"></script>
<script type="text/JavaScript" src="{{URL::asset('js/jQuery.print/jquery.print.js')}}"/>
{{--<script type="text/JavaScript" src="{{URL::asset('js/print/printPDF.js')}}"/>--}}

<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            'Cache-Control': 'no-cache',
            'Pragma': 'no-cache'
        }
    });
</script>

<!-- Scripts -->
{{--<script src="{{URL::asset('js/app.js')}}"></script>--}}

@yield('script')

<script>
    $(document).ready(function () {

        /**
         * print pdf
         */
        $('#print').click(function () {
            window.print();
        });

        /**
         * download PDF
         * @type {jsPDF}
         */
//        var doc = new jsPDF();
//        var specialElementHandlers = {
//            '#editor': function (element, renderer) {
//                return true;
//            }
//        };
//
//        $('#download_pdf').click(function () {
//            doc.fromHTML($('#need-print').html(), 15, 15, {
//                'width': 170,
//                'elementHandlers': specialElementHandlers
//            });
//            doc.save('sample-file.pdf');
//        });

        $('.dropdown').click(function () {
            $('.dropdown-menu').toggle();
        });
    });

</script>

</body>
</html>
