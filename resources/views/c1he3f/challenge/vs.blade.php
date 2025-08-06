@extends('layouts.chef')
@section('content')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css" />
<script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/feather-icons@4.29.0/dist/feather.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<style>
    .plus-btn {
        position: fixed;
        bottom: 30px;
        text-align: center;
        left: 20px;
        z-index: 99999;
        background-color: black;
        color: white;
        width: 50px;
        height: 50px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 37px;
    }

    .swiper-wrapper {
        height: fit-content !important;
    }

    .accept-challenge {
        background: var(--primary);
        color: white;
        border-radius: 12px;
        padding: 3px 15px;
        position: relative;
        top: 14px;
    }

</style>

<body style="direction: rtl;">
    <div class="page-wrapper">
        <div id="preloader">
            <div class="loader">
                <div class="spinner-border text-primary" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
            </div>
        </div>
        <header class="header header-fixed">
            <div class="header-content">
                <div class="right-content">
                    <a href="{{ route('challenge.all-vs') }}" class="accept-challenge" style="position: relative; top: 0px;">
                        تحدياتي
                    </a>
                </div>
                <div class="mid-content">
                    <h4 class="title">جميع التحديات</h4>
                </div>
                <div class="left-content">
                    <a href="{{ url('/') }}" class="back-btn">
                        <i class="feather icon-arrow-left"></i>
                    </a>
                </div>
            </div>
        </header>
        <main class="page-content space-top">
            <div class="container">
                @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
                @endif
                <div class="dz-custom-swiper">
                    <div thumbsSlider="" class="swiper mySwiper dz-tabs-swiper">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide">
                                <h5 class="title">تحديات الطهاة</h5>
                            </div>
                            <div class="swiper-slide">
                                <h5 class="title">تحديات المستخدمين</h5>
                            </div>
                            <div class="swiper-slide">
                                <h5 class="title">طبخاتي</h5> {{-- أضف تبويبة لـ "طبخاتي" --}}
                            </div>
                        </div>
                    </div>
                    <div class="swiper mySwiper2 dz-tabs-swiper2">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide">
                                <ul class="featured-list">
                                    @foreach ($chefChallenges as $challenge)
                                    <li>
                                        <div class="swiper-slide" style="position: relative;">
                                            <a href="{{ route('challenge.show', $challenge->id) }}" style="color: white;">
                                                <div class="dz-categories-bx" style="padding: 0px !important; height: 112px; margin-top: 40px; margin-bottom: 30px; display: flex; justify-content: space-between; align-items: center;">
                                                    <div style="height: 100%; padding: 10px 20px;
											border-top-right-radius: 15px;
											width: 50%;
											background-color: #a50707; color: white;">
                                                        <p style="margin-bottom: 0px;">
                                                        </p>
                                                        <h3 style=" flex-direction: column;
							width: 100px;
												z-index: 999999;
													display: flex;
													align-items: center;
													justify-content: center;
													top: 9px;
												position: relative;
													font-size: 15px; color: rgb(255, 255, 255); font-weight: normal;">
                                                            <p style="font-size: 28px;"> {{ $challenge->responses_count }} </p>

                                                            <span>قبل التحدي</span>
                                                        </h3>
                                                        <p></p>
                                                    </div>

                                                    <div>
                                                        <div style="    left: 37%;
    position: absolute;
    top: -16px;
 z-index: 99999999999999;">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="100" height="130" viewBox="0 0 1396 1931" fill="none">
                                                                <g clip-path="url(#clip0_104_2)">
                                                                    <path d="M0 0L646.256 487.552L523.514 475.391L680.506 661.206L536.805 700.415L225.945 332.478L299.954 339.809L0 0Z" fill="#C15D0C"></path>
                                                                    <path d="M81.79 75.7466L607.633 472.493L497.103 461.526L668.578 664.445L548.676 697.176L252.3 346.343L327.217 353.787L81.79 75.7466Z" fill="#18062C"></path>
                                                                    <path d="M193.968 179.621L554.754 451.809L460.922 442.49L652.22 668.935L565.034 692.687L288.481 365.38L364.591 372.937L193.968 179.621Z" fill="url(#paint0_linear_104_2)"></path>
                                                                    <path d="M193.968 179.621L554.754 451.809L460.922 442.49L652.22 668.935L565.034 692.687L288.481 365.38L364.591 372.937L193.968 179.621Z" fill="url(#paint1_linear_104_2)"></path>
                                                                    <path d="M193.968 179.621L388.844 385.325L311.939 377.71L575.655 689.789L565.034 692.687L288.481 365.38L364.591 372.937L193.968 179.621Z" fill="#D97F04"></path>
                                                                    <path d="M1396 1931L787.344 1397.19L908.837 1418.39L765.931 1221.49L912.131 1192.97L1195.1 1582.78L1121.83 1570.05L1396 1931Z" fill="#C15D0C"></path>
                                                                    <path d="M1320 1849.4L824.718 1415.09L934.169 1434.19L778.029 1219.16L900.033 1195.35L1169.83 1567.04L1095.65 1554.08L1320 1849.4Z" fill="#18062C"></path>
                                                                    <path d="M1215.78 1737.57L875.95 1439.64L968.816 1455.78L794.671 1215.87L883.391 1198.59L1135.12 1545.39L1059.81 1532.26L1215.78 1737.57Z" fill="url(#paint2_linear_104_2)"></path>
                                                                    <path d="M1215.78 1737.57L875.95 1439.64L968.816 1455.78L794.671 1215.87L883.391 1198.59L1135.12 1545.39L1059.81 1532.26L1215.78 1737.57Z" fill="url(#paint3_linear_104_2)"></path>
                                                                    <path d="M1215.78 1737.57L1036.52 1518.06L1112.63 1531.36L872.599 1200.7L883.391 1198.59L1135.12 1545.39L1059.81 1532.26L1215.78 1737.57Z" fill="#D97F04"></path>
                                                                    <path d="M1396 0L749.744 487.552L872.486 475.391L715.494 661.206L859.195 700.415L1170.05 332.478L1096.05 339.809L1396 0Z" fill="#C15D0C"></path>
                                                                    <path d="M1314.21 75.7466L788.367 472.493L898.897 461.526L727.422 664.445L847.324 697.176L1143.7 346.343L1068.78 353.787L1314.21 75.7466Z" fill="#18062C"></path>
                                                                    <path d="M1202.03 179.621L841.246 451.809L935.078 442.49L743.78 668.935L830.966 692.687L1107.52 365.38L1031.41 372.937L1202.03 179.621Z" fill="url(#paint4_linear_104_2)"></path>
                                                                    <path d="M1202.03 179.621L841.246 451.809L935.078 442.49L743.78 668.935L830.966 692.687L1107.52 365.38L1031.41 372.937L1202.03 179.621Z" fill="url(#paint5_linear_104_2)"></path>
                                                                    <path d="M1202.03 179.621L1007.16 385.325L1084.06 377.71L820.345 689.789L830.966 692.687L1107.52 365.38L1031.41 372.937L1202.03 179.621Z" fill="#D97F04"></path>
                                                                    <path d="M0 1931L608.656 1397.19L487.163 1418.39L630.069 1221.49L483.869 1192.97L200.897 1582.78L274.168 1570.05L0 1931Z" fill="#C15D0C"></path>
                                                                    <path d="M75.9966 1849.4L571.282 1415.09L461.831 1434.19L617.97 1219.16L495.967 1195.35L226.173 1567.04L300.352 1554.08L75.9966 1849.4Z" fill="#18062C"></path>
                                                                    <path d="M180.223 1737.57L520.05 1439.64L427.184 1455.78L601.329 1215.87L512.609 1198.59L260.877 1545.39L336.192 1532.26L180.223 1737.57Z" fill="url(#paint6_linear_104_2)"></path>
                                                                    <path d="M180.223 1737.57L520.05 1439.64L427.184 1455.78L601.329 1215.87L512.609 1198.59L260.877 1545.39L336.192 1532.26L180.223 1737.57Z" fill="url(#paint7_linear_104_2)"></path>
                                                                    <path d="M180.223 1737.57L359.48 1518.06L283.369 1531.36L523.401 1200.7L512.609 1198.59L260.877 1545.39L336.192 1532.26L180.223 1737.57Z" fill="#D97F04"></path>
                                                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M418.039 1115.23C412.473 1082.67 413.666 1052.16 415.426 1019.48C416.449 1000.67 418.266 976.013 412.416 957.942C405.032 935.042 382.71 921.632 361.183 912.483C333.693 920.325 304.896 918.506 279.28 903.959C219.471 870.035 206.293 789.629 229.638 729.339C244.292 691.494 270.817 654.16 311.541 642.227C315.858 640.977 320.118 640.068 324.435 639.443L332.159 634.272C379.245 602.564 465.068 596.881 520.674 600.745L530.557 601.427C571.112 578.357 615.812 559.377 661.592 549.888C678.632 546.365 700.84 543.012 718.391 544.262L740.372 545.796C751.845 540.398 763.376 534.659 775.417 529.033C830.455 503.406 877.711 502.781 937.293 512.838C971.77 518.635 1003.18 534.545 1026.98 560.287L1035.56 569.606C1059.58 569.663 1084.57 577.561 1107.97 592.563C1169.94 632.283 1195.44 704.904 1163.69 773.036C1142.96 817.53 1108.31 850.545 1060.26 862.989C1047.54 866.285 1032.2 868.274 1017.55 868.16C999.886 894.072 979.665 928.28 971.884 954.135C958.025 1000.16 950.925 1049.03 949.108 1097.05C948.312 1117.39 948.142 1140.12 950.13 1160.41L950.471 1163.99L950.016 1167.51C947.233 1190.41 925.706 1198.48 906.906 1204.1C888.901 1209.5 869.93 1213.42 851.414 1216.89C798.307 1226.83 742.928 1233.03 688.912 1235.13C634.84 1237.23 572.872 1235.7 520.618 1220.87C510.451 1217.97 500.284 1214.73 490.514 1210.75C440.475 1190.47 425.139 1156.43 418.153 1115.4L418.039 1115.23Z" fill="black"></path>
                                                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M382.37 886.742C472.623 930.042 443.656 992.833 446.325 1073.98C447.745 1117.85 445.303 1109.09 477.053 1096.2C489.606 1091.08 499.659 1086.19 505.396 1069.32C515.62 1039.37 536.01 968.228 528.57 894.981C528.57 894.981 549.812 917.484 530.501 1032.67C522.379 1081.25 511.303 1076.08 551.46 1071.93C584.857 1068.47 589.799 1076.53 601.67 1028.29C608.429 1000.84 614.563 963 610.587 924.359C610.587 924.359 626.32 941.009 612.916 1025.39C605.305 1073.24 595.195 1063.24 638.248 1068.52C667.045 1072.1 676.19 1076.02 684.028 1037.38C687.322 1021.13 689.651 1001.13 687.549 980.729C687.549 980.729 700.67 994.594 684.142 1071.02C781.949 1083.07 864.25 1115.12 864.25 1115.12C601.443 1065.51 511.473 1096.25 480.632 1123.58C439.396 1160.18 497.501 1180.69 529.365 1189.73C661.195 1227.18 916.164 1178.02 917.925 1163.53C917.925 1163.53 907.247 1056.53 940.872 944.702C954.674 898.732 1001.7 834.35 1001.7 834.35C1001.7 834.35 1091.05 852.136 1134.33 759.285C1162.16 699.563 1132.17 646.375 1090.48 619.611C1047.94 592.336 1000.4 594.381 970.805 638.761C970.805 638.761 974.554 599.666 1003.18 582.107C990.003 567.844 967.283 550.513 931.841 544.546C867.885 533.807 830.569 538.807 788.935 558.184C747.302 577.561 705.668 602.223 649.267 605.462C649.267 605.462 695.388 592.79 716.062 576.368C716.062 576.368 646.484 571.481 543.053 631.374C543.053 631.374 498.921 676.492 489.151 711.723C489.151 711.723 483.585 671.776 518.403 632.908C518.403 632.908 403.669 624.953 350.108 661.036C371.124 668.537 380.836 685.243 380.836 685.243C326.48 649.898 281.893 683.538 259.628 741.044C228.502 821.337 282.177 910.324 361.979 878.161C361.979 878.161 397.365 837.589 452.232 833.554C452.232 833.554 400.318 846.397 382.256 886.799L382.37 886.742ZM465.807 664.9C465.807 664.9 449.335 735.021 486.255 790.538C453.539 756.501 441.895 701.949 465.807 664.9ZM453.198 660.184C453.198 660.184 425.31 705.018 437.862 752.239C423.151 720.929 427.866 680.299 453.198 660.184ZM483.017 825.542C483.017 825.542 542.599 794.118 676.474 789.743C708.111 788.72 699.818 791.448 716.687 763.092C713.052 782.128 722.651 785.936 738.271 789.118C767.749 795.141 817.051 790.538 835.34 719.565C842.724 769.457 803.589 777.185 858.003 778.435C925.252 780.026 970.237 767.468 981.938 688.937C981.938 688.937 984.891 729.452 970.748 760.308C970.748 760.308 1009.71 725.02 1009.71 665.525C1028.11 754.91 950.471 797.755 1005.51 800.255C1026.64 801.221 1069.86 772.07 1069.86 772.07C1069.86 772.07 1039.59 804.858 1007.55 812.302C1007.55 812.302 1044.3 818.723 1076.68 800.312C1076.68 800.312 1037.88 833.838 990.003 819.973C914.631 793.095 902.078 802.415 795.41 802.812C723.162 803.096 594.797 800.994 483.017 825.428V825.542Z" fill="white"></path>
                                                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M649.267 605.519C779.109 618.645 859.82 505.679 984.834 600.177C989.378 593.358 995.341 586.937 1003.18 582.107C990.002 567.844 967.34 550.513 931.84 544.546C867.885 533.807 830.568 538.807 788.935 558.184C747.301 577.561 705.668 602.223 649.267 605.462V605.519Z" fill="#CBCBCB"></path>
                                                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M970.805 638.818C1099.62 602.28 1155.97 718.031 1110.36 796.164C1119.16 786.39 1127.34 774.286 1134.39 759.285C1162.22 699.563 1132.23 646.318 1090.54 619.611C1047.99 592.335 1000.45 594.381 970.861 638.761L970.805 638.818Z" fill="#CBCBCB"></path>
                                                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M380.893 685.243C412.359 642.057 422.583 643.364 518.402 632.908C518.402 632.908 403.669 624.953 350.165 661.036C371.18 668.537 380.893 685.243 380.893 685.243Z" fill="#CBCBCB"></path>
                                                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M380.893 685.243C326.536 649.898 281.949 683.538 259.684 741.044C255.879 750.932 253.323 760.933 251.959 770.877C251.959 770.877 280.075 664.218 380.893 685.3V685.243Z" fill="#CBCBCB"></path>
                                                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M852.436 767.013C842.496 765.422 836.873 730.361 835.623 721.61C841.701 769.684 804.327 777.241 858.059 778.548C925.309 780.139 970.293 767.581 981.994 688.993C963.534 785.481 863.796 768.831 852.436 767.013Z" fill="#CBCBCB"></path>
                                                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M1060.15 807.699C1018.06 819.348 1041.29 796.391 1041.29 796.391C1031.3 803.21 1019.54 809.574 1007.55 812.359C1007.55 812.359 1032.94 816.791 1060.15 807.699Z" fill="#CBCBCB"></path>
                                                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M1005.51 800.312C1026.64 801.278 1069.86 772.127 1069.86 772.127C992.275 812.188 996.875 766.729 1003.12 743.658C989.605 780.367 970.066 798.721 1005.51 800.312Z" fill="#CBCBCB"></path>
                                                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M812.847 765.933C748.835 811.45 716.63 763.149 716.63 763.149C712.995 782.185 722.594 785.992 738.214 789.175C759.172 793.493 790.071 792.357 812.847 765.933Z" fill="#CBCBCB"></path>
                                                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M477.053 1096.14C489.605 1091.02 499.659 1086.14 505.395 1069.26C514.029 1044.09 529.819 989.764 530.16 929.587C525.048 986.013 493.638 1079.6 446.836 1090.4C447.802 1115.06 450.13 1107.11 477.053 1096.14Z" fill="#CBCBCB"></path>
                                                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M611.098 970.046C611.098 970.046 601.613 1038.97 558.332 1071.31C585.595 1069.32 590.651 1072.95 601.669 1028.23C605.702 1011.87 609.508 991.753 611.098 970.046Z" fill="#CBCBCB"></path>
                                                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M688.174 1004.77C683.914 1034.43 664.034 1059.43 640.86 1068.81C667.613 1072.22 676.473 1074.83 684.084 1037.33C686.072 1027.61 687.663 1016.47 688.23 1004.77H688.174Z" fill="#CBCBCB"></path>
                                                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M864.25 1115.12C790.355 1063.12 692.775 1084.43 690.332 1036.42C689.026 1046.19 687.038 1057.67 684.141 1071.02C781.949 1083.07 864.25 1115.12 864.25 1115.12Z" fill="#CBCBCB"></path>
                                                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M448.313 977.604C459.162 909.301 391.287 880.889 452.346 833.497C452.346 833.497 400.432 846.34 382.37 886.742C432.921 911.006 446.098 941.35 448.313 977.66V977.604Z" fill="#CBCBCB"></path>
                                                                    <path d="M912.643 948.339L912.302 948.055C906.395 943.054 899.863 938.452 892.65 934.247L953.651 848.499L925.65 825.712C909.348 811.62 889.355 800.653 866.181 793.038C844.882 785.708 822.219 781.958 798.818 781.958C780.074 781.958 762.637 784.458 746.62 789.459L749.63 780.821H606.781L563.273 923.848L520.334 780.821H375.44L504.714 1150.18H621.208L643.246 1086.88L660.115 1102.67C702.885 1140.29 751.959 1159.38 806.088 1159.38C845.563 1159.38 879.983 1148.02 905.656 1126.48C919.231 1115.57 930.307 1101.54 937.691 1085.68C944.848 1069.94 948.483 1053.01 948.483 1035.28C948.483 998.969 936.101 968.909 912.699 948.396L912.643 948.339Z" fill="black"></path>
                                                                    <path d="M520.277 1128.07L406.452 802.869H503.862L563.046 1000.05L623.026 802.869H718.505L605.418 1128.07H520.22H520.277Z" fill="url(#paint8_linear_104_2)"></path>
                                                                    <path d="M806.032 1137.28C757.128 1137.28 712.825 1119.72 674.599 1086.08L662.785 1075L714.756 1012.72L727.763 1023.8C740.77 1035.28 754.118 1044.03 767.863 1049.43C780.87 1055.17 794.217 1057.84 807.565 1057.84C819.379 1057.84 828.581 1055.57 835.056 1050.96C839.657 1047.5 841.928 1043.29 841.928 1037.61C841.928 1031.93 839.997 1028.46 835.794 1025.39C831.193 1021.93 820.515 1016.58 796.83 1010.85C774.679 1005.9 758.264 1000.9 746.393 996.299C733.784 991.355 722.708 984.82 712.768 977.206C702.09 968.796 693.684 958.454 688.345 945.896C683.403 934.076 680.677 919.927 680.677 904.243C680.677 888.56 683.744 874.07 689.481 861.796C695.615 848.783 704.759 837.702 716.63 828.951C738.782 812.529 766.67 804.119 798.761 804.119C818.982 804.119 839.259 807.188 859.138 814.063C879.018 820.541 896.966 830.088 911.45 842.703L923.662 852.647L877.428 917.597L863.682 904.982C856.81 898.845 846.87 893.504 834.658 889.299C822.049 884.696 809.042 882.821 796.83 882.821C786.152 882.821 777.348 884.753 770.873 888.958C767.408 890.89 765.137 893.901 765.137 900.777C765.137 906.914 767.068 910.721 771.612 913.79C775.417 916.461 788.026 922.598 823.923 931.349C856.412 939.361 880.836 950.442 898.046 964.989C916.789 981.411 926.331 1005.11 926.331 1035.28C926.331 1050.17 923.264 1063.92 917.528 1076.53C911.791 1088.75 902.987 1100.23 891.571 1109.38C869.817 1127.73 840.792 1137.28 806.032 1137.28Z" fill="url(#paint9_linear_104_2)"></path>
                                                                    <path d="M529.819 1114.66L425.366 816.28H493.866L562.99 1046.47L632.966 816.28H699.647L595.933 1114.66H529.819Z" fill="url(#paint10_linear_104_2)"></path>
                                                                    <path d="M806.032 1123.87C760.877 1123.87 719.698 1107.79 683.63 1076.14L681.188 1073.86L716.346 1031.76L719.016 1034.03C733.386 1046.7 748.154 1056.13 762.694 1061.82C776.951 1068.07 792.059 1071.25 807.565 1071.25C822.162 1071.25 834.033 1068.12 842.837 1061.93L843.178 1061.7C851.3 1055.62 855.447 1047.5 855.447 1037.61C855.447 1027.72 851.641 1020.22 843.803 1014.54C835.851 1008.57 821.083 1002.89 800.125 997.833C780.188 993.344 763.83 988.684 751.391 983.854C740.543 979.592 730.603 973.91 721.118 966.636C711.803 959.306 705.1 950.782 700.84 940.725C696.524 930.496 694.252 917.881 694.252 904.3C694.252 890.719 696.864 878.047 701.749 867.592C706.918 856.682 714.642 847.306 724.696 839.805C744.575 825.087 769.51 817.587 798.818 817.587C818.357 817.587 837.157 820.655 854.765 826.792C873.849 833.043 889.923 841.794 902.703 852.931L905.486 855.204L875.383 897.538L872.827 895.208C864.421 887.708 853.118 881.571 839.089 876.74C825.968 871.967 811.712 869.524 796.887 869.524C783.312 869.524 772.52 872.138 763.944 877.593C755.822 882.309 751.732 890.151 751.732 900.948C751.732 911.744 755.822 919.529 764.228 925.098C772.18 930.667 791.832 937.429 820.799 944.532C851.357 952.089 873.793 962.147 889.412 975.387C904.918 989.025 912.927 1009.31 912.927 1035.45C912.927 1048.07 910.371 1060.11 905.316 1071.19C900.318 1081.82 892.65 1091.54 883.164 1099.15L882.88 1099.38C863.398 1115.8 837.498 1124.1 805.975 1124.1L806.032 1123.87Z" fill="url(#paint11_linear_104_2)"></path>
                                                                </g>
                                                                <defs>
                                                                    <linearGradient id="paint0_linear_104_2" x1="1228.21" y1="1331.47" x2="176.536" y2="143.671" gradientUnits="userSpaceOnUse">
                                                                        <stop stop-color="#FFE700"></stop>
                                                                        <stop offset="0.52" stop-color="#E5B90E"></stop>
                                                                        <stop offset="0.99" stop-color="#FFE600"></stop>
                                                                    </linearGradient>
                                                                    <linearGradient id="paint1_linear_104_2" x1="239.672" y1="102.037" x2="546.095" y2="626.699" gradientUnits="userSpaceOnUse">
                                                                        <stop offset="0.02" stop-color="#FFE700"></stop>
                                                                        <stop offset="0.21" stop-color="#FDE200"></stop>
                                                                        <stop offset="0.4" stop-color="#F9D600"></stop>
                                                                        <stop offset="0.59" stop-color="#F1C201"></stop>
                                                                        <stop offset="0.78" stop-color="#E7A602"></stop>
                                                                        <stop offset="0.98" stop-color="#DA8203"></stop>
                                                                        <stop offset="0.99" stop-color="#D97F04"></stop>
                                                                    </linearGradient>
                                                                    <linearGradient id="paint2_linear_104_2" x1="264.683" y1="512.095" x2="1226.45" y2="1773.97" gradientUnits="userSpaceOnUse">
                                                                        <stop stop-color="#FFE700"></stop>
                                                                        <stop offset="0.52" stop-color="#E5B90E"></stop>
                                                                        <stop offset="0.99" stop-color="#FFE600"></stop>
                                                                    </linearGradient>
                                                                    <linearGradient id="paint3_linear_104_2" x1="1160.5" y1="1810.85" x2="893.317" y2="1265.07" gradientUnits="userSpaceOnUse">
                                                                        <stop offset="0.02" stop-color="#FFE700"></stop>
                                                                        <stop offset="0.21" stop-color="#FDE200"></stop>
                                                                        <stop offset="0.4" stop-color="#F9D600"></stop>
                                                                        <stop offset="0.59" stop-color="#F1C201"></stop>
                                                                        <stop offset="0.78" stop-color="#E7A602"></stop>
                                                                        <stop offset="0.98" stop-color="#DA8203"></stop>
                                                                        <stop offset="0.99" stop-color="#D97F04"></stop>
                                                                    </linearGradient>
                                                                    <linearGradient id="paint4_linear_104_2" x1="164.937" y1="1330.45" x2="1216.62" y2="142.704" gradientUnits="userSpaceOnUse">
                                                                        <stop stop-color="#FFE700"></stop>
                                                                        <stop offset="0.52" stop-color="#E5B90E"></stop>
                                                                        <stop offset="0.99" stop-color="#FFE600"></stop>
                                                                    </linearGradient>
                                                                    <linearGradient id="paint5_linear_104_2" x1="1153.54" y1="101.062" x2="847.052" y2="625.675" gradientUnits="userSpaceOnUse">
                                                                        <stop offset="0.02" stop-color="#FFE700"></stop>
                                                                        <stop offset="0.21" stop-color="#FDE200"></stop>
                                                                        <stop offset="0.4" stop-color="#F9D600"></stop>
                                                                        <stop offset="0.59" stop-color="#F1C201"></stop>
                                                                        <stop offset="0.78" stop-color="#E7A602"></stop>
                                                                        <stop offset="0.98" stop-color="#DA8203"></stop>
                                                                        <stop offset="0.99" stop-color="#D97F04"></stop>
                                                                    </linearGradient>
                                                                    <linearGradient id="paint6_linear_104_2" x1="1132.21" y1="513.379" x2="170.448" y2="1775.31" gradientUnits="userSpaceOnUse">
                                                                        <stop stop-color="#FFE700"></stop>
                                                                        <stop offset="0.52" stop-color="#E5B90E"></stop>
                                                                        <stop offset="0.99" stop-color="#FFE600"></stop>
                                                                    </linearGradient>
                                                                    <linearGradient id="paint7_linear_104_2" x1="236.454" y1="1812.18" x2="503.586" y2="1266.41" gradientUnits="userSpaceOnUse">
                                                                        <stop offset="0.02" stop-color="#FFE700"></stop>
                                                                        <stop offset="0.21" stop-color="#FDE200"></stop>
                                                                        <stop offset="0.4" stop-color="#F9D600"></stop>
                                                                        <stop offset="0.59" stop-color="#F1C201"></stop>
                                                                        <stop offset="0.78" stop-color="#E7A602"></stop>
                                                                        <stop offset="0.98" stop-color="#DA8203"></stop>
                                                                        <stop offset="0.99" stop-color="#D97F04"></stop>
                                                                    </linearGradient>
                                                                    <linearGradient id="paint8_linear_104_2" x1="406.452" y1="965.5" x2="718.505" y2="965.5" gradientUnits="userSpaceOnUse">
                                                                        <stop offset="0.02" stop-color="#FFE700"></stop>
                                                                        <stop offset="0.21" stop-color="#FDE200"></stop>
                                                                        <stop offset="0.4" stop-color="#F9D600"></stop>
                                                                        <stop offset="0.59" stop-color="#F1C201"></stop>
                                                                        <stop offset="0.78" stop-color="#E7A602"></stop>
                                                                        <stop offset="0.98" stop-color="#DA8203"></stop>
                                                                        <stop offset="0.99" stop-color="#D97F04"></stop>
                                                                    </linearGradient>
                                                                    <linearGradient id="paint9_linear_104_2" x1="662.728" y1="970.671" x2="926.331" y2="970.671" gradientUnits="userSpaceOnUse">
                                                                        <stop offset="0.02" stop-color="#FFE700"></stop>
                                                                        <stop offset="0.21" stop-color="#FDE200"></stop>
                                                                        <stop offset="0.4" stop-color="#F9D600"></stop>
                                                                        <stop offset="0.59" stop-color="#F1C201"></stop>
                                                                        <stop offset="0.78" stop-color="#E7A602"></stop>
                                                                        <stop offset="0.98" stop-color="#DA8203"></stop>
                                                                        <stop offset="0.99" stop-color="#D97F04"></stop>
                                                                    </linearGradient>
                                                                    <linearGradient id="paint10_linear_104_2" x1="562.592" y1="810.597" x2="559.863" y2="1038.35" gradientUnits="userSpaceOnUse">
                                                                        <stop offset="0.02" stop-color="#FFE700"></stop>
                                                                        <stop offset="0.21" stop-color="#FDE200"></stop>
                                                                        <stop offset="0.4" stop-color="#F9D600"></stop>
                                                                        <stop offset="0.59" stop-color="#F1C201"></stop>
                                                                        <stop offset="0.78" stop-color="#E7A602"></stop>
                                                                        <stop offset="0.98" stop-color="#DA8203"></stop>
                                                                        <stop offset="0.99" stop-color="#D97F04"></stop>
                                                                    </linearGradient>
                                                                    <linearGradient id="paint11_linear_104_2" x1="799.897" y1="813.382" x2="797.225" y2="1041.13" gradientUnits="userSpaceOnUse">
                                                                        <stop offset="0.02" stop-color="#FFE700"></stop>
                                                                        <stop offset="0.21" stop-color="#FDE200"></stop>
                                                                        <stop offset="0.4" stop-color="#F9D600"></stop>
                                                                        <stop offset="0.59" stop-color="#F1C201"></stop>
                                                                        <stop offset="0.78" stop-color="#E7A602"></stop>
                                                                        <stop offset="0.98" stop-color="#DA8203"></stop>
                                                                        <stop offset="0.99" stop-color="#D97F04"></stop>
                                                                    </linearGradient>
                                                                    <clipPath id="clip0_104_2">
                                                                        <rect width="1396" height="1931" fill="white"></rect>
                                                                    </clipPath>
                                                                </defs>
                                                            </svg>
                                                        </div>
                                                    </div>
                                                    <!-- <div style="    left: 137px;
				    background-color: black;
				    height: 98%;
				    position: absolute;
				width: 20%;    top: 1px;
				    z-index: 1;
				
											">
							</div> -->

                                                    <div style="padding: 10px 20px;
																		width: 50%;

											border-top-left-radius: 15px;
											background-color: black; color: white;     z-index: 99999;
">


                                                        <div style="display: flex; justify-content: center;">
                                                            <div class="dz-item-rating" style="border-radius: 50px; background-color: #e00000; font-size: 17px; overflow: hidden; line-height: unset; border: 2px solid #e00000;">
                                                                <img src="{{ asset('storage/' . $challenge->chef->chefProfile?->official_image) }}" style="

																	width: 30px; 
																					height: 30px;" alt="">
                                                            </div>
                                                            <h5 style="font-size: 10px; color: gray; text-align: center; align-items: center; justify-content: center; display: flex; margin-right: 10px;">
                                                                {{ $challenge->chef->name }}</h5>
                                                        </div>
                                                        <span style="align-items: center; justify-content: center; 
										display: flex;">{{ $challenge->name }}</span>
                                                        <p style="margin-bottom: 14px;
    margin-top: 18px;

    text-align: center;"><style>
        .countdown {
            font-size: 15px;
            color: rgb(255, 255, 255);
            font-weight: bold;
            background-color: #000;
            /* لمحاكاة الخلفية المظلمة في الصورة */
            padding: 5px 10px;
            border-radius: 5px;
            display: inline-block;
        }

    </style>

                                                            {{-- <sub style="font-size: 15px; color: rgb(255, 255, 255); font-weight: bold;">
                                                                10 : 60 : 59 : 50 --}}
                                                                <sub id="countdown-timer" style="font-size: 15px;">جاري الحساب...</sub>

<script>
    // تمرير end_date من Laravel Blade
    const endDateStr = "{{ $challenge->end_date }}T23:59:59"; // أضف وقتًا افتراضيًا (11:59:59 مساءً)
    const endDate = new Date(endDateStr).getTime();

    // التحقق من صحة التاريخ
    if (isNaN(endDate)) {
        document.getElementById("countdown-timer").innerHTML = "تاريخ غير صحيح";
        throw new Error("تاريخ الانتهاء غير صالح: " + endDateStr);
    }

    // تحديث العداد كل ثانية
    const countdownTimer = setInterval(() => {
        const now = new Date().getTime();
        const distance = endDate - now;

        // إذا انتهى الوقت
        if (distance < 0) {
            clearInterval(countdownTimer);
            document.getElementById("countdown-timer").innerHTML = "انتهى الوقت";
            return;
        }

        // الحسابات
        const days = Math.floor(distance / (1000 * 60 * 60 * 24));
        const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        const seconds = Math.floor((distance % (1000 * 60)) / 1000);

        // عرض الوقت بنفس التنسيق
        document.getElementById("countdown-timer").innerHTML =
            `${days} : ${hours.toString().padStart(2, '0')} : ${minutes.toString().padStart(2, '0')} : ${seconds.toString().padStart(2, '0')}`;
    }, 1000);

</script>

                                                            {{-- </sub> --}}
                                                        </p>
                                                        <span style="align-items: center; justify-content: center; display: flex; font-size: 12px;">
                                                            {{-- {{ $challenge->challenge_type = 'users' ? 'للمستخدمين' : 'للطهاه' }} --}}
                                                            {{ $challenge->challenge_type == 'users' ? 'للمستخدمين' : 'للطهاة' }}

                                                        </span>


                                                    </div>
                                                </div>
                                            </a>
                                        </div>

                                        <div class="swiper-slide" style="position: relative;">
                                            <a href="{{ route('challenge.show', $challenge->id) }}" style="color: white;">


                                                <div class="dz-categories-bx" style="padding: 0px !important; background-color: transparent; height: 50px; margin-top: -40px; margin-bottom: 30px; display: flex; justify-content: space-between; align-items: center;">
                                                    <a href="{{ route('challenge.show', $challenge->id) }}" style="height: 100%; padding: 10px 20px;

							width: 50%;     justify-content: center;
    display: flex
;
    text-align: center;

																			border-bottom-right-radius: 15px;
																			background-color: #a50707; color: white;">

                                                        <h3 style=" flex-direction: column;
															width: 100px;
																				z-index: 999999;
																					display: flex;
																					align-items: center;
																					justify-content: center;
																				position: relative;
																					font-size: 15px; color: rgb(255, 255, 255); font-weight: normal;">
                                                            <p style="font-size: 17px;">
                                                                <div style="color: white; position: relative; top: 10px;">عرض التحديات </div>
                                                            </p>
                                                        </h3>
                                                    </a>


                                                    <div style="padding: 10px 20px;
							height: 100%;
							width: 50%; 																					display: flex;
																					align-items: center;
																					justify-content: center;
																					top:25px;

																			border-bottom-left-radius: 15px;
																			background-color: black; color: white;     z-index: 99999;
								">
                                                        <p style="font-size: 17px; position:relative; top: 9px;">
@if ($challenge->challengeResponses->isEmpty())
{{-- إذا لم يتم قبول التحدي بعد --}}
<a href="{{ route('challenge.add-vs', $challenge->id) }}" style="color: white;">إقبل التحدي</a>
@else
{{-- إذا تم قبول التحدي --}}
<span style="color: green; font-weight: bold;">تم قبول التحدي</span>
@endif </p>

                                                    </div>
                                                </div>
                                        </div>

                                    </li>
                                    @endforeach
                                    @if ($chefChallenges->isEmpty())
                                    <li>
                                        <p>لا توجد تحديات طهاة حاليًا.</p>
                                    </li>
                                    @endif
                                </ul>
                            </div>

                            <div class="swiper-slide">
                                <ul class="featured-list">
                                    @foreach ($userChallenges as $challenge)
                                    <li>
                                        <div class="dz-card list">
                                            <div class="dz-media">
                                                @php
                                                $fullPath = asset('storage/' . $challenge->announcement_path);
                                                $fileExtension = pathinfo($challenge->announcement_path, PATHINFO_EXTENSION);
                                                $isVideo = in_array($fileExtension, ['mp4', 'mov', 'ogg', 'webm', 'avi']);
                                                @endphp
                                                @if($isVideo)
                                                <video controls style="height: 186px; object-fit: contain; border-radius: 20px; max-width: 100%; max-height: 100%;">
                                                    <source src="{{ Storage::url($challenge->announcement_path) }}" type="video/{{ $fileExtension }}">
                                                    متصفحك لا يدعم الفيديو.
                                                </video>
                                                @else
                                                <img src="{{ $fullPath }}" alt="صورة التحدي" style="max-width: 100%; max-height: 100%; object-fit: contain;">
                                                @endif
                                            </div>
                                            <div class="dz-content">
                                                <div class="dz-head">
                                                    <h6 class="title">
                                                        <a href="{{ route('challenge.show', $challenge->id) }}">{{ $challenge->message }}</a>
                                                    </h6>
                                                    <ul class="tag-list">
                                                        <li>
                                                            <a href="javascript:void(0);" style="flex-direction: row-reverse; display: flex; align-items: center; gap: 5px;">
                                                                {{ \Carbon\Carbon::parse($challenge->start_at)->format('Y-m-d h:i A') }}
                                                                <i class="feather icon-calendar"></i>
                                                            </a>
                                                            <a href="javascript:void(0);" style="flex-direction: row-reverse; display: flex; align-items: center; gap: 5px;">
                                                                {{ \Carbon\Carbon::parse($challenge->end_at)->format('Y-m-d h:i A') }}
                                                                <i class="feather icon-calendar"></i>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                    <ul class="tag-list">
                                                        <li class="dz-price" style="text-align: center; font-size: 14px;">
                                                            <i class="fa-solid fa-user" style="color: var(--primary);"></i>
                                                            {{ $challenge->challenge_type == 'users' ? 'للمستخدمين' : 'للطهاة' }}
                                                            
                                                        </li>
                                                    </ul>
                                                    @if($challenge->recipe)
                                                    <ul class="tag-list">
                                                        <li class="dz-price" style="text-align: center; font-size: 14px;">
                                                            <i class="fa-solid fa-utensils" style="color: var(--primary);"></i>
                                                            {{ $challenge->recipe?->title }}
                                                        </li>
                                                    </ul>
                                                    @endif
                                                    @if ($challenge->has_responded)
                                                    <span class="accepted-challenge-text">تم قبول التحدي</span>
                                                    @else
                                                    {{-- Check if it's a 'users' challenge --}}
                             {{-- الكود اللي بيعرض الزر --}}
                             @if (Auth::check() && Auth::user()->id != $challenge->user_id)
                             {{-- لو التحدي لسه ما اتقبلش --}}
                             @if ($challenge->challengeResponses->isEmpty())
                             @if ($challenge->challenge_type == 'users')
                             <a href="javascript:void(0);" class="dz-btn prevent-user-challenge-acceptance accept-challenge" data-challenge-id="{{ $challenge->id }}">
                                 إقبل التحدي
                             </a>
                             @else
                             <a href="{{ route('challenge.add-vs', $challenge->id) }}" id="accept-challenge-{{ $challenge->id }}" class="accept-challenge dz-btn accept-challenge">
                                 إقبل التحدي
                             </a>
                             @endif
                             @else
                             {{-- لو التحدي اتقبل بالفعل، نعرض الرسالة --}}
                             <a href="javascript:void(0);" class="dz-btn accepted-challenge-btn">
                                 تم قبول التحدي
                             </a>
                             @endif
                             @endif

                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    @endforeach
                                    @if ($userChallenges->isEmpty())
                                    <li>
                                        <p>لا توجد تحديات مستخدمين حاليًا.</p>
                                    </li>
                                    @endif
                                </ul>
                            </div>

                            <div class="swiper-slide">
                                <ul class="featured-list">
                                    @foreach ($myCookings as $response)
                                    <li>
                                        <div class="dz-card list">
                                            <div class="dz-media">
                                                @php
                                                $fullPath = asset('storage/' . $response->recipe_image_path); // افترض أن المسار هو image_path

                                                $fileExtension = pathinfo($response->image_path, PATHINFO_EXTENSION);
                                                $isVideo = in_array($fileExtension, ['mp4', 'mov', 'ogg', 'webm', 'avi']);
                                                @endphp
                                                @if($isVideo)
                                                <video controls style="height: 186px; object-fit: contain; border-radius: 20px; max-width: 100%; max-height: 100%;">
                                                    <source src="{{ Storage::url($challenge->announcement_path) }}" type="video/{{ $fileExtension }}">
                                                    متصفحك لا يدعم الفيديو.
                                                </video>
                                                @else
                                                <img src="{{ $fullPath }}" alt="صورة الطبخ" style="height: 142px; width: 283px;">

                                                @endif
                                            </div>
                                            <div class="dz-content">
                                                <div class="dz-head">
                                                    <h6 class="title">
                                                        <a href="#">{{ $response->message_to_chef }}</a> {{-- يمكن أن يكون هناك مسار لعرض استجابة التحدي --}}

                                                    </h6>
                                                    <ul class="tag-list">
                                                        <li>
                                                            <a href="javascript:void(0);" style="flex-direction: row-reverse; display: flex; align-items: center; gap: 5px;">
                                                                {{ \Carbon\Carbon::parse($response->created_at)->format('Y-m-d h:i A') }}
                                                                <i class="feather icon-calendar"></i>
                                                            </a>
                                                        </li>
                                                    </ul>

                                                    <ul class="tag-list">
                                                        <li class="dz-price" style="text-align: center; font-size: 14px;">
                                                            <i class="fa-solid fa-trophy" style="color: var(--primary);"></i>
                                                            {{ $response->challenge?->message }}
                                                        </li>
                                                    </ul>
                                                    <ul class="tag-list">
                                                        <li class="dz-price" style="text-align: center; font-size: 14px; display: flex; align-items: center; gap: 5px; margin-top: 5px;">
                                                            <img src="{{ asset('storage/' . $challenge->chefProfile->official_image) }}" alt="صورة الشيف" style=" width: 45px;
                                        height: 46px;
                                        border-radius: 50%;
                                        border: 2px solid var(--primary);" alt="صورة الشيف">
                                                            الشيف / {{ $response->challenge?->chef?->name }}
                                                        </li>
                                                    </ul>
                                                    <script>
                                                        document.addEventListener('DOMContentLoaded', function() {
                                                            document.querySelectorAll('.prevent-user-challenge-acceptance').forEach(button => {
                                                                button.addEventListener('click', function(event) {
                                                                    event.preventDefault();
                                                                    Swal.fire({
                                                                        icon: 'warning'
                                                                        , title: 'غير مسموح'
                                                                        , text: 'لا يمكنك الاشتراك في تحديات المستخدمين. من فضلك، اشترك في تحديات الطهاة.'
                                                                        , confirmButtonText: 'حسناً'
                                                                        , customClass: {
                                                                            confirmButton: 'dz-btn'
                                                                        , }
                                                                    });
                                                                });
                                                            });
                                                        });

                                                    </script>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    @endforeach
                                    @if ($myCookings->isEmpty())
                                    <li>
                                        <p>لم تشارك في أي طبخات بعد.</p>
                                    </li>
                                    @endif
                                </ul>
                            </div>

                        </div>
                    </div>
                </div>
                {{-- <a href="{{ route('challenge.all-vs') }}" class="plus-btn">
                <span style="position: relative; top: -4px;">+</span>
                </a> --}}
            </div>
        </main>
    </div>

    <script>
        var swiper = new Swiper(".mySwiper", {
            spaceBetween: 10
            , slidesPerView: 3, // تم تعديلها إلى 3 لو عندك 3 تبويبات
            freeMode: true
            , watchSlidesProgress: true
        , });
        var swiper2 = new Swiper(".mySwiper2", {
            spaceBetween: 10
            , thumbs: {
                swiper: swiper, // تصحيح: كان "swper"
            }
        });

    </script>
</body>
@endsection
