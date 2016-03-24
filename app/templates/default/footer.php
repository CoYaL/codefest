<?php
/**
 * Sample layout.
 */
use Helpers\Assets;
use Helpers\Hooks;
use Helpers\Url;

//initialise hooks
$hooks = Hooks::get();
?>
<div class="<?php if(\Helpers\Session::get('role') === null) echo 'hidden';?>">
<?php
$users = new Models\Users();
$user = $users->getUserById(\Helpers\Session::get('userID'));

printf('<div class="alert alert-info "><h3>%s</h3></div>', $user->role);

?>
</div>
</div>

<!-- JS -->
<?php

$jsArray = [
    Url::templatePath().'js/jquery.js',
    Url::templatePath().'js/app.js',
    Url::templatePath().'js/bootstrap-datepicker.min.js',
    '//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js',
];

if (isset($data['javascript'])){
    foreach ($data['javascript'] as &$jsFile) {
        $jsArray[] = Url::templatePath() . "js/" . $jsFile . ".js";
    }
}

Assets::js($jsArray);

//hook for plugging in javascript
$hooks->run('js');

//hook for plugging in code into the footer
$hooks->run('footer');
?>

</body>
</html>
