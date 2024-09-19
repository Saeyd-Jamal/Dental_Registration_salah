<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="{{ asset('img/icon.png') }}">
    <title>تقرير الاسنان</title>

    <style>
        body {
            font-family: 'XBRiyaz', sans-serif;
        }

        @page {
            header: page-header;
            footer: page-footer;
        }
    </style>
    <style>
        table.blueTable {
            width: 100%;
            text-align: right;
            border-collapse: collapse;
        }

        table.blueTable td,
        table.blueTable th {
            border: 1px solid #AAAAAA;
            padding: 5px 9px;
            white-space: nowrap;
        }

        table.blueTable tbody td {
            font-size: 13px;
            color: #000000;
        }

        table.blueTable tbody tr:nth-child(even) {
            background: #F5F5F5;
        }

        table.blueTable thead {
            background: #b8b8b8;
            background: -moz-linear-gradient(top, #dedede 0%, #d7d7d7 66%, #D3D3D3 100%);
            background: -webkit-linear-gradient(top, #dedede 0%, #d7d7d7 66%, #D3D3D3 100%);
            background: linear-gradient(to bottom, #dedede 0%, #d7d7d7 66%, #D3D3D3 100%);
            border-bottom: 2px solid #444444;
        }

        table.blueTable thead th {
            font-size: 18px;
            font-weight: bold;
            text-align: right;
        }

        table.blueTable tfoot {
            font-size: 14px;
            font-weight: bold;
            color: #FFFFFF;
            background: #EEEEEE;
            background: -moz-linear-gradient(top, #f2f2f2 0%, #efefef 66%, #EEEEEE 100%);
            background: -webkit-linear-gradient(top, #f2f2f2 0%, #efefef 66%, #EEEEEE 100%);
            background: linear-gradient(to bottom, #f2f2f2 0%, #efefef 66%, #EEEEEE 100%);
            border-top: 2px solid #444444;
        }

        table.blueTable tfoot td {
            font-size: 14px;
        }

        table.blueTable tfoot .links {
            text-align: right;
        }

        table.blueTable tfoot .links a {
            display: inline-block;
            background: #1C6EA4;
            color: #FFFFFF;
            padding: 2px 8px;
            border-radius: 5px;
        }
    </style>
    <style>
        .card {
            border: 1px solid #ddd; /* تحديد حدود للبطاقة */
            padding: 15px;          /* مسافة داخلية */
            margin-bottom: 20px;    /* مسافة بين البطاقات */
            border-radius: 8px;     /* زوايا دائرية */
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); /* تأثير ظل خفيف */
        }
        .card-header {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 10px;
            border-bottom: 1px solid #ddd;
            padding-bottom: 5px;
        }
        .card-body {
            font-size: 14px;
            line-height: 1.6;
        }
        .row {
            width: 100%;
            margin: 0 15px;
            overflow: hidden;
        }

        .col {
            width: 48%;
            float: right;
            margin-bottom: 10px;
        }

    </style>
</head>

<body>
    <h1 align="center">حجز الأسنان لتاريخ {{$day}}</h1>
    <div class="row">
        <div class="col">
            <div class="card shadow">
                <div class="card-body">
                    <h3 class="card-title">أسنان رجال</h3>
                    <table class="table blueTable">
                        <thead>
                            <tr>
                                <th>رقم <br> الحجز</th>
                                <th>الاسم</th>
                                <th>نوع <br> الحجز</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($records as $record)
                                @if($record['doctor_id'] == '2')
                                    <tr>
                                        <td align="center">{{ $record['num_rec'] }}</td>
                                        <td>{{ $record['patient_name'] }}</td>
                                        <td>{{ $record['type'] }}</td>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col" style="width: 4%;">
        </div>
        <div class="col">
            <div class="card shadow">
                <div class="card-body">
                    <h3 class="card-title">أسنان نساء</h3>
                    <table class="table blueTable">
                        <thead>
                            <tr>
                                <th>رقم <br> الحجز</th>
                                <th>الاسم</th>
                                <th>نوع <br> الحجز</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($records as $record)
                                @if($record['doctor_id'] == '3')
                                    <tr>
                                        <td align="center">{{ $record['num_rec'] }}</td>
                                        <td>{{ $record['patient_name'] }}</td>
                                        <td>{{ $record['type'] }}</td>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <htmlpagefooter name="page-footer">
        <table width="100%" style="vertical-align: bottom; color: #000000;  margin: 1em">
            <tr>
                <td width="33%">{DATE j-m-Y}</td>
                <td width="33%" align="center">{PAGENO}/{nbpg}</td>
                @auth
                    <td width="33%" style="text-align: left;">{{ Auth::user()->name }}</td>
                @else
                    <td width="33%" style="text-align: left;">اسم المستخدم</td>
                @endauth
            </tr>
        </table>
    </htmlpagefooter>
</body>

</html>
