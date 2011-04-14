<?php
/**
 * Build the setup options form.
 *
 * @package pbkdf2convert
 * @subpackage build
 */

$output = '
<label for="pbkdf2-activatePluginMgr">Activate PBKDF2Convert Plugin for mgr Logins:</label>
<input type="checkbox" name="activatePluginMgr" id="pbkdf2-activatePluginMgr" value="1" checked="checked" />
<br />
<label for="pbkdf2-activatePluginWeb">Activate PBKDF2Convert Plugin for web Logins:</label>
<input type="checkbox" name="activatePluginWeb" id="pbkdf2-activatePluginWeb" value="1" />
';

return $output;