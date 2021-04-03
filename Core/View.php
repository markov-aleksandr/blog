<?php

namespace Core;

class View
{
    public function generate($contentView, $templateView = 'templateView.php', $data = null, $additionalData = null)
    {
        include '../Application/Views/' . $templateView;
    }

}