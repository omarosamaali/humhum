    const videoReelsContainer = document.querySelector('.video-reels-container');
    const videos = document.querySelectorAll('.video-reel');
    const totalResponses = {{ $totalResponses ?? 0 }};
    let currentVideoIndex = 0;
    let countdownInterval;

    function debounce(func, wait) {
        let timeout;
        return function executedFunction(...args) {
            const later = () => {
                clearTimeout(timeout);
                func(...args);
            };
            clearTimeout(timeout);
            timeout = setTimeout(later, wait);
        };
    }

    function updateCountdown() {
        if (countdownInterval) {
            clearInterval(countdownInterval);
        }

        const currentVideo = videos?.[currentVideoIndex];
        if (!currentVideo) {
            console.warn('No current video found to update countdown.');
            return;
        }

        const currentVideoContainer = currentVideo.closest('.video-reel-item');
        const countdownTimerElement = currentVideoContainer.querySelector('.countdown-timer');

        if (!countdownTimerElement) {
            console.warn('Countdown timer element not found for current video.');
            return;
        }

        const endDateStr = countdownTimerElement.dataset.endDate;
        if (!endDateStr) {
            countdownTimerElement.textContent = 'تاريخ الانتهاء غير محدد';
            return;
        }

        // إضافة وقت نهاية اليوم إذا لم يكن موجود
        let formattedEndDate = endDateStr;
        if (!endDateStr.includes('T') && !endDateStr.includes(' ')) {
            formattedEndDate = endDateStr + 'T23:59:59';
        }

        const endDate = new Date(formattedEndDate).getTime();
        if (isNaN(endDate)) {
            countdownTimerElement.textContent = 'تاريخ الانتهاء غير صالح';
            return;
        }

        const calculateAndDisplayTime = () => {
            const now = new Date().getTime();
            const distance = endDate - now;

            if (distance < 0) {
                countdownTimerElement.textContent = 'انتهى التحدي';
                clearInterval(countdownInterval);
                return;
            }
            
            const days = Math.floor(distance / (1000 * 60 * 60 * 24));
            const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((distance % (1000 * 60)) / 1000);
            
            countdownTimerElement.textContent = `${days} يوم : ${hours.toString().padStart(2, '0')} ساعة : ${minutes.toString().padStart(2, '0')} دقيقة : ${seconds.toString().padStart(2, '0')} ثانية`;
        };
        
        calculateAndDisplayTime(); // عرض الوقت فوراً عند التحديث 
        countdownInterval = setInterval(calculateAndDisplayTime, 1000);
    }

    function updateHeaderInfo() {
        const currentVideo = videos[currentVideoIndex];
        if (!currentVideo) {
            console.error('No current video to update header info from.');
            return;
        }
        
        const currentVideoContainer = currentVideo.closest('.video-reel-item');
        const userNameElement = currentVideoContainer.querySelector('.user-name');
        const userImageElement = currentVideoContainer.querySelector('.user-profile-image');
        const userCountryElement = currentVideoContainer.querySelector('.user-country');
        
        const userName = userNameElement ? userNameElement.textContent : 'اسم المتحدي';
        const userImageSrc = userImageElement ? userImageElement.src : '{{ asset("assets/images/chef.jpeg") }}';
        const userCountry = userCountryElement ? userCountryElement.textContent : 'بلد المتحدي';
        
        // Update header elements
        const headerUserName = document.getElementById('header-user-name');
        const headerUserImage = document.getElementById('header-user-image');
        const headerUserCountry = document.getElementById('header-user-country');

        if (headerUserName) {
            headerUserName.textContent = userName;
        }
        if (headerUserImage) {
            headerUserImage.src = userImageSrc;
        }
        if (headerUserCountry) {
            headerUserCountry.textContent = userCountry;
        }

        const headerCounter = document.querySelector('.header-counter');
        if (headerCounter) {
            headerCounter.textContent = `${currentVideoIndex + 1}/${totalResponses}`;
        }
    }

    function playCurrentVideo() {
        console.log(`تشغيل الفيديو رقم: ${currentVideoIndex}`);
        videos.forEach((vid, index) => {
            const playPauseIcon = vid.parentElement.querySelector('.play-pause-icon');
            if (index === currentVideoIndex) {
                if (vid.readyState >= 2) {
                    vid.play().catch(err => console.error(`خطأ في تشغيل الفيديو ${index}:`, err));
                    if (playPauseIcon) playPauseIcon.className = 'fa-solid fa-pause pause-icon play-pause-icon';
                } else {
                    vid.load();
                    setTimeout(() => vid.play().catch(err => console.error(`خطأ في تشغيل الفيديو ${index}:`, err)), 100);
                }
            } else {
                vid.pause();
                vid.currentTime = 0;
                if (playPauseIcon) playPauseIcon.className = 'fa-solid fa-play pause-icon play-pause-icon';
            }
        });
        
        updateHeaderInfo();
        updateCountdown();
    }

    function handleScroll() {
        const scrollX = videoReelsContainer.scrollLeft;
        const viewportWidth = videoReelsContainer.clientWidth;
        const newIndex = Math.round(scrollX / viewportWidth);

        if (newIndex !== currentVideoIndex && newIndex >= 0 && newIndex < videos.length) {
            console.log(`السكرول وصل للفيديو رقم: ${newIndex}`);
            currentVideoIndex = newIndex;
            playCurrentVideo();
        }
    }

    function myFunctionHeart(buttonElement) {
        const heartIcon = buttonElement.querySelector('.heart-icon');
        if (heartIcon) {
            heartIcon.style.color = heartIcon.style.color === 'red' ? 'white' : 'red';
            console.log(`تغيير لون القلب للفيديو ${currentVideoIndex}`);
        } else {
            console.warn('No heart-icon found inside the button for myFunctionHeart.');
        }
    }

    function myFunctionMute(buttonElement) {
        const currentVideo = videos[currentVideoIndex];
        if (!currentVideo) {
            console.error('ما فيش فيديو حالي');
            return;
        }
        currentVideo.muted = !currentVideo.muted;
        const muteIcon = buttonElement.querySelector('.mute-icon');
        if (muteIcon) {
            muteIcon.className = `fa-solid fa-volume-${currentVideo.muted ? 'xmark' : 'high'} pause-icon mute-icon`;
        }
        console.log(`الفيديو ${currentVideoIndex} ${currentVideo.muted ? 'مكتوم' : 'مش مكتوم'}`);
    }

    function myFunction(buttonElement) {
        const currentVideo = videos[currentVideoIndex];
        if (!currentVideo) {
            console.error('ما فيش فيديو حالي');
            return;
        }
        const playPauseIcon = buttonElement.querySelector('.play-pause-icon');
        if (currentVideo.paused) {
            currentVideo.play().catch(err => console.error(`خطأ في تشغيل الفيديو ${currentVideoIndex}:`, err));
            if (playPauseIcon) playPauseIcon.className = 'fa-solid fa-pause pause-icon play-pause-icon';
            console.log(`تشغيل الفيديو ${currentVideoIndex}`);
        } else {
            currentVideo.pause();
            if (playPauseIcon) playPauseIcon.className = 'fa-solid fa-play pause-icon play-pause-icon';
            console.log(`إيقاف الفيديو ${currentVideoIndex}`);
        }
    }

    function preloadVideos() {
        videos.forEach((vid, index) => {
            vid.preload = 'auto';
            vid.load();
        });
    }

    function autoAdvanceVideo() {
        videos.forEach((vid, index) => {
            vid.onended = () => {
                console.log(`الفيديو ${index} خلّص`);
                const nextIndex = (currentVideoIndex + 1) % videos.length;
                videoReelsContainer.scrollTo({
                    left: nextIndex * videoReelsContainer.clientWidth,
                    behavior: 'smooth'
                });
            };
        });
    }

    // بدء التطبيق عند تحميل الصفحة
    document.addEventListener('DOMContentLoaded', () => {
        console.log("بدء تهيئة الفيديوهات...");
        preloadVideos();
        playCurrentVideo();
        autoAdvanceVideo();
        videoReelsContainer.addEventListener('scroll', debounce(handleScroll, 100));
    });
