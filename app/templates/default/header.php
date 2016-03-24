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
<!DOCTYPE html>
<html lang="<?php echo LANGUAGE_CODE; ?>">
<head>

	<!-- Site meta -->
	<meta charset="utf-8">
	<?php
    //hook for plugging in meta tags
    $hooks->run('meta');
    ?>
	<title><?php echo $data['title'].' - '.SITETITLE; //SITETITLE defined in app/Core/Config.php ?></title>

	<!-- CSS -->
	<?php
    Assets::css([
        '//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css',
        Url::templatePath().'css/style.css',
        Url::templatePath().'css/bootstrap-datepicker.min.css',
        Url::templatePath().'css/font-awesome.min.css',
    ]);

    //hook for plugging in css
    $hooks->run('css');
    ?>

</head>
<body>
<?php
//hook for running code after body tag
$hooks->run('afterBody');
?>
<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <div class="container">
                <ul class="nav navbar-nav">
                    <li><a href="/leave">Verlof</a></li>
                    <li><a href="/hours/registration">Uren</a></li>
                    <li><a href="/hours/overview">Overzicht</a></li>
                    <li><a href="/users">Gebruikers</a></li>
                    <li><a href="/employees">Medewerkers</a></li>
                    <li><a href="/management/leaveRequests">Accorderen</a></li>
                    <li><a href="/holidays">Feestdagen</a></li>
                    <li><a href="/users">Gebruikers</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="/authentication/logout">Uitloggen</a></li>
                </ul>
            </div>
        </div>
    </div>
</nav>

<div class="container">
