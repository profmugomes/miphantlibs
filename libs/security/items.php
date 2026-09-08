<?php
// Copyright (C) 2025-2026 Murilo Gomes <profmugomes.com.br>
// SPDX-License-Identifier: MIT

namespace MiPhantLibs\security;

class items {
    public function clean(?string $valor) : string|int|null {
        if (is_null($valor)) {
            $txt = '';
        } else {
            $txt = trim($valor);
            $txt = strip_tags($txt);
            $txt = addslashes($txt);
        }

        return $txt;
    }
}