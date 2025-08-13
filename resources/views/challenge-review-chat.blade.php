<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>محادثة التقييم</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <style>
        body {
            font-family: 'Cairo', sans-serif;
        }

        .gradient-bg {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        .chat-bubble-user {
            background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
            border-radius: 20px 20px 5px 20px;
        }

        .chat-bubble-chef {
            background: #f8f9fa;
            border-radius: 20px 20px 20px 5px;
            border: 1px solid #e9ecef;
        }

        .chat-input-container {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-top: 1px solid #e9ecef;
        }

        .send-btn {
            background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
            transition: all 0.3s ease;
        }

        .send-btn:hover {
            transform: scale(1.05);
        }

        .star-filled {
            color: #fbbf24;
        }

        .star-empty {
            color: #d1d5db;
        }

        .message-time {
            font-size: 0.75rem;
        }

        .participant-info {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 10px;
            margin-bottom: 5px;
        }

        .participant-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            border: 2px solid white;
            object-fit: cover;
        }

        .participant-name {
            color: white;
            font-weight: 600;
            font-size: 14px;
        }

        .chat-status {
            color: rgba(255, 255, 255, 0.8);
            font-size: 12px;
        }

    </style>
</head>
<body class="bg-gray-100 min-h-screen">
    <!-- Header -->
    <div class="bg-black text-white p-4 sticky top-0 z-10 shadow-lg">
        <div class="flex items-center justify-between">
            <div class="p-2"></div>

            <div class="flex flex-col items-center gap-2">
                <h1 class="text-lg font-bold">محادثة التقييم</h1>

                <!-- معلومات الطرف الآخر -->
                <div class="participant-info">
                    <img src="{{ asset('storage/' . $otherParticipant['image']) }}" alt="{{ $otherParticipant['name'] }}" class="participant-avatar">
                    <div class="text-center">
                        <div class="participant-name">{{ $otherParticipant['name'] }}</div>
                        <div class="chat-status">
                            {{ $otherParticipant['type'] == 'chef' ? 'الشيف' : 'المتحدي' }}
                        </div>
                    </div>
                </div>

                <div class="flex items-center justify-center gap-1">
                    <div class="flex items-center gap-1">
                        @php
                        $rating = $review->rating ?? 0;
                        $fullStars = floor($rating);
                        $emptyStars = 5 - $fullStars;
                        @endphp

                        @for($i = 0; $i < $fullStars; $i++) <svg class="w-4 h-4 star-filled" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                            </svg>
                            @endfor

                            @for($i = 0; $i < $emptyStars; $i++) <svg class="w-4 h-4 star-empty" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                                </svg>
                                @endfor
                                <span class="text-sm mr-2">{{ number_format($rating, 1) }}</span>
                    </div>
                </div>
            </div>
            <button onclick="goBack()" class="p-2 hover:bg-white hover:bg-opacity-20 rounded-full transition-colors">
                <i class="fas fa-arrow-left text-xl"></i>
            </button>

        </div>
    </div>

    <!-- Chat Container -->
    <div class="flex flex-col h-screen">
        <!-- Messages Area -->
        <div id="messagesContainer" class="flex-1 overflow-y-auto p-4 pb-24 scroll-smooth" style="max-height: calc(100vh - 180px);">

            <!-- Original Review Message -->
            <div class="mb-6 bg-white rounded-lg p-4 shadow-md border-r-4 border-blue-500">
                <div class="flex items-start gap-3">
                    <img src="{{ asset('storage/' . $review->chef->chefProfile->official_image) }}" alt="Chef" class="w-10 h-10 rounded-full">
                    <div class="flex-1">
                        <div class="flex items-center gap-2 mb-2">
                            <h4 class="font-semibold text-gray-800">{{ $review->chef->name }}</h4>
                            <span class="text-xs text-gray-500">التقييم الأصلي</span>
                        </div>
                        <p class="text-gray-700 mb-2">{{ $review->chef_message_response }}</p>
                        <div class="flex items-center gap-2 text-xs text-gray-500">
                            <span>{{ $review->created_at->diffForHumans() }}</span>
                            <span>•</span>
                            <span>التقييم الأساسي</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Chat Messages -->
            <div id="chatMessages">
                @foreach($review->messages as $message)
                @if($message->sender_id == Auth::id())
                <!-- User Message -->
                <div class="flex justify-end mb-4">
                    <div class="max-w-xs lg:max-w-md">
                        <div class="chat-bubble-user text-white p-4 shadow-md">
                            <p class="text-sm">{{ $message->message }}</p>
                        </div>
                        <div class="flex items-center justify-end gap-2 mt-1 message-time">
                            <span class="text-gray-500">{{ $message->created_at->diffForHumans() }}</span>
                            <div class="flex gap-1">
                                <i class="fas fa-check text-blue-500 text-xs"></i>
                                @if($message->is_read)
                                <i class="fas fa-check text-blue-500 text-xs -mr-2"></i>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                @else
                <!-- Other User Message -->
                <div class="flex justify-start mb-4">
                    <div class="flex items-start gap-2 max-w-xs lg:max-w-md">
                        @php
                        $senderImage = $review->chef->chefProfile->official_image;

                        if ($message->sender_id == $review->chef_id) {
                        // المرسل هو الشيف
                        $senderImage = $review->chef->chefProfile->official_image ?? $review->chef->chefProfile->official_image;

                        } else {
                        // المرسل هو المتحدي - تحقق من عدة أعمدة محتملة
                        $senderImage = $review->chef->chefProfile->official_image

                        ?? $review->chef->chefProfile->official_image

                        ?? $review->chef->chefProfile->official_image

                        ?? $review->chef->chefProfile->official_image;

                        }
                        @endphp
                        <img src="{{ asset('storage/' . $senderImage) }}" alt="{{ $message->sender->name }}" class="w-8 h-8 rounded-full flex-shrink-0">
                        <div>
                            <div class="chat-bubble-chef text-gray-800 p-4 shadow-md">
                                <p class="text-sm">{{ $message->message }}</p>
                            </div>
                            <div class="flex items-center justify-start gap-2 mt-1 mr-2 message-time">
                                <span class="text-gray-500">{{ $message->created_at->diffForHumans() }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                @endforeach
            </div>
        </div>

        <!-- Input Area -->
        <div class="fixed bottom-0 left-0 right-0 chat-input-container p-4">
            <div class="flex items-center gap-3 max-w-4xl mx-auto">
                <div class="flex-1 relative">
                    <input type="text" id="messageInput" placeholder="اكتب رسالتك هنا..." class="w-full border border-gray-300 rounded-full py-3 px-6 pr-12 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" maxlength="500">
                </div>
                <button id="sendButton" class="send-btn text-white p-3 rounded-full shadow-lg">
                    <i class="fas fa-paper-plane"></i>
                </button>
            </div>
            {{-- <div class="text-center mt-2"> --}}
            <span style="top: 34px; position: absolute; left: 80px;" class="text-xs text-gray-500" id="charCount">0/500</span>
            {{-- </div> --}}
        </div>
    </div>

    <script>
        const reviewId = {
            {
                $review - > id
            }
        };

        const currentUserId = {
            {
                Auth::id()
            }
        };
        const otherParticipant = @json($otherParticipant);

        const messageInput = document.getElementById('messageInput');
        const sendButton = document.getElementById('sendButton');
        const messagesContainer = document.getElementById('messagesContainer');
        const chatMessagesDiv = document.getElementById('chatMessages');
        const charCount = document.getElementById('charCount');

        function goBack() {
            window.history.back();
        }

        // دالة لإضافة الرسالة إلى الواجهة
        function addMessageToUI(messageData) {
            const isCurrentUser = messageData.sender_id === currentUserId;

            let messageHtml;
            if (isCurrentUser) {
                messageHtml = `
                    <div class="flex justify-end mb-4">
                        <div class="max-w-xs lg:max-w-md">
                            <div class="chat-bubble-user text-white p-4 shadow-md">
                                <p class="text-sm">${messageData.message}</p>
                            </div>
                            <div class="flex items-center justify-end gap-2 mt-1 message-time">
                                <span class="text-gray-500 text-xs">${messageData.created_at}</span>
                                <div class="flex gap-1">
                                    <i class="fas fa-check text-blue-500 text-xs"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                `;
            } else {
                messageHtml = `
                    <div class="flex justify-start mb-4">
                        <div class="flex items-start gap-2 max-w-xs lg:max-w-md">
                            <img src="/storage/${messageData.sender_image}" 
                                 alt="${messageData.sender_name}" 
                                 class="w-8 h-8 rounded-full flex-shrink-0">
                            <div>
                                <div class="chat-bubble-chef text-gray-800 p-4 shadow-md">
                                    <p class="text-sm">${messageData.message}</p>
                                </div>
                                <div class="flex items-center justify-start gap-2 mt-1 mr-2 message-time">
                                    <span class="text-gray-500 text-xs">${messageData.created_at}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                `;
            }

            chatMessagesDiv.innerHTML += messageHtml;
            messagesContainer.scrollTop = messagesContainer.scrollHeight;
        }

        // دالة إرسال الرسالة
        function sendMessage() {
            const message = messageInput.value.trim();
            if (message === '' || message.length > 500) {
                return;
            }

            // تعطيل زر الإرسال مؤقتاً
            sendButton.disabled = true;

            // إرسال الرسالة عبر AJAX
            fetch(`/challenge-review-chat/${reviewId}/send`, {
                    method: 'POST'
                    , headers: {
                        'Content-Type': 'application/json'
                        , 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                    , body: JSON.stringify({
                        message: message
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        addMessageToUI(data.message);
                        messageInput.value = '';
                        charCount.textContent = '0/500';
                    } else {
                        console.error('Error:', data.error);
                        alert('حدث خطأ في إرسال الرسالة');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('حدث خطأ في إرسال الرسالة');
                })
                .finally(() => {
                    sendButton.disabled = false;
                });
        }

        // الربط بين الدالة وزر الإرسال
        sendButton.addEventListener('click', sendMessage);

        // الربط بين الدالة وزر Enter
        messageInput.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                sendMessage();
            }
        });

        // تحديث عدد الحروف
        messageInput.addEventListener('input', function() {
            charCount.textContent = `${this.value.length}/500`;
            sendButton.disabled = this.value.trim() === '';
        });

        // تمرير الصفحة لأسفل عند التحميل
        window.addEventListener('load', function() {
            messagesContainer.scrollTop = messagesContainer.scrollHeight;
        });

    </script>
</body>
</html>
