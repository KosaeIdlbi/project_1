<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>تأكيد الحساب</title>
    <!-- استدعاء Bootstrap للتنسيق السريع والجميل -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.rtl.min.css">
    <style>
        body {
            background-color: #f4f6f9;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            padding: 40px 0;
        }

        .email-container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
            overflow: hidden;
            border-top: 5px solid #007bff;
            /* شريط ملون في الأعلى */
        }

        .header {
            background-color: #f8f9fa;
            padding: 30px;
            text-align: center;
            border-bottom: 1px solid #e9ecef;
        }

        .content {
            padding: 40px 30px;
            text-align: center;
        }

        .btn-verify {
            display: inline-block;
            background-color: #007bff;
            color: #ffffff;
            padding: 12px 30px;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
            font-size: 16px;
            margin: 20px 0;
            transition: background-color 0.3s;
            border: none;
        }

        .btn-verify:hover {
            background-color: #0056b3;
            color: #ffffff;
            text-decoration: none;
        }

        .footer {
            background-color: #f8f9fa;
            padding: 20px;
            text-align: center;
            font-size: 12px;
            color: #6c757d;
            border-top: 1px solid #e9ecef;
        }

        .warning-text {
            color: #dc3545;
            font-size: 0.9em;
            margin-top: 15px;
            background-color: #fff5f5;
            padding: 10px;
            border-radius: 5px;
            display: inline-block;
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="email-container">
            <!-- رأس الرسالة -->
            <div class="header">
                <h2 class="h3 mb-0">مرحباً، {{ $user->name }}</h2>
            </div>

            <!-- محتوى الرسالة -->
            <div class="content">
                <p class="lead">شكراً لتسجيلك في منصتنا!</p>
                <p>نرحب بك بشدة ونتطلع لرؤيتك معنا. لضمان أمان حسابك والاستفادة من كافة الميزات، يرجى تفعيل بريدك
                    الإلكتروني بالضغط على الزر أدناه:</p>

                <!-- زر التفعيل -->
                <a href="{{ route('admin.verify.verifyUser', ['token' => $token]) }}" class="btn-verify">
                    تفعيل حسابي الآن
                </a>

                <div class="mt-4">
                    <small>إذا لم يعمل الزر أعلاه، يمكنك نسخ الرابط التالي ولصقه في متصفحك:</small>
                    <br>
                    <a href="{{ route('admin.verify.verifyUser', ['token' => $token]) }}"
                        style="word-break: break-all; color: #007bff; font-size: 0.85em;">
                        {{ route('admin.verify.verifyUser', ['token' => $token]) }}
                    </a>
                </div>

                <!-- تنبيه انتهاء الصلاحية -->
                <div class="warning-text">
                    <i class="fa fa-clock-o"></i> يرجى ملاحظة أن هذا الرابط سينتهي صلاحيته خلال <strong>24 ساعة</strong>
                    من الآن.
                </div>
            </div>

            <!-- تذييل الرسالة -->
            <div class="footer">
                <p class="mb-0">إذا لم تقم بإنشاء هذا الحساب، يمكنك تجاهل هذه الرسالة بأمان.</p>
                &copy; {{ date('Y') }} جميع الحقوق محفوظة.
            </div>
        </div>
    </div>

</body>

</html>
