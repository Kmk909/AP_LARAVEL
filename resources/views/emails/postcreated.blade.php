@component('mail::message')
# Introduction

Your Post was successfully created.

@component('mail::button', ['url' => ''])
Click Here
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
