Dear {{$user->name}},

your username is: {{$user->email}}
your username is: {{$user->password}}

Click here to active your account {{ url('password/reset/'.$user->id) }}