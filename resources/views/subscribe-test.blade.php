<!DOCTYPE html>
<html>

<head>
    <title>Test OneSignal</title>
    <script src="https://cdn.onesignal.com/sdks/web/v16/OneSignalSDK.page.js" defer></script>
</head>

<body>
    <h1>اختبار OneSignal</h1>
    <button id="subscribe">اشترك في الإشعارات</button>
    <button id="check">تحقق من الحالة</button>
    <div id="status"></div>

    <script>
        window.OneSignalDeferred = window.OneSignalDeferred || [];
        OneSignalDeferred.push(async function(OneSignal) {
            await OneSignal.init({
                appId: "008f1fac-93f0-43ee-9545-2ea058405cd1",
                allowLocalhostAsSecureOrigin: true,
            });

            // زر الاشتراك
            document.getElementById('subscribe').onclick = async function() {
                await OneSignal.Slidedown.promptPush();
            };

            // زر التحقق من الحالة
            document.getElementById('check').onclick = async function() {
                const isPushSupported = await OneSignal.Notifications.isPushSupported();
                const permission = await OneSignal.Notifications.permissionNative;
                const playerId = await OneSignal.User.PushSubscription.id;
                
                document.getElementById('status').innerHTML = `
                    <p>Push Supported: ${isPushSupported}</p>
                    <p>Permission: ${permission}</p>
                    <p>Player ID: ${playerId || 'لا يوجد'}</p>
                `;
            };
        });
    </script>
</body>

</html>