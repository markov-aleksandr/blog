<?php

namespace Core;

class View
{
    public function generate($contentView, $templateView, $data = null)
    {
        include '../Application/Views/' . $templateView;
    }
}