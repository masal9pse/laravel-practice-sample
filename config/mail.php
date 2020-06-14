<?php

return [
 // Mail Driver
 'driver' => env('MAIL_DRIVER', 'smtp'),

 // SMTP Host Address
 'host' => env('MAIL_HOST', 'smtp.mailgun.org'),

 // SMTP Host Port
 'port' => env('MAIL_PORT', 587),

 // Global "From" Address
 'from' => [
  'address' => env('MAIL_FROM_ADDRESS', null),
  'name' => env('MAIL_FROM_NAME', null)
 ],

 // E-Mail Encryption Protocol
 'encryption' => env('MAIL_ENCRYPTION', null),

 // SMTP Server Username
 'username' => env('MAIL_USERNAME', null),

 // SMTP Server Password
 'password' => env('MAIL_PASSWORD', null),

 // Sendmail System Path
 'sendmail' => '/usr/sbin/sendmail -bs',

 // Mail "Pretend"
 'pretend' => env('MAIL_PRETEND', false),
];
