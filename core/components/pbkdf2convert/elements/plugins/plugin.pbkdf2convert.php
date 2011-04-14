<?php
if (!empty($user) && $user->get('hash_class') === 'hashing.modMD5' && !empty($password) && $user->passwordMatches($password)) {
    $user->set('hash_class', 'hashing.modPBKDF2');
    $user->set('password', $password);
    $user->save();
}
?>