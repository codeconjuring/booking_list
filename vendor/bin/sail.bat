@ECHO OFF
setlocal DISABLEDELAYEDEXPANSION
SET BIN_TARGET=%~dp0/../laravel/sail/bin/sail
<<<<<<< HEAD
SET COMPOSER_RUNTIME_BIN_DIR=%~dp0
=======
SET COMPOSER_BIN_DIR=%~dp0
>>>>>>> e10096cb739d7b8b8acd2b5c95085ad53e862f7f
bash "%BIN_TARGET%" %*
