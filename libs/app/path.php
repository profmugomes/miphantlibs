<?php
// Copyright (C) 2025-2026 Murilo Gomes <profmugomes.com.br>
// SPDX-License-Identifier: MIT

namespace MiPhantLibs\app;

use MiPhantLibs\system\platform;

class path {
    public function join(string ...$values):string {
        return implode(DIRECTORY_SEPARATOR, array_map(function($v) {
            return trim($v, '/\\');
        }, $values));
    }
}