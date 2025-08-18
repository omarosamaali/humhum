<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>رد على بلاغك</title>
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.6; color: #333;">
    <div style="max-width: 600px; margin: 0 auto; padding: 20px; border: 1px solid #ddd; border-radius: 8px;">
        <h2 style="color: #667eea;">رد على بلاغك</h2>
        <p>عزيزي {{ $report->user->name ?? 'المستخدم' }}،</p>
        <p>شكرًا لتقديمك بلاغًا. لقد راجعنا بلاغك المتعلق {{ $report->report_type == 'fake_account' ? 'بحساب وهمي' : 'بالمحتوى أو الرسالة أو التعليق' }}.</p>
        <p><strong>رسالتنا لك:</strong></p>
        <p>{{ $adminMessage }}</p>
        <p>إذا كنت بحاجة إلى مزيد من المساعدة، يرجى التواصل معنا.</p>
        <p>مع أطيب التحيات،<br>فريق الدعم</p>
    </div>
</body>
</html>
