<div>
    <style>
        /* حاوية الأيقونة */
        .notification-bell-wrapper {
            position: relative;
            display: inline-flex;
            /* لضمان أن الكود يأخذ حجم المحتوى */
            align-items: center;
            gap: 10px;
            cursor: pointer;
        }

        /* الدائرة الحمراء */
        .static-red-bell {
            background-color: #dc2626;
            /* أحمر داكن */
            color: white;
            padding: 4px 12px;
            /* حشو صغير للبدء */
            border-radius: 50px;
            /* دائرة */
            display: flex;
            align-items: center;
            gap: 8px;
            min-width: 30px;
            /* عرض أدنى لضمان ألا تنهصر الرقم */
            justify-content: center;
            /* توسيط المحتوى داخل الدائرة */
            box-shadow: 0 4px 6px rgba(220, 38, 38, 0.2);
            z-index: 2;
            font-weight: 600;
            /* جعل الرقم سميكاً */
            font-size: 0.9rem;
        }
    </style>
    <div class="notification-bell-wrapper position-relative">
        <!-- الدائرة الحمراء -->
        <div class="static-red-bell">
            <!-- الرقم يظهر الآن كجزء من الدائرة -->
            <span>جديد: {{ $numberOfNewOrders }}</span>
        </div>
    </div>
</div>
