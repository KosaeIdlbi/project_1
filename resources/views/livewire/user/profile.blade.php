<div>
    <div class="container py-5">
        <div class="row justify-content-center">
            <!-- العمود الجانبي: معلومات المستخدم -->
            <div class="col-lg-4 mb-4">
                <div class="profile-card p-4">
                    <div class="profile-header"></div>

                    <div class="profile-img-container">
                        <!-- صورة المستخدم الحالية -->
                        @if ($user->img)
                            <img src="{{ asset('users/imgs/' . $user->img->path) }}" alt="Profile Image"
                                class="profile-img" id="profilePreview">
                        @else
                            <img src="{{ asset('assets/img/img11.jpg') }}" alt="Profile Image" class="profile-img"
                                id="profilePreview">
                        @endif
                        <!-- زر تغيير الصورة -->
                        <label for="fileInput" class="upload-btn" title="تغيير الصورة">
                            <i class="fa fa-camera"></i>
                        </label>
                        <form action="" method="POST" enctype="multipart/form-data">
                            <input type="file" id="fileInput" wire:model.live='Img' onchange="previewImage(event)">
                        </form>
                    </div>

                    <h4 class="mt-3 mb-1">{{ $user->name }}</h4>
                    <p class="text-muted mb-3">{{ $user->email }}</p>

                    <!-- ✨ إضافة قسم حالة الحساب -->
                    <div class="account-status-box mb-3">
                        @if ($user->email_verified_at)
                            <!-- حالة الحساب مفعل -->
                            <div class="status-card verified-card">
                                <div class="status-icon bg-light-success">
                                    <i class="fa fa-check-circle text-success"></i>
                                </div>
                                <div class="status-content">
                                    <div class="status-title text-success">الحساب مفعل</div>
                                    <div class="status-subtitle text-muted">حسابك محمي ومؤكد بالكامل</div>
                                </div>
                                <div class="status-action">
                                    <i class="fa fa-shield-halved text-success opacity-50"></i>
                                </div>
                            </div>
                        @else
                            <!-- حالة الحساب غير مفعل -->
                            <div class="status-card unverified-card">
                                <div class="status-icon bg-light-danger">
                                    <i class="fa fa-exclamation-circle text-danger"></i>
                                </div>
                                <div class="status-content">
                                    <div class="status-title text-danger">الحساب غير مفعل</div>
                                    <div class="status-subtitle text-muted small">يرجى تفعيل البريد الإلكتروني</div>
                                </div>
                            </div>

                            <!-- زر التفعيل الأنيق -->
                            <a href="{{ route('user.verify.edit') }}" class="btn-verify-action">
                                <i class="fa fa-paper-plane me-2"></i>
                                تفعيل الحساب الآن
                            </a>
                        @endif
                    </div>
                    <!-- ✨ نهاية إضافة قسم حالة الحساب -->
                    <div class="balance-box">
                        <small class="text-muted d-block mb-1">الرصيد الحالي</small>
                        <div class="balance-amount">
                            <i class="fa fa-wallet ms-2"></i>
                            {{ $user->balance }} ل.س
                        </div>
                        <a href="{{ route('user.wallet.create') }}"
                            class="btn btn-sm btn-outline-success mt-2 w-100">شحن الرصيد</a>
                    </div>
                    <hr class="my-4">

                    <div class="text-start">
                        <ul class="list-unstyled">
                            <li class="mb-2">
                                <form action="{{ route('user.logout') }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="dropdown-item text-danger">
                                        <i class="bi bi-box-arrow-right me-2"></i> تسجيل خروج
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- العمود الرئيسي: الإعدادات والتعديل -->
            <div class="col-lg-8">
                <div class="settings-card">
                    <h4 class="mb-4 fw-bold">إعدادات الحساب</h4>

                    <!-- أزرار التبويب -->
                    <ul class="nav nav-pills mb-4">
                        <li class="nav-item">
                            <button wire:click.prevent='$set("show","personal_info")'
                                class="nav-link {{ $show == 'personal_info' ? 'active' : '' }}" type="button">
                                <i class="fa fa-user-edit"></i> المعلومات الشخصية
                            </button>
                        </li>
                        <li class="nav-item">
                            <button wire:click.prevent='$set("show","edit_password")'
                                class="nav-link {{ $show == 'edit_password' ? 'active' : '' }}" type="button">
                                <i class="fa fa-lock"></i> كلمة المرور
                            </button>
                        </li>
                    </ul>

                    <!-- محتوى التبويبات -->
                    <div class="tab-content">
                        @switch($show)
                            @case('personal_info')
                                <div class="tab-pane fade show active">
                                    <div class="row g-3">
                                        <div class="col-md-12"> <!-- جعلناه col-md-12 ليعرض بشكل كامل أفقياً -->
                                            <label class="form-label">الاسم الكامل</label>
                                            <div class="row g-2"> <!-- صف داخلي لترتيب العناصر -->

                                                <!-- حقل الإدخال يأخذ الجزء الأكبر -->
                                                <div class="col">
                                                    <input wire:model='name' type="text" class="form-control">
                                                </div>

                                                <!-- الزر يأخذ مساحة "تلقائية" حسب محتواه (Auto width) -->
                                                <div class="col-auto">
                                                    <button wire:click.prevent='updateName'
                                                        class="btn btn-primary h-100">حفظ</button>
                                                </div>
                                                <div class="tx-center mg-b-20" style="color: red"> <x-input-error
                                                        input="name"></x-input-error></div>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <label class="form-label">البريد الإلكتروني</label>
                                            <input type="email" class="form-control" value={{ $user->email }} readonly>
                                        </div>

                                        <!-- حقل المنطقة الزمنية (بدلاً من الهاتف والعنوان) -->
                                        <div class="col-12">
                                            <label class="form-label"><i class="fa fa-globe me-2"></i>المنطقة الزمنية
                                                (Timezone)</label>
                                            <select wire:model.live='TimeZone' class="form-select">
                                                <option value="Asia/Damascus">سوريا - دمشق (GMT+3)</option>
                                                <option value="Asia/Riyadh">السعودية - الرياض (GMT+3)</option>
                                                <option value="Asia/Dubai">الإمارات - دبي (GMT+4)</option>
                                                <option value="Asia/Kuwait">الكويت (GMT+3)</option>
                                                <option value="Asia/Cairo">مصر - القاهرة (GMT+2)</option>
                                                <option value="Europe/London">المملكة المتحدة - لندن (GMT+0)</option>
                                                <option value="America/New_York">أمريكا - نيويورك (GMT-5)</option>
                                                <!-- المناطق الإضافية -->
                                                <option value="Asia/Qatar">قطر - الدوحة (GMT+3)</option>
                                                <option value="Asia/Bahrain">البحرين - المنامة (GMT+3)</option>
                                                <option value="Asia/Muscat">عُمان - مسقط (GMT+4)</option>
                                                <option value="Asia/Amman">الأردن - عمان (GMT+3)</option>
                                                <option value="Asia/Beirut">لبنان - بيروت (GMT+2)</option>
                                                <option value="Asia/Baghdad">العراق - بغداد (GMT+3)</option>
                                                <option value="Asia/Aden">اليمن - صنعاء (GMT+3)</option>
                                                <option value="Africa/Algiers">الجزائر - الجزائر العاصمة (GMT+1)</option>
                                                <option value="Africa/Casablanca">المغرب - الدار البيضاء (GMT+1)</option>
                                                <option value="Africa/Tunis">تونس - تونس (GMT+1)</option>
                                                <option value="Europe/Berlin">ألمانيا - برلين (GMT+1)</option>
                                                <option value="Europe/Paris">فرنسا - باريس (GMT+1)</option>
                                                <option value="Europe/Istanbul">تركيا - إسطنبول (GMT+3)</option>
                                                <option value="Asia/Tokyo">اليابان - طوكيو (GMT+9)</option>
                                                <option value="Asia/Shanghai">الصين - شنغهاي (GMT+8)</option>
                                                <!-- يمكنك إضافة المزيد من المناطق هنا -->
                                            </select>
                                            <div class="form-text">سيتم ضبط تواريخ الطلبات والإشعارات بناءً على هذه
                                                المنطقة.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @break

                            @case('edit_password')
                                <div class="tab-pane fade show active">
                                    <div class="alert alert-info d-flex align-items-center">
                                        <i class="fa fa-info-circle ms-2 fs-4"></i>
                                        <div>
                                            تأكد من أن كلمة المرور الجديدة قوية وتتكون من 8 أحرف على الأقل.
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">كلمة المرور الحالية</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fa fa-lock"></i></span>
                                            <input wire:model='current_password' type="password" class="form-control"
                                                required>
                                        </div>
                                        <div class="tx-center mg-b-20" style="color: red"> <x-redirect-message
                                                name="current_password_incorrect"></x-redirect-message></div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">كلمة المرور الجديدة</label>
                                            <input wire:model='password' type="password" class="form-control" required>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">تأكيد كلمة المرور الجديدة</label>
                                            <input wire:model='password_confirmation' type="password" class="form-control"
                                                required>
                                        </div>
                                        <div class="tx-center mg-b-20" style="color: red"> <x-input-error
                                                input="password"></x-input-error></div>
                                    </div>
                                    <div class="tx-center mg-b-20" style="color: green"> <x-redirect-message
                                            name="success"></x-redirect-message></div>
                                    <a href={{ route('user.password.create') }} class="tx-info tx-12 d-block mg-t-10">هل نسيت
                                        كلمة المرور?</a>
                                    <div class="d-flex justify-content-end mt-4">
                                        <button wire:click.prevent='updatePassword' class="btn btn-danger px-4">تحديث كلمة
                                            المرور</button>
                                    </div>

                                </div>
                            @break

                            @default
                        @endswitch
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
