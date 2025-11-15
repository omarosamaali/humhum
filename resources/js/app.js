import './bootstrap';
import Alpine from 'alpinejs';
import Choices from 'choices.js';
import 'choices.js/public/assets/styles/choices.min.css';

window.Alpine = Alpine;
Alpine.start();

import countries from "i18n-iso-countries";
import arLocale from "i18n-iso-countries/langs/ar.json";

countries.registerLocale(arLocale);

document.addEventListener('DOMContentLoaded', function() {
    console.log('DOMContentLoaded fired'); // للتأكد إن الكود شغال
    
    const select = document.querySelector('select[name="country"]');
    console.log('Select element:', select); // تأكد إن الـ select موجود
    
    if (!select) {
        console.error('Select element not found!');
        return;
    }

    // امسح أي options موجودة
    select.innerHTML = '';

    // ضيف option فاضي للبداية
    const emptyOption = document.createElement('option');
    emptyOption.value = '';
    emptyOption.textContent = 'اختر الدولة';
    select.appendChild(emptyOption);

    // جيب كل الدول بالعربي
    const countryObj = countries.getNames("ar", { select: "official" });
    console.log('Countries:', countryObj); // شوف الدول اتجابت ولا لأ
    
    // حول الـ object لـ array ورتبها أبجدياً
    const sortedCountries = Object.entries(countryObj).sort((a, b) => 
        a[1].localeCompare(b[1], 'ar')
    );
    
    console.log('Sorted countries:', sortedCountries.length); // عدد الدول

    // ضيف كل دولة كـ option
    sortedCountries.forEach(([code, name]) => {
        const option = document.createElement('option');
        option.value = code;
        option.textContent = name;
        select.appendChild(option);
    });
    
    console.log('Options added:', select.options.length); // عدد الـ options

    // دلوقتي شغل Choices.js
    const choicesInstance = new Choices(select, {
        searchEnabled: true,
        searchPlaceholderValue: 'ابحث عن دولة...',
        noResultsText: 'لا توجد نتائج',
        itemSelectText: 'اضغط للاختيار',
        shouldSort: false,
        callbackOnCreateTemplates: function(template) {
            return {
                item: (classNames, data) => {
                    if (!data.value) return template(`
                        <div class="${classNames.item}" data-item data-id="${data.id}" data-value="${data.value}">
                            ${data.label}
                        </div>
                    `);
                    
                    const flag = `https://flagcdn.com/16x12/${data.value.toLowerCase()}.png`;
                    return template(`
                        <div class="${classNames.item}" data-item data-id="${data.id}" data-value="${data.value}">
                            <img src="${flag}" style="margin-left: 8px; vertical-align: middle; width: 16px; height: 12px;" onerror="this.style.display='none'">
                            ${data.label}
                        </div>
                    `);
                },
                choice: (classNames, data) => {
                    if (!data.value) return template(`
                        <div class="${classNames.item} ${classNames.itemChoice}" data-choice data-id="${data.id}" data-value="${data.value}">
                            ${data.label}
                        </div>
                    `);
                    
                    const flag = `https://flagcdn.com/16x12/${data.value.toLowerCase()}.png`;
                    return template(`
                        <div class="${classNames.item} ${classNames.itemChoice}" data-choice data-id="${data.id}" data-value="${data.value}">
                            <img src="${flag}" style="margin-left: 8px; vertical-align: middle; width: 16px; height: 12px;" onerror="this.style.display='none'">
                            ${data.label}
                        </div>
                    `);
                },
            };
        }
    });
    
    console.log('Choices initialized:', choicesInstance);
});