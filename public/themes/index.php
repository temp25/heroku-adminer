<?php

require_once("./themes.php");

$currentTheme = "";

if(file_exists($THEME_INI_FILE_PATH)) {
	global $THEME_INI_FILE_PATH;
	$currentTheme = file_get_contents($THEME_INI_FILE_PATH, true);
}

echo "
<!DOCTYPE html>
<html lang=\"en\">
<head>
    <meta charset=\"UTF-8\">
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">
    <meta http-equiv=\"X-UA-Compatible\" content=\"ie=edge\">
    <title>Adminer theme manager</title>
    <link rel=\"stylesheet\" type=\"text/css\" href=\"css/toastr.min.css\" />
    <script type=\"text/javascript\" src=\"js/jquery-3.4.1.min.js\"></script>
    <script type=\"text/javascript\" src=\"js/toastr.min.js\"></script>
    <script type=\"text/javascript\" src=\"js/app.js\"></script>
</head>
<body>
";

echo "<br/><br/><br/><i>Current Theme: <b><lable id=\"currentTheme\">$currentTheme</lable></b></i><br/>";
echo "<br/><label>Available themes :<label>&emsp;"; //&emsp; means 4 tabs
echo "<select id=\"themes\" onChange=\"themeChangeListener(this)\">";

$i=0;
foreach($themes as $themeName => $themePath){
	$optionTag = "<option value=\"".($i++)."\"";
	
	if($currentTheme == $themeName) {
		$optionTag .= " selected=\"selected\"";
	}

	$optionTag .= ">$themeName</option>";
	echo $optionTag;
}

echo "</select>";

echo "<br/><br/><div style=\"margin-left: 150px\"><button onClick=\"changeTheme()\">Change Theme</button></div><br/>";

echo "
</body>
</html>
";

?>