<?php

namespace MusicStation\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class MusicStationUserBundle extends Bundle
{
    public function getParent()
    {
        return 'FOSUserBundle';
    }
}
