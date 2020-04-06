<?php

error_reporting(E_ALL);
ini_set("display_errors", 1);

if (!isset($_POST["selectedTheme"])) {
    die("invalid script execution");
}

require_once("./themes.php");

try {
    $selectedTheme=$_POST["selectedTheme"];

    if(!array_key_exists($selectedTheme, $themes)) {
        echo "{\"error\":\"Theme ".$selectedTheme." doesn't exists\", \"status\": \"Failed to change theme\"}";
        exit(-1);
    }

    $selectedThemePath=$themes[$selectedTheme];

    function removeFile($filePath)
    {
        if (file_exists($filePath)) {
            unlink($filePath);
        }
    }

    function createFile($filePath, $contents)
    {
        file_put_contents($filePath, $contents, LOCK_EX);
    }

    function copyFile($themePath)
    {
        global $ADMINER_THEME_PATH;
        copy($themePath, $ADMINER_THEME_PATH);
    }
    
    //Remove themes if existing
    removeFile($THEME_INI_FILE_PATH);
    removeFile($ADMINER_THEME_PATH);

    //Create new theme.ini file
    createFile($THEME_INI_FILE_PATH, $selectedTheme);

    if (strcmp($selectedTheme, "Default Theme") != 0) {
        
        //Copy adminer.css file from corresponding path
        copyFile($selectedThemePath);

    }

    echo "{\"currentTheme\":\"$selectedTheme\", \"currentThemePath\": \"$selectedThemePath\", \"status\": \"changed to theme, ".$selectedTheme."\"}";

} catch (\Exception $ex) {
    error_log($ex->getMessage());
}
