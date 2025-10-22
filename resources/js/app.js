import './bootstrap';
import Alpine from 'alpinejs';
import Choices from 'choices.js';
import 'choices.js/public/assets/styles/choices.min.css';
import { initializeApp } from "firebase/app";
import { getMessaging, getToken, onMessage } from "firebase/messaging";

window.Alpine = Alpine;
Alpine.start();

import countries from "i18n-iso-countries";
import arLocale from "i18n-iso-countries/langs/ar.json";

countries.registerLocale(arLocale);

document.addEventListener('DOMContentLoaded', function() {
    const select = document.querySelector('select[name="country"]');
    if (!select) return;

    // فقط شغل Choices.js من غير ما تضيف الدول تاني
    new Choices(select, {
        searchEnabled: true,
        searchPlaceholderValue: 'ابحث ...',
        noResultsText: 'لا توجد نتائج',
        itemSelectText: 'اضغط للاختيار',
        callbackOnCreateTemplates: function(template) {
            return {
                item: (classNames, data) => {
                    const flag = `https://flagcdn.com/16x12/${data.value.toLowerCase()}.png`;
                    return template(`
                        <div class="${classNames.item} ${data.highlighted ? classNames.highlightedState : classNames.itemSelectable}" data-item data-id="${data.id}" data-value="${data.value}" ${data.active ? 'aria-selected="true"' : ''} ${data.disabled ? 'aria-disabled="true"' : ''}>
                            <img src="${flag}" style="margin-left: 8px; vertical-align: middle;" onerror="this.style.display='none'">
                            ${data.label}
                        </div>
                    `);
                },
                choice: (classNames, data) => {
                    const flag = `https://flagcdn.com/16x12/${data.value.toLowerCase()}.png`;
                    return template(`
                        <div class="${classNames.item} ${classNames.itemChoice} ${data.disabled ? classNames.itemDisabled : classNames.itemSelectable}" data-select-text="${this.config.itemSelectText}" data-choice ${data.disabled ? 'data-choice-disabled aria-disabled="true"' : 'data-choice-selectable'} data-id="${data.id}" data-value="${data.value}" ${data.groupId > 0 ? 'role="treeitem"' : 'role="option"'}>
                            <img src="${flag}" style="margin-left: 8px; vertical-align: middle;" onerror="this.style.display='none'">
                            ${data.label}
                        </div>
                    `);
                },
            };
        }
    });
});


const firebaseConfig = {
  apiKey: "AIzaSyBQCPTwnybdtLNUwNCzDDA23TLt3pD5zP4",
  authDomain: "omdachina25.firebaseapp.com",
  projectId: "omdachina25",
  storageBucket: "omdachina25.firebasestorage.app",
  messagingSenderId: "1031143486488",
  appId: "1:1031143486488:web:0a662055d970826268bf6d",
};

const app = initializeApp(firebaseConfig);
const messaging = getMessaging(app);

// طلب إذن الإشعارات
Notification.requestPermission().then((permission) => {
  if (permission === 'granted') {
    getToken(messaging, { vapidKey: 'YOUR_VAPID_KEY' })
      .then((currentToken) => {
        // احفظ الـ token في قاعدة البيانات
        fetch('/save-fcm-token', {
          method: 'POST',
          headers: { 'Content-Type': 'application/json' },
          body: JSON.stringify({ token: currentToken })
        });
      });
  }
});

// استقبال الإشعارات
onMessage(messaging, (payload) => {
  console.log('إشعار جديد:', payload);
  // اعرض الإشعار
});