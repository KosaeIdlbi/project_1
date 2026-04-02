<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>إعادة تعيين كلمة المرور</title>
    <!-- استدعاء Bootstrap للتنسيق -->
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
            border-top: 5px solid #dc3545;
            /* شريط أحمر للتنبيه */
        }

        .header {
            background-color: #fff5f5;
            padding: 30px;
            text-align: center;
            border-bottom: 1px solid #e9ecef;
        }

        .content {
            padding: 40px 30px;
            text-align: center;
        }

        .btn-reset {
            display: inline-block;
            background-color: #dc3545;
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

        .btn-reset:hover {
            background-color: #b02a37;
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

        .timer-box {
            background-color: #e2e6ea;
            padding: 15px;
            border-radius: 8px;
            display: inline-block;
            margin-top: 20px;
        }

        .timer-text {
            font-weight: bold;
            color: #495057;
            font-size: 1.1em;
            margin: 0;
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
                <p class="lead">استلمنا طلباً لتغيير كلمة المرور الخاصة بحسابك.</p>
                <p>إذا كنت من قام بهذا الطلب، يرجى الضغط على الزر أدناه لإدخال كلمة مرور جديدة:</p>

                <!-- زر إعادة التعيين -->
                <a href="{{ route('admin.password.edit', ['token' => $token]) }}" class="btn-reset">
                    تغيير كلمة المرور
                </a>

                <div class="mt-4">
                    <small>إذا لم يعمل الزر، يمكنك نسخ الرابط ولصقه في المتصفح:</small>
                    <br>
                    <a href="{{ route('admin.password.edit', ['token' => $token]) }}"
                        style="word-break: break-all; color: #dc3545; font-size: 0.85em;">
                        {{ route('admin.password.edit', ['token' => $token]) }}
                    </a>
                </div>

                <!-- عرض وقت انتهاء الصلاحية -->
                <div class="timer-box">
                    <p class="timer-text">
                        <i class="fa fa-hourglass-half"></i>
                        صلاحية هذا الرابط تنتهي خلال: {{ config('password.expire_time') }} دقيقة
                    </p>
                </div>

                <div class="mt-3">
                    <small class="text-muted">إذا لم تطلب تغيير كلمة المرور، يرجى تجاهل هذه الرسالة وسيتم الاحتفاظ بكلمة
                        المرور الحالية.</small>
                </div>
            </div>

            <!-- تذييل الرسالة -->
            <div class="footer">
                <p class="mb-0">لأمان حسابك، لا تقم بمشاركة هذا الرابط مع أي شخص.</p>
                &copy; {{ date('Y') }} جميع الحقوق محفوظة.
            </div>
        </div>
    </div>

</body>

</html>
