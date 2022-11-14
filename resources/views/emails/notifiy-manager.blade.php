<p>Dear <b>{{ $department->manager->name }}</b>,</p>

<p>Thear is new register employee in your department <b>{{ $department->name }}</b></p>

<p>Please go to his <a href="{{ routeHelper("users.show", $user) }}?manager-approve">cover</a> to approve his account</p>

<p>Thank you,</p>
