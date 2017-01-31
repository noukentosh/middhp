<h1>Hello {$name}</h1>
{foreach $users as $user}
<ul>
    <li>{$user.login}</li>
    <li>{$user.password}</li>
    <li>{$user.group}</li>
    <li>{$user.token}</li>
</ul>
{/foreach}