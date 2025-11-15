<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Auth;

class ViewServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        View::share('swalScript', '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>');

        View::composer('*', function ($view) {

            $countryName = session('locale') === 'ar' ? 'غير محدد' : 'Undefined';
            $countries = [];

            if (Auth::check()) {
                $country = strtolower(Auth::user()->country);

                if (session('locale') === 'ar') {
                    $countries = [
                        'af' => 'أفغانستان',
                        'al' => 'ألبانيا',
                        'dz' => 'الجزائر',
                        'ad' => 'أندورا',
                        'ao' => 'أنغولا',
                        'ar' => 'الأرجنتين',
                        'au' => 'أستراليا',
                        'at' => 'النمسا',
                        'bh' => 'البحرين',
                        'bd' => 'بنغلاديش',
                        'be' => 'بلجيكا',
                        'br' => 'البرازيل',
                        'ca' => 'كندا',
                        'cn' => 'الصين',
                        'co' => 'كولومبيا',
                        'cu' => 'كوبا',
                        'cy' => 'قبرص',
                        'cz' => 'التشيك',
                        'dk' => 'الدنمارك',
                        'eg' => 'مصر',
                        'fr' => 'فرنسا',
                        'de' => 'ألمانيا',
                        'gr' => 'اليونان',
                        'hk' => 'هونغ كونغ',
                        'hu' => 'المجر',
                        'in' => 'الهند',
                        'id' => 'إندونيسيا',
                        'iq' => 'العراق',
                        'ir' => 'إيران',
                        'ie' => 'أيرلندا',
                        'il' => 'إسرائيل',
                        'it' => 'إيطاليا',
                        'jp' => 'اليابان',
                        'jo' => 'الأردن',
                        'kw' => 'الكويت',
                        'lb' => 'لبنان',
                        'ly' => 'ليبيا',
                        'ma' => 'المغرب',
                        'my' => 'ماليزيا',
                        'mx' => 'المكسيك',
                        'nl' => 'هولندا',
                        'nz' => 'نيوزيلندا',
                        'ng' => 'نيجيريا',
                        'no' => 'النرويج',
                        'om' => 'سلطنة عُمان',
                        'pk' => 'باكستان',
                        'ps' => 'فلسطين',
                        'ph' => 'الفلبين',
                        'pl' => 'بولندا',
                        'pt' => 'البرتغال',
                        'qa' => 'قطر',
                        'ro' => 'رومانيا',
                        'ru' => 'روسيا',
                        'sa' => 'السعودية',
                        'sd' => 'السودان',
                        'sy' => 'سوريا',
                        'se' => 'السويد',
                        'ch' => 'سويسرا',
                        'tn' => 'تونس',
                        'tr' => 'تركيا',
                        'ua' => 'أوكرانيا',
                        'ae' => 'الإمارات العربية المتحدة',
                        'gb' => 'المملكة المتحدة',
                        'us' => 'الولايات المتحدة الأمريكية',
                        'ye' => 'اليمن',
                    ];
                } else {
                    $countries = [
                        'af' => 'Afghanistan',
                        'al' => 'Albania',
                        'dz' => 'Algeria',
                        'ad' => 'Andorra',
                        'ao' => 'Angola',
                        'ar' => 'Argentina',
                        'au' => 'Australia',
                        'at' => 'Austria',
                        'bh' => 'Bahrain',
                        'bd' => 'Bangladesh',
                        'be' => 'Belgium',
                        'br' => 'Brazil',
                        'ca' => 'Canada',
                        'cn' => 'China',
                        'co' => 'Colombia',
                        'cu' => 'Cuba',
                        'cy' => 'Cyprus',
                        'cz' => 'Czech Republic',
                        'dk' => 'Denmark',
                        'eg' => 'Egypt',
                        'fr' => 'France',
                        'de' => 'Germany',
                        'gr' => 'Greece',
                        'hk' => 'Hong Kong',
                        'hu' => 'Hungary',
                        'in' => 'India',
                        'id' => 'Indonesia',
                        'iq' => 'Iraq',
                        'ir' => 'Iran',
                        'ie' => 'Ireland',
                        'il' => 'Israel',
                        'it' => 'Italy',
                        'jp' => 'Japan',
                        'jo' => 'Jordan',
                        'kw' => 'Kuwait',
                        'lb' => 'Lebanon',
                        'ly' => 'Libya',
                        'ma' => 'Morocco',
                        'my' => 'Malaysia',
                        'mx' => 'Mexico',
                        'nl' => 'Netherlands',
                        'nz' => 'New Zealand',
                        'ng' => 'Nigeria',
                        'no' => 'Norway',
                        'om' => 'Oman',
                        'pk' => 'Pakistan',
                        'ps' => 'Palestine',
                        'ph' => 'Philippines',
                        'pl' => 'Poland',
                        'pt' => 'Portugal',
                        'qa' => 'Qatar',
                        'ro' => 'Romania',
                        'ru' => 'Russia',
                        'sa' => 'Saudi Arabia',
                        'sd' => 'Sudan',
                        'sy' => 'Syria',
                        'se' => 'Sweden',
                        'ch' => 'Switzerland',
                        'tn' => 'Tunisia',
                        'tr' => 'Turkey',
                        'ua' => 'Ukraine',
                        'ae' => 'United Arab Emirates',
                        'gb' => 'United Kingdom',
                        'us' => 'United States',
                        'ye' => 'Yemen',
                    ];
                }

                $countryName = $countries[$country] ?? (session('locale') === 'ar' ? 'غير محدد' : 'Undefined');
            }

            $view->with([
                'countryName' => $countryName,
                'countries' => $countries,
            ]);
        });
    }
}
