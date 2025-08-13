<script src="https://cdn.tailwindcss.com"></script>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700&display=swap" rel="stylesheet">
<style>
    .modal-overlay {
        background: rgba(0, 0, 0, 0.5);
        backdrop-filter: blur(4px);
    }

    .notification-new {
        background: linear-gradient(135deg, #eff6ff 0%, #dbeafe 100%);
        border-right: 4px solid #3b82f6;
    }

    .star-filled {
        color: #fbbf24;
        fill: currentColor;
    }

    .star-empty {
        color: #d1d5db;
    }

    .pulse-dot::before {
        content: '';
        width: 12px;
        height: 12px;
        background: #3b82f6;
        border-radius: 50%;
        position: absolute;
        top: -2px;
        right: -2px;
        animation: pulse 2s infinite;
    }

    @keyframes pulse {
        0% {
            transform: scale(0.95);
            opacity: 1;
        }

        70% {
            transform: scale(1);
            opacity: 0.7;
        }

        100% {
            transform: scale(0.95);
            opacity: 1;
        }
    }

    .gradient-bg {
        background: linear-gradient(135deg, #e63333 0%, #dc2626 100%);
    }

    .fa-bell {
        font-size: 24px;
        width: 37px;
        color: rgb(94, 94, 94);
        height: 37px;
        text-align: center;
        align-items: center;
        display: flex;
        justify-content: center;
    }

</style>

<button id="notificationBtn" class="relative">
    <i class="fa-solid fa-bell" style=""></i>
    @if($notificationsCount > 0)
    <span id="notificationCount" class="absolute -top-2 -left-2 bg-red-500 text-white text-xs font-bold rounded-full w-6 h-6 flex items-center justify-center">
        {{ $notificationsCount }}
    </span>
    @endif
</button>
<div id="notificationModal" class="fixed inset-0 z-50 hidden items-center justify-center modal-overlay">
    <div class="mb-[60px] bg-white rounded-2xl shadow-2xl w-full max-w-2xl mx-4 max-h-[90vh] overflow-hidden transform transition-all duration-300">
        <div class="flex justify-between items-center p-3 border-b border-gray-200 gradient-bg">
            <h2 class="text-xl font-bold text-white">الإشعارات</h2>
            <button id="closeModal" class="text-white hover:text-gray-200 transition-colors p-2 rounded-full hover:bg-white hover:bg-opacity-20">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
        <div class="overflow-y-auto max-h-[70vh]" id="notificationsContainer">
@foreach ($notifications as $notification)
<div class="notification-new p-6 border-b border-gray-100 hover:bg-gray-50 transition-colors cursor-pointer" onclick="openReviewChat({{ $notification->id }})">
    <div class="flex items-start gap-4">
        <div class="relative flex-shrink-0">
            <img src="{{ asset('storage/' . $notification->chef->chefProfile->official_image) }}" alt="Chef Image" class="w-14 h-14 rounded-full object-cover border-3 border-orange-200 shadow-md">
        </div>
        <div class="flex-1">
            <div class="flex justify-between items-start mb-2" style="flex-direction: column;">
        <h3 class="font-bold text-gray-800 text-lg" style="text-transform: capitalize;">
            {{ $notification->chef->name }}
            <span class="text-sm text-gray-500">(الشيف)</span>
        </h3>

        <h3 class="font-bold text-gray-800 text-lg" style="text-transform: capitalize;">
            {{ $notification->challengeResponse->user->name }}
            <span class="text-sm text-gray-500">(صاحب التحدي)</span>
        </h3> <span class="text-sm text-gray-500">{{ $notification->created_at->diffForHumans() }}</span>

            </div>
            <p class="text-gray-700 mb-3 leading-relaxed">
                {{ $notification->chef_message_response }}
            </p>
            <div class="flex items-center justify-between">
                <div>
                    <span class="text-sm font-medium text-gray-600 mb-1 block">تقييم الشيف:</span>
                    <div class="flex items-center gap-1">
                        @php
                        $rating = $notification->rating ?? 0;
                        $fullStars = floor($rating);
                        $halfStar = ($rating - $fullStars) >= 0.5 ? 1 : 0;
                        $emptyStars = 5 - $fullStars - $halfStar;
                        @endphp
                        <div class="flex items-center gap-1">
                            @for($i = 0; $i < $fullStars; $i++) <svg class="w-4 h-4 star-filled" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                </svg>
                                @endfor
                                @if($halfStar)
                                <svg class="w-4 h-4 star-half" viewBox="0 0 20 20">
                                    <defs>
                                        <linearGradient id="half-{{ $notification->id }}">
                                            <stop offset="50%" stop-color="#fbbf24" />
                                            <stop offset="50%" stop-color="#d1d5db" />
                                        </linearGradient>
                                    </defs>
                                    <path fill="url(#half-{{ $notification->id }})" d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                </svg>
                                @endif
                                @for($i = 0; $i < $emptyStars; $i++) <svg class="w-4 h-4 star-empty" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                                    </svg>
                                    @endfor
                                    <span class="text-sm text-gray-600 mr-2">{{ number_format($rating, 1) }}</span>
                        </div>
                    </div>
                </div>
                @if($notification->created_at->diffInDays() < 1) <span class="bg-blue-100 text-blue-800 text-xs font-medium px-3 py-1 rounded-full">
                    جديد
                    </span>
                    @endif
            </div>
        </div>
    </div>
</div>
@endforeach </div>


        <div class="p-2 bg-gray-50 border-t border-gray-200">
            <div class="flex justify-between items-center">
                <span class="text-sm text-gray-600">{{ $notificationsCount }} إشعارات إجمالي</span>

            </div>
        </div>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const notificationBtn = document.getElementById('notificationBtn');
        const modal = document.getElementById('notificationModal');
        const closeModalBtn = document.getElementById('closeModal');

        // فتح المودال
        notificationBtn.addEventListener('click', function() {
            modal.classList.remove('hidden');
            modal.classList.add('flex');
            document.body.style.overflow = 'hidden';
        });

        // إغلاق المودال
        closeModalBtn.addEventListener('click', function() {
            modal.classList.add('hidden');
            modal.classList.remove('flex');
            document.body.style.overflow = 'auto';
        });

        // إغلاق المودال عند النقر خارجه
        modal.addEventListener('click', function(e) {
            if (e.target === modal) {
                modal.classList.add('hidden');
                modal.classList.remove('flex');
                document.body.style.overflow = 'auto';
            }
        });

        // إغلاق بـ Escape
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && !modal.classList.contains('hidden')) {
                modal.classList.add('hidden');
                modal.classList.remove('flex');
                document.body.style.overflow = 'auto';
            }
        });
    });

</script>
<script>
    // باقي الكود الموجود...

    // إضافة دالة فتح الشات
    function openReviewChat(reviewId) {
        // إغلاق المودال أولاً
        const modal = document.getElementById('notificationModal');
        modal.classList.add('hidden');
        modal.classList.remove('flex');
        document.body.style.overflow = 'auto';

        // الانتقال لصفحة الشات
        window.location.href = `/challenge-review-chat/${reviewId}`;
    }

</script>
