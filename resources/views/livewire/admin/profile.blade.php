<div>
    <div class="profile-wrapper">
        <!-- العمود الرئيسي: الإعدادات والتعديل -->
        <div class="main-content">
            <div class="card settings-card">
                <h4 class="settings-title">إعدادات الحساب</h4>

                <!-- أزرار التبويب -->
                <ul class="tabs">
                    <li>
                        <button wire:click.prevent='$set("show", "personal_info")'
                            class="tab-btn {{ $show == 'personal_info' ? 'active' : '' }}" type="button">
                            <i class="fa fa-user-edit"></i> المعلومات الشخصية
                        </button>
                    </li>
                    <li>
                        <button wire:click.prevent='$set("show", "edit_password")'
                            class="tab-btn {{ $show == 'edit_password' ? 'active' : '' }}" type="button">
                            <i class="fa fa-lock"></i> كلمة المرور
                        </button>
                    </li>
                </ul>

                <!-- محتوى التبويبات -->
                <div>
                    @switch($show)
                        @case('personal_info')
                            <div class="img-container">
                                @if ($admin->img)
                                    <img src="{{ asset('users/imgs/' . $admin->img->path) }}" alt="Profile Image"
                                        class="profile-img" id="profilePreview">
                                @else
                                    <img src="{{ asset('assets/img/img11.jpg') }}" alt="Profile Image" class="profile-img"
                                        id="profilePreview">
                                @endif
                                <!-- زر تغيير الصورة -->
                                <label for="fileInput" class="upload-btn" title="تغيير الصورة">
                                    <i class="fa fa-camera"></i>
                                </label>
                                <!-- إخفاء حقل الملف -->
                                <input type="file" id="fileInput" wire:model.live='Img' onchange="previewImage(event)"
                                    style="display: none;">
                            </div>
                            <div>
                                <div class="form-group">
                                    <label class="form-label">الاسم الكامل</label>
                                    <div class="input-with-btn">
                                        <input wire:model='name' type="text" class="form-control">
                                        <button wire:click.prevent='updateName' class="btn btn-primary">حفظ</button>
                                    </div>
                                    <div class="error-msg"> <x-input-error input="name"></x-input-error></div>
                                </div>

                                <div class="form-group">
                                    <label class="form-label">البريد الإلكتروني</label>
                                    <input type="email" class="form-control" value="{{ $admin->email }}" readonly>
                                </div>

                                <div class="form-group">
                                    <label class="form-label">
                                        <i class="fa fa-globe"></i> المنطقة الزمنية (Timezone)
                                    </label>
                                    <select wire:model.live='TimeZone' class="form-select">
                                        <option value="Asia/Damascus">سوريا - دمشق (GMT+3)</option>
                                        <option value="Asia/Riyadh">السعودية - الرياض (GMT+3)</option>
                                        <option value="Asia/Dubai">الإمارات - دبي (GMT+4)</option>
                                        <option value="Asia/Kuwait">الكويت (GMT+3)</option>
                                        <option value="Asia/Cairo">مصر - القاهرة (GMT+2)</option>
                                        <option value="Europe/London">المملكة المتحدة - لندن (GMT+0)</option>
                                        <option value="America/New_York">أمريكا - نيويورك (GMT-5)</option>
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
                                    </select>
                                    <div class="form-help">سيتم ضبط تواريخ الطلبات والإشعارات بناءً على هذه المنطقة.</div>
                                </div>
                            </div>
                        @break

                        @case('edit_password')
                            <div>
                                <div class="info-alert">
                                    <i class="fa fa-info-circle"></i>
                                    <div>تأكد من أن كلمة المرور الجديدة قوية وتتكون من 8 أحرف على الأقل.</div>
                                </div>

                                <div class="form-group">
                                    <label class="form-label">كلمة المرور الحالية</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fa fa-lock"></i></span>
                                        <input wire:model='current_password' type="password" class="form-control" required>
                                    </div>
                                    <div class="error-msg">
                                        <x-redirect-message name="current_password_incorrect"></x-redirect-message>
                                    </div>
                                </div>

                                <div style="display: flex; gap: 15px;">
                                    <div class="form-group" style="flex: 1;">
                                        <label class="form-label">كلمة المرور الجديدة</label>
                                        <input wire:model='password' type="password" class="form-control" required>
                                    </div>
                                    <div class="form-group" style="flex: 1;">
                                        <label class="form-label">تأكيد كلمة المرور الجديدة</label>
                                        <input wire:model='password_confirmation' type="password" class="form-control" required>
                                    </div>
                                </div>
                                <div class="error-msg"> <x-input-error input="password"></x-input-error></div>

                                <div class="success-msg">
                                    <x-redirect-message name="success"></x-redirect-message>
                                </div>

                                <a href="{{ route('admin.password.create') }}" class="forgot-link">هل نسيت كلمة المرور?</a>

                                <div class="d-flex justify-content-end mt-4">
                                    <button wire:click.prevent='updatePassword' class="btn btn-danger">تحديث كلمة
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
