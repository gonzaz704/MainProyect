@component('mail::message')

Hello Mr,Mrs.

{{ $user->name }} wants you to join Notidata to publish yours papers so they could be seen by other researchers and they
could also be used to complment the information of some news.

[Click Here you join Notidata]({{ route("register") }})

If you don't want to join you can also approve or refuse the summary he/she did about your paper.


### {{ $paper->titulo }}

@component('mail::button', ['url' => route('paper.view',$paper->id)])
View paper
@endcomponent

@component('mail::button', ['url' => route('papers.verify.confirm',$paper->id)])
Accept
@endcomponent

@component('mail::button', ['url' => route('papers.verify.reject',$paper->id)])
Refuse
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent