@extends('admin.layouts.master')
@section('title')
    ملفي الشخصي
@endsection
@section('content')
    <style>
        /* تنسيقات CSS البسيطة والمخصصة */
        .profile-wrapper {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            max-width: 1000px;
            margin: 50px auto;
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            padding: 0 15px;
            box-sizing: border-box;
        }

        /* تنسيق البطاقات */
        .card {
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
            overflow: hidden;
        }

        /* العمود الجانبي */
        .sidebar {
            flex: 1;
            min-width: 300px;
        }

        .profile-header {
            height: 120px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        .profile-content {
            padding: 20px;
            text-align: center;
            margin-top: -60px;
        }

        .img-container {
            position: relative;
            display: inline-block;
        }

        .profile-img {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            border: 4px solid #fff;
            object-fit: cover;
            background-color: #eee;
        }

        .upload-btn {
            position: absolute;
            bottom: 5px;
            left: 5px;
            background: #fff;
            width: 35px;
            height: 35px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
            border: none;
        }

        .upload-btn:hover {
            background: #f0f0f0;
        }

        .user-name {
            margin: 15px 0 5px;
            color: #333;
            font-size: 1.2rem;
        }

        .user-email {
            color: #777;
            font-size: 0.9rem;
            margin-bottom: 20px;
        }

        /* صندوق الرصيد */
        .balance-box {
            background: #f8f9fa;
            border: 1px dashed #ccc;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        .balance-amount {
            font-size: 1.5rem;
            font-weight: bold;
            color: #28a745;
            margin: 5px 0;
        }

        /* الأزرار والروابط */
        .btn {
            padding: 8px 16px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 0.9rem;
            text-decoration: none;
            display: inline-block;
            transition: 0.2s;
        }

        .btn-block {
            width: 100%;
            box-sizing: border-box;
        }

        .btn-primary {
            background: #667eea;
            color: white;
        }

        .btn-primary:hover {
            background: #5a6fd6;
        }

        .btn-danger {
            background: #dc3545;
            color: white;
        }

        .btn-danger:hover {
            background: #c82333;
        }

        .btn-outline-success {
            background: transparent;
            border: 1px solid #28a745;
            color: #28a745;
            width: 100%;
            box-sizing: border-box;
        }

        .btn-outline-success:hover {
            background: #28a745;
            color: white;
        }

        .logout-link {
            color: #dc3545;
            text-decoration: none;
            padding: 10px;
            display: block;
            text-align: right;
        }

        .logout-link:hover {
            text-decoration: underline;
        }

        /* العمود الرئيسي */
        .main-content {
            flex: 2;
            min-width: 300px;
        }

        .settings-card {
            padding: 25px;
        }

        .settings-title {
            margin-top: 0;
            color: #333;
            border-bottom: 2px solid #f0f0f0;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }

        /* التبويبات */
        .tabs {
            list-style: none;
            padding: 0;
            margin: 0 0 20px 0;
            display: flex;
            gap: 10px;
            border-bottom: 1px solid #eee;
        }

        .tab-btn {
            padding: 10px 20px;
            background: none;
            border: none;
            border-bottom: 3px solid transparent;
            cursor: pointer;
            font-size: 1rem;
            color: #666;
            font-family: inherit;
        }

        .tab-btn.active {
            color: #667eea;
            border-bottom-color: #667eea;
            font-weight: bold;
        }

        /* النماذج والحقول */
        .form-group {
            margin-bottom: 15px;
        }

        .form-label {
            display: block;
            margin-bottom: 5px;
            color: #555;
            font-weight: 500;
        }

        .form-control,
        .form-select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 6px;
            box-sizing: border-box;
            font-size: 0.95rem;
        }

        .form-control:focus,
        .form-select:focus {
            outline: none;
            border-color: #667eea;
        }

        .form-control[readonly] {
            background-color: #f9f9f9;
            color: #777;
            cursor: not-allowed;
        }

        /* تنسيق صف الإسم والزر */
        .input-with-btn {
            display: flex;
            gap: 10px;
            align-items: center;
        }

        .input-with-btn .form-control {
            flex: 1;
        }

        .error-msg {
            color: red;
            font-size: 0.85rem;
            margin-top: 5px;
            text-align: center;
        }

        .success-msg {
            color: green;
            font-size: 0.9rem;
            margin-top: 5px;
            text-align: center;
        }

        .info-alert {
            background: #e3f2fd;
            color: #0c5460;
            padding: 15px;
            border-radius: 6px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
        }

        .info-alert i {
            margin-left: 10px;
            font-size: 1.2rem;
        }

        .input-group {
            display: flex;
        }

        .input-group-text {
            background: #eee;
            padding: 10px;
            border: 1px solid #ddd;
            border-right: none;
            border-radius: 6px 0 0 6px;
            color: #555;
        }

        .input-group .form-control {
            border-radius: 0 6px 6px 0;
        }

        .form-help {
            font-size: 0.8rem;
            color: #888;
            margin-top: 5px;
        }

        .forgot-link {
            display: block;
            margin-top: 10px;
            font-size: 0.85rem;
            color: #667eea;
            text-decoration: none;
        }

        .forgot-link:hover {
            text-decoration: underline;
        }

        .d-flex {
            display: flex;
        }

        .justify-content-end {
            justify-content: flex-end;
        }

        .mt-4 {
            margin-top: 1.5rem;
        }

        /* الاستجابة للشاشات الصغيرة */
        @media (max-width: 768px) {
            .profile-wrapper {
                flex-direction: column;
            }

            .sidebar,
            .main-content {
                width: 100%;
            }
        }
    </style>
    @livewire('admin.profile', ['admin' => $admin])
@endsection
