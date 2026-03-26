@extends('layouts.auth-user')
<link href="{{ asset('assets/css/profile.css') }}" rel="stylesheet">

@section('title', 'ملفى')

@section('content')

<style>
    @import url('https://fonts.googleapis.com/css2?family=Tajawal:wght@300;400;500;700;800&display=swap');

    * {
        box-sizing: border-box;
        margin: 0;
        padding: 0;
    }

    body {
        font-family: 'Tajawal', sans-serif !important;
        direction: rtl;
        background: #f7f8fc;
    }

    .profile-page {
        min-height: 100dvh;
        background: #f7f8fc;
        display: flex;
        flex-direction: column;
    }

    /* === Hero Header === */
    .profile-hero {
        background: linear-gradient(160deg, var(--primary-color, #2563eb) 0%,
                color-mix(in srgb, var(--primary-color, #2563eb) 70%, #000) 100%);
        padding: 54px 24px 80px;
        position: relative;
        overflow: hidden;
        text-align: center;
    }

    .profile-hero::before {
        content: '';
        position: absolute;
        width: 280px;
        height: 280px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.06);
        top: -90px;
        left: -70px;
    }

    .profile-hero::after {
        content: '';
        position: absolute;
        width: 200px;
        height: 200px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.04);
        bottom: -60px;
        right: -40px;
    }

    /* Back & Edit buttons */
    .hero-nav {
        display: flex;
        align-items: center;
        justify-content: space-between;
        position: relative;
        z-index: 2;
        margin-bottom: 28px;
    }

    .hero-icon-btn {
        width: 38px;
        height: 38px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.15);
        backdrop-filter: blur(8px);
        border: 1.5px solid rgba(255, 255, 255, 0.25);
        display: flex;
        align-items: center;
        justify-content: center;
        color: #fff;
        text-decoration: none;
        transition: background 0.2s, transform 0.15s;
        flex-shrink: 0;
    }

    .hero-icon-btn:hover {
        background: rgba(255, 255, 255, 0.25);
    }

    .hero-icon-btn:active {
        transform: scale(0.92);
    }

    .hero-nav-title {
        color: #fff;
        font-size: 16px;
        font-weight: 700;
        letter-spacing: -0.2px;
        position: relative;
        z-index: 2;
    }

    /* Avatar */
    .avatar-wrap {
        position: relative;
        display: inline-block;
        z-index: 2;
        margin-bottom: 14px;
    }

    .avatar-wrap img {
        width: 90px;
        height: 90px;
        border-radius: 50%;
        object-fit: cover;
        border: 3px solid rgba(255, 255, 255, 0.5);
        box-shadow: 0 6px 24px rgba(0, 0, 0, 0.18);
    }

    .avatar-status {
        position: absolute;
        bottom: 4px;
        left: 4px;
        width: 16px;
        height: 16px;
        border-radius: 50%;
        background: #22c55e;
        border: 2.5px solid #fff;
    }

    .avatar-status.inactive {
        background: #ef4444;
    }

    .hero-name {
        color: #fff;
        font-size: 22px;
        font-weight: 800;
        margin-bottom: 6px;
        position: relative;
        z-index: 2;
    }

    .hero-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: rgba(255, 255, 255, 0.15);
        backdrop-filter: blur(8px);
        border: 1px solid rgba(255, 255, 255, 0.25);
        border-radius: 20px;
        padding: 4px 14px;
        font-size: 12px;
        font-weight: 600;
        color: #fff;
        position: relative;
        z-index: 2;
    }

    .badge-dot {
        width: 7px;
        height: 7px;
        border-radius: 50%;
        background: #22c55e;
        flex-shrink: 0;
    }

    .badge-dot.inactive {
        background: #fca5a5;
    }

    /* === Card Body === */
    .profile-card {
        background: #fff;
        border-radius: 32px 32px 0 0;
        margin-top: -32px;
        flex: 1;
        padding: 32px 20px 40px;
        position: relative;
        z-index: 2;
        box-shadow: 0 -4px 30px rgba(0, 0, 0, 0.06);
    }

    /* === Info rows === */
    .info-section {
        margin-bottom: 24px;
    }

    .info-section-title {
        font-size: 11px;
        font-weight: 700;
        color: #9ca3af;
        letter-spacing: 0.8px;
        text-transform: uppercase;
        margin-bottom: 10px;
        padding-right: 4px;
    }

    .info-card {
        background: #f9fafb;
        border: 1.5px solid #f0f0f0;
        border-radius: 18px;
        overflow: hidden;
    }

    .info-row {
        display: flex;
        align-items: center;
        gap: 14px;
        padding: 16px 18px;
        position: relative;
    }

    .info-row+.info-row::before {
        content: '';
        position: absolute;
        top: 0;
        right: 18px;
        left: 18px;
        height: 1px;
        background: #f0f0f0;
    }

    .info-row-icon {
        width: 38px;
        height: 38px;
        border-radius: 12px;
        background: color-mix(in srgb, var(--primary-color, #2563eb) 10%, #fff);
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--primary-color, #2563eb);
        flex-shrink: 0;
    }

    .info-row-content {
        flex: 1;
        min-width: 0;
    }

    .info-row-label {
        font-size: 11px;
        color: #9ca3af;
        font-weight: 500;
        margin-bottom: 2px;
    }

    .info-row-value {
        font-size: 14px;
        font-weight: 600;
        color: #1f2937;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    /* === Delete Button === */
    .btn-delete {
        width: 100%;
        height: 54px;
        background: #fff5f5;
        color: #ef4444;
        border: 1.5px solid #fecaca;
        border-radius: 14px;
        font-family: 'Tajawal', sans-serif;
        font-size: 15px;
        font-weight: 600;
        cursor: pointer;
        transition: background 0.2s, border-color 0.2s, transform 0.15s;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        margin-top: 8px;
    }

    .btn-delete:active {
        transform: scale(0.97);
        background: #fee2e2;
    }
</style>

<div class="profile-page">

    <!-- Hero -->
    <div class="profile-hero">
        <div class="hero-nav">
            <a href="{{ route('users.welcome') }}" class="hero-icon-btn" aria-label="رجوع">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"
                    stroke-linecap="round" stroke-linejoin="round">
                    <polyline points="15 18 9 12 15 6" />
                </svg>
            </a>

            <span class="hero-nav-title">{{ __('messages.حسابي') }}</span>

            <a href="{{ route('users.profile.edit', Auth::user()->id) }}" class="hero-icon-btn"
                aria-label="تعديل الملف">
                <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"
                    stroke-linecap="round" stroke-linejoin="round">
                    <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7" />
                    <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z" />
                </svg>
            </a>
        </div>

        <!-- Avatar -->
        <div class="avatar-wrap">
            <img src="{{ Auth::user()->avatar ? Auth::user()->avatar : asset('assets/images/default.jpg') }}"
                alt="avatar">
            @php $isActive = Auth::user()->status == 'فعال'; @endphp
            <span class="avatar-status {{ $isActive ? '' : 'inactive' }}"></span>
        </div>

        <h1 class="hero-name">{{ Auth::user()->name }}</h1>

        <div class="hero-badge">
            <span class="badge-dot {{ $isActive ? '' : 'inactive' }}"></span>
            {{ __('messages.account') }}
            @php $locale = session('locale', 'ar'); @endphp
            {{ $locale === 'ar' ? ($isActive ? 'فعّال' : 'غير فعّال') : ($isActive ? 'Active' : 'Inactive') }}
        </div>
    </div>

    <!-- Card -->
    <div class="profile-card">

        <!-- Personal Info -->
        <div class="info-section">
            <p class="info-section-title">المعلومات الشخصية</p>
            <div class="info-card">

                {{-- Name --}}
                <div class="info-row">
                    <div class="info-row-icon">
                        <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="8" r="4" />
                            <path d="M4 20c0-4 3.6-7 8-7s8 3 8 7" />
                        </svg>
                    </div>
                    <div class="info-row-content">
                        <p class="info-row-label">{{ __('messages.my_name') }}</p>
                        <p class="info-row-value">{{ Auth::user()->name }}</p>
                    </div>
                </div>

                {{-- Email --}}
                <div class="info-row">
                    <div class="info-row-icon">
                        <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="2" y="4" width="20" height="16" rx="3" />
                            <path d="m2 7 10 7 10-7" />
                        </svg>
                    </div>
                    <div class="info-row-content">
                        <p class="info-row-label">البريد الإلكتروني</p>
                        <p class="info-row-value" style="direction:ltr; justify-content:flex-end;">
                            {{ Auth::user()->email }}
                        </p>
                    </div>
                </div>

                {{-- Country --}}
                <div class="info-row">
                    <div class="info-row-icon">
                        <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="12" r="10" />
                            <path
                                d="M2 12h20M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z" />
                        </svg>
                    </div>
                    <div class="info-row-content">
                        <p class="info-row-label">{{ __('messages.from') }}</p>
                        <p class="info-row-value">
                            <img src="https://flagcdn.com/24x18/{{ Auth::user()->country }}.png" alt="Flag"
                                style="width:22px; height:16px; border-radius:3px;">
                            {{ $countryName }}
                        </p>
                    </div>
                </div>

            </div>
        </div>

        <!-- Danger Zone -->
        <div class="info-section">
            <p class="info-section-title">منطقة الخطر</p>

            <form id="delete-account-form" method="POST" action="{{ route('users.profile.destroy') }}"
                style="display:none;">
                @csrf
                @method('DELETE')
            </form>

            <button type="button" onclick="deleteUser()" class="btn-delete">
                <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                    stroke-linecap="round" stroke-linejoin="round">
                    <polyline points="3 6 5 6 21 6" />
                    <path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6" />
                    <path d="M10 11v6M14 11v6" />
                    <path d="M9 6V4a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v2" />
                </svg>
                {{ __('messages.delete_account') }}
            </button>
        </div>

    </div>
</div>

<script>
    function deleteUser() {
        Swal.fire({
            title: "{{ __('messages.delete_confirmation') }}",
            html: `
                <p style="color: #ef4444; font-weight: bold; margin-bottom: 15px;">
                    {{ __('messages.delete_warning') }}
                </p>
                <p style="margin-bottom: 15px;">{{ __('messages.type_delete_confirm') }}</p>
                <input type="text" id="delete-confirm" class="swal2-input" placeholder="DELETE" style="width: 80%;">
            `,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#ef4444',
            cancelButtonColor: '#6b7280',
            confirmButtonText: "{{ __('messages.yes_delete') }}",
            cancelButtonText: "{{ __('messages.cancel') }}",
            preConfirm: () => {
                const input = document.getElementById('delete-confirm').value;
                if (input !== 'DELETE') {
                    Swal.showValidationMessage("{{ __('messages.must_type_delete') }}");
                    return false;
                }
                return true;
            }
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-account-form').submit();
            }
        });
    }
</script>

{!! $swalScript !!}

@endsection