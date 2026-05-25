<?php

class DirectoresView {

    public function renderDirectores($directores) {

        $count = count($directores);

        require_once __DIR__ . '/../templates/directores.phtml';
    }
}