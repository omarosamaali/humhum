<!DOCTYPE html>
<html lang="ar">

<head>
    <title>أفراد منزلي</title>
    <meta name="viewport"
        content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, minimal-ui, viewport-fit=cover">
    <link rel="shortcut icon" type="image/x-icon" href="assets/images/user-logo/favicon.png">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <link rel="stylesheet" href="{{ asset('css/toast.css') }}">
    @vite(['resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@300;400;500;700;800&display=swap"
        rel="stylesheet">
</head>

<body>

    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Tajawal', sans-serif !important;
            direction: rtl;
            background: #f7f8fc;
            min-height: 100dvh;
        }

        /* === Hero Header === */
        .page-hero {
            background: linear-gradient(160deg, var(--primary-color, #2563eb) 0%,
                    color-mix(in srgb, var(--primary-color, #2563eb) 70%, #000) 100%);
            padding: 54px 20px 72px;
            position: relative;
            overflow: hidden;
            text-align: center;
        }

        .page-hero::before {
            content: '';
            position: absolute;
            width: 260px;
            height: 260px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.06);
            top: -80px;
            left: -60px;
        }

        .page-hero::after {
            content: '';
            position: absolute;
            width: 180px;
            height: 180px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.04);
            bottom: -50px;
            right: -30px;
        }

        .hero-nav {
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: relative;
            z-index: 2;
            margin-bottom: 20px;
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
            cursor: pointer;
            transition: background 0.2s, transform 0.15s;
            flex-shrink: 0;
        }

        .hero-icon-btn:hover {
            background: rgba(255, 255, 255, 0.25);
        }

        .hero-icon-btn:active {
            transform: scale(0.92);
        }

        .hero-icon-btn.add-btn-hero {
            background: rgba(255, 255, 255, 0.2);
            border-color: rgba(255, 255, 255, 0.35);
        }

        .hero-nav-title {
            color: #fff;
            font-size: 16px;
            font-weight: 700;
        }

        .hero-emoji {
            font-size: 40px;
            display: block;
            margin-bottom: 8px;
            position: relative;
            z-index: 2;
        }

        .hero-subtitle {
            color: rgba(255, 255, 255, 0.85);
            font-size: 15px;
            font-weight: 600;
            position: relative;
            z-index: 2;
            margin-bottom: 8px;
        }

        .hero-quota {
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

        .hero-quota.full {
            background: rgba(239, 68, 68, 0.25);
            border-color: rgba(239, 68, 68, 0.4);
        }

        /* === Main Card === */
        .page-card {
            background: #fff;
            border-radius: 32px 32px 0 0;
            margin-top: -32px;
            min-height: calc(100dvh - 160px);
            padding: 28px 16px 40px;
            position: relative;
            z-index: 2;
            box-shadow: 0 -4px 30px rgba(0, 0, 0, 0.06);
        }

        /* === Member Cards === */
        .members-list {
            display: flex;
            flex-direction: column;
            gap: 14px;
            list-style: none;
        }

        .member-card {
            background: #f9fafb;
            border: 1.5px solid #f0f0f0;
            border-radius: 20px;
            overflow: hidden;
            transition: box-shadow 0.2s;
        }

        .member-card:active {
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.08);
        }

        .member-top {
            display: flex;
            align-items: center;
            gap: 14px;
            padding: 16px 16px 12px;
        }

        .member-avatar {
            width: 58px;
            height: 58px;
            border-radius: 50%;
            object-fit: cover;
            border: 2.5px solid var(--primary-color, #2563eb);
            flex-shrink: 0;
        }

        .member-info {
            flex: 1;
            min-width: 0;
        }

        .member-name {
            font-size: 15px;
            font-weight: 700;
            color: #1f2937;
            margin-bottom: 4px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .member-badge {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            font-size: 11px;
            font-weight: 600;
            padding: 2px 10px;
            border-radius: 20px;
            background: color-mix(in srgb, var(--primary-color, #2563eb) 10%, #fff);
            color: var(--primary-color, #2563eb);
            border: 1px solid color-mix(in srgb, var(--primary-color, #2563eb) 20%, transparent);
        }

        .member-badge.owner {
            background: color-mix(in srgb, #f59e0b 12%, #fff);
            color: #b45309;
            border-color: color-mix(in srgb, #f59e0b 25%, transparent);
        }

        .member-actions {
            display: flex;
            gap: 8px;
            align-items: center;
        }

        .btn-profile {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: var(--primary-color, #2563eb);
            color: #fff;
            border: none;
            border-radius: 10px;
            padding: 7px 14px;
            font-family: 'Tajawal', sans-serif;
            font-size: 12px;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
            transition: opacity 0.2s, transform 0.15s;
            white-space: nowrap;
        }

        .btn-profile:active {
            transform: scale(0.95);
            opacity: 0.9;
        }

        .btn-delete-member {
            width: 34px;
            height: 34px;
            border-radius: 10px;
            background: #fff5f5;
            border: 1.5px solid #fecaca;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #ef4444;
            cursor: pointer;
            transition: background 0.2s, transform 0.15s;
            flex-shrink: 0;
        }

        .btn-delete-member:active {
            transform: scale(0.92);
            background: #fee2e2;
        }

        /* Member Stats Row */
        .member-stats {
            display: flex;
            border-top: 1px solid #f0f0f0;
            padding: 10px 16px;
            gap: 0;
        }

        .stat-item {
            flex: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 4px;
            font-size: 11px;
            color: #6b7280;
            font-weight: 500;
            position: relative;
        }

        .stat-item+.stat-item::before {
            content: '';
            position: absolute;
            right: 0;
            top: 4px;
            bottom: 4px;
            width: 1px;
            background: #f0f0f0;
        }

        .stat-icon {
            width: 26px;
            height: 26px;
            border-radius: 8px;
            background: color-mix(in srgb, var(--primary-color, #2563eb) 10%, #fff);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary-color, #2563eb);
        }

        /* === Empty state === */
        .empty-state {
            text-align: center;
            padding: 48px 24px;
            color: #9ca3af;
        }

        .empty-state .empty-icon {
            font-size: 52px;
            display: block;
            margin-bottom: 12px;
        }

        .empty-state p {
            font-size: 14px;
            font-weight: 500;
        }

        /* === Toast === */
        #toast-message {
            position: fixed;
            bottom: 24px;
            left: 50%;
            transform: translateX(-50%);
            z-index: 9999;
            padding: 12px 20px;
            border-radius: 14px;
            font-size: 14px;
            font-weight: 600;
            font-family: 'Tajawal', sans-serif;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.12);
            display: flex;
            align-items: center;
            gap: 8px;
            animation: slideUp 0.4s ease-out;
        }

        #toast-message.success {
            background: #f0fdf4;
            color: #166534;
            border: 1.5px solid #86efac;
        }

        #toast-message.error {
            background: #fff5f5;
            color: #991b1b;
            border: 1.5px solid #fca5a5;
        }

        @keyframes slideUp {
            from {
                transform: translateX(-50%) translateY(20px);
                opacity: 0;
            }

            to {
                transform: translateX(-50%) translateY(0);
                opacity: 1;
            }
        }

        @keyframes slideOut {
            from {
                transform: translateX(-50%) translateY(0);
                opacity: 1;
            }

            to {
                transform: translateX(-50%) translateY(20px);
                opacity: 0;
            }
        }

        body {
            padding: 0px !important;
        }
    </style>

    <!-- Toasts -->
    @if(session('success'))
    <div id="toast-message" class="toast-message success">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"
            stroke-linecap="round" stroke-linejoin="round">
            <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14" />
            <polyline points="22 4 12 14.01 9 11.01" />
        </svg>
        {{ session('success') }}
    </div>
    @endif

    @if(session('error'))
    <div id="toast-message" class="toast-message error">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"
            stroke-linecap="round" stroke-linejoin="round">
            <circle cx="12" cy="12" r="10" />
            <line x1="12" y1="8" x2="12" y2="12" />
            <line x1="12" y1="16" x2="12.01" y2="16" />
        </svg>
        {{ session('error') }}
    </div>
    @endif

    <!-- Hero -->
    <div class="page-hero">
        <div class="hero-nav">
            <a href="{{ route('users.welcome') }}" class="hero-icon-btn" aria-label="الرئيسية">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"
                    stroke-linecap="round" stroke-linejoin="round">
                    <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z" />
                    <polyline points="9 22 9 12 15 12 15 22" />
                </svg>
            </a>

            <span class="hero-nav-title">{{ __('messages.أفراد منزلي') }}</span>

            <button onclick="openAlert()" class="hero-icon-btn add-btn-hero" aria-label="إضافة فرد">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"
                    stroke-linecap="round" stroke-linejoin="round">
                    <line x1="12" y1="5" x2="12" y2="19" />
                    <line x1="5" y1="12" x2="19" y2="12" />
                </svg>
            </button>
        </div>

        <span class="hero-emoji">👪</span>
        <p class="hero-subtitle">{{ __('messages.my_family_members') }}</p>

        <div class="hero-quota {{ $count >= 10 ? 'full' : '' }}">
            @if ($count < 10) <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2" />
                <circle cx="9" cy="7" r="4" />
                <path d="M23 21v-2a4 4 0 0 0-3-3.87" />
                <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                </svg>
                {{ __('messages.can_add') }} {{ 10 - $count }}/10
                @else
                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"
                    stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="10" />
                    <line x1="12" y1="8" x2="12" y2="12" />
                    <line x1="12" y1="16" x2="12.01" y2="16" />
                </svg>
                {{ __('messages.cannot_add_more') }}
                @endif
        </div>
    </div>

    <!-- Main Card -->
    <div class="page-card">
        @if($myFamilies->isEmpty())
        <div class="empty-state">
            <span class="empty-icon">🏠</span>
            <p>لا يوجد أفراد حتى الآن</p>
        </div>
        @else
        <ul class="members-list">
            @foreach ($myFamilies as $myFamily)
            <li class="member-card">

                <div class="member-top">
                    <img src="{{ $myFamily->avatar ? $myFamily->avatar : asset('assets/images/default.jpg') }}"
                        class="member-avatar" alt="{{ $myFamily->name }}">

                    <div class="member-info">
                        <p class="member-name">{{ $myFamily->name }}</p>
                        <span class="member-badge {{ $myFamily->owner == '1' ? 'owner' : '' }}">
                            @if($myFamily->owner == '1')
                            ⭐ {{ __('messages.main_account') }}
                            @else
                            {{ __('messages.member') }}
                            @endif
                        </span>
                    </div>

                    <div class="member-actions">
                        <a href="{{ route('users.family.show', $myFamily) }}" class="btn-profile">
                            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2" />
                                <circle cx="12" cy="7" r="4" />
                            </svg>
                            {{ __('messages.profile') }}
                        </a>

                        @if($myFamily->owner == '0')
                        <form id="delete-form-{{ $myFamily->id }}" method="POST"
                            action="{{ route('users.family.destroy', $myFamily->id) }}" style="display:none;">
                            @csrf
                            @method('DELETE')
                        </form>
                        <button type="button" onclick="deleteUser({{ $myFamily->id }})" class="btn-delete-member"
                            aria-label="حذف">
                            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="3 6 5 6 21 6" />
                                <path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6" />
                                <path d="M10 11v6M14 11v6" />
                            </svg>
                        </button>
                        @endif
                    </div>
                </div>

                <!-- Stats Row -->
                <div class="member-stats">
                    {{-- Has email --}}
                    <div class="stat-item">
                        <div class="stat-icon">
                            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <rect x="2" y="4" width="20" height="16" rx="3" />
                                <path d="m2 7 10 7 10-7" />
                            </svg>
                        </div>
                        {{ $myFamily?->has_email == '1' ? __('messages.yes') : __('messages.no') }}
                    </div>

                    {{-- Language --}}
                    <div class="stat-item">
                        <div class="stat-icon">
                            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="12" cy="12" r="10" />
                                <path
                                    d="M2 12h20M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z" />
                            </svg>
                        </div>
                        {{ __('messages.' . $myFamily->language) }}
                    </div>

                    {{-- Tasks --}}
                    <div class="stat-item">
                        <div class="stat-icon">
                            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="9 11 12 14 22 4" />
                                <path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11" />
                            </svg>
                        </div>
                        0
                    </div>

                    {{-- Notifications --}}
                    <div class="stat-item">
                        <div class="stat-icon">
                            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9" />
                                <path d="M13.73 21a2 2 0 0 1-3.46 0" />
                            </svg>
                        </div>
                        {{ $myFamily->send_notification == '1' ? __('messages.yes') : __('messages.no') }}
                    </div>
                </div>

            </li>
            @endforeach
        </ul>
        @endif
    </div>

    {!! $swalScript !!}

    <script>
        // Toast auto-dismiss
    document.addEventListener('DOMContentLoaded', function () {
        const toast = document.getElementById('toast-message');
        if (toast) {
            setTimeout(() => {
                toast.style.animation = 'slideOut 0.5s ease-out';
                setTimeout(() => toast.remove(), 500);
            }, 3000);
        }
    });

    // Delete member
    function deleteUser(familyId) {
        Swal.fire({
            title: "{{ __('messages.confirm_delete_member') }}",
            html: `
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
                document.getElementById('delete-form-' + familyId).submit();
            }
        });
    }

    // Add member
    const count = {{ $count }};

    function openAlert() {
        if (count >= 10) {
            Swal.fire({
                title: "{{ __('messages.cannot_add_more_members') }}",
                confirmButtonText: "{{ __('messages.ok') }}",
                icon: "warning"
            });
        } else {
            const remaining = {{ 10 - $count }};
            Swal.fire({
                title: `{{ __('messages.remaining_members') }} ${remaining} {{ __('messages.members_question') }}`,
                showDenyButton: true,
                confirmButtonText: "{{ __('messages.yes') }}",
                denyButtonText: "{{ __('messages.no') }}",
                icon: "question"
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "{{ route('users.family.create') }}";
                } else if (result.isDenied) {
                    Swal.fire("{{ __('messages.cancelled') }}", "", "info");
                }
            });
        }
    }
    </script>

    <script src="assets/js/jquery.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/settings.js"></script>
    <script src="assets/js/custom.js"></script>

</body>

</html>