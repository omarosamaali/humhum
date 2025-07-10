@extends('layouts.admin')

@section('title', 'الرئيسية - لوحة التحكم')
@section('page-title', 'الرئيسية')

@push('styles')
<style>
    .stats-card {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        border-radius: 15px;
        padding: 30px;
        margin-bottom: 30px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        transition: transform 0.3s ease;
    }
    
    .stats-card:hover {
        transform: translateY(-5px);
    }
    
    .stats-card .icon {
        font-size: 3rem;
        opacity: 0.8;
        margin-bottom: 15px;
    }
    
    .stats-card .number {
        font-size: 2.5rem;
        font-weight: 700;
        margin-bottom: 10px;
    }
    
    .stats-card .label {
        font-size: 1.1rem;
        opacity: 0.9;
    }
    
    .welcome-section {
        background: white;
        border-radius: 15px;
        padding: 40px;
        margin-bottom: 30px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        text-align: center;
    }
    
    .welcome-section h2 {
        color: #333;
        margin-bottom: 20px;
        font-weight: 600;
    }
    
    .welcome-section p {
        color: #666;
        font-size: 1.1rem;
        line-height: 1.6;
    }
    
    .quick-actions {
        background: white;
        border-radius: 15px;
        padding: 30px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }
    
    .quick-actions h4 {
        color: #333;
        margin-bottom: 25px;
        font-weight: 600;
    }
    
    .action-btn {
        display: block;
        width: 100%;
        padding: 15px 20px;
        margin-bottom: 15px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        text-decoration: none;
        border-radius: 10px;
        transition: all 0.3s ease;
        border: none;
        text-align: right;
    }
    
    .action-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0,0,0,0.2);
        color: white;
    }
    
    .action-btn i {
        margin-left: 10px;
        font-size: 1.2rem;
    }
</style>
@endpush

@section('content')
    <!-- قسم الترحيب -->
    <div class="welcome-section">
        <h2>مرحباً بك في لوحة تحكم الإدارة</h2>
        <p>
            مرحباً <strong>{{ Auth::user()->name }}</strong>، يمكنك من خلال هذه اللوحة إدارة جميع 
            جوانب النظام بسهولة وفعالية. استخدم القوائم الجانبية للوصول إلى الأقسام المختلفة.
        </p>
    </div>

    <div class="row">
        <!-- إحصائيات سريعة -->
        <div class="col-lg-8">
            <div class="row">
                <div class="col-md-6">
                    <div class="stats-card">
                        <div class="icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <div class="number">{{ \App\Models\User::count() }}</div>
                        <div class="label">إجمالي المستخدمين</div>
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="stats-card">
                        <div class="icon">
                            <i class="fas fa-user-check"></i>
                        </div>
                        <div class="number">{{ \App\Models\User::where('status', 'فعال')->count() }}</div>
                        <div class="label">المستخدمين النشطين</div>
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="stats-card">
                        <div class="icon">
                            <i class="fas fa-crown"></i>
                        </div>
                        <div class="number">{{ \App\Models\User::where('role', 'مدير')->count() }}</div>
                        <div class="label">المديرين</div>
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="stats-card">
                        <div class="icon">
                            <i class="fas fa-user-tie"></i>
                        </div>
                        <div class="number">{{ \App\Models\User::where('role', 'مشرف')->count() }}</div>
                        <div class="label">المشرفين</div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="stats-card">
                        <div class="icon">
                            <i class="fas fa-user-friends"></i>
                        </div>
                        <div class="number">{{ \App\Models\User::where('role', 'طاه')->count() }}</div>
                        <div class="label">الطهاه</div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- الإجراءات السريعة -->
        <div class="col-lg-4">
            <div class="quick-actions">
                <h4>
                    <i class="fas fa-bolt ms-2"></i>
                    الإجراءات السريعة
                </h4>
                
                <a href="{{ route('admin.users.index') }}" class="action-btn">
                    <i class="fas fa-users"></i>
                    إدارة المستخدمين
                </a>
                
                {{-- <a href="{{ route('admin.users.create') }}" class="action-btn">
                    <i class="fas fa-user-plus"></i>
                    إضافة مستخدم جديد
                </a>
                
                <a href="#" class="action-btn">
                    <i class="fas fa-chart-bar"></i>
                    عرض التقارير
                </a>
                
                <a href="#" class="action-btn">
                    <i class="fas fa-cog"></i>
                    إعدادات النظام
                </a> --}}
            </div>
        </div>
    </div>
    
    <!-- معلومات إضافية -->
    <div class="row mt-4">
        <div class="col-12">
            <div class="alert alert-info" role="alert">
                <i class="fas fa-info-circle ms-2"></i>
                <strong>نصيحة:</strong> يمكنك الوصول إلى جميع الأقسام من خلال القائمة الجانبية. 
                لا تتردد في استكشاف جميع الميزات المتاحة.
            </div>
        </div>
    </div>
@endsection