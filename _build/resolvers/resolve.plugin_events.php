<?php
/**
 * @package pbkdf2convert
 * @subpackage build
 */
$success = true;
if ($object) {
    $pluginid= $object->get('id');
    if ($pluginid > 0) {
        $events = array();
        switch ($options[xPDOTransport::PACKAGE_ACTION]) {
            case xPDOTransport::ACTION_INSTALL:
            case xPDOTransport::ACTION_UPGRADE:
                if (isset($options['activatePluginMgr']) && !empty($options['activatePluginMgr'])) {
                    $events[] = 'OnManagerAuthentication';
                }
                if (isset($options['activatePluginWeb']) && !empty($options['activatePluginWeb'])) {
                    $events[] = 'OnWebAuthentication';
                }
                if (!empty($events)) {
                    foreach ($events as $eventName) {
                        $event = $object->xpdo->getObject('modEvent',array('name' => $eventName));
                        if ($event) {
                            $pluginEvent = $object->xpdo->getObject('modPluginEvent',array(
                                'pluginid' => $pluginid,
                                'event' => $event->get('name'),
                            ));
                            if (!$pluginEvent) {
                                $pluginEvent= $object->xpdo->newObject('modPluginEvent');
                                $pluginEvent->set('pluginid', $pluginid);
                                $pluginEvent->set('event', $event->get('name'));
                                $pluginEvent->set('priority', 0);
                                $pluginEvent->set('propertyset', 0);
                                $success= $pluginEvent->save();
                            }
                        }
                        unset($event,$pluginEvent);
                    }
                    unset($events,$eventName);
                }
                break;
            case xPDOTransport::ACTION_UNINSTALL: break;
        }
    }
}

return $success;