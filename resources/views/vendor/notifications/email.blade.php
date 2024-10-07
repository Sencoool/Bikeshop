@component('mail::message')
{{-- Greeting --}}
@if (! empty($greeting))
# {{ $greeting }}
@else
@if ($level === 'error')
# @lang('อุ้ปส์!')
@else
# @lang('สวัสดี!')
@endif
@endif

{{-- Intro Lines --}}

@lang('คุณได้รับอีเมล์นี้เนื่องจากเราได้รับการแจ้งเตือนว่าคุณต้องการรีเซ็ตรหัสผ่านของแอ็คเคาท์คุณ')

{{-- @foreach ($introLines as $line)
{{ $line }}

@endforeach --}}

{{-- Action Button --}}
@isset($actionText)
<?php
    switch ($level) {
        case 'success':
        case 'error':
            $color = $level;
            break;
        default:
            $color = 'primary';
    }
?>
@component('mail::button', ['url' => $actionUrl, 'color' => $color])
@lang('เปลี่ยนรหัสผ่าน')
{{-- {{ $actionText }} --}}
@endcomponent
@endisset

{{-- Outro Lines --}}

@lang('ลิงก์รีเซ็ตรหัสผ่านนี้จะหมดอายุภายใน 60 นาที

หากคุณไม่ได้ขอรีเซ็ตรหัสผ่าน ไม่จำเป็นต้องดำเนินการใด ๆ')

{{-- @foreach ($outroLines as $line)
{{ $line }}

@endforeach --}}

{{-- Salutation --}}
@if (! empty($salutation))
{{ $salutation }}
@else
@lang('ด้วยความเคารพ'),<br>
{{ config('app.name') }}
@endif

{{-- Subcopy --}}
@isset($actionText)
@slot('subcopy')
@lang(
    "ถ้าหากคุณมีปัญหาในการ รีเซ็ตรหัสผ่าน ให้พิมพ์ URL นี้และวางลงไปบน\n".
    'เว็บบราวเซอร์ของคุณ:',
    [
        'actionText' => $actionText,
    ]
) <span class="break-all">[{{ $displayableActionUrl }}]({{ $actionUrl }})</span>
@endslot
@endisset
@endcomponent
